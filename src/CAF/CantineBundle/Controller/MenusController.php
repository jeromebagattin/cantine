<?php

namespace CAF\CantineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MenusController extends Controller
{
    public function indexAction()
    {
       
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('CAFCantineBundle:Plats')
        ;

        $listPlats = $repository->myFind();
        foreach ($listPlats as $plat) 
        {
            echo $plat->getLibelle();
        }
        
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
