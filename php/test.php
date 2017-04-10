<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:GET,POST');
header('Content-Type:text/plain; charset=utf-8');
//$backValue=$_POST['trans_data'];
 $backValue = "dsadsd";
echo json_encode($backValue);
//echo $backValue."+后台返回";
?>