<?php
/**
 * Created by PhpStorm.
 * User: MOGA
 * Date: 2017-05-28
 * Time: 4:09 PM
 */
spl_autoload_register("load");
function load($className)
{
    require_once("classes/$className.php");
}
