<?php

namespace App\Repositories;

use App\Models\Customer;
use PDO;

class CustomerRepository extends \Core\Model implements CustomerInterface
{

    public function customerCount($from = null, $to = null)
    {
        $db = static::getDB();

        if ($from) {
            $queryString = 'SELECT COUNT(*) AS count FROM customer WHERE cast(created_at as date) BETWEEN ? AND ?';
            $statement = [$from, $to];
        } else {
            $queryString = 'SELECT COUNT(*) AS count FROM customer WHERE
            YEAR(created_at) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
            AND MONTH(created_at) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)';
            $statement = [];
        }
        $stmt = $db->prepare($queryString);
        $stmt->execute($statement);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function addCustomer($data)
    {
        if ($this->validate($data)) {
            $queryString = 'INSERT INTO customer (first_name,last_name,email,created_at) VALUES (?,?,?,?)';
            $db = static::getDB();
            $stmt = $db->prepare($queryString);
            $stmt->execute(array_values($data));
            return $stmt ? true : false;
        } else {
            return false;
        }


    }

    private function validate($date)
    {
        if ($date['first_name'] == null || $date['last_name'] == null || $date['email'] == null || $date['created_at'] == null) {
            return false;
        } else {
            return true;
        }
    }
}