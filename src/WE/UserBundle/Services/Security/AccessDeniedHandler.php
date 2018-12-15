<?php
namespace WE\UserBundle\Services\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    private $router;
    
    public function __construct(RouterInterface $router) 
    {
        $this->router = $router;
    }
    
    public function handle(Request $o_req, AccessDeniedException $accessDeniedException)
    {
        // ...
        
        //return new Response("Le user n'est pas le bon !", 403);
        //return $this->redirectToRoute('http://www.google.be');
        //return new RedirectResponse($this->router->generate('we_platform_home'));
        
        //$o_req->get('_route');
        //$currentUrl = $o_req->getUri();
        //return new RedirectResponse($currentUrl);
        
        $o_req->getSession()->getFlashBag()->add('notice', "Vous n'avez pas accès à cette manipulation !");
        
        return new RedirectResponse($o_req->headers->get('referer'));
    }
}