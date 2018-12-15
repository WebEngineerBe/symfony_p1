<?php
// src/WE/PlatformBundle/DataFixtures/ORM/LoadPage.php
namespace WE\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use WE\TestBundle\Entity\Page;
use WE\TestBundle\Entity\PageData;

class LoadPage implements FixtureInterface
{

    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des pages à ajouter
        $a_pages = array();
        $a_pages[0] = array(
            'token' => 'fd34ab0aba94f0e3c427075f4254c35c4a2ac5d5',
            'parent_id' => 0,
            's_id' => 1,
            'type' => 'home',
            'position' => 1,
            'status' => 1,
            'data' => array(
                0 => array(
                    'lang' => 'fr',
                    'title' => 'Carrelages Bruxelles',
                    'titleBtn' => 'Accueil',
                    'content' => 'Itaque verae amicitiae difficillime reperiuntur in iis qui in honoribus reque publica versantur; ubi enim istum invenias qui honorem amici anteponat suo?',
                    'url' => 'fr/carrelages+bruxelles.html',
                    'status' => 1
                ),
                1 => array(
                    'lang' => 'nl',
                    'title' => 'Tegels Brussel',
                    'titleBtn' => 'Home',
                    'content' => 'Haec ut omittam, quam graves, quam difficiles plerisque videntur calamitatum societates! Ad quas non est facile inventu qui descendant. Quamquam Ennius recte.',
                    'url' => 'nl/tegels+brussel.html',
                    'status' => 1
                ),
                2 => array(
                    'lang' => 'it',
                    'title' => 'Mattonelle Bruxelles',
                    'titleBtn' => 'Home page',
                    'content' => 'Utque aegrum corpus quassari etiam levibus solet offensis, ita animus eius angustus et tener, quicquid increpuisset, ad salutis suae dispendium existimans factum aut cogitatum, insontium caedibus fecit victoriam luctuosam.',
                    'url' => 'it/mattonelle-bruxelles.html',
                    'status' => 2
                )
            )
        );
        $a_pages[1] = array(
            'token' => 'da24ab0aba94ffv7c427075f4254c35cia2ar53x',
            'parent_id' => 0,
            's_id' => 1,
            'type' => 'categorie',
            'position' => 2,
            'status' => 1,
            'data' => array(
                0 => array(
                    'lang' => 'fr',
                    'title' => 'Le plus grand choix de carrelages à Bruxelles',
                    'titleBtn' => 'Carrelages',
                    'content' => 'Itaque verae amicitiae difficillime reperiuntur in iis qui in honoribus reque publica versantur; ubi enim istum invenias qui honorem amici anteponat suo?',
                    'url' => 'fr/le+plus+grand+choix+de+carrelages+%C3%A0+bruxelles.html',
                    'status' => 1
                ),
                1 => array(
                    'lang' => 'nl',
                    'title' => 'Het grootste aanbod van tegels in Brussel',
                    'titleBtn' => 'Tegels',
                    'content' => 'Haec ut omittam, quam graves, quam difficiles plerisque videntur calamitatum societates! Ad quas non est facile inventu qui descendant. Quamquam Ennius recte.',
                    'url' => 'nl/het+grootste+aanbod+van+tegels+in+brussel.html',
                    'status' => 1
                )
            )
        );
        $a_pages[2] = array(
            'token' => 'opml7b0aba94f0e3c4er675f4253c35cra2acgh6',
            'parent_id' => 2,
            's_id' => 1,
            'type' => 'produit',
            'position' => 1,
            'status' => 1,
            'data' => array(
                0 => array(
                    'lang' => 'fr',
                    'title' => 'Carrelage sol aspect carreaux de ciment',
                    'titleBtn' => 'Carrelage sol aspect carreaux de ciment',
                    'content' => 'Itaque verae amicitiae difficillime reperiuntur in iis qui in honoribus reque publica versantur; ubi enim istum invenias qui honorem amici anteponat suo?',
                    'url' => 'fr/carrelage+sol+aspect+carreaux+de+ciment+.html',
                    'status' => 1
                ),
                1 => array(
                    'lang' => 'nl',
                    'title' => 'Keramische motief tegel',
                    'titleBtn' => 'Keramische motief tegel',
                    'content' => 'Haec ut omittam, quam graves, quam difficiles plerisque videntur calamitatum societates! Ad quas non est facile inventu qui descendant. Quamquam Ennius recte.',
                    'url' => 'nl/keramische+motief+tegel.html',
                    'status' => 1
                )
            )
        );
        $a_pages[3] = array(
            'token' => 'scg4ty7aba94f0e3c427075f425rc35cya2dfza1',
            'parent_id' => 2,
            's_id' => 1,
            'type' => 'produit',
            'position' => 2,
            'status' => 1,
            'data' => array(
                0 => array(
                    'lang' => 'fr',
                    'title' => 'Carrelage sol aspect bois',
                    'titleBtn' => 'Carrelage sol aspect bois',
                    'content' => 'Itaque verae amicitiae difficillime reperiuntur in iis qui in honoribus reque publica versantur; ubi enim istum invenias qui honorem amici anteponat suo?',
                    'url' => 'fr/carrelage+sol+aspect+bois.html',
                    'status' => 1
                ),
                1 => array(
                    'lang' => 'nl',
                    'title' => 'Vloertegel houtlook',
                    'titleBtn' => 'Vloertegel houtlook',
                    'content' => 'Haec ut omittam, quam graves, quam difficiles plerisque videntur calamitatum societates! Ad quas non est facile inventu qui descendant. Quamquam Ennius recte.',
                    'url' => 'nl/vloertegel+houtlook.html',
                    'status' => 1
                )
            )
        );
        $a_pages[4] = array(
            'token' => 'dd34ab0aba94f0e3c427075f4254c35c4a2acddd',
            'parent_id' => 2,
            's_id' => 1,
            'type' => 'produit',
            'position' => 3,
            'status' => 2,
            'data' => array(
                0 => array(
                    'lang' => 'fr',
                    'title' => 'Carrelage sol aspect béton-ciment',
                    'titleBtn' => 'Carrelage sol aspect béton-ciment',
                    'content' => 'Itaque verae amicitiae difficillime reperiuntur in iis qui in honoribus reque publica versantur; ubi enim istum invenias qui honorem amici anteponat suo?',
                    'url' => 'fr/carrelage+sol+aspect+béton-ciment.html',
                    'status' => 1
                ),
                1 => array(
                    'lang' => 'nl',
                    'title' => 'Vloertegel betonlook',
                    'titleBtn' => 'Vloertegel betonlook',
                    'content' => 'Haec ut omittam, quam graves, quam difficiles plerisque videntur calamitatum societates! Ad quas non est facile inventu qui descendant. Quamquam Ennius recte.',
                    'url' => 'nl/vloertegel+betonlook.html',
                    'status' => 1
                ),
                2 => array(
                    'lang' => 'it',
                    'title' => 'Mattonelle di cemento-cemento',
                    'titleBtn' => 'Mattonelle di cemento-cemento',
                    'content' => 'Utque aegrum corpus quassari etiam levibus solet offensis, ita animus eius angustus et tener, quicquid increpuisset, ad salutis suae dispendium existimans factum aut cogitatum, insontium caedibus fecit victoriam luctuosam.',
                    'url' => 'it/mattonelle-di-cemento-cemento.html',
                    'status' => 2
                )
            )
        );
        $a_pages[5] = array(
            'token' => 'szzeeb0aba94f0e3c427075f4254c35c4a2scvbn',
            'parent_id' => 2,
            's_id' => 1,
            'type' => 'contact',
            'position' => 3,
            'status' => 1,
            'data' => array(
                0 => array(
                    'lang' => 'fr',
                    'title' => 'Contactez Carrelage Salvatore',
                    'titleBtn' => 'Contact',
                    'content' => 'Itaque verae amicitiae difficillime reperiuntur in iis qui in honoribus reque publica versantur; ubi enim istum invenias qui honorem amici anteponat suo?',
                    'url' => 'fr/contactez+carrelage+salvatore.html',
                    'status' => 1
                ),
                1 => array(
                    'lang' => 'nl',
                    'title' => 'Neem contact op met Carrelage Salvatore',
                    'titleBtn' => 'Contact',
                    'content' => 'Haec ut omittam, quam graves, quam difficiles plerisque videntur calamitatum societates! Ad quas non est facile inventu qui descendant. Quamquam Ennius recte.',
                    'url' => 'nl/neem+contact+op+met+carrelage+salvatore.html',
                    'status' => 1
                )
            )
        );
        foreach ($a_pages as $a_page) {
            // On crée une page
            $o_page = new Page();
            $o_page->setToken($a_page['token']);
            $o_page->setParentId($a_page['parent_id']);
            $o_page->setSId($a_page['s_id']);
            $o_page->setType($a_page['type']);
            $o_page->setPosition($a_page['position']);
            $o_page->setStatus($a_page['status']);
            
            // Init var
            $a_pagePage = array();
            // Boucle sur les datas
            foreach ($a_page['data'] as $a_data) {
                // Création d'une première candidature
                $a_pagePage[$a_data['lang']] = new PageData();
                $a_pagePage[$a_data['lang']]->setLang($a_data['lang']);
                $a_pagePage[$a_data['lang']]->setTitle($a_data['title']);
                $a_pagePage[$a_data['lang']]->setTitleBtn($a_data['titleBtn']);
                $a_pagePage[$a_data['lang']]->setContent($a_data['content']);
                $a_pagePage[$a_data['lang']]->setUrl($a_data['url']);
                $a_pagePage[$a_data['lang']]->setStatus($a_data['status']);
                
                // On lie les dats à page
                $a_pagePage[$a_data['lang']]->setPage($o_page);
            }
            
            // Persiste le One 
            $manager->persist($o_page);
            
            // Boucle sur les datas listées par langues
            foreach ($a_pagePage as $s_lang => $o_data) {
                // Persiste le Many (proprietaire)
                $manager->persist($a_pagePage[$s_lang]);
            }
        }
        // On déclenche l'enregistrement de toutes les pages et datas
        //$manager->flush();
    }
}