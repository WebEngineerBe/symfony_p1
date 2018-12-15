<?php
// src/WE/PlatformBundle/DataFixtures/ORM/LoadSkill.php
namespace WE\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use WE\PlatformBundle\Entity\Skill;

class LoadSkill implements FixtureInterface
{

    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $names = array(
            'PHP', 'JavaScript', 'Online Marketing', 'MySQL', 'Zend Framework', 
            'Zend Studio', 'Smarty', 'jQuery', 'XML', 'Ajax', 'XSL', 'XSLT', 
            'MVC', 'POO', 'Design Patterns', 'Photoshop', 'CSS2', 'CSS3', 
            'XHTML', 'HTML', 'HTML5', 'RSS', 'Tortoise SVN', 'VPN', 
            'Eclipse IDE', 'JSON', 'Underscore', 'Backbone.js', 'Internet', 
            'Backbone', 'création de site web', 'NodeJS', 'Socket.IO', 
            'MongoDB', 'Mongoose', 'Script Shell', 'Serveur Linux', 
            'Twitter Bootstrap', 'Docker', 'Back-Office', 'Front-Office'
        );
        foreach ($names as $name) {
            // On crée la compètence
            $skill = new Skill();
            $skill->setName($name);
            // On la persiste
            $manager->persist($skill);
        }
        // On déclenche l'enregistrement de toutes les compètences
        //$manager->flush();
    }
}