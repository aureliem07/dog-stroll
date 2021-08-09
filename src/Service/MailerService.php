<?php

namespace App\Service;

use Twig\Environment;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class MailerService{
  private $mailer;

  public function __construct(MailerInterface $mailer)
  {
    $this->mailer = $mailer;
  }

  public function send($from,$to,$subject,$content){
    $email = (new TemplatedEmail())->from($from)
                          ->to($to)
                          ->subject($subject)
                          ->htmlTemplate('mailer/mailer.html.twig')
                          ->context([
                            'to' => $to,
                            'subject' => $subject,
                            'content' => $content
                          ]);

    $this->mailer->send($email);
  }
}
