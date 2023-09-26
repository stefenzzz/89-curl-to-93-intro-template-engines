<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Attributes\{Get, Post};
use App\Models\Email as ModelsEmail;
use App\View;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class UserController
{
    public function __construct(public MailerInterface $mailer)
    {

    }

    #[Get('/users/create')]
    public function create():View
    {
      
        return View::make('users/register');
    }

    #[Get('/users/emailschedule')]
    public function createAll():View
    {
      
        return View::make('users/emailschedule');
    }

    #[Post('/users')]
    public function register()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $firstName = explode(' ',$name)[0];

        $text = <<<Body
        Hello $firstName,

        Thank you for signing up!

        Body;

        $html = <<<HTMLBody

        <h1 style="text-align: center; color: blue;">Welcome</h1>
        Hello $firstName,
        <br /><br />
        Thank you for signing up!

        HTMLBody;

        // to send email using symfony we need 
        // first - trasponter object
        // second - mailer service
        // third - email object

        // first build the email object and chain the properties

        $email = (new Email())
                ->from('support@example.com')
                ->to($email)
                ->subject('Welcome')
                ->attach('hell world','attachment.txt')
                ->text($text)
                ->html($html);

        // now we created the email object we need to send this using the mailing service by create the mailing class
        // we need to create a tranposter object to pass in to the mailer constructor paramter

    
        // we simply created a custom mailer in services directory and swap the builtin mailer object in symfony
        $this->mailer->send($email);

    }
    #[Post('/users/emailschedule')]
    public function emailschedule()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $firstName = explode(' ',$name)[0];

        $text = <<<Body
        Hello $firstName,

        Thank you for signing up!

        Body;

        $html = <<<HTMLBody

        <h1 style="text-align: center; color: blue;">Welcome</h1>
        Hello $firstName,
        <br /><br />
        Thank you for signing up!

        HTMLBody;

        (new ModelsEmail())->queue(
            new Address($email),
            new Address('support@example.com'),
            'Welcome!',
            $html,
            $text,
        );
    }
}