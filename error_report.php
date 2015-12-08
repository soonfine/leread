<?php
require_once(dirname(__FILE__)."/include/common.inc.php");

$id=htmlspecialchars($_GET['id']);

if(!$id){
    SBYOU_net_error('1','请指定正确的文档！');
}  

if(!is_numeric($id)){
    $id='/'.$id;    
    $id_row=$dsql->GetOne("select * from dede_arctype where typedir='$id' and topid!=45 limit 1");
    if(!$id_row['id']){
        SBYOU_net_error('1','请指定正确的文档！');
    }   
    $id=intval($id_row['id']);
}  

if(is_numeric($id)){
    $dsql->ExecuteNoneQuery("UPDATE dede_arctype SET error_report=1 WHERE id='$id'");
    echo '<head><meta http-equiv="refresh" content="3; url='.$_SERVER["HTTP_REFERER"].'"></head><body><center>Commit success! I will deal with it as soon as possbile!!<br>The page will return in 3 seconds</center></body>';
    //header('Location:'.$_SERVER["HTTP_REFERER"]); 
    exit();
}

SBYOU_net_error('1','请指定正确的文档！');

?>
