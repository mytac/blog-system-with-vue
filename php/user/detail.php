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
//展示文章详情
function showArticle($articleId){
    $sql="SELECT * FROM article WHERE id=$articleId";
    return queryError($sql,99,'body');
}

//展示文章评论
function showCommentList($articleId){
    $sql="SELECT * FROM comment WHERE articleId=$articleId";
    return queryError($sql,99,'commentList');
}
//对文章进行评论
function doComment($articleId,$userId,$content){
    //$sql="INSERT INTO comment VALUES (NULL,$articleId,$userId,'$content', CURRENT_TIMESTAMP)";
    $sql="INSERT INTO `comment` (`id`, `articleId`, `userId`, `content`, `createTime`) VALUES (NULL,$articleId,$userId,'$content', CURRENT_TIMESTAMP)";
    return insertError($sql,2);
}

//main
switch($d['chose']){
    case "showArticle":$back=showArticle($d['articleId']);break;
    case "showCommentList":$back=showCommentList($d['articleId']);break;
    case "doComment":$back=doComment($d['articleId'],$d['userId'],$d['content']);break;
    default: $back="in php there no set 'chose' property";break;
}
//ajax_back
echo json_encode($back);
?>