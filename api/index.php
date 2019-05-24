<?php
    require "vendor/autoload.php";
    $app = new \Slim\App;


   
    $container = $app->getContainer();
    $container['db'] = function ($c) {
    $pdo = new PDO("mysql:host=127.0.0.1; dbname=restaurant;charset=utf8", 'root', '');
    return $pdo;
    
    };

    $app->get("/getmenus",function($req, $res){
        $sql = "select * from menu";
        $sth = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $this->response->withJson($sth);
    });

    $app->post("/add",function($req, $res){
        $body = $req->getParsedBody();
        // print_r($body);

        $data = [
            "status"=>false,
            "result"=>"error"
        ];

        $sql = "insert into menu values('" . $body['menu_id']."','".$body['menu_name']."', '".$body['menu_type']."','".$body['menu_price']."' )";
        $sth = $this->db->prepare($sql);
        $sth->execute();
        $count = $sth->rowCount();

        if($count >0){
            $data['status'] = true;
            $data['result'] = "OK";
        }

        return $this->response->withJson($data);

        
   
    });


    $app->post("/searchmenu",function($req, $res){
        $body = $req->getParsedBody();
        // print_r($body);

        $sql = "select * from menu ";
        $sql = $sql . " where menu_id = '".$body['keyword']."' ";
        $sql = $sql . " or menu_name like '%".$body['keyword']."%' ";
        $sth = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
     
        return $this->response->withJson($sth);
       
     });

 
    $app->post("/getmenu",function($req, $res){
        $body = $req->getParsedBody();
        // print_r($body);
        

        $sql = "select * from menu ";
        $sql = $sql . " where menu_id = '".$body['keyword']."' ";
        $sql = $sql . " or menu_name like '%".$body['keyword']."%' ";
        $sth = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        $data = [
            "data"=>$sth,
            "nrow"=>count($sth)
        ];

        return $this->response->withJson($data);

    });

    $app->post("/update",function($req, $res){
        $body = $req->getParsedBody();
        // print_r($body);

        $data = [
            "status"=>false,
            "result"=>"error"
        ];

        $sql = "UPDATE menu SET menu_id ='" . $body['menu_id']."', menu_name ='".$body['menu_name']."', menu_type ='".$body['menu_type']."',menu_price = '".$body['menu_price']."' ";
        $sql = $sql . " where menu_id = '".$body['menu_id']."' ";
        $sth = $this->db->prepare($sql);
        $sth->execute(); 
        $count = $sth->rowCount();

        if($count >0){
            $data['status'] = true;
            $data['result'] = "OK";
        }

        return $this->response->withJson($data);

    });

    $app->post("/delmenu",function($req, $res){
        $body = $req->getParsedBody();
        // print_r($body);

        $data = [
            "status"=>false,
            "result"=>"error"
        ];


        $sql = "DELETE FROM menu ";
        $sql = $sql . " where menu_id = '".$body['menu_id']."' ";
        $sth = $this->db->prepare($sql);
        $sth->execute();
        $count = $sth->rowCount();

        if($count >0){
            $data['status'] = true;
            $data['result'] = "OK";
        }

       
        return $this->response->withJson($data);
    });
    
    $app->run();