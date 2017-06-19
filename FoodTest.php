<?php
/**
 * Created by PhpStorm.
 * User: MOGA
 * Date: 2017-05-19
 * Time: 1:30 PM
 */
//header("Content-type: application/json; charset=utf-8");
require_once ("includes/foodine_autoloader.php");
include_once("includes/configuration.php");
//Food::getFoodsByCategoryId(1,true);
echo "<pre>";
var_dump(Food::getFoodsByCategoryId("1 or 1",true));
echo "</pre>";
//echo json_encode(Food::getFoodsByCategoryId(5,true),JSON_UNESCAPED_UNICODE);
//echo "<pre>";
////var_dump(Food::getImagesByFoodId(5));
//echo "</pre>";