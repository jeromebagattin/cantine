<?php

namespace CAF\CantineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MenusController extends Controller
{
    public function indexAction()
    {
        $content = $this->get('templating')->render('CAFCantineBundle:Menus:index.html.twig', array (
             'nom' => 'jerome'
        ));
        return new Response($content);
    }
    
    public function ByeAction()
    {
        $content = $this->get('templating')->render('CAFCantineBundle:Menus:Bye.html.twig', array (
             'nom' => 'jerome'
        ));
        return new Response($content);
    }
}
