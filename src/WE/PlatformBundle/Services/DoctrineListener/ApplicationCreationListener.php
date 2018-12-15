<?php
// src/WE/PlatformBundle/Services/DoctrineListener/ApplicationCreationListener.php
namespace WE\PlatformBundle\Services\DoctrineListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use WE\PlatformBundle\Services\Email\ApplicationMailer;
use WE\PlatformBundle\Entity\Application;

class ApplicationCreationListener
{
    /**
     * @var ApplicationMailer
     */
    private $applicationMailer;

    public function __construct(ApplicationMailer $applicationMailer)
    {
        $this->applicationMailer = $applicationMailer;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        
        // On ne veut envoyer un email que pour les entités Application
        if (! $entity instanceof Application) 
            return;
        
        $this->applicationMailer->sendNewNotification($entity);
    }
}