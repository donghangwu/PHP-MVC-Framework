<?php
namespace app\models;
use app\Database;

class Product
{
    public ?int $id=null;
    public ?string $title=null;
    public ?string $desc=null;
    public ?float $price=null;
    public ?string $imagePath=null;
    public ?array $imageFile=null;

    public function load($data)
    {
        $this->id=(int)$data['id']??null;
        $this->title=$data['title']??null;
        $this->desc=$data['desc']??null;
        $this->price=(float)$data['price']??null;
        $this->imagePath=$data['image']??null;
        $this->imageFile=$data['imageFile']??null;

    }
    public function save()
    {
        $errors=[];
        if(!$this->title)
        {
            $errors[]='Product title is required';
        }
        if(!$this->price)
        {
            $errors[]='Product price is required';
        }
        if(!empty($errors))
        {
            return $errors;
        }
        $db = Database::$db;
        print_r($this);
        exit();
        if($this->id){
            $db->updateProduct($this);
        }
        else{
            $lastid=$db->createProduct($this);
            echo $lastid;
            echo'<br>';
            print_r($this->imageFile);
             //upload image:
            if($this->imageFile&&$this->imageFile['tmp_name'])
            {
                if (!is_dir(__DIR__ . '/../public/images')) {
                    mkdir(__DIR__ . '/../public/images');
                }
                //make sure the upload files are not the same with previous one
                //use lastintertId to unique identify each product
                $this->imagePath = 'images/' .$lastid. '/' . $this->imageFile['name'];
                mkdir(dirname($this->imagePath));
                move_uploaded_file($this->imageFile['tmp_name'], $this->imagePath);
                $db->updateImage($this->imagePath,$lastid);

            }
        }

    }

    public function getProductbyId($id)
    {
        $db = Database::$db;
        return $db->getProductById($id);
    }
}