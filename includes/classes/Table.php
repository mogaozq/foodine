<?php

/**
 * Created by PhpStorm.
 * User: MOGA
 * Date: 2017-04-24
 * Time: 4:33 PM
 */
class Table
{
    protected $data = array();

    function __construct($row)
    {
        foreach ($row as $key => $value) {
            if (key_exists($key, $this->data)) {
                if (is_numeric($value))
                    $this->data[$key] = (int)$value;
                else
                    $this->data[$key] = $value;
            }
        }
    }

    function __get($property)
    {
        if (key_exists($property, $this->data)) {
            return $this->data[$property];
        } else {
            die("invalid property");
        }
    }

    static function connect()
    {
        $conn = new mysqli(HOST_NAME, USER, PASS, DB_NAME);
        $conn->set_charset("utf8");
        return $conn;
    }

    static function disconnect($conn)
    {
        $conn->close();

    }


}