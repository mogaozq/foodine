<?php

/**
 * Created by PhpStorm.
 * User: MOGA
 * Date: 2017-04-24
 * Time: 4:35 PM
 */
//include_once("Table.php");//error why?
define("CATEGORY_ID", "id");
define("CATEGORY_NAME", "name");
define("CATEGORY_BRANCH_ID", "branch_id");

class Category extends Table
{
    public static $error = false;

    protected $data = array(
        CATEGORY_ID => 0,
        CATEGORY_NAME => "",
        CATEGORY_BRANCH_ID => 0,
    );

    /**
     * @param bool $assoc it defines that function return result as associative array or Category object
     * @return array|bool|mixed return array of Categories and return false if operation failed.
     */
    public static function getAllCategories($assoc = false)
    {
        $conn = self::connect();
        $result = $conn->query("SELECT * FROM foodine.category");
        if ($result->num_rows) {
            if ($assoc) {
                $categories = $result->fetch_all(MYSQLI_ASSOC);
            } else {
                $categories = array();
                foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
                    $categories [] = new Category($row);
                }
            }

            $result->free();
            $ret = $categories;
        } else
            $ret = false;
        self::disconnect($conn);
        return $ret;

    }

    public static function getCategoryById($id)
    {
        $conn = self::connect();
        $result = $conn->query("SELECT * FROM foodine.category WHERE id = $id");
        if ($result->num_rows) {
            $category = $result->fetch_assoc();
            $category = new Category($category);
            $return = $category;
        } else {
            self::$error = $conn->error;
            $return = false;
        }

        $result->free();
        self::disconnect($conn);
        return $return;

    }

    /**
     * @param $name
     * @param $adminId
     * @return bool return false if operation failed.
     */

    public static function addCategory($name, $adminId)
    {
        $conn = self::connect();
        $result = $conn->query("INSERT INTO foodine.category (`name`, admin_id) VALUES ('$name',$adminId)");
        echo "<br/>";
        if ($result) {
            self::$error = false;
            self::disconnect($conn);
            return true;
        } else {
            self::$error = $conn->error;
            self::disconnect($conn);
            return false;
        }

    }

    function __set($property, $value)
    {
        if (key_exists($property, $this->data)) {
            if ($property != CATEGORY_ID && $property != CATEGORY_ADMIN_ID) {
                $query = "UPDATE foodine.category SET $property = '$value' WHERE id = $this->id";
                $conn = self::connect();
                $conn->query($query);
                $this->data[$property] = $value;
                if ($conn->affected_rows) {
                    return $this;
                } else {
                    return false;
                }

            } else {
                die("you can not change read only property");
            }

        } else {
            die("invalid property");
        }
    }

    public
    function toArray()
    {
        return $this->data;
    }


}