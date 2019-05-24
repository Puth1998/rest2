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
    <h1>Delete Page</h1>
    <h2> <a href="index.php">หนัาหลัก</a> <a href="add.php">เพิ่มข้อมูล</a>    <a href="search.php">ค้นหาข้อมูล</a>    <a href="edit.php">แก้ไขข้อมูล</a>    <a href="del.php">ลบข้อมูล</a></h2>

    <form action="del.php">
        <table>
            <tr>
                <th>รหัสเมนู</th>
                <td><input type="text" name="keyword"></td>
                <td><input type="submit" name="submit" value="สืบค้น"></td>
            </tr>
        </table>
    </form>

<?php        
    if(!empty($_REQUEST['submit']) && $_REQUEST['submit'] == 'ลบข้อมูล'){
        $sql = "delete from menu ";
        $sql .= " where menu_id = '".$_REQUEST['menu_id']."' ";
        $r = $conn->query($sql);

        if(!$r){
            print("error [".$conn->errno."] " . $conn->error);
        }else{
            echo "delete complete!!!!!! <br> Click <a href='index.php'>Back</a> to home page";
            
        }
        exit;
    }

    if(!empty($_REQUEST['submit']) && $_REQUEST['submit'] == 'สืบค้น'){
        $sql = "select * from menu ";
        $sql = $sql . " where menu_id = '".$_REQUEST['keyword']."' ";
        $rs = $conn->query($sql);
        if ($rs->num_rows == 0){
            echo "--------------  No match record---------------";
            exit;
        }else{
            $row = $rs->fetch_array();
            $id = $row['menu_id'];
            $name = $row['menu_name'];
            $type = $row['menu_type'];
            $price = $row['menu_price'];
?>

<form action="del.php" method="get">
            <input type="hidden" value="<?php echo $id;?>" name="menu_id" />
        <table>
            <tr>
                <th>รหัสเมนู</th>
                <td><?php echo $id; ?></td>
            </tr>
            <tr>
                <th>ชื่อเมนู</th>
                <td><?php echo $name;?></td>
            </tr>
            <tr>
                <th>ประเภทอาหาร</th>
                <td>
                <?php 
                    switch($menu_type){
                        case 1:
                            echo "อาหารคาว";break;
                        case 2:
                            echo "อาหารหวาน";break;
                        case 3:
                            echo "อาหารว่าง";break;    
                    }
                
                ?>
                </td>
            </tr>
            <tr>
                <th>ราคา</th>
                <td><?php echo $price;?></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="ลบข้อมูล" name='submit'> </td>  
            </tr>
        
        </table>
    </form>

<?


        }
    }
    
    
    
    
?>    
 

</body>
</html>