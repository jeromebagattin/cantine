<?php

namespace CAF\CantineBundle\Controller;

use CAF\CantineBundle\Entity\Menus;
use CAF\CantineBundle\Entity\MenusPlat;
use CAF\CantineBundle\Form\MenusType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class MenusController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $menus = $em->getRepository('CAFCantineBundle:Menus')->findAll();
        
        if (null === $menus) {
            throw new NotFoundHttpException("Pas de Menus.");
        }

        $content = $this->get('templating')->render('CAFCantineBundle:Menus:index.html.twig', array(
            'menus' => $menus
        ));
        return new Response($content);
    }
    
    public function viewAction() {
        $em = $this->getDoctrine()->getManager();
        $menus = $em->getRepository('CAFCantineBundle:Menus')->findAll();
        
        if (null === $menus) {
            throw new NotFoundHttpException("Pas de Menus.");
        }

        $content = $this->get('templating')->render('CAFCantineBundle:Menus:view.html.twig', array(
            'menus' => $menus
        ));
        return new Response($content);
    }

    public function addAction(Request $request) {
        $menu = new Menus();
        $form = $this->createForm(new MenusType(), $menu);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($menu);

//            foreach ($form->get('plat')->getData() as $plat) {
//                $choix = new Menusplat();
//
//                // Se the message and user for current feedback
//                $choix->setMenus($menu);
//                $choix->setplat($plat);
//                //$choix->setLettre($form->get('letter')->getData());
//                $choix->setLettre('_');
//                // Persist the owning side
//                $em->persist($choix);
//
//                // Sync the inverse side
//                //$menu->addMenusplat($choix);
//            }

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Menu bien enregistrée.');
            return $this->redirect($this->generateUrl('caf_menus_index', array('id' => $menu->getId())));
        }

        return $this->render('CAFCantineBundle:Menus:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }
    
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('CAFCantineBundle:Menus')->find($id);
        
        if (null === $menu) {
            throw new NotFoundHttpException("Le menu d'id " . $id . " n'existe pas.");
        }

        $form = $this->createForm(new MenusType(), $menu);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($menu);
            $em->flush();

            return $this->redirect($this->generateUrl('caf_menus_index'));
        }

        return $this->render('CAFCantineBundle:Menus:edit.html.twig', array(
                    'form' => $form->createView(),
                    'id' => $menu->getId()
        ));
        
        $content = $this->renderView('CAFCantineBundle:Menus:edit.html.twig', array (
             'nom' => $id
        ));
        $tag = $request->query->get('tag');
        return new Response($content);
    }

}
