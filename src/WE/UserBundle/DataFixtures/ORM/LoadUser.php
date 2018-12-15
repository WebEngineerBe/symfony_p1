<?php
// src/WE/UserBundle/DataFixtures/ORM/LoadUser.php
namespace WE\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use WE\UserBundle\Entity\User;

class LoadUser implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste de noms d'utilisateurs
        $a_users = array(
            'steph', 'maria', 'celia', 'clara'
        );
        foreach ($a_users as $s_username) {
            // On crée l'utilisateur
            $o_user = new User();
            $o_user->setUsername($s_username);
            $o_user->setPassword($s_username);
            $o_user->setSalt('');
            $o_user->setRoles(array('ROLE_USER'));
            // On la persiste
            $manager->persist($o_user);
        }
        // On déclenche l'enregistrement
        $manager->flush();
    }
}