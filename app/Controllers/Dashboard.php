<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\I18n\Time;
use App\Models\CustomerModel;
use App\Models\RestaurantModel;


class Dashboard extends Controller
{
    var $db = null;

    public function __construct()
    {
        $this->db = db_connect();
        $this->customer = new CustomerModel();
        $this->restaurant = new RestaurantModel();
    }

    public function index()
    {
        $params = $this->request->getGet();
        unset($params['start']);
        unset($params['end']);

        $params['business_id'] = $_SESSION['user_business'];

        $order = $this->db->table('orders');
        $total = $order->where($params)->selectSum('order_total')->get();
        $average = $order->where($params)->selectAvg('order_total')->get();
        $topRest = $this->db->query('SELECT count(rest_id), rest_id FROM orders WHERE business_id = ' . $_SESSION['user_business'] . ' GROUP BY rest_id ORDER BY count(rest_id) DESC');
        $topRest = $topRest->getFirstRow();
        $start = !empty($this->request->getGet('start')) ? $this->request->getGet('start') : date("Y-m-d", strtotime("2019-01-01"));
        $end = !empty($this->request->getGet('end')) ? $this->request->getGet('end') : date("Y-m-d");

        if (!empty($topRest)) {
            $topRest = $this->restaurant->where('rest_id', $topRest->rest_id)->first();
            $topRest = $topRest['rest_name'];
        }

        $data = [
            'title' => !empty($params['rest_id']) ? $this->restaurant->where('rest_id', $params['rest_id'])->first()['rest_name'] : 'overview',
            'time' => new Time('now', 'America/Chicago', 'en_US'),
            'total' => round($total->getResult()[0]->order_total, 2),
            'average' => round($average->getResult()[0]->order_total, 2),
            'totalOrders' => $order->where($params)->countAllResults(),
            'topRest' => !empty($topRest) ? $topRest : NULL,
            'restaurants' => $this->restaurant->where(['business_id' => $_SESSION['user_business']])->orderBy('priority', 'ASC')->findAll(),
            'monthlyData' => !empty($params['rest_id']) ? $this->getMonthlyTotal($params['rest_id'], date('Y')) : $this->getMonthlyTotal(NULL, date('Y')),
            'topSellerItems' => !empty($params['rest_id']) ? $this->getTopSeller($params['rest_id']) : $this->getTopSeller(),
            'orderTiming' => !empty($params['rest_id']) ? $this->getTimingData($params['rest_id']) : $this->getTimingData(),
            'start' => $start,
            'end' => $end,
        ];

        echo view('templates/header', $data);
        echo view('templates/nav', $data);
        echo view('dashboard/overview', $data);
        echo view('templates/footer');
    }

    public function getStats()
    {
        $params = $this->request->getGet();
        $params['placed_at >='] = $params['start'];
        $params['placed_at <='] = $params['end'];
        unset($params['start']);
        unset($params['end']);

        $order = $this->db->table('orders');
        $earnings = $order->where($params)->selectSum('order_total')->get();
        $averageOrder = $order->where($params)->selectAvg('order_total')->get();
        $topRest = $this->db->query('SELECT count(rest_id), rest_id FROM orders WHERE business_id = ' . $_SESSION['user_business'] . ' GROUP BY rest_id ORDER BY count(rest_id) DESC');
        $topRest = $topRest->getFirstRow();
        if (!empty($topRest)) {
            $topRest = $this->restaurant->where('rest_id', $topRest->rest_id)->first();
            $topRest = $topRest['rest_name'];
        }

        $data = [
            'total' => round($earnings->getResult()[0]->order_total, 2),
            'average' => round($averageOrder->getResult()[0]->order_total, 2),
            'totalOrders' => $order->where($params)->countAllResults(),
            'topRest' => !empty($topRest) ? $topRest : NULL,
        ];

        echo json_encode($data);
    }

    public function getMonthlyTotal($restId = NULL, $year = NULL)
    {
        $year = $this->request->getGet('year') ? $this->request->getGet('year') : $year;
        $restId = $this->request->getGet('restId') ? $this->request->getGet('restId') : $restId;

        $monthlyDataArray = [];
        for ($i = 1; $i < 13; $i++) {
            $query = ($restId) ?
                $this->db->query('SELECT SUM(order_total) as s FROM ninetofab.orders WHERE rest_id = ' . $restId . ' AND YEAR(placed_at) = ' . $year . ' AND MONTH(placed_at) = ' . $i) :
                $this->db->query('SELECT SUM(order_total) as s FROM ninetofab.orders WHERE YEAR(placed_at) = ' . $year . ' AND MONTH(placed_at) = ' . $i);
            $row = $query->getFirstRow();
            array_push($monthlyDataArray, round($row->s, 2));
        }
        echo json_encode($monthlyDataArray);
        return $monthlyDataArray;
    }

    public function getTopSeller($restId = NULL)
    {
        $items = [];
        $orderItemsJoinItems = "SELECT order_items.item_id, items.item_name, items.rest_id, items.category_id
        FROM ninetofab.order_items
        JOIN ninetofab.items
        ON order_items.item_id = items.item_id";

        if ($restId) {
            $orderItemsJoinItems = $orderItemsJoinItems . " where rest_id=" . $restId;
        }

        $top10 = "SELECT count(t.item_id) as total_sold ,
        t.item_name, t.item_id, t.rest_id, t.category_id, category_name
        FROM ( " . $orderItemsJoinItems . ") as t 
        JOIN ninetofab.category
		ON t.category_id = category.category_id
        group by t.item_id 
        order by count(t.item_id) DESC 
        limit 10";

        $top10 = $this->db->query($top10);
        $top10 = $top10->getResult();

        foreach ($top10 as $row) {
            $top10value = "SELECT sum(t.total) as total, t.item_name FROM (SELECT order_items.item_id ,
            order_items.order_item_quantity,
            items.item_name,items.item_price, 
            (order_items.order_item_quantity * items.item_price) as total
            FROM order_items
            JOIN items
            ON order_items.item_id = items.item_id) as t WHERE t.item_id = " . $row->item_id;
            $top10value = $this->db->query($top10value);

            foreach ($top10value->getResult() as $result) {
                $item['item_name'] = $row->item_name;
                $item['category_name'] = $row->category_name;
                $item['total_sold'] = $row->total_sold;
                $item['total_value'] = (float) $result->total;
                array_push($items, $item);
            }
        }
        return $items;
    }

    public function getTimingData($restId = NULL)
    {
        $data = array_fill(0, 24, 0);

        $today = new Time('now', 'America/Chicago', 'en_US');
        $today = $today->setTime(0, 0, 0);
        $tommorow = new Time('now +1 day', 'America/Chicago', 'en_US');
        $tommorow = $tommorow->setTime(0, 0, 0);

        $condition = $restId ? "AND rest_id = $restId" : "";

        $ordersByHour = "SELECT 
        HOUR(placed_at) 'hr', COUNT(DISTINCT order_id) 'count'
        FROM ninetofab.orders
        WHERE (placed_at BETWEEN '$today' AND '$tommorow' " . $condition . ")
        GROUP BY hr;";
        $ordersByHour = $this->db->query($ordersByHour);
        $ordersByHour = $ordersByHour->getResult();

        foreach ($ordersByHour as $order) {
            $data[intval($order->hr)] = $order->count;
        }

        $max = max($data);
        $data = array_slice($data, 8, 23);
        $data = [$data, $max];
        return $data;
    }
}
