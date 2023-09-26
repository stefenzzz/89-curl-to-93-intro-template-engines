<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\{View, App, Container};
use App\Services\InvoiceService;
use App\Attributes\Get;
use App\Attributes\Post;

// use PDO;
// use App\Models\{User,Invoice,SignUp};

class HomeController
{
    
    
    public function __construct()
    {

    }
    #[Get('/')]
    #[Post(routePath: '/home')]
    public function index():View
    {   
      
        return View::make('index');
    }

    #[Get('/curl')]
    public function curl()
    {
        $handle = curl_init();
        
        var_dump($handle);

        $param = [
            'api_key' => 'test_6447200e184c11ebc843',
            'email' => 'phenuthijara@gmail.com'
        ];

        $url = 'https://api.emailable.com/v1/verify?'.http_build_query($param);
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($handle);

        if($content != false){
            $data = json_decode($content,true);
            echo '<pre>';
            print_r($data);
        }

       
    }
}