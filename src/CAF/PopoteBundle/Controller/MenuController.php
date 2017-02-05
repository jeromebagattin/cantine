<?php

namespace CAF\PopoteBundle\Controller;

use CAF\PopoteBundle\Entity\Menu;
// use CAF\PopoteBundle\Entity\MenuPlat;
use CAF\PopoteBundle\Form\MenuType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $menus = $em->getRepository('CAFPopoteBundle:Menu')->findByMenu($em);

        if (null === $menus) {
            throw new NotFoundHttpException("Pas de Menu.");
        }

        $content = $this->get('templating')->render('CAFPopoteBundle:Menu:index.html.twig', array(
            'menus' => $menus
        ));
        return new Response($content);
    }
    
    public function viewAction(Menu $menu) {
        

        $content = $this->get('templating')->render('CAFPopoteBundle:Menu:view.html.twig', array(
            'menu' => $menu
        ));
        return new Response($content);
        
    }

    public function addAction(Request $request) {
        $menu = new Menu();
        $form = $this->createForm(new MenuType(), $menu);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($menu);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Menu bien enregistrée.');
            return $this->redirect($this->generateUrl('popote_menu_index', array('id' => $menu->getId())));
        }

        return $this->render('CAFPopoteBundle:Menu:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

    public function editAction(Menu $menu, Request $request) {
        $em = $this->getDoctrine()->getManager();
        
        $form = $this->createForm(new MenuType(), $menu);

        foreach($menu->getMp() as $mp)
        {
            $menu->removeMp($mp);
            $em->remove($mp);
        }
        $em->persist($menu);
        
        if ($form->handleRequest($request)->isValid()) {
            
            $em->persist($menu);
            $em->flush();
            return $this->redirect($this->generateUrl('popote_menu_index'));
        }
        
         return $this->render('CAFPopoteBundle:Menu:edit.html.twig', array(
                    'form' => $form->createView(),
                    'id'   => $menu->getId()
        ));
    }
    
    public function deleteAction(Menu $menu) {
        $em = $this->getDoctrine()->getManager();
       
        foreach($menu->getMp() as $mp)
        {
            $menu->removeMp($mp);
            $em->remove($mp);
        }
        
        $em->persist($menu);
        $em->remove($menu);
        $em->flush();
        return $this->redirect($this->generateUrl('popote_menu_index'));
    }
    
    
}
