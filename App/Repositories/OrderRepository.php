<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use PDO;

class OrderRepository extends \Core\Model implements OrderInterface
{

    public function allOrder()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT o.id,co.name as country, CONCAT(cu.first_name,\' \', cu.last_name) as customer,o.device,o.buy_date,SUM(p.price*oi.qty) as totalPrice,SUM(oi.qty) as totalQTY
        FROM orders o 
            INNER JOIN country co ON o.country_id = co.id 
            INNER JOIN customer cu ON o.customer_id = cu.id 
            INNER JOIN order_item oi ON oi.order_id = o.id 
            INNER JOIN product p ON oi.product_id = p.id GROUP BY o.id
        ');
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function chartGenerator()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT COUNT(*) as cu_count, cast(created_at as date) as date FROM customer GROUP BY cast(created_at as date)');
        $customer = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $db->query(' SELECT SUM(oi.qty) as or_count, cast(o.buy_date as date) as date FROM orders o INNER JOIN order_item oi ON oi.order_id = o.id GROUP BY cast(o.buy_date as date),oi.order_id');
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result['customer'] = array_fill(0, 30, (int)0);
        $result['order'] = array_fill(0, 30, (int)0);
        for ($i = 30; $i > 0; $i--) {
            $result['dates'][] = date("Y-m-d", strtotime("-$i days"));

            foreach ($customer as $rec) {
                if ($rec['date'] == date("Y-m-d", strtotime("-$i days"))) {
                    $key = array_search($rec['date'], $result['dates']);
                    $result['customer'][$key] = (int)$rec['cu_count'];
                }
            }
            foreach ($orders as $item) {
                if ($item['date'] == date("Y-m-d", strtotime("-$i days"))) {
                    $key = array_search($item['date'], $result['dates']);
                    $result['order'][$key] = (int)$item['or_count'];
                }
            }
        }

        return $result;
    }


    public function getOrderCount($from = null, $to = null)
    {
        $db = static::getDB();
        if ($from) {
            $queryString = 'SELECT COUNT(*) AS count FROM orders WHERE cast(buy_date as date) BETWEEN ? AND ?';
            $statement = [$from, $to];
        } else {
            $queryString = 'SELECT COUNT(*) AS count FROM orders WHERE
            YEAR(buy_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
            AND MONTH(buy_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)';
            $statement = [];
        }

        $stmt = $db->prepare($queryString);
        $stmt->execute($statement);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function getTotalRevenue($from = null, $to = null)
    {
        $db = static::getDB();
        if ($from) {
            $queryString = 'SELECT p.price,oi.qty,o.buy_date FROM order_item oi
            INNER JOIN product p ON oi.product_id = p.id
            INNER JOIN orders o ON oi.order_id = o.id
            WHERE cast(o.buy_date as date) BETWEEN ? AND ?';
            $statement = [$from, $to];
        } else {
            $queryString = 'SELECT p.price,oi.qty,o.buy_date FROM order_item oi
            INNER JOIN product p ON oi.product_id = p.id
            INNER JOIN orders o ON oi.order_id = o.id WHERE
            YEAR(o.buy_date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
            AND MONTH(o.buy_date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)';
            $statement = [];
        }

        $stmt = $db->prepare($queryString);
        $stmt->execute($statement);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $orderItem = new OrderItem();
        $orderItem->calculateTotalPrice($result);
        return $orderItem->getTotalPrice();
    }


}