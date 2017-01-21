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
            array('route' => 'caf_menus_index', 'title' => 'Menus'),
            array('route' => 'caf_repas_index', 'title' => 'Repas'),
            array('route' => 'caf_plats_index', 'title' => 'Plats'),
            array('route' => 'caf_typeplats_index', 'title' => 'Type de plats'),
        );

        return $this->render('CAFCantineBundle:Cantine:menu.html.twig', array(
                    // Tout l'intérêt est ici : le contrôleur passe
                    // les variables nécessaires au template !
                    'listMenu' => $listMenu
        ));
    }
    
}
