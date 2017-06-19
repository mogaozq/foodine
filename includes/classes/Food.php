<?php

/**
 * Created by PhpStorm.
 * User: MOGA
 * Date: 2017-05-18
 * Time: 10:05 PM
 */
define("FOOD_ID", "id");
define("FOOD_NAME", "name");
define("FOOD_PRICE", "price");
define("FOOD_PAY_OFF", "pay_off");
define("FOOD_PUBLISHED", "published");
define("FOOD_BRANCH_ID", "branch_id");

define("FOOD_IMAGES", "images");//related table


class Food extends Table
{
    protected $data = array(
        FOOD_ID => 0,
        FOOD_NAME => "",
        FOOD_PRICE => 0,
        FOOD_PAY_OFF => 0,
        FOOD_PUBLISHED => 0,
        FOOD_BRANCH_ID => 0,

        FOOD_IMAGES => array(), //related table
    );

    function __construct($row)
    {
        parent::__construct($row);
        $images = self::getImagesByFoodId($row['id']);
        $this->data[FOOD_IMAGES] = $images;
    }


    public static function getFoodsByCategoryId($categoryId, $assoc = false)
    {
        $query = "SELECT id, `name`, price, pay_off, published,branch_id FROM food JOIN food_has_category on id=food_id WHERE category_id = $categoryId";
        $conn = self::connect();
        $result = $conn->query($query);

        if ($result->num_rows) {
            if ($assoc) {
                $foods = $result->fetch_all(MYSQLI_ASSOC);
                foreach ($foods as &$food){
                    $food['images']= self::getImagesByFoodId($food["id"]);
                }
            } else {
                $foods = array();
                foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
                    $foods[] = new Food($row);
                }
            }
            $ret = $foods;
            $result->free();
        } else {
            $ret = false;
        }
        self::disconnect($conn);
        return $ret;
    }

    /**
     * @param $foodId
     * @return array : (array of strings) images paths of the food whose id is in the parameter as foodId and return empty array if there is not image related to the food .
     */
    public static function getImagesByFoodId($foodId)
    {
        $query ="SELECT image_name FROM food_image WHERE food_id = $foodId";
        $conn = self::connect();
        $result = $conn->query($query);
        if($result->num_rows){
            foreach($result->fetch_all() as $image){
                $images[] = $image[0];
            }
            $ret = $images;
            $result->free();
        }else{
            $ret = [];
        }
        self::disconnect($conn);
        return $ret;
    }



}