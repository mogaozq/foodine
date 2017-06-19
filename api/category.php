<?php
/**
 * Created by PhpStorm.
 * User: MOGA
 * Date: 2017-05-19
 * Time: 11:11 AM
 */
header("Content-type: application/json; charset=utf-8");
require_once("../includes/foodine_autoloader.php");
include_once("../includes/configuration.php");
$json = json_encode(Category::getAllCategories(true),JSON_UNESCAPED_UNICODE);
echo $json;
