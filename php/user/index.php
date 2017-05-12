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

//登录注册页
//登录验证
function isLogin($id,$psd){
    $sql = "SELECT psd FROM userLog where username=$id";
    return $psd==queryBasic($sql,0,'')[0]? 1:0;
}
//注册页获取字段
function fetchRegistData($d){
    global $conn;
    $username=$d['username'];
    $psd=$d['psd'];
    $nickname=$d['nickname'];
    $email=$d['email'];
    $city=$d['city'];
    $birth=$d['birth'];
    $sex=$d['sex'];

    $sql="INSERT INTO userlog vALUES(NULL,'$username','$psd','$nickname')";
    if(queryBasic($sql,2,'')){
        $sql="SELECT id FROM userlog WHERE username='$username'";
        $res=queryBasic($sql,0,'');
        if($res&&$res[0]){
            $sql="INSERT INTO userinfo VALUES($res[0],'$nickname','$email','$city','$birth',$sex)";
            if(queryBasic($sql,2,'')){
                return array('status'=>1);
            }
        }
    }
        $msg=mysqli_error($conn);
        $error=array('status'=>0,'msg'=>$msg);
        return $error;
    }
//推荐作者
function getGoodWriters(){
   $sql="SELECT * FROM userinfo WHERE isHot=1";
    return queryError($sql,99,'body');
}
//推荐文章
function goodArticle(){
    $sql="SELECT * FROM article WHERE isHot=1";
    return queryError($sql,99,'body');
}
//显示通知
function showNotification($userId){
    $sql="SELECT * FROM notification WHERE userId=$userId";
    return queryError($sql,99,'body');
}
//main
switch($d['chose']){
    case "isLogin": $get_id=$d['username'];$get_psd=$d['psd'];$back=isLogin($get_id,$get_psd);break;
    case "regist":$back=fetchRegistData($d);break;
    case "goodWriters":$back=getGoodWriters();break;
    case "goodArticle":$back=goodArticle();break;
    case "showNotification":$back=showNotification($d['userId']);break;
    default: $back="in php there no set 'chose' property";break;
}
//ajax_back
echo json_encode($back);
?>