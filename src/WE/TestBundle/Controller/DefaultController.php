<?php

namespace WE\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WE\TestBundle\Entity\LogEvent;
use WE\TestBundle\Entity\Page;
use WE\TestBundle\Entity\PageData;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        // On récupère l'annonce $id
        $a_page = $em->getRepository('WETestBundle:Page')->find(1);
        //$a_pageData = $em->getRepository('WETestBundle:PageData')->findBy(array('page' => $a_page));
        $a_pageData = $em->getRepository('WETestBundle:PageData')->findOneBy(array('page' => $a_page, 'url' => 'fr-carrelages-bruxelles-html'));
        //$a_pageData = $em->getRepository('WETestBundle:PageData')->findOneBy(array('url' => 'fr-carrelages-bruxelles-html'));
        //$a_pageData = $em->getRepository('WETestBundle:PageData')->findOneByUrl('fr-carrelages-bruxelles-html');
        
        return $this->render('WETestBundle:Default:index.html.twig', array(
            //'page' => $a_page,
            'pageData' => $a_pageData
        ));
    }
    
    public function test0Action()
    {
        $em = $this->getDoctrine()->getManager();
        
        $o_repository = $em->getRepository('WETestBundle:PageData');
        $listPage = $o_repository->findOneByUrl('fr-carrelages-bruxelles-html');
        
        $a_page = $em->getRepository('WETestBundle:Page')->find($listPage->getPage()->getId());
        
        return $this->render('WETestBundle:Default:queryBulder.html.twig', array(
            'data' => $listPage,
            'other' => $a_page
        ));
    }
    
    public function test1Action()
    {
        $em = $this->getDoctrine()->getManager();
        
        $o_repository = $em->getRepository('WETestBundle:Page');
        $listPage = $o_repository->myFindAll();
        
        return $this->render('WETestBundle:Default:queryBulder.html.twig', array(
            'data' => $listPage
        ));
    }
    
    public function test2Action()
    {
        $em = $this->getDoctrine()->getManager();
        
        $o_repository = $em->getRepository('WETestBundle:Page');
        $listPage = $o_repository->myFindOne(1);
        
        return $this->render('WETestBundle:Default:queryBulder.html.twig', array(
            'data' => $listPage
        ));
    }
    
    public function test3Action()
    {
        $em = $this->getDoctrine()->getManager();
        
        $o_repository = $em->getRepository('WETestBundle:Page');
        $pageData = $o_repository->getPageDataByUrl('fr-carrelages-bruxelles-html');
        
        return $this->render('WETestBundle:Default:queryBulder.html.twig', array(
            'data' => $pageData
        ));
    }
    
    public function test4Action()
    {
        $em = $this->getDoctrine()->getManager();
        
        $o_repository = $em->getRepository('WETestBundle:PageData');
        $o_currentPage = $o_repository->findOneByUrl('fr-carrelages-bruxelles-html');
        
        $o_repository = $em->getRepository('WETestBundle:PageData');
        $a_pageDatas = $o_repository->getPageDataById(array(
            'id' => $o_currentPage->getPage()->getId(),
            'toArray' => true
        ));
        
        $a_pds = array();
        if ((is_array($a_pageDatas)) && (count($a_pageDatas)>0)) {
            foreach ($a_pageDatas as $a_pageData) {
                $a_pds[$a_pageData['lang']] = $a_pageData;
            }
        }
        
        return $this->render('WETestBundle:Default:queryBulder.html.twig', array(
            'data' => $a_pds,
            'other' => $o_currentPage
        ));
    }
    
    public function test5Action()
    {
        $em = $this->getDoctrine()->getManager();
        
        //$o_repository = $em->getRepository('WETestBundle:PageData');
        //$o_pageData = $o_repository->find(1);
        $o_repository = $em->getRepository('WETestBundle:PageData');
        $o_currentPage = $o_repository->findOneByUrl('fr-carrelages-bruxelles-html');
        
        /*$o_currentPage->setTitle('Carrelages Bruxelles 3');
        $em->persist($o_currentPage);
        $em->flush();*/
        
        // On crée la compètence
        /*$o_page = new Page();
        $o_page->setToken('2224ab0aba94f0e3c427075f4254c35c4a2ac222');
        $o_page->setParentId(0);
        $o_page->setSId(1);
        $o_page->setType('contact');
        $o_page->setPosition(1);
        $o_page->setStatus(2);
        
        // Init var
        $a_pagePage = array();
        $a_pagePage['fr'] = new PageData();
        $a_pagePage['fr']->setLang('fr');
        $a_pagePage['fr']->setTitle('Test2 pour le slug');
        $a_pagePage['fr']->setTitleBtn('Test2');
        $a_pagePage['fr']->setContent('blabla bla...');
        //$a_pagePage['fr']->setUrl('fr/test1.html');
        $a_pagePage['fr']->setStatus(2);
        // On lie les dats à page
        $a_pagePage['fr']->setPage($o_page);
        
        $em->persist($o_page);
        $em->persist($a_pagePage['fr']);
        $em->flush();*/
        
        return $this->render('WETestBundle:Default:queryBulder.html.twig', array(
            'data' => $o_currentPage,
            //'other' => $a_pagePage['fr']->getUrl()
        ));
    }
}
