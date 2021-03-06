<?php

namespace CAF\PopoteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PopoteController extends Controller {

    public function indexAction() {
        $content = $this->get('templating')->render('CAFPopoteBundle:Menu:index.html.twig');
        return new Response($content);
    }

    public function menuAction() {
        $user = $this->getUser();
        
        if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
            $listMenus = array(
                array('route' => 'popote_menu_index', 'title' => 'Menus'),
                array('route' => 'popote_repa_index', 'title' => 'Repas'),
                array('route' => 'popote_plat_index', 'title' => 'Plats'),
                array('route' => 'popote_typeplat_index', 'title' => 'Type de plats'),
            );
        } else {
            $listMenus = array(
                array('route' => 'popote_menu_index', 'title' => 'Menus'),
            );
        }

        return $this->render('CAFPopoteBundle:Popote:menu.html.twig', array(
                    'listMenus' => $listMenus
        ));
    }

}
