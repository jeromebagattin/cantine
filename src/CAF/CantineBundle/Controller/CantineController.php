<?php

namespace CAF\CantineBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CantineController extends Controller
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
//            echo $plat->getLibelle();
        }
        
        $content = $this->get('templating')->render('CAFCantineBundle:Menus:index.html.twig', array (
             'nom' => 'jerome'
        ));
        return new Response($content);
    }
    
    public function menuAction() {
        // On fixe en dur une liste ici, bien entendu par la suite
        // on la récupérera depuis la BDD !
        $listMenu = array(
            array('id' => 2, 'title' => 'Menus'),
            array('id' => 5, 'title' => 'Repas'),
            array('id' => 9, 'title' => 'Plats')
        );

        return $this->render('CAFCantineBundle:Cantine:menu.html.twig', array(
                    // Tout l'intérêt est ici : le contrôleur passe
                    // les variables nécessaires au template !
                    'listMenu' => $listMenu
        ));
    }
    
}
