<?php

error_reporting(0); 
$conn = new mysqli('localhost', 'root', '', 'restaurant');

$return = array();
if($conn->connect_errno){
    array_push($return, array('result' => "ERR"));
    $return['status']=$conn->connect_error;
}else{
    if(!empty($_REQUEST['menu_id'])){
        $sql = "insert into menu values('" . $_REQUEST['menu_id']."','".$_REQUEST['menu_name']."', '".$_REQUEST['menu_type']."','".$_REQUEST['menu_price']."' )";
        $r = $conn->query($sql);

        $return['sql'] = $sql;

        if(!$r){
            $return['result'] = "ERR";
            $return['status'] = $conn->error;
        }else{
            $return['result'] = "OK";
            $return['status'] = "Operation complete";
        }
    }
}
print json_encode($return);    

?>