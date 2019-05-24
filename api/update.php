
<?php

error_reporting(0); 
$conn = new mysqli('127.0.0.1', 'root', '1q2w3e4r', 'restaurant');

$return = array();
if($conn->connect_errno){
    array_push($return, array('result' => "ERR"));
    $return['status']=$conn->connect_error;
}else{
    if(!empty($_REQUEST['menu_id'])){
        $sql = "update menu set ";
        $sql .= " menu_name = '".$_REQUEST['menu_name']."', ";
        $sql .= " menu_type = '".$_REQUEST['menu_type']."', ";
        $sql .= " menu_price = '".$_REQUEST['menu_price']."' ";
        $sql .= " where menu_id = '".$_REQUEST['menu_id']."' ";

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