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


//保存或更新文章
function saveContent($d){
    $textId=$d['textId'];
    $userId=$d['userId'];
    $title=$d['title'];
    $content=$d['content'];
    $categoryId=$d['categoryId'];
    $sql="SELECT id FROM userlog WHERE username='$userId'";
    $id=queryError($sql,0,'body')['body'][0];
    if(is_string($id)===true){
        if(!empty($textId)){
            $sql="UPDATE `article` SET `title` = '$title', `categoryId` = '$categoryId',`content`='$content' WHERE `article`.`id` = $textId";}
        else{
            $sql="INSERT INTO article VALUES (NULL,'$id','$userId','$title','$content',$categoryId,0,0,0,CURRENT_TIMESTAMP)";
        }
        return insertError($sql,2);
    }
    return array('status'=>0);
}
//新建分类
function addCategory($d){
    $userId=$d['userId'];
    $title=$d['title'];
    $sql="INSERT INTO category VALUES (NULL,'$userId=!end!=$title','$userId')";
    return insertError($sql,2);
}
//获取用户的文章分类
function getArticleCategory($d){
    $userId=$d['userId'];
    $sql="SELECT id,title  FROM category WHERE userid='$userId'";
    return queryError($sql,100,'category');
}
// 拉取文章列表
function getArticleList($userId){
    $sql="SELECT id,title,content,likeNum,createTime FROM article WHERE username='$userId'";
    return queryError($sql,100,'articles');
}
// 删除指定文章
function deleteArticle($id){
    $sql="DELETE FROM `article` WHERE `article`.`id` = $id";
    return insertError($sql,2);
}
//main
switch($d['chose']){
    case "saveContent": $back=saveContent($d);break;
    case 'addCategory':$back=addCategory($d);break;
    case 'getArticleCategory': $back=getArticleCategory($d);break;
    case 'getArticleList': $back=getArticleList($d['userId']);break;
    case 'deleteArticle':$back=deleteArticle($d['id']);break;
    default: $back="in php there no set 'chose' property";break;
}
//ajax_back
echo json_encode($back);
?>