
<?php
$conn = new mysqli('127.0.0.1', 'root', '1q2w3e4r', 'student');
$sql = "select st.id, st.name, dp.dep_name, sc.school_name  from student st "
    . "left join department  dp on st.department = dp.id left join school sc "
    . " on sc.id = dp.school_id where st.flag=0";
$rs = $conn->query($sql);
$ret = array();
while($row = $rs->fetch_array()){
    array_push($ret, $row);
}

print json_encode($ret);