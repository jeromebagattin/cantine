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
        $menus = $em->getRepository('CAFPopoteBundle:Menu')->findAll();
        
        if (null === $menus) {
            throw new NotFoundHttpException("Pas de Menu.");
        }

        $content = $this->get('templating')->render('CAFPopoteBundle:Menu:index.html.twig', array(
            'menus' => $menus
        ));
        return new Response($content);
    }

    public function addAction(Request $request) {
        $menu = new Menu();
        $form = $this->createForm(new MenuType(), $menu);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($menu);

//            foreach ($form->get('plats')->getData() as $plat) {
//                $choix = new MenuPlats();
//
//                // Se the message and user for current feedback
//                $choix->setMenu($menu);
//                $choix->setPlats($plat);
//                //$choix->setLettre($form->get('letter')->getData());
//                $choix->setLettre('_');
//                // Persist the owning side
//                $em->persist($choix);
//
//                // Sync the inverse side
//                //$menu->addMenuPlats($choix);
//            }

            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Menu bien enregistrée.');
            return $this->redirect($this->generateUrl('popote_menu_index', array('id' => $menu->getId())));
        }

        return $this->render('CAFPopoteBundle:Menu:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }
    
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $menu = $em->getRepository('CAFPopoteBundle:Menu')->find($id);
        
        if (null === $menu) {
            throw new NotFoundHttpException("Le menu d'id " . $id . " n'existe pas.");
        }

        $form = $this->createForm(new MenuType(), $menu);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($menu);
            $em->flush();

            return $this->redirect($this->generateUrl('popote_menu_index'));
        }

        return $this->render('CAFPopoteBundle:Menu:edit.html.twig', array(
                    'form' => $form->createView(),
                    'id' => $menu->getId()
        ));
        
        $content = $this->renderView('CAFPopoteBundle:Menu:edit.html.twig', array (
             'nom' => $id
        ));
        $tag = $request->query->get('tag');
        return new Response($content);
    }

}
