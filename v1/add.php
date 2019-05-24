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
    $price = 0;
    if(!empty($_REQUEST['submit']) && $_REQUEST['submit'] == 'เพิ่มข้อมูล'){
        $sql = "insert into menu values('" . $_REQUEST['menu_id']."','".$_REQUEST['menu_name']."', '".$_REQUEST['menu_type']."','".$_REQUEST['menu_price']."' )";
        $r = $conn->query($sql);

        if(!$r){
            print("error [".$conn->errno."] " . $conn->error);
            $id = $_REQUEST['menu_id'];
            $name = $_REQUEST['menu_name'];
            $type = $_REQUEST['menu_type'];
            $price = $_REQUEST['menu_price'];
        }else{
            echo "Add complete!!!!!! <br> Click <a href='index.php'>Back</a> to home page";
            exit;
        }
        
    }
?>

</head>
<body>
    <h1>Add Page</h1>
    <h2> <a href="index.php">หนัาหลัก</a> <a href="add.php">เพิ่มข้อมูล</a>    <a href="search.php">ค้นหาข้อมูล</a>    <a href="edit.php">แก้ไขข้อมูล</a>    <a href="del.php">ลบข้อมูล</a></h2>
    <form action="add.php" method="get">
        <table>
            <tr>
                <th>รหัสเมนู</th>
                <td><input type="text" name="menu_id" 
                    value="<?php echo $id; ?>" required pattern="[m][0-9]{4}"
                    /></td>
            </tr>
            <tr>
                <th>ชื่อเมนู</th>
                <td><input type="text" name="menu_name" required  maxlength="50" value="<?php echo $name;?>"/></td>
            </tr>
            <tr>
                <th>ประเภทอาหาร</th>
                <td>
                <select required  name="menu_type">
                    <option <?php echo ($type == 1)?"selected":"";   ?>value="1">อาหารคาว</option>
                    <option <?php echo ($type == 2)?"selected":"";   ?> value="2">อาหารหวาน</option>
                    <option <?php echo ($type == 3)?"selected":"";   ?> value="3">อาหารว่าง</option>
                </select>
                </td>
            </tr>
            <tr>
                <th>ราคา</th>
                <td><input type="number" name="menu_price" maxlength="4" min=0 max=9999 value="<?php echo $price;?>"/></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="เพิ่มข้อมูล" name='submit'></td>
            </tr>
        
        </table>
    </form>
</body>
</html>