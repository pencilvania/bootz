<?php

namespace App\Models;

use App\Models\Country;
use App\Models\Customer;

class Order
{
    private $id;
    private $country;
    private $customer;
    private $device;
    private $buy_date;


    public function __construct()
    {
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return mixed
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param mixed $device
     */
    public function setDevice($device)
    {
        $this->device = $device;
    }

    /**
     * @return mixed
     */
    public function getBuyDate()
    {
        return $this->buy_date;
    }

    /**
     * @param mixed $buy_date
     */
    public function setBuyDate($buy_date)
    {
        $this->buy_date = $buy_date;
    }


    public function convert($data)
    {
        $response = array();
        foreach ($data as $record)
        {
            $order = new self();
            $order->setId($record['id']);
            $order->setCountry($record['country']);
            $order->setCustomer($record['customer']);
            $order->setDevice($record['device']);
            $order->setBuyDate($record['buy_date']);
            array_push($response,$order);
        }
        return $response;
    }

}
