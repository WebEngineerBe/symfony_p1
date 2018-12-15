<?php
namespace WE\PlatformBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class LengthMin extends Constraint
{
    public $message = "Le contenu est trop court !";
}