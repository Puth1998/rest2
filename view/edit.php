<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


</head>
<body>
    <h1 class="p-3 mb-2 bg-warning text-dark">Edit Page</h1>
    <h2> 
    <a href="/rest2/view/index.php" class="text-secondary">หน้าหลัก</a>
    <a href="/rest2/view/add.php" class="text-success">เพิ่มข้อมูล</a>    
    <a href="/rest2/view/search.php" class="text-info">ค้นหาข้อมูล</a>    
    <a href="/rest2/view/edit.php"class="text-warning">แก้ไขข้อมูล</a>    
    <a href="/rest2/view/del.php" class="text-danger">ลบข้อมูล</a>
    </h2>

         <table>
            <tr>
                <th>รหัสเมนู</th>
                <td><input type="text" id="keyword"></td>
                <td><input type="button" id="btnSearch" value="สืบค้น"></td>
            </tr>
        </table>
  
         <table>
            <tr>
                <th>รหัสเมนู</th>
                <td><span id="menu_id"></span></td>
            </tr>
            <tr>
                <th>ชื่อเมนู</th>
                <td><input type="text" id="menu_name" required  maxlength="50"  /></td>
            </tr>
            <tr>
                <th>ประเภทอาหาร</th>
                <td>
                <select required  id="menu_type">
                    <option value=1>อาหารคาว</option>
                    <option value="2">อาหารหวาน</option>
                    <option value="3">อาหารว่าง</option>
                </select>
                </td>
            </tr>
            <tr>
                <th>ราคา</th>
                <td><input type="number" id="menu_price" maxlength="4" min=0 max=9999  ></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="button" value="บันทึกข้อมูล" id='btnSave'></td>  
            </tr>
        
        </table> 
        <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
<script>
function btnSave_click(){
    var data = new Object();
         data.menu_id = $("#menu_id").text(); 
         data.menu_name = $("#menu_name").val();
         data.menu_type = $("#menu_type").val();
         data.menu_price = $("#menu_price").val();
         console.log(data);
        
         var url = "http://localhost/rest2/api/index.php/update";
         $.ajax(
             {
                    url: url, 
                    type: 'post', 
                    dataType: 'json',
                    success: function(feedback){
                        alert(feedback.status);
                        if(feedback.result == "OK")
                            window.location = '/rest2/view/index.php';
                    },
                    data: data
            });
}

function btnSearch_click(){
    var url = "http://localhost/rest2/api/index.php/getmenu";
    var data = new Object();
        data.keyword = $("#keyword").val().trim();          
        $("#keyword").val("");
        $.ajax(
            {
                url: url, 
                type: 'post', 
                dataType: 'json',
                success: function(feedback){
                    if(feedback.nrow > 0){
                        var data = (feedback.data)[0];
                            $("#menu_id").text(data.menu_id);
                            $("#menu_name").val(data.menu_name);
                            $("#menu_type option[value='"+ data.menu_type+"']").prop('selected', true);
                            $("#menu_price").val(data.menu_price);
                    }else{
                        alert("Not found");
                    }                            
                    },
                data: data
        });

}


$(function(){
    $("#btnSave").click(btnSave_click);
    $("#btnSearch").click(btnSearch_click);
});
</script>
</html>