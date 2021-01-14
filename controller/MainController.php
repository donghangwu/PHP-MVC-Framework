<?php
namespace app\controllers;

use app\models\Product;
use app\Router;

class MainController{

    public function index(Router $router)
    {
        $keyword=$_GET['search']?? '';
        $products=$router->db->getProducts($keyword);

        return $router->renderView('products/index',
    ['products'=>$products,
     'search'=>$keyword
    ]);
    }

    public function create(Router $router)
    {
        $errors=[];
        $productData=[
            'title'=>'',
            'desc'=>'',
            'imageFile'=>'',
            'price'=>'',
            'create_date'=>''
        ];
        if($_SERVER['REQUEST_METHOD']==='POST')
        {
            $productData['title']=$_POST['title'];
            $productData['desc']=$_POST['description'];
            $productData['price']=$_POST['price'];
            $productData['imageFile']=$_FILES['image']??null;
            $product = new Product();
            //get all the data for mysql to create
            $product->load($productData);
            //save all data to mysql
            $errors=$product->save();
            //transfer user to index page
            if(empty($errors))
            {
                header('Location: /');
                exit();
            }

        }

        $router->renderView('products/create',
        ['products'=>$productData,
        'errors'=>$errors
        ]);
    }

    public function edit(Router $router)
    {
        $errors=[];
        $productData=[
            'id'=>'',
            'title'=>'',
            'desc'=>'',
            'imageFile'=>'',
            'price'=>'',
            'create_date'=>''
        ];
        $id='';
        $id=$_GET['id'];
        $data=$router->db->getProductById($id);
        $productData['id']=$_GET['id'];
        $productData['title']=$data['title'];
        $productData['desc']=$data['description'];
        $productData['price']=$data['price'];
        $productData['imageFile']=$data['image'];
        
        //deal with request
        if($_SERVER['REQUEST_METHOD']==='POST')
        {
            // print_r($data);
            // exit();
            $productData['title']=$_POST['title'];
            $productData['desc']=$_POST['description'];
            $productData['price']=$_POST['price'];
            $productData['imageFile']=$_FILES['image']??null;
            $product = new Product();
            //get all the data for mysql to create
            $product->load($productData);
            //save all data to mysql
            $errors=$product->save();
            //transfer user to index page
            if(empty($errors))
            {
                header('Location: /');
                exit();
            }

        }

        $router->renderView('products/edit',
        ['products'=>$productData,
        'errors'=>$errors
        ]);
    }

    public function delete(Router $router)
    {
        $id=$_POST['id']??null;
        if(!$id)
        {
            header('Location: /');
        }
        $router->db->deleteProduct($id);
        header('Location: /');
    }
}