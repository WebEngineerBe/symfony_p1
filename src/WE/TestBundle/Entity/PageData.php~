<?php

namespace WE\TestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PageData
 *
 * @ORM\Table(name="we_page_data")
 * @ORM\Entity(repositoryClass="WE\TestBundle\Repository\PageDataRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class PageData
{
    /**
     * @var int
     */
    const ENABLE = 1;
    
    /**
     * @var int
     */
    const DELETED = 2;
    
    /**
     * @var int
     */
    const PERMANENTLY_DELETED = 3;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * J'ai ajouté le paramètre inversedBy qui est symétrique du mappedBy qui 
     * est l'attribut de l'entité inverse (Page) qui pointe vers l'entité 
     * propriétaire (PageData). C'est donc l'attribut pagesData.
     * 
     * @ORM\ManyToOne(targetEntity="WE\TestBundle\Entity\Page", inversedBy="pageDatas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $page;

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=5, options={"default":"fr", "comment":"Langue de la page"})
     */
    private $lang;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, options={"comment":"Titre de la page"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="titleBtn", type="string", length=255, options={"comment":"Titre du bouton"})
     */
    private $titleBtn;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true, options={"comment":"Text de la page"})
     */
    private $content;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(name="url", type="string", length=255, unique=true, options={"comment":"URL de la page"})
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="integer", options={"unsigned":true, "default":1, "comment":"activer = 1, supprimer = 2, supprimer définitivement = 3"})
     */
    private $status;
    
    /**
     * @ORM\PostLoad
     */
    public function postLoadLog()
    {
        //...
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set lang
     *
     * @param string $lang
     *
     * @return PageData
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return PageData
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set titleBtn
     *
     * @param string $titleBtn
     *
     * @return PageData
     */
    public function setTitleBtn($titleBtn)
    {
        $this->titleBtn = $titleBtn;

        return $this;
    }

    /**
     * Get titleBtn
     *
     * @return string
     */
    public function getTitleBtn()
    {
        return $this->titleBtn;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return PageData
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return PageData
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return PageData
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set page
     *
     * @param \WE\TestBundle\Entity\Page $page
     *
     * @return PageData
     */
    public function setPage(\WE\TestBundle\Entity\Page $page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \WE\TestBundle\Entity\Page
     */
    public function getPage()
    {
        return $this->page;
    }
}
