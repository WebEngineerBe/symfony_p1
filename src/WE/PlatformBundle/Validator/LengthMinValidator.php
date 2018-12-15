<?php
namespace WE\PlatformBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class LengthMinValidator extends ConstraintValidator
{
    /**
     * {@inheritDoc}
     * @see \Symfony\Component\Validator\ConstraintValidatorInterface::validate()
     */
    public function validate($value, Constraint $constraint)
    {
        if (strlen($value)<3) {
            $this->context->addViolation($constraint->message);
        }
    }
}