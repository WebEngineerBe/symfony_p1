<?php
// src/WE/PlatformBundle/Services/Email/ApplicationMailer.php
namespace WE\PlatformBundle\Services\Email;

use WE\PlatformBundle\Entity\Application;

class ApplicationMailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    
    /**
     * @var string
     */
    private $email;
    
    public function __construct(\Swift_Mailer $mailer, $email)
    {
        $this->mailer = $mailer;
        $this->email = $email;
    }

    public function sendNewNotification(Application $application)
    {
        $message = new \Swift_Message(
            'Nouvelle candidature', 
            'Vous avez reçu une nouvelle candidature.')
        ;
        
        $message
            //->addTo($application->getAdvert()->getAuthor()) // Ici bien sûr il faudrait un attribut "email", j'utilise "author" à la place
            ->addTo($this->email) 
            ->addFrom('info@webengineer.be')
        ;
        
        $this->mailer->send($message);
    }
}