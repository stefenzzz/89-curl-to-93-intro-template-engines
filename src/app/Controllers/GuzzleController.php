<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Contracts\EmailValidationInterface;


class GuzzleController
{
    public function __construct(
        private EmailValidationInterface $emailValidationService
        )
    {
        
    }
    #[Get('/guzzle')]
    public function index()
    {
        $email = 'phenuthijara@gmail.com';
        $result = $this->emailValidationService->validate($email);

        echo '<pre>';
        print_r($result);
        echo '</pre>';
    }
}
