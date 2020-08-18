<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\CustomerModel;
use App\Models\OrderModel;
use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;

class Order extends Controller
{

    var $db = null;

    public function __construct()
    {
        $this->db = db_connect();
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
        $info = $this->db->table('orders');
        $info->select('*');
        $info->where('order_num', $id);
        $info->join('restaurants', 'restaurants.rest_id = orders.rest_id');
        $info->join('customers', 'customers.cus_id = orders.cus_id');
        $queryInfo = $info->get();

        $orderItems = $this->db->table('order_items');
        $orderItems->select('*');
        $orderItems->where('order_num', $id);
        $orderItems->join('items', 'items.item_id = order_items.item_id');
        $queryOrderItems = $orderItems->get();

        $data = [
            'title' => 'orders',
            'time' => new Time('now', 'America/Chicago', 'en_US'),
            'id' => $id,
            'info' => $queryInfo->getResult(),
            'items' => $queryOrderItems->getResult()
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('order/order_detail', $data);
        echo view('templates/footer');
    }


    public function edit($id = null)
    {
        $order = new OrderModel();
        if ($this->request->getVar('status')) {
            $data = [
                'order_status' => $this->request->getVar('status'),
            ];
            $order->update($id, $data);

            return redirect()->to('/order/view/' . $this->request->getVar('num'));
        }
        return redirect()->to('/order');
    }

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
