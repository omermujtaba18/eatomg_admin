<?php

namespace App\Controllers;

use App\Models\AddOnModel;
use App\Models\CategoryModel;
use App\Models\CustomerModel;
use App\Models\ItemModel;
use App\Models\ItemModifierModel;
use App\Models\ItemAddonModel;
use App\Models\ModifierModel;
use App\Models\OrderModel;
use App\Models\AddOnGroupModel;
use App\Models\ModifierGroupModel;
use App\Models\OrderItemModel;
use App\Models\OrderItemModifierModel;
use App\Models\OrderItemAddonModel;
use App\Models\PromotionModel;
use App\Models\RestaurantModel;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;


/** 
 * 1. Login 
 * 2. Register 
 * 3. login facebook
 * 4. login google
 * 5. get_menu
 * 6. get_menu_item
 * 7. check_modifier_addon
 * 8. update_password
 * 9. update_account
 * 10. check_promo
 * 11. order_hisotry
 * 12. place_order
 */


class Api extends Controller
{
    use ResponseTrait;

    var $db, $category, $item, $modifier,
        $order, $customer, $addon, $session, $categories,
        $itemModifier, $itemAddon, $modifierGroup, $addonGroup,
        $order_item, $order_item_modifier, $order_item_addon,
        $promotion, $restaurant, $user;

    public function __construct()
    {
        $this->db = db_connect();
        $this->item = new ItemModel();
        $this->modifier = new ModifierModel();
        $this->category = new CategoryModel();
        $this->order = new OrderModel();
        $this->customer = new CustomerModel();
        $this->addon = new AddOnModel();
        $this->categories = $this->category->findAll();
        $this->itemModifier = new ItemModifierModel();
        $this->itemAddon = new ItemAddonModel();
        $this->modifierGroup = new ModifierGroupModel();
        $this->addonGroup = new AddOnGroupModel();
        $this->order_item = new OrderItemModel();
        $this->order_item_modifier = new OrderItemModifierModel();
        $this->order_item_addon = new OrderItemAddonModel();
        $this->promotion = new PromotionModel();
        $this->restaurant = new RestaurantModel();
        $this->session = session();
    }

    public function check_token()
    {
        $token = $this->request->getGet('token');

        if (!empty($token)) {
            $customer = $this->customer->where('token', $token)->first();
            if (!empty($customer)) {
                $this->user = $customer;
                return 0;
            }
        }
        return $this->fail('Invalid API token', 400);
    }

    public function login_user()
    {
        if ($this->request->getPost()) {
            $email = trim($this->request->getPost('email'));
            $password = trim($this->request->getPost('password'));

            if (empty($email) || empty($password)) {
                return $this->fail('Email or password cannot be empty.', 400);
            }

            $customer = $this->customer->where([
                'cus_email' => $email,
            ])->first();

            if (empty($customer) || password_verify($password, $customer['cus_password'])) {
                return $this->fail('Invalid email or password.', 404);
            }

            if (empty($customer['token'])) {
                $customer['token'] = md5(uniqid($customer['cus_email'], true));
                $this->customer->save([
                    'cus_id' => $customer['cus_id'],
                    'token' => $customer['token']
                ]);
            }

            return $this->respond($customer, 200);
        }
        return $this->fail('Invalid request!', 405);
    }

    public function register_user()
    {
        if ($this->request->getPost()) {

            $name = trim($this->request->getPost('name'));
            $email = trim($this->request->getPost('email'));
            $password = trim($this->request->getPost('password'));

            if (empty($name) || empty($email) || empty($password)) {
                return $this->fail('Name, email or password cannot be empty.', 400);
            }

            $customer = $this->customer->where('cus_email', $this->request->getPost('email'))->first();

            if (!empty($customer)) {
                return $this->fail('Email already exists, Try a different email!', 409);
            }

            $cus_id = $this->customer->insert([
                'cus_name' => $name,
                'cus_email' => $email,
                'cus_password' => password_hash($password, PASSWORD_DEFAULT),
                'token' => md5(uniqid($customer['cus_email'], true)),
                'has_register' => 1
            ]);
            $customer = $this->customer->find($cus_id);
            return $this->respondCreated($customer);
        }
        return $this->fail('Invalid request!', 405);
    }

    // NOT DONE
    public function login_with_facebook()
    {
    }

    // NOT DONE
    public function login_with_google()
    {
    }

    public function get_restaurant()
    {
        if ($this->request->getGet()) {
            $check_token = $this->check_token();
            if ($check_token) {
                return $check_token;
            }

            $type = $this->request->getGet('type');

            if (empty($type)) {
                return $this->fail('Please provide restaurant type', 400);
            }

            $restaurants = $this->restaurant->where('type', $type)->findAll();
            return $this->respond($restaurants);
        }
        return $this->fail('Invalid request!', 405);
    }


    public function get_menu()
    {
        if ($this->request->getGet()) {
            $check_token = $this->check_token();
            if ($check_token) {
                return $check_token;
            }

            $rest_id = $this->request->getGet('rest_id');
            $restaurant = $this->restaurant->find($rest_id);

            if (empty($rest_id) || empty($restaurant)) {
                return $this->fail('`rest_id` is missing', 400);
            }

            $menu = [];
            $categories = $this->category->where('rest_id', $rest_id)->findAll();

            foreach ($categories as $category) {
                $items = $this->item->where('category_id', $category['category_id'])->findAll();
                $obj['title'] = $category['category_name'];
                $obj['data'] = $items;
                array_push($menu, $obj);
            }

            return $this->respond($menu);
        }
        return $this->fail('Invalid request!', 405);
    }

    public function get_menu_item()
    {
        if ($this->request->getGet()) {
            $check_token = $this->check_token();
            if ($check_token) {
                return $check_token;
            }

            $item_id = $this->request->getGet('item_id');
            if (empty($item_id)) {
                return $this->fail('`item_id` is missing!', 400);
            }

            $item = [];
            $item = $this->item->find($item_id);

            if (empty($item)) {
                return $this->fail('Item doesnot exists!', 404);
            }

            $item_modifier = $this->itemModifier->where('item_id', $item['item_id'])->findAll();
            $item_addon = $this->itemAddon->where('item_id', $item['item_id'])->findAll();
            $item['modifier'] = [];
            $item['addon'] = [];

            if (empty($item_addon) && empty($item_modifier)) {
                return $this->respond($item);
            }

            if (!empty($item_modifier)) {
                foreach ($item_modifier as $im) {
                    $modifierGroup = $this->modifierGroup->where('modifier_group_id', $im['modifier_group_id'])->findAll();
                    foreach ($modifierGroup as $mg) {
                        $m['modifier_group_instruct'] = $mg['modifier_group_instruct'];
                        $m['modifier_group_id'] = $mg['modifier_group_id'];

                        $m['modifier'] = $this->modifier->where('modifier_group_id', $mg['modifier_group_id'])->findAll();
                    }
                    array_push($item['modifier'], $m);
                }
            }

            if (!empty($item_addon)) {
                foreach ($item_addon as $ia) {
                    $addonGroup = $this->addonGroup->where('addon_group_id', $ia['addon_group_id'])->findAll();
                    foreach ($addonGroup as $ag) {
                        $a['addon_group_instruct'] = $ag['addon_group_instruct'];
                        $a['addon'] = $this->addon->where('addon_group_id', $ag['addon_group_id'])->findAll();
                    }
                    array_push($item['addon'], $a);
                }
            }

            return $this->respond($item);
        }
        return $this->fail('Invalid request!', 405);
    }

    public function check_modifier_or_addon()
    {
        if ($this->request->getGet()) {
            $check_token = $this->check_token();
            if ($check_token) {
                return $check_token;
            }

            $modifier = $this->itemModifier->where('item_id', $this->request->getGet('item_id'))->findAll();
            $addon = $this->itemAddon->where('item_id', $this->request->getGet('item_id'))->findAll();

            if (empty($modifier) && empty($addon)) {
                return $this->respond(false);
            }
            return $this->respond(true);
        }
        return $this->fail('Invalid request!', 405);
    }

    public function update_password()
    {
        if ($this->request->getGet()) {
            $check_token = $this->check_token();
            if ($check_token) {
                return $check_token;
            }

            $oldpass = trim($this->request->getPost('oldpass'));
            $newpass = trim($this->request->getPost('newpass'));

            if (empty($oldpass) || empty($newpass)) {
                return $this->fail('`oldpass` or `newpass` doesnot exists!', 400);
            }

            if (!password_verify($oldpass, $this->user['cus_password'])) {
                return $this->fail('Invalid password', 404);
            }

            $this->customer->save([
                'cus_id' => $this->user['cus_id'],
                'cus_password' => password_hash($newpass, PASSWORD_DEFAULT),
            ]);
            return $this->respondCreated();
        }
        return $this->fail('Invalid request!', 405);
    }


    public function update_account()
    {
        $check_token = $this->check_token();
        if ($check_token) {
            return $check_token;
        }

        if ($this->request->getPost()) {
            $newData = [
                'cus_id' => $this->user['cus_id'],
                'cus_name' => $this->request->getPost('name'),
                'cus_address' => $this->request->getPost('address'),
                'cus_city' => $this->request->getPost('city'),
                'cus_state' => $this->request->getPost('state'),
                'cus_zip' => $this->request->getPost('zip'),
                'cus_dob' => $this->request->getPost('dob'),
                'cus_phone' => $this->request->getPost('phone')
            ];
            $this->customer->save($newData);
            return $this->respondCreated($this->customer->find($this->user['cus_id']));
        }

        return $this->fail('Invalid request!', 405);
    }

    public function check_promo()
    {
        $check_token = $this->check_token();
        if ($check_token) {
            return $check_token;
        }

        if ($this->request->getPost()) {

            $promo = $this->request->getPost('code');

            if (empty($promo)) {
                return $this->fail('`code` is missing!', 400);
            }

            $promotion = $this->promotion->where('promo_code', $promo)->first();

            if (!empty($promotion)) {
                return $this->fail('`code` doesnot exists!', 404);
            }

            return $this->respond($promotion);
        }

        return $this->fail('Invalid request!', 405);
    }

    public function order_history()
    {
        if ($this->request->getGet()) {
            $check_token = $this->check_token();
            if ($check_token) {
                return $check_token;
            }

            $order = $this->db->table('orders');
            $orders = $order->select('*')->where(['is_complete' => 0, 'cus_id' => $this->user['cus_id']])
                ->join('restaurants', 'restaurants.rest_id = orders.rest_id')->orderBy('order_id', 'DESC')->get();

            $orders = $orders->getResult('array');

            $active_order = [];
            foreach ($orders as $ao) {
                $order_item = $this->db->table('order_items');
                $item = $order_item->select('order_item_id,items.item_id,order_item_quantity,item_name,item_price')
                    ->where('order_id', $ao['order_id'])
                    ->join('items', 'items.item_id = order_items.item_id')->get();
                $ao['items'] = $item->getResult('array');
                array_push($active_order, $ao);
            }

            $orders = $order->select('*')->where(['is_complete' => 1, 'cus_id' => $this->user['cus_id']])
                ->join('restaurants', 'restaurants.rest_id = orders.rest_id')->orderBy('order_id', 'DESC')->get();
            $orders = $orders->getResult('array');

            $past_order = [];
            foreach ($orders as $po) {
                $order_item = $this->db->table('order_items');
                $item = $order_item->select('order_item_id,items.item_id,order_item_quantity,item_name,item_price')
                    ->where('order_id', $po['order_id'])
                    ->join('items', 'items.item_id = order_items.item_id')->get();
                $po['items'] = $item->getResult('array');
                array_push($past_order, $po);
            }


            $history = [
                [
                    'title' => "Active Orders",
                    'data' => $active_order
                ],
                [
                    'title' => "Past Orders",
                    'data' => $past_order
                ]
            ];

            return $this->respond($history);
        }
        return $this->fail('Invalid request!', 405);
    }

    // NOT DONE
    public function place_order()
    {
        $check_token = $this->check_token();
        if ($check_token) {
            return $check_token;
        }
        // if ($this->request->getMethod() == 'post') {
        //     $order_num = round(microtime(true) * 1000);
        //     $cus_id = $this->request->getPost('cus_id');
        //     $rest_id = $this->request->getPost('rest_id');
        //     $cart = $this->session->cart;
        //     $card = [
        //         "cardNumber" => str_replace(' ', '', $this->request->getPost('card_num')),
        //         "expirationDate" => str_replace('/', '-', $this->request->getPost('exp_date')),
        //         "cardCode" => $this->request->getPost('cvv')
        //     ];

        //     $response = $this->order->chargeCard($rest_id, $cart['cart_total'], $card, $cus_id, $order_num);

        //     if ($response[0]) {
        //         $order_id = $this->order->createOrder($cart, $cus_id, $rest_id, 0, 'website', 'card', $order_num);
        //         $this->session->remove('cart');
        //         $this->session->set('order_id', $order_id);
        //         return redirect()->to('/checkout/confirmation');
        //     };

        //     return $this->fail($response[1], 400);
        // }
        return $this->failNotFound();
    }

    /* 
    Cart Object
        {
            items:[
                    [0]: [
                            item_id,
                            item_name,
                            item_price,
                            item_quantity,
                            item_total,
                            modifier: [
                                [0]: [
                                    modifier_group_id,
                                    modifier_group_instruct
                                    modifier_id
                                    modifier_item,
                                    modifier_price
                                ]
                            ],
                            addon:[
                                [0]: [
                                    addon_group_id,
                                    addon_group_instruct
                                    addon_id,
                                    addon_item,
                                    addon_price
                                ]
                            ]
                        ], 
                    ]
                ],
                instruct: "",
                cart_subtotal: ",
                cart_tax:"",
                cart_total:"",
        }
    */
}
