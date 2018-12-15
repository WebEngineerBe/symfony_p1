<?php
namespace WE\TestBundle\Services\DoctrineListener;

use WE\TestBundle\Entity\PageData;
use WE\TestBundle\Entity\LogEvent;
#use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Event\PreFlushEventArgs;
use Monolog\Logger;


class PageDataListener
{
    private $logger;
    
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }
    
    public function prePersist(LifecycleEventArgs $args)
    {
        // Récupère l'Entity
        $entity = $args->getObject();
        
        // On ne veut envoyer un email que pour les entités Application
        if (! $entity instanceof PageData)
            return;
            
        $o_logEvent = new LogEvent();
        $o_logEvent->setName('prePersist');
        $o_logEvent->setO('page=1');
        $o_logEvent->setDate(new \Datetime());
        
        $em = $args->getObjectManager();
        $em->persist($o_logEvent);
        $em->flush();
    }
    
    public function postPersist(LifecycleEventArgs $args)
    {
        // Récupère l'Entity
        $entity = $args->getObject();
        
        // On ne veut envoyer un email que pour les entités Application
        if (! $entity instanceof PageData)
            return;
            
        $o_logEvent = new LogEvent();
        $o_logEvent->setName('postPersist');
        $o_logEvent->setO('page=1');
        $o_logEvent->setDate(new \Datetime());
        
        $em = $args->getObjectManager();
        $em->persist($o_logEvent);
        $em->flush();
    }
    
    public function preUpdate(PreUpdateEventArgs $args)
    {
        // Récupère l'Entity
        $entity = $args->getEntity();
        
        // On ne veut envoyer un email que pour les entités Application
        if (! $entity instanceof PageData)
            return;
        
        if ($args->hasChangedField('param')) {
            // Some stuff
        }
        
        $o_logEvent = new LogEvent();
        $o_logEvent->setName('preUpdate');
        $o_logEvent->setO('page=1');
        $o_logEvent->setDate(new \Datetime());
        
        $em = $args->getObjectManager();
        $em->persist($o_logEvent);
        $em->flush();
    }
    
    public function postUpdate(LifecycleEventArgs $args)
    {
        // Récupère l'Entity
        $entity = $args->getObject();
        
        /*$uow = $em->getUnitOfWork();
         $uow->computeChangeSets();
         $changeset = $uow->getEntityChangeSet($entity);*/
        //$OriginalEntityData = $uow->getOriginalEntityData( $entity );
        
        // On ne veut envoyer un email que pour les entités Application
        if (! $entity instanceof PageData)
            return;
        
        $o_logEvent = new LogEvent();
        $o_logEvent->setName('postUpdate');
        $o_logEvent->setO('page=1');
        $o_logEvent->setDate(new \Datetime());
        
        $em = $args->getObjectManager();
        $em->persist($o_logEvent);
        $em->flush();
    }
    
    public function postLoad(LifecycleEventArgs $args)
    {
        // Récupère l'Entity
        $entity = $args->getObject();
        
        // On ne veut envoyer un email que pour les entités Application
        if (! $entity instanceof PageData)
            return;
            
        $o_logEvent = new LogEvent();
        $o_logEvent->setName('postLoad');
        $o_logEvent->setO('page=1');
        $o_logEvent->setDate(new \Datetime());
        
        $em = $args->getObjectManager();
        $em->persist($o_logEvent);
        $em->flush();
        
        //$logger = $this->get('logger');
        
        $this->logger->info('Tout va bien, je suis en version 2.3');
        $this->logger->error('Je ne peux pas trouver la voiture n°53');
        $this->logger->critical('Il manque un ; !!');
    }
    
    public function preFlush(LifecycleEventArgs $args)
    {
        // Récupère l'Entity
        $entity = $args->getObject();
        
        // On ne veut envoyer un email que pour les entités Application
        if (! $entity instanceof PageData)
            return;
            
        $o_logEvent = new LogEvent();
        $o_logEvent->setName('preFlush');
        $o_logEvent->setO('page=1');
        $o_logEvent->setDate(new \Datetime());
        
        $em = $args->getObjectManager();
        $em->persist($o_logEvent);
        $em->flush();
    }
}