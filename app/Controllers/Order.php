<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\CustomerModel;
use App\Models\OrderModel;
use App\Models\OrderItemModifierModel;
use App\Models\OrderItemAddonModel;

use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class Order extends Controller
{

    var $db, $order_item_modifier, $order_item_addon, $order = null;

    public function __construct()
    {
        $this->db = db_connect();
        $this->order_item_modifier = new OrderItemModifierModel();
        $this->order_item_addon = new OrderItemAddonModel();
        $this->order = new OrderModel();
    }


    public function index()
    {
        $builder = $this->db->table('orders');
        $builder->select('*');
        $builder->join('restaurants', 'restaurants.rest_id = orders.rest_id');
        $builder->join('customers', 'customers.cus_id = orders.cus_id');
        $query = $builder->get();

        $data = [
            'title' => 'orders',
            'orders'  => $query->getResult(),
            'time' => new Time('now', 'America/Chicago', 'en_US')
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
        $order['is_complete'], $order['order_payment_type'],
        $order['cus_country'], $order['cus_zip']);

        $data['order'] = $order;


        $items = $this->db->table('order_items');
        $items = $items->select('order_items.order_item_id,order_items.order_item_quantity,items.item_name,items.item_price')
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
            return redirect()->to('/order/view/' . $request['num']);
        }
        return redirect()->to('/order');
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
}
