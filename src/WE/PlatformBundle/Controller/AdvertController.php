<?php
namespace WE\PlatformBundle\Controller;

use WE\PlatformBundle\Entity\Advert;
use WE\PlatformBundle\Entity\AdvertSkill;
use WE\PlatformBundle\Entity\Application;
use WE\PlatformBundle\Entity\Image;
use WE\PlatformBundle\Form\AdvertType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use WE\PlatformBundle\Form\AdvertEditType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class AdvertController extends Controller
{
    public function indexAction($page)
    {
        if ($page<1)
            throw new NotFoundHttpException("Page $page inexistante !");
            
        // On récupère le service
        $o_antispam = $this->container->get('we_platform.services.antispam');
        // Le text à vérifier
        $s_text = "J'ai moins de xxx caractères.";
        // Vérifie le texts
        if ($o_antispam->isSpam($s_text))
            throw new \Exception('Votre message a été détecter comme spam !');
        
        // Nombre maximum par page
        $nbParPage = 5;
        // Retourne les annonces
        $listAdverts = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('WEPlatformBundle:Advert')
            //->findAll()
            ->getAdverts($page, $nbParPage)
        ;
        // Nombre total d'annonces
        $nbPages=ceil(count($listAdverts)/$nbParPage);
        
        // Si la page n'existe pas, on retourne une 404
        if ($page > $nbPages) 
            throw $this->createNotFoundException("La page ".$page." n'existe pas !");
        
        return $this->render('WEPlatformBundle:Advert:index.html.twig', array(
            'listAdverts' => $listAdverts,
            'nbPages'     => $nbPages,
            'page'        => $page,
        ));
    }
    
    public function viewAction($id, Request $o_req)
    {
        // On récupère le repository
        //$repository = $this->getDoctrine()->getManager()->getRepository('WEPlatformBundle:Advert');
        // On récupère l'entité correspondante à l'id $id
        //$advert = $repository->find($id);
        // Autre syntaxe
        //$advert = $this->getDoctrine()->getManager()->find('WEPlatformBundle:Advert', $id);
        
        $em = $this->getDoctrine()->getManager();
        // On récupère l'annonce $id
        $advert = $em->getRepository('WEPlatformBundle:Advert')->find($id);
        
        // $advert est donc une instance de OC\PlatformBundle\Entity\Advert
        // ou null si l'id $id n'existe pas, d'où ce if :
        if (null === $advert) 
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        
        // On récupère la liste des candidatures à cette annonce.
        $listApplications = $em->getRepository('WEPlatformBundle:Application')->findBy(array('advert' => $advert));
        
        // On récupère maintenant la liste des AdvertSkill
        $listAdvertSkills = $em->getRepository('WEPlatformBundle:AdvertSkill')->findBy(array('advert' => $advert));
        
        return $this->render('WEPlatformBundle:Advert:view.html.twig', array(
            'advert' => $advert,
            'listApplications' => $listApplications,
            'listAdvertSkills' => $listAdvertSkills
        ));
    }
    
    /**
     * @Security("has_role('ROLE_ADMIN')")
     * 
     * @param Request $o_req
     * 
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $o_req)
    {
        $advert = new Advert();
        
        //$form = $this->get('form.factory')->createBuilder(AdvertType::class, $advert);
        // ou
        $form = $this->createForm(AdvertType::class, $advert);
        
        if ($o_req->isMethod('POST') && $form->handleRequest($o_req)->isValid()) {
            // Déplace l'image dans le dossier
            //$advert->getImage()->upload();
            
            $advert->setIp($o_req->server->get('REMOTE_ADDR'));
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();
            
            $o_req->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
            
            return $this->redirectToRoute('we_platform_view', array('id' => $advert->getId()));
        }
        
        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('WEPlatformBundle:Advert:add.html.twig', array(
            //'form' => $form->getForm()->createView()
            // ou
            'form' => $form->createView()
        ));
    }
    
    /**
     * @Security("has_role('ROLE_AUTEUR') or has_role('ROLE_MODERATEUR')")
     * 
     * @param int $id
     * @param Request $o_req
     * @throws NotFoundHttpException
     * 
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction($id, Request $o_req)
    {
        $em = $this->getDoctrine()->getManager();
        // On récupère l'annonce $id
        $advert = $em->getRepository('WEPlatformBundle:Advert')->find($id);
        if (null === $advert) 
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        
        $form = $this->createForm(AdvertEditType::class, $advert, array('advert_id' => $id));
        
        //$this->logger->info('Tout va bien, je suis en version 2.3');
        //$this->logger->error('Je ne peux pas trouver la voiture n°53');
        //$this->logger->critical('Il manque un ; !!');
        
        if ($o_req->isMethod('POST') && $form->handleRequest($o_req)->isValid()) {
            
            //$o_antiflood = $this->container->get('we_platform.services.validator.antiflood');
            //$o_antiflood->validate("");
            
            // Déplace l'image dans le dossier
            //$advert->getImage()->upload();
            
            $advert->setIp($o_req->server->get('REMOTE_ADDR'));
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();
            
            $o_req->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée !');
            
            return $this->redirectToRoute('we_platform_view', array('id' => $id));
        }
        
        return $this->render('WEPlatformBundle:Advert:edit.html.twig', array(
            'advert' => $advert,
            'form' => $form->createView()
        ));
    }
    
    /**
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     * 
     * @param unknown $id
     * @param Request $o_req
     * @throws NotFoundHttpException
     * 
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($id, Request $o_req)
    {
        $em = $this->getDoctrine()->getManager();
        
        // On récupère l'annonce $id
        $advert = $em->getRepository('WEPlatformBundle:Advert')->find($id);
        if (null === $advert)
            throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
        
        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
        // Cela permet de protéger la suppression d'annonce contre cette faille
        $form = $this->get('form.factory')->create();
            
        // On boucle sur les catégories de l'annonce pour les supprimer
        foreach ($advert->getCategories() as $category) {
            $advert->removeCategory($category);
        }
        
        if ($o_req->isMethod('POST') && $form->handleRequest($o_req)->isValid()) {
            $em->remove($advert);
            $em->flush();
            
            $o_req->getSession()->getFlashBag()->add('info', "L'annonce a bien été supprimée.");
            
            return $this->redirectToRoute('we_platform_home');
        }
        
        return $this->render('WEPlatformBundle:Advert:delete.html.twig', array(
            'advert' => $advert,
            'form'   => $form->createView()
        ));
    }
    
    public function jsonOrHtmlAction($id, Request $o_req)
    {
        if ($o_req->isXmlHttpRequest()) {
            return new JsonResponse(array(
                'id' => $o_req->request->get('id'), // $_POST['id']
                'type' => 'json'
            ));
        } else {
            return $this->render('WEPlatformBundle:Advert:jsonOrHtml.html.twig', array(
                'id' => $id, // $_GET['id']
                'type' => 'html'
            ));
        }
    }
    
    public function salutAction()
    {
        $xml = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/src/WE/PlatformBundle/Resources/config/transaction.xml');
        $xml_array = unserialize(serialize(json_decode(json_encode((array) $xml), 1)));
        echo '<pre>';print_r($xml_array);echo '</pre>';
        //$var = strip_tags(var_export($xml_array));
        return new Response('');
    }
}