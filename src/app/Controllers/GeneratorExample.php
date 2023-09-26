<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Attributes\{Get};
use App\Models\{Ticket};

// use PDO;
// use App\Models\{User,Invoice,SignUp};

class GeneratorExample
{

    public function __construct(private Ticket $ticketmodel)
    {
       

    }
    #[Get('/generator')]
    public function index()
    {   
        echo '<pre>';
        print_r($this->ticketmodel->generatorExample());
        foreach($this->ticketmodel->generatorExample() as $ticket){

            echo $ticket['id']. ' '.$ticket['title']. PHP_EOL;
        }
        echo '</pre>';
        
    }
    

}