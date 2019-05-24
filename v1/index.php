<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

<?php
    
    error_reporting(0); 
    $conn = new mysqli('127.0.0.1', 'root', '1q2w3e4r', 'restaurant');
    if($conn->connect_errno){
        die("Error [".$conn->connect_errno."]" . $conn->connect_error);
    }
?>


</head>
<body>
    <h1>Main Page</h1>
    <h2> <a href="add.php">เพิ่มข้อมูล</a>    <a href="search.php">ค้นหาข้อมูล</a>    <a href="edit.php">แก้ไขข้อมูล</a>    <a href="del.php">ลบข้อมูล</a></h2>
    <table border=1 width="600px">
        <thead>
            <th>รหัสเมนู</th>
            <th>ชื่อเมนูอาหาร</th>
            <th>ประเภทอาหาร</th>
            <th>ราคา</th>            
        </thead>
        <tbody>
<?php        
    
    $sql = "select * from menu";


    $rs = $conn->query($sql);
    while($row = $rs->fetch_array()){
?>    

            <tr>
                <td align='center'><?php echo $row['menu_id'];?></td>
                <td><?php echo $row['menu_name'];?></td>
                <td align='center'><?php 
                    switch($row['menu_type']){
                        case 1:
                            echo "อาหารคาว";break;
                        case 2:
                            echo "อาหารหวาน";break;
                        case 3:
                            echo "อาหารว่าง";break;    
                    }
                
                ?></td>
                <td align='right'><?php echo $row['menu_price'];?></td>
            </tr>
<?php
}

$conn->close();
?>            
        </tbody>
    </table>

</body>
</html>