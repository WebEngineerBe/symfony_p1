<?php
namespace WE\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{
    /**
     * Crée la connection du user
     * 
     * @param Request $o_req
     * 
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $o_req)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) 
            return $this->redirectToRoute('we_platform_home');
        
        $authenticationUtils = $this->get('security.authentication_utils');
        
        return $this->render('WEUserBundle:Security:login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ));
    }
    
    /**
     * Retourne le role le plus grand du user connecté
     *  - via le Template : src/WE/PlatformBundle/Resources/views/navbar.html.twig
     *
     * @param string $s_data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getRoleAction($s_data = null) 
    {
        $a_role = array();
        
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            if ($this->isGranted('ROLE_SUPER_ADMIN')) {
                $a_role = array('role' => 'ROLE_SUPER_ADMIN', 'role_text' => 'Super admin');
            } elseif ($this->isGranted('ROLE_ADMIN')) {
                $a_role = array('role' => 'ROLE_ADMIN', 'role_text' => 'Admin');
            } elseif ($this->isGranted('ROLE_MODERATEUR')) {
                $a_role = array('role' => 'ROLE_MODERATEUR', 'role_text' => 'Modérateur');
            } elseif ($this->isGranted('ROLE_AUTEUR')) {
                $a_role = array('role' => 'ROLE_AUTEUR', 'role_text' => 'Auteur');
            } else {
                $a_role = array('role' => 'ROLE_USER', 'role_text' => 'Invité');
            }
        }
        
        if (isset($a_role[$s_data]))
            return new Response($a_role[$s_data]);
        else 
            return new Response('Erreur role !');
    }
}