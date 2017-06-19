<?php
$array = array();

$names =['mohammed ','samed'];
$array['names'] = &$names;
$array['names'][0] = "dada";



echo "<pre>";
var_dump($names);
echo "</pre>";