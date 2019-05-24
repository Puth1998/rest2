<?php
$conn = new mysqli('127.0.0.1', 'root', '1q2w3e4r', 'restaurant');
$sql = "select * from menu ";
$sql = $sql . " where menu_id = '".$_REQUEST['keyword']."' ";
$sql = $sql . " or menu_name like '%".$_REQUEST['keyword']."%' ";

$rs = $conn->query($sql);
$ret = array();
while($row = $rs->fetch_array()){
    array_push($ret, $row);
}

print json_encode($ret);