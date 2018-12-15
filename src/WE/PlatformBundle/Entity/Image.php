<?php

namespace WE\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Image
 *
 * @ORM\Table(name="we_image")
 * @ORM\Entity(repositoryClass="WE\PlatformBundle\Repository\ImageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Image
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;
    
    /**
     * @var UploadedFile
     */
    private $file;
    
    private $advert_id;
    
    /**
     * @var string
     */
    private $tempUrl;
    
    /**
     * @var string
     */
    private $tempFileRelatif;
    
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
     * Set url
     *
     * @param string $url
     *
     * @return Image
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
     * Set alt
     *
     * @param string $alt
     *
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
        
        return $this;
    }
    
    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }
    
    /**
     * @param UploadedFile $file
     * 
     * @return object 
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        
        // On vérifie si on avait déjà un fichier pour cette entité
        if ((null !== $this->url) && (! empty($this->url))) {
            // On sauvegarde l'url courante
            $this->tempUrl = $this->url;
            // On réinitialise la valeur de attribut url
            $this->url = null;
        }
        
        return $this;
    }
    
    public function getFile()
    {
        return $this->file;
    }
    
    /**
     * @param $advert_id
     *
     * @return int
     */
    public function setAdvertId($advert_id)
    {
        $this->advert_id = $advert_id;
        
        return $this;
    }
    
    public function getAdvertId()
    {
        return $this->advert_id;
    }
    
    /**
     * @ORM\PreFlush()
     */
    public function preUploadFile()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
        if (null === $this->file)
            return;
            
        //$advert = $args->getEntityManager()->getRepository('Advert');
        
        //$advert_id = $this->get('security.context')->getToken()->getAdvert()->getId();
        
        // Nom original du fichier
        // $nameFile = $this->file->getClientOriginalName();
        $nameFile = sprintf("file_%d.%s", $this->advert_id, $this->file->guessExtension());
        
        $this->url = sprintf("/web/%s/%s", $this->getUploadDir(), $nameFile);
    }
    
    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function postUploadFile()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
        if (null === $this->file)
            return;
        
        // Si on avait un ancien fichier, on le supprime
        if (null !== $this->tempUrl) {
            $a_url = explode('/', $this->tempUrl);
            
            $oldFile = $this->getUploadRootDir().'/'.end($a_url);
            if (file_exists($oldFile)) 
                unlink($oldFile);
        }
            
        // Nom original du fichier
        // $nameFile = $this->file->getClientOriginalName();
        $nameFile = sprintf("file_%d.%s", $this->advert_id, $this->file->guessExtension());
        
        $this->file->move($this->getUploadRootDir(), $nameFile);
        //$this->url = sprintf("/web/%s/%s", $this->getUploadDir(), $nameFile);
    }
    
    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        //$this->logger->info('preRemove, supprime un fichier');
        
        if ((null !== $this->url) && (! empty($this->url))) {
            $a_url = explode('/', $this->url);
            // On sauvegarde temporairement le chemin relatif du fichier
            $this->tempFileRelatif = $this->getUploadRootDir().'/'.end($a_url);
        }
    }
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        //$this->logger->info('postRemove, supprime un fichier');
        
        // Si le fichier exist
        if (file_exists($this->tempFileRelatif)) {
            // On supprime le fichier en post remove
            unlink($this->tempFileRelatif);
        }
    }
    
    public function getUploadDir()
    {
        // On retourne le chemin relatif vers l'image pour un navigateur (relatif au répertoire /web donc)
        return 'uploads/img';
    }
    
    protected function getUploadRootDir()
    {
        // On retourne le chemin relatif vers l'image pour notre code PHP
        return $_SERVER['DOCUMENT_ROOT'].'/web/'.$this->getUploadDir();
    }
}
