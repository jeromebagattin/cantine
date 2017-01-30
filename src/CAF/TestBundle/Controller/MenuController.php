<?php

namespace CAF\TestBundle\Controller;

use CAF\TestBundle\Entity\Menu;
use CAF\TestBundle\Form\MenuType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $menus = $em->getRepository('CAFTestBundle:Menu')->findAll();

        if (null === $menus) {
            throw new NotFoundHttpException("Pas de Menu.");
        }

        return $this->render('CAFTestBundle:Menu:index.html.twig', array(
             'menus' => $menus
        ));
    }
    
    public function addAction(Request $request) {
        $menu = new Menu();
        $form = $this->createForm(new MenuType(), $menu);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($menu);

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Menu bien enregistrée.');
            return $this->redirect($this->generateUrl('test_menu_index', array('id' => $menu->getId())));
        }

        return $this->render('CAFTestBundle:Menu:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }
}
