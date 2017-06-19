<?php
/**
 * Created by PhpStorm.
 * User: MOGA
 * Date: 2017-04-24
 * Time: 5:07 PM
 */
//header('Content-Type: application/json; charset=utf-8');
require_once ("includes/foodine_autoloader.php");
include_once("includes/configuration.php");
echo "<pre>";
var_dump(Category::getAllCategories(true));
echo "</pre>";
//echo json_encode(Category::getAllCategories(true),JSON_UNESCAPED_UNICODE);
//var_dump(Category::getAllCategories());
//$done = Category::addCategory("غذای کم ",1);
//var_dump(Category::getCategoryById(4));
//echo "<br/>";
//if(empty(Category::$error)){
//    echo "error";
//}
//echo "<br/>";
//echo "moga";
//echo "<br/>";
//if(Category::getCategoryById(4)->id="تلخی جات"){
//    echo "updated seccesfully";
//    echo "<br/>";
//    var_dump(Category::getCategoryById(4));
//};
//}

?>
