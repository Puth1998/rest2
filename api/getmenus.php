<?php
$conn = new mysqli('localhost', 'root', '', 'restaurant');
$sql = "select * from menu";


$rs = $conn->query($sql);
$ret = array();
while($row = $rs->fetch_array()){
    array_push($ret, $row);
}

print json_encode($ret);