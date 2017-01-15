<?php

namespace CAF\CantineBundle\Controller;

use CAF\CantineBundle\Entity\Menus;
use CAF\CantineBundle\Form\MenusType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class MenusController extends Controller
{
    public function viewAction()
    {
       
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('CAFCantineBundle:Plats')
        ;

        $plats = $repository->myFindAll();
        if (null === $plats) {
            throw new NotFoundHttpException("Pas de plats.");
        }
        
        $content = $this->get('templating')->render('CAFCantineBundle:Menus:view.html.twig', array (
             'plats' => $plats
        ));
        return new Response($content);
    }
    
    public function addAction(Request $request)
    {
        $menu = new Menus();

        $form = $this->createForm(new MenusType(), $menu);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($menu);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Menu bien enregistrée.');
            return $this->redirect($this->generateUrl('caf_menu_view', array('id' => $menu->getId())));
        }

        return $this->render('CAFCantineBundle:Menus:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }
}
