<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use App\Models\CustomerModel;


class Dashboard extends Controller
{
    var $db = null;

    public function __construct()
    {
        $this->db = db_connect();
        $this->customer = new CustomerModel();
    }

    public function index()
    {
        $orderT = $this->db->table('orders');
        $orderT->selectSum('order_total');
        $total = $orderT->get();

        $orderT->selectAvg('order_total');
        $average = $orderT->get();

        $query = $this->db->query('SELECT count(rest_id), rest_id FROM orders GROUP BY rest_id ORDER BY count(rest_id) DESC');
        $row = $query->getFirstRow();

        if (!empty($row)) {
            $restT = $this->db->table('restaurants');
            $restT->where('rest_id', $row->rest_id);
            $restName = $restT->get()->getResult()[0]->rest_name;
        }

        $data = [
            'title' => 'overview',
            'time' => new Time('now', 'America/Chicago', 'en_US'),
            'total' => round($total->getResult()[0]->order_total, 2),
            'average' => round($average->getResult()[0]->order_total, 2),
            'totalOrders' => $orderT->countAll(),
            'topRest' => !empty($restName) ? $restName : NULL
        ];


        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('dashboard/overview', $data);
        echo view('templates/footer');
    }

    public function view($name = null)
    {
        echo "Dashboard: " . $name;
        
        
            //  $email = \Config\Services::email();
            // $email->setFrom('omgnorth@tasteolive.com','Olive Mediterranean Grill');
            // $email->setTo('faisal@eatomg.com');
            // $email->setSubject('Merry Christmas!');
            // $email->setMessage(view('templates/email'));
    
            // if(!$email->send(false)){
            //     $email->printDebugger();
            // }
    
            // $email->clear();
        
        // $customers = $this->customer->findAll();
        
        // foreach($customers as $customer){
        //     $email = \Config\Services::email();
        //     $email->setFrom('omgnorth@tasteolive.com','Olive Mediterranean Grill');
        //     $email->setTo($customer['cus_email']);
        //     $email->setSubject('Merry Christmas!');
        //     $email->setMessage(view('templates/email'));
    
        //     if(!$email->send(false)){
        //         $email->printDebugger();
        //     }
    
        //     $email->clear();
                    
        // }
    }

    public function getMonthlyTotal($val = NULL)
    {
        $monthlyDataArray = [];

        if (!is_null($val)) {
            for ($i = 1; $i < 13; $i++) {
                $query = $this->db->query('SELECT SUM(order_total) as s FROM ninetofab.orders WHERE rest_id = ' . $val . ' AND YEAR(placed_at) = 2020 AND MONTH(placed_at) = ' . $i);
                $row = $query->getFirstRow();
                array_push($monthlyDataArray, round($row->s, 2));
            }
        } else {
            for ($i = 1; $i < 13; $i++) {
                $query = $this->db->query('SELECT SUM(order_total) as s FROM ninetofab.orders WHERE YEAR(placed_at) = 2020 AND MONTH(placed_at) = ' . $i);
                $row = $query->getFirstRow();
                array_push($monthlyDataArray, round($row->s, 2));
            }
        }
        echo json_encode($monthlyDataArray);
    }

    public function getTopSeller()
    {

        $labels = [];
        $data = [];

        $query = "SELECT count(t.item_id) ,
        t.item_name, t.item_id
        FROM (SELECT order_items.item_id, items.item_name
        FROM order_items
        JOIN items
        ON order_items.item_id = items.item_id) as t group by 
        t.item_id order by count(t.item_id) desc";

        $query = $this->db->query($query);

        $rows = $query->getResult();
        // item_id

        foreach ($rows as $row) {
            $query2 = "SELECT sum(t.total) as total, t.item_name FROM (SELECT order_items.item_id ,
            order_items.order_item_quantity,
            items.item_name,items.item_price, 
            (order_items.order_item_quantity * items.item_price) as total
            FROM order_items
            JOIN items
            ON order_items.item_id = items.item_id) as t WHERE t.item_id = " . $row->item_id;
            $query2 = $this->db->query($query2);
            foreach ($query2->getResult() as $result) {
                array_push($labels, $result->item_name);
                array_push($data, (float) $result->total);
            }
        }

        $data = [$labels, $data];
        echo json_encode($data);
    }

    public function getTimingData()
    {
        $labels = [
            '12AM', '1AM', '2AM', '3AM', '4AM', '5AM', '6AM', '7AM', '8AM', '9AM', '10AM', '11AM',
            '12PM', '1PM', '2PM', '3PM', '4PM', '5PM', '6PM', '7PM', '8PM', '9PM', '10PM', '11PM'
        ];
        $data = array_fill(0, 24, 0);

        $time = new Time('now', 'America/Chicago', 'en_US');
        $today = $time->setTime(0, 0, 0);

        $time = new Time('now +1 day', 'America/Chicago', 'en_US');
        $tommorow = $time->setTime(0, 0, 0);

        $query = "SELECT 
        HOUR(placed_at) 'hr', COUNT(DISTINCT order_id) 'count'
        FROM ninetofab.orders
        WHERE placed_at BETWEEN '$today' AND '$tommorow'
        GROUP BY hr;";

        $query = $this->db->query($query);
        $rows = $query->getResult();

        foreach ($rows as $val) {
            $data[intval($val->hr)] = $val->count;
        }
        $max = max($data);
        $labels = array_slice($labels, 8, 23);
        $data = array_slice($data, 8, 23);

        $data = [$labels, $data, $max];
        echo json_encode($data);
    }
}
