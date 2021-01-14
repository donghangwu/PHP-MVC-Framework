<?php
namespace app;
require_once "../controller/MainController.php";
class Router
{
    public array $getRoutes=[];
    public array $postRoutes=[];
    public Database $db;

    public function __construct()
    {
        # code...
        $this->db=new Database();
    }
    public function get($url,$fn)
    {
        $this->getRoutes[$url]=$fn;
    }

    public function post($url,$fn)
    {
        $this->postRoutes[$url]=$fn;
    }

    public function resolve()
    {
        //$fn='';
        $curUrl=$_SERVER['PATH_INFO']?? '/';
        $curMethod=strtolower($_SERVER['REQUEST_METHOD']);
        if($curMethod==='get')
        {
            $fn=$this->getRoutes[$curUrl]??null;
        }
        else{
            $fn=$this->postRoutes[$curUrl]??null;
        }
        if($fn)
        {
            //excuete the function from mainController
            call_user_func($fn,$this);
        }
        else{
            echo "404 <br> Page Not Found ";
        }

       

    }
    public function renderView($view,$params=[])
    {
        foreach($params as $key=> $value)
        {
            $$key=$value;
            //create a product variable out of the 'product' string
        }
        //save anything into buffer and will not send to the web
        ob_start();
        include __DIR__."/views/$view.php";
        //the value of the include_once file will be saved in $conent
        $content=ob_get_clean();//return those output and clean the buffer
        include __DIR__."/views/layout.php";

    }
}