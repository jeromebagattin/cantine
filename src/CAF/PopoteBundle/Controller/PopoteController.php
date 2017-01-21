<?php

namespace CAF\PopoteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PopoteController extends Controller
{
    public function indexAction()
    {
        $content = $this->get('templating')->render('CAFPopoteBundle:Menu:index.html.twig');
        return new Response($content);
    }
    
    public function menuAction() {
        $listMenus = array(
            array('route' => 'popote_menu_index', 'title' => 'Menus'),
            array('route' => 'popote_repa_index', 'title' => 'Repas'),
            array('route' => 'popote_plat_index', 'title' => 'Plats'),
            array('route' => 'popote_typeplat_index', 'title' => 'Type de plats'),
        );

        return $this->render('CAFPopoteBundle:Popote:menu.html.twig', array(
                    // Tout l'intérêt est ici : le contrôleur passe
                    // les variables nécessaires au template !
                    'listMenus' => $listMenus
        ));
    }
    
}
