<?php
namespace WE\PlatformBundle\Services\Antispam;

class WEAntispam
{
    private $mailer;
    private $locale;
    private $minLength;
    
    public function __construct(\Swift_Mailer $mailer, $locale, $minLength) 
    {
        $this->mailer = $mailer;
        $this->locale = $locale;
        $this->minLength = (int) $minLength;
    }
    /**
     * Vérifie si le text est un spam ou non.
     * 
     * @param       string      $s_text
     * @return      boolean     
     */
    public function isSpam($s_text) 
    {
        return strlen($s_text) < $this->minLength;
    }
}