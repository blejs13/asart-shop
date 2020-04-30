<?php

class Products extends Controller{
    public function index(){
        $_SESSION['numberOfProducts']=0;
        $this->view('products');
    }

    public function loadProducts($lastid){
        $limit=12;        
        $sql = "SELECT * FROM products WHERE ID < " . $lastid  . ' AND STATUS=1 AND DELETED!=1 ORDER BY ID DESC limit '.$limit;// . $top;
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

    public function loadProductstest(){
        echo json_encode($_POST);
    }
}