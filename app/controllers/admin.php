<?php

class Admin extends Controller{
    
    public function index(){
        //session_start();
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            $this->view('admin');
        }
        else{
            $this->view('adminlogin');
        }
    }

    public function login($username="",$password=""){
        if($username!="" || $password!=""){
            $username=trim($username);
            $password=trim($password);
            $sql = 'SELECT haslo FROM users WHERE nazwa_uzytkownika ="'.$username.'"';
            
            $data = self::query($sql);
            if($data!=[]){
                if(password_verify($password,$data[0]['haslo'])){
                    $_SESSION['loggedin']=true;
                    $_SESSION['username']=$username;
                    $_SESSION['password']=$password;
                }
                else{
                    echo 'NOK';
                }
            }
            else{
                echo 'NOK';
            }
           
        }
        else{
            echo 'NOK';
        }
    }

    public function logout(){
        $_SESSION['loggedin']=false;
        header('Location: ../admin');
    }

    public function addproduct(){
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            $this->view('addproduct');
        }
        else{
            $this->view('adminlogin');
        }
    }

    public function deleteProduct($id){
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            $sql = 'UPDATE products SET DELETED=1, EDIT_DATE=CURRENT_TIMESTAMP where ID="'.$id.'"';
            $data = self::query($sql);
        }
        else{
            $this->view('adminlogin');
        }
    }

    public function insertProduct($model=[]){
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        $error = [];
        $isminiature=false;
        if(isset($model['POST']) && isset($model['FILES'])){
            $editedid=$model['POST']['id'];
            $title = $model['POST']['title'];
            $info = $model['POST']['info'];
            $price = $model['POST']['price'];
            $price = preg_replace('/[^0-9]/', '', $price);
            if($price==""){
                $price=0;    
            }
            if(isset($model['POST']['status'])){
                $status = 1;
            }
            else {
                $status = 0;
            }
            if(isset($model['POST']['muszla'])){
                $muszla = 1;
            }
            else {
                $muszla = 0;
            }
             

            echo json_encode($model);
            if($editedid!=""){
                //$fi = new FilesystemIterator(__DIR__, FilesystemIterator::SKIP_DOTS);
              //  $photosinfolder=iterator_count($fi);
              
 
            }
            else{
                //liczenie dobrych plikow
                $extension=array("jpeg","jpg","png");
                $numberofinserted=0;
                foreach($model['FILES']['photos']['name'] as $index=>$tmp_name) {
                    $file_name=$model['FILES']['photos']['name'][$index];
                    $ext=pathinfo($file_name,PATHINFO_EXTENSION);
                    if(in_array($ext,$extension) && $model['FILES']['photos']['error'][$index]=="0") {
                        $numberofinserted++;
                    }
                }
                //sprawdzenie czy jest miniatura
                if(isset($model['FILES']['miniature'])){
                    $file_name=$model['FILES']['miniature']['name'];
                    $ext=pathinfo($file_name,PATHINFO_EXTENSION);
                    if(in_array($ext,$extension) && $model['FILES']['miniature']['error']=="0") {
                        $isminiature=true;
                    }
                } 
                //wstawianie produktu
                if($isminiature==true && $numberofinserted!=0){
                    $sql = "INSERT INTO products(NAME,INFO,PRICE,MUSZLA,ILOSC_ZDJEC,STATUS) VALUES('{$title}','{$info}',{$price},{$muszla},{$numberofinserted},{$status})";
                    $data = self::query($sql);
                    echo json_encode($data);
                    $sql ="SELECT ID FROM products ORDER BY ID  DESC LIMIT 1;";
                    $data = self::query($sql);
                    echo ' ';
                    echo json_encode($data);
                    $lastid = $data[0][0];
                    if( is_dir("files/images/products/".$lastid) === false )
                    {   
                        mkdir("files/images/products/".$lastid);
                        mkdir("files/images/products/".$lastid."/fullsize");
                        mkdir("files/images/products/".$lastid."/small");
                    }  
                    $file_tmp=$model['FILES']['miniature']["tmp_name"];
                    move_uploaded_file($file_tmp,"files/images/products/".$lastid."/small/smallphoto.jpg");
                    $imgfolder=1;
                    foreach($model['FILES']['photos']['name'] as $index=>$tmp_name) {
                        $file_name=$model['FILES']['photos']["name"][$index];
                        $file_tmp=$model['FILES']['photos']["tmp_name"][$index];
                        $ext=pathinfo($file_name,PATHINFO_EXTENSION);
                        
                        if(in_array($ext,$extension)  && $model['FILES']['photos']['error'][$index]=="0") {
                            move_uploaded_file($file_tmp,"files/images/products/".$lastid."/fullsize/photo".$imgfolder.".jpg");
                            $imgfolder++;    
                        }
                        else {
                            array_push($error,"Błąd zapisu $file_name, podczas wstawiania produktu.");
                        }
                    }
                }
            }
        }
        else{
            echo 'NOK';
        }

        header('Location: ../admin');
    }
    else{
        $this->view('adminlogin');
    }
    }

    public function editproduct($id){
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            $sql = "SELECT * FROM products WHERE ID = " . $id ;
            $data = self::query($sql);
            $this->view('addproduct',$data[0]);
        }
        else{
            $this->view('adminlogin');
        }
    }

    public function loadProducts($lastid){
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            $limit=12;        
            $sql = "SELECT * FROM products WHERE ID < " . $lastid  . ' AND DELETED!=1 ORDER BY ID DESC limit '.$limit;// . $top;
            $data = self::query($sql);

            $json_array = array();

            foreach($data as $product){            
                $p=(object)["ID"=> $product["ID"],
                    "NAME"=> $product["NAME"],
                    "INFO"=> $product["INFO"],
                    "PRICE"=> $product["PRICE"],
                    "DATE"=> $product["DATE"],
                    "STATUS"=> $product["STATUS"],
                    "MUSZLA"=> $product["MUSZLA"],
                    "ILOSC_ZDJEC"=> $product["ILOSC_ZDJEC"]];
                $json_array[]=$p;
            }
            
            
            echo json_encode($json_array);
        }
        else{
            $this->view('adminlogin');
        }
    }

}

