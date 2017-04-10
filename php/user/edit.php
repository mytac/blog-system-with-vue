<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/10
 * Time: 20:51
 */
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:PUT,GET,POST');
header('Access-Control-Max-Age:60');
header('Access-Control-Allow-Headers:x-requested-with,content-type');
header('Content-Type:application/json;charset=utf-8');


//ajax_in
$d=json_decode($_GET["data"],true);
$get_key="";
$back="";
$conn = mysqli_connect('localhost:3306', 'root', 'root','blog');

//db
function loopQuery($res){
    $arr =  array();
    while($row = mysqli_fetch_array($res)){
        $arr[] = $row;
    }
    return $arr;
}

function queryBasic($sql,$type,$isTable){
    global $conn;
    $res=mysqli_query($conn,$sql);
    switch($type){
        case 0:return mysqli_fetch_row($res);break;//一个object
        case 1:return mysqli_fetch_object($res);break;
        case 2:return $res;break;
        default:return loopQuery($res);break;//【{}，{}】
    }
}
function insertError($sql){
    if(queryBasic($sql,2,'')){
        return array('status'=>1);
    }
    global $conn;
    $msg=mysqli_error($conn);
    $error=array('status'=>0,'msg'=>$msg);
    return $error;
}



//保存文章
function saveContent($d){
    //$textId=$d['textId'];
    $userId=$d['userId'];
    $title=$d['title'];
    $content=$d['content'];
    $categoryId=$d['categoryId'];
    $sql="INSERT INTO article VALUES (NULL,$userId,'$title','$content',$categoryId)";
    return insertError($sql);
}
//新建分类
function addCategory($d){
    $userId=$d['userId'];
    $title=$d['title'];
    $sql="INSERT INTO category VALUES ($userId,NULL,'$title')";
    return insertError($sql);
}
//main
switch($d['chose']){
    case "saveContent": $back=saveContent($d);break;
    case 'addCategory':$back=addCategory($d);break;
    default: $back="in php there no set 'chose' property";break;
}
//ajax_back
echo json_encode($back);
?>