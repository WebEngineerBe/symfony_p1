<?php

namespace WE\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class WEUserBundle extends Bundle
{
    public function getParent() 
    {
        return 'FOSUserBundle';
    }
}
