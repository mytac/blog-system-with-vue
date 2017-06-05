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
    /* if(!$isTable){
        $conn = mysqli_connect('localhost:3306', 'root', 'root','blog');
     }
     else{$conn = mysqli_connect('localhost:3306', 'root', 'root');}*/
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

//显示通知
function showWriterList($userId){
    $sql="SELECT * FROM attention WHERE userId=$userId";
    return queryError($sql,99,'body');
}

// 读取关注作者的文章列表
function showArticleList($writerId,$type){
    $sql='';
    if($type==1){
        $sql="SELECT * FROM article WHERE userid=$writerId ORDER BY likeNum DESC ";
    }else{
        $sql="SELECT * FROM article WHERE userid=$writerId ORDER BY createTime DESC ";
    }
    return queryError($sql,99,'body');
}
// 获取关注作者列表
function getWriterList($userId){
    $sql="SELECT writerId,writername WHERE username=$userId";
    return queryError($sql,100,'body');
}
// 拉取个人信息
function showProfile($userId){
    $sql="SELECT * FROM userinfo WHERE username=$userId";
    return queryError($sql,1,'userbean');
}
function updateProfile($bean){
    // 解析bean
    $sql="UPDATE .....";
    return insertError($sql,2);
}
//main
switch($d['chose']){
    case "showWriterList":$back=showWriterList($d['userId']);break;
    case "showArticleList":$back=showArticleList($d['writerId'],$d['type']);break;
    case "getWriterList":$back=getWriterList($d['userId']);break;
    case "showProfile":$back=showProfile($d['userId']);break;
    default: $back="in php there no set 'chose' property";break;
}
//ajax_back
echo json_encode($back);
?>