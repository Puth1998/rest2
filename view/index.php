<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Main</title>
</head>
<body>
    <h1 div class="p-3 mb-2 bg-dark text-white">Main Page</h1>
    <h2> 
    <a href="/rest2/view/index.php" class="text-secondary">หน้าหลัก</a>
    <a href="/rest2/view/add.php" class="text-success">เพิ่มข้อมูล</a>    
    <a href="/rest2/view/search.php" class="text-info">ค้นหาข้อมูล</a>    
    <a href="/rest2/view/edit.php"class="text-warning">แก้ไขข้อมูล</a>    
    <a href="/rest2/view/del.php" class="text-danger">ลบข้อมูล</a>
    </h2>

    <div class="container">
    <table class="table table-striped table-dark" border=1 width="600px">
        <thead>
            <th>รหัสเมนู</th>
            <th>ชื่อเมนูอาหาร</th>
            <th>ประเภทอาหาร</th>
            <th>ราคา</th>            
        </thead>
        <tbody id="tblData">            
        </tbody>
    </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>


<script>
    function loadData(){
        var url = "http://localhost/rest2/api/index.php/getmenus";
        $.getJSON(url).done(function( data ) {
            // console.log(JSON.stringify(data));

            var line = "";
            $.each(data, function(k,item){
                // console.log(item);
                line += "<tr><td align='center'>"+ item.menu_id+"</td>";
                line += "<td align='center'>"+item.menu_name+"</td>";
                line += "<td align='center'>";
                
                switch(item['menu_type']){
                        case "1":
                            line +="อาหารคาว";break;
                        case "2":
                            line +="อาหารหวาน";break;
                        case "3":
                            line +="อาหารว่าง";break;    
                    }
                line +="</td>";
                line += "<td align='center'>"+item.menu_price+"</td>";
                line += "</tr>";
            });

            $("#tblData").empty();
            $("#tblData").append(line);
        });
    }

    $(function(){
        loadData();
    });

</script>
</html>