<?php
namespace WE\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavbarController extends Controller
{
    public function getDataAction()
    {
        $a_menu = array();
        $a_menu['left'][] = array('href' => $this->generateUrl('we_platform_home'), 'label' => 'Accueil', 'active' => true);
        $a_menu['left'][] = array('href' => $this->generateUrl('we_platform_view', array('id' => 1)), 'label' => 'Annonces', 'active' => false, 'secondary' => array(
            0 => array('href' => $this->generateUrl('we_platform_add'), 'label' => 'Ajouter une annonce', 'active' => false),
            1 => array('href' => $this->generateUrl('we_platform_view', array('id' => 1)), 'label' => "Voir une annonce", 'active' => false),
            2 => array('href' => $this->generateUrl('we_platform_edit', array('id' => 1)), 'label' => "Editer une annonce ", 'active' => false),
            3 => array('href' => $this->generateUrl('we_platform_delete', array('id' => 1)), 'label' => "Supprimer une annonce", 'active' => false),
            3 => array('href' => $this->generateUrl('we_platform_salut'), 'label' => "Hello world", 'active' => false)
        ));
        $a_menu['left'][] = array('href' => $this->generateUrl('we_platform_jsonOrHtml', array('id' => 9)), 'label' => 'Données Json', 'active' => false);
        //$a_menu['right'][] = array('href' => '#facebook', 'label' => 'Facebook', 'active' => false);
        //$a_menu['right'][] = array('href' => '#twitter', 'label' => 'Twitter', 'active' => false);
        
        //if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            //print_r($this->get('security.token_storage')->getToken()->getUser()->getRoles());
            $a_menu['right'][] = array('href' => $this->generateUrl('fos_user_security_logout'), 'label' => 'Déconnexion', 'active' => false, 'fontawesome' => 'fa-sign-out', 'a_user' => array(
                'username' => $this->getUser()->getUsername()
            ));
        } else { 
            $a_menu['right'][] = array('href' => $this->generateUrl('fos_user_security_login'), 'label' => 'Connexion', 'active' => false, 'fontawesome' => 'fa-sign-in');
        }
        
        return $this->render('WEPlatformBundle::navbar.html.twig', array('a_menu' => $a_menu));
    }
}