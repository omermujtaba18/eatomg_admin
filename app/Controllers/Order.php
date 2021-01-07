<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\CustomerModel;
use App\Models\OrderModel;
use App\Models\OrderItemModifierModel;
use App\Models\OrderItemAddonModel;
use App\Models\RestaurantModel;

use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

use \PayPalCheckoutSdk\Core\PayPalHttpClient;
use \PayPalCheckoutSdk\Core\SandboxEnvironment;
use \PayPalCheckoutSdk\Core\ProductionEnvironment;
use \PayPalCheckoutSdk\Payments\CapturesRefundRequest;
use \PayPalHttp\HttpException;

use DateTime;

use App\Helpers\TextMessage;

class Order extends Controller
{

    var $db, $order_item_modifier, $order_item_addon, $order, $customer, $restaurant, $time, $session = null;

    public function __construct()
    {
        $this->db = db_connect();
        $this->order_item_modifier = new OrderItemModifierModel();
        $this->order_item_addon = new OrderItemAddonModel();
        $this->order = new OrderModel();
        $this->customer = new CustomerModel();
        $this->restaurant = new RestaurantModel();
        $this->time = new Time('now', 'America/Chicago', 'en_US');
    }


    public function index()
    {
        $restId = $this->request->getGet('rest_id');

        $start = !empty($this->request->getGet('start')) ? $this->request->getGet('start') : date("Y-m-d");
        $endGet = !empty($this->request->getGet('end')) ? $this->request->getGet('end') : date("Y-m-d");

        $end = !empty($this->request->getGet('end')) ?
            date_format(date_add(date_create($this->request->getGet('end')), date_interval_create_from_date_string("1 days")), 'Y-m-d')
            : date_format(date_add(date_create(), date_interval_create_from_date_string("1 days")), 'Y-m-d');

        $builder = $this->db->table('orders');
        $builder->select('*');
        $builder->join('customers', 'customers.cus_id = orders.cus_id');
        $builder->where('orders.rest_id', $restId);
        $builder->where('placed_at >=', $start);
        $builder->where('placed_at <=', $end);
        $query = $builder->get();

        $data = [
            'title' => 'orders',
            'orders'  => $query->getResult(),
            'countOrders' => $this->order->where(['rest_id' => $restId, 'placed_at >=' => $start, 'placed_at <=' => $end])->countAllResults(),
            'time' => $this->time,
            'rest_id' => $this->request->getGet('rest_id'),
            'reload' => 'reload',
            'pending' => $this->order->where(['order_status' => 'Pending', 'rest_id' => $restId, 'placed_at >=' => $start, 'placed_at <=' => $end])->countAllResults(),
            'confirmed' => $this->order->where(['order_status' => 'Confirmed', 'rest_id' => $restId, 'placed_at >=' => $start, 'placed_at <=' => $end])->countAllResults(),
            'ready' => $this->order->where(['order_status' => 'Ready', 'rest_id' => $restId, 'placed_at >=' => $start, 'placed_at <=' => $end])->countAllResults(),
            'delivered' => $this->order->where(['order_status' => 'Delivered', 'rest_id' => $restId, 'placed_at >=' => $start, 'placed_at <=' => $end])->countAllResults(),
            'cancelled' => $this->order->where(['order_status' => 'Cancelled', 'rest_id' => $restId, 'placed_at >=' => $start, 'placed_at <=' => $end])->countAllResults(),
            'start' => $start,
            'end' => $endGet
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('order/order', $data);
        echo view('templates/footer');
    }

    public function view($id = null)
    {
        $order = $this->db->table('orders');
        $order = $order->select('*')->where('order_num', $id)
            ->join('restaurants', 'restaurants.rest_id = orders.rest_id')
            ->join('customers', 'customers.cus_id = orders.cus_id')->get();
        $order = $order->getResult('array')[0];
        unset($order['cus_email'], $order['cus_password'],
        $order['cus_dob'], $order['has_register'],
        $order['rest_location'], $order['rest_id'],
        $order['is_complete'], $order['cus_country'], $order['cus_zip']);

        $data['order'] = $order;


        $items = $this->db->table('order_items');
        $items = $items->select('order_items.order_item_id,order_items.order_item_note,order_items.order_item_quantity,items.item_name,items.item_price')
            ->where('order_id', $order['order_id'])
            ->join('items', 'items.item_id = order_items.item_id')->get();
        $items = $items->getResult('array');

        $data['items'] = $items;

        $items_modified = [];
        foreach ($items as $item) {
            $modifier = $this->db->table('order_item_modifiers');
            $modifier = $modifier->select('modifiers.modifier_item,modifiers.modifier_price')->where('order_item_id', $item['order_item_id'])
                ->join('modifier_group', 'modifier_group.modifier_group_id = order_item_modifiers.modifier_group_id')
                ->join('modifiers', 'modifiers.modifier_id = order_item_modifiers.modifier_id')->get();
            $modifier = $modifier->getResult('array');
            $item['modifier'] = $modifier;

            $addon = $this->db->table('order_item_addons');
            $addon = $addon->select('addon.addon_item,addon.addon_price')->where('order_item_id', $item['order_item_id'])
                ->join('addon_group', 'addon_group.addon_group_id = order_item_addons.addon_group_id')
                ->join('addon', 'addon.addon_id = order_item_addons.addon_id')->get();
            $addon = $addon->getResult('array');
            $item['addon'] = $addon;

            array_push($items_modified, $item);
        }

        $data['items'] = $items_modified;
        $data['title'] = 'orders';
        $data['time'] = new Time('now', 'America/Chicago', 'en_US');
        $data['id'] = $id;
        $data['rest_id'] = $this->request->getGet('rest_id');

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('order/order_detail', $data);
        echo view('templates/footer');
    }

    public function edit($id = null)
    {
        $request = $this->request->getGet();

        if (!empty($id) && !empty($request['status'])) {
            $data = [
                'order_id' => $id,
                'order_status' => $request['status'],
            ];
            if ($request['status'] == "Delivered") {
                $data['is_complete'] = 1;
            }
            $this->order->save($data);

            $order = $this->order->find($id);
            $customer = $this->customer->find($order['cus_id']);
            $restaurant = $this->restaurant->find($order['rest_id']);

            $this->sendMessage($customer, $order, $restaurant, $request['status']);

            return redirect()->to('/order/view/' . $request['num'] . '?rest_id=' . $this->request->getGet('rest_id'));
        }
        return redirect()->to('/order?rest_id=' . $this->request->getGet('rest_id'));
    }


    public function cancelOrder($id)
    {
        if ($this->request->getGet('status') == 'Cancelled') {
            $order = $this->order->where('order_id', $id)->first();
            $cancel = false;

            switch ($order['order_payment_type']) {
                case 'CARD':
                    $responseCard = $this->cancelCardOrder($order['payment_id']);
                    $cancel = $responseCard['status'] == 'succeeded' ? true : false;
                    break;
                case 'PAYPAL':
                    $responsePaypal = $this->cancelPaypalOrder($order['payment_id']);
                    $cancel = $responsePaypal->statusCode == 201 ? true : false;
                    break;
                default:
                    break;
            }

            if ($cancel) {
                $this->order->save([
                    'order_id' => $id,
                    'order_status' => 'Cancelled',
                ]);
            }

            return redirect()->to('/order/view/' . $this->request->getGet('num') . '?rest_id=' . $this->request->getGet('rest_id'));
        }
    }


    public function cancelCardOrder($paymentId)
    {
        \Stripe\Stripe::setApiKey(getEnv('STRIPE_SECRET_KEY'));
        $intent = \Stripe\PaymentIntent::retrieve($paymentId);
        $chargeId = $intent->charges->data[0]->id;
        $refund = \Stripe\Refund::create([
            'charge' => $chargeId,
            'reverse_transfer' => true,
        ]);

        return $refund;
    }

    public function cancelPaypalOrder($paymentId)
    {
        $environment = getEnv('CI_ENVIRONMENT') == 'development' ?
            new SandboxEnvironment(getEnv('CLIENT_ID_D'), getEnv('CLIENT_SECRET_D')) : new ProductionEnvironment(getEnv('CLIENT_ID'), getEnv('CLIENT_SECRET'));
        $client = new PayPalHttpClient($environment);
        $request = new CapturesRefundRequest($paymentId);

        try {
            $response = $client->execute($request);
            return $response;
        } catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
    }

    //Useless method
    public function create()
    {
        $customerModel = new CustomerModel();
        $categoryModel = new CategoryModel();
        $orderModel = new OrderModel();

        if ($this->request->getPost()) {
            $orderNum = round(microtime(true) * 1000);

            $subtotal = 0;
            foreach ($this->request->getPost('price') as $index => $value) {
                $subtotal += ($value * $this->request->getPost('quantity')[$index]);

                $modifier = "modifier" . ($index + 1);
                $modifierString = '';
                if ($this->request->getPost($modifier)) {
                    $modifierString = (implode(",", $this->request->getPost($modifier)));
                }

                $db = $this->db->table('order_items');
                $data = [
                    'order_num' => $orderNum,
                    'item_id'  => $this->request->getPost("item")[$index],
                    'order_item_quantity'  => $this->request->getPost("quantity")[$index],
                    'modifier' => $modifierString
                ];
                $db->insert($data);
            }
            $orderModel->save([
                'order_num' => $orderNum,
                'cus_id' => $this->request->getPost('customer_id'),
                'order_placed_time' => new Time('now', 'America/Chicago', 'en_US'),
                'order_delivery_time' => new Time('now +30 minute', 'America/Chicago', 'en_US'),
                'order_subtotal' => $subtotal,
                'order_tax' => '0',
                'order_total' => $subtotal,
                'order_status' => 'Pending',
                'order_type' => 'Take Out',
                'order_instruct' => '',
                'rest_id' => $this->request->getPost('rest_id'),
                'order_complete' => '0'
            ]);

            return redirect()->to('/order');
        }

        $data = [
            'title' => 'orders',
            'customers' => $customerModel->findAll(),
            'category' => $categoryModel->findAll(),
            'time' => new Time('now', 'America/Chicago', 'en_US')
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('order/order_add', $data);
        echo view('templates/footer');
    }


    public function sendMessage($customer, $order, $restaurant, $status)
    {
        $deliver_at = new DateTime($order['deliver_at']);

        $msg['Confirmed'] = str_replace(
            ['%customer_name%', '%order_num%', '%deliver_at%'],
            [$customer['cus_name'], $order['order_num'], $deliver_at->format('h:i A')],
            'Dear %customer_name%, Your order (#%order_num%) has been confirmed. Kindly pickup your order by %deliver_at%.'
        );

        $msg['Ready'] = str_replace(
            ['%customer_name%', '%order_num%'],
            [$customer['cus_name'], $order['order_num']],
            'Dear %customer_name%, Your order (#%order_num%) is ready. Kindly pickup your order.'
        );

        $msg['Delivered'] = str_replace('%rest_name%', $restaurant['rest_name'], 'Thank you for ordering today at %rest_name%. Please let us know how was it');

        $msg['Cancelled'] = str_replace(
            ['%customer_name%', '%order_num%'],
            [$customer['cus_name'], $order['order_num']],
            'Dear %customer_name%, Your order (#%order_num%) has been cancelled.'
        );

        $textMessage = new TextMessage();
        $textMessage->sendTextMessage('+1' . $customer['cus_phone'], $msg[$status]);
    }
}
