<?php

declare(strict_types = 1);

namespace App\Services;

use App\Enums\EmailStatus;
use App\Models\Email as ModelsEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{

    public function __construct(
        protected ModelsEmail $emailModel,
        protected MailerInterface $mailer
        )
    {
        
    }
    public function send(array $to, string $template): bool
    {
        // sleep(1);

        return true;
    }

    public function sendQueuedEmails():void
    {

        
        $emails = $this->emailModel->getEmailByStatus(EmailStatus::Queue);

        foreach($emails as $email){

            $meta = json_decode($email->meta, true);

            $emailMessage = (new Email())
                            ->from($meta['from'])
                            ->to($meta['to'])
                            ->subject($email->subject)
                            ->text($email->text_body)
                            ->html($email->html_body);

    
            $this->mailer->send($emailMessage);

            // $this->emailModel->markEmailSent($email->id);
      
        }
        

          

    }
}