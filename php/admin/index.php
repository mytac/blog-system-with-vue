<?php
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
    while($row = mysqli_fetch_object($res)){
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
// 异常处理
function insertError($sql){
    if(queryBasic($sql,2,'')){
        return array('status'=>1);
    }
    global $conn;
    $msg=mysqli_error($conn);
    $error=array('status'=>0,'msg'=>$msg);
    return $error;
}
function queryError($sql,$type,$bean){
    $res=queryBasic($sql,$type,'');
    if(is_string($res)==false){
        return array('status'=>1,$bean=>$res);
    }
    global $conn;
    $msg=mysqli_error($conn);
    $error=array('status'=>0,'msg'=>$msg);
    return $error;
}


//（管理员）设置推荐文章
function setHotArticle($articleId,$status){
    $sql="UPDATE `article` SET `isHot` = $status WHERE `article`.`id` = $articleId";
    return queryError($sql,2,'body');
}
//（管理员）设置推荐文章
function setHotWriter($writerId,$status){
    $sql="UPDATE `userinfo` SET `isHot` = $status WHERE `userinfo`.`id` = $writerId;";
    return queryError($sql,2,'body');
}
//main
switch($d['chose']){
    case "setHotArticle": $back=setHotArticle($d['articleId'],$d['status']);break;
    case "setHotWriter": $back=setHotWriter($d['writerId'],$d['status']);break;
    default: $back="in php there no set 'chose' property";break;
}
//ajax_back
echo json_encode($back);
?>