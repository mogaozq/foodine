<?php
/**
 * Created by PhpStorm.
 * User: MOGA
 * Date: 2017-05-19
 * Time: 1:57 PM
 */
header("Content-type: application/json; charset=utf-8");
require_once("../includes/foodine_autoloader.php");
include_once("../includes/configuration.php");

if(!empty($_GET['categoryId']) && is_numeric($_GET['categoryId'])){
    $categoryId = $_GET['categoryId'];
    echo "<br/>";
    $json = json_encode(Food::getFoodsByCategoryId($categoryId,true),JSON_UNESCAPED_UNICODE);
    echo $json;
}else{
    echo "[]";
}
