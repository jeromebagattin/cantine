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

    private function fillSemaine($type) {
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('CAFPopoteBundle:Plat')
        ;


        $results = $repository->createQueryBuilder('a')
                ->where('a.typePlat = :id')
                ->setParameter('id', $type)
                ->getQuery()
                ->getResult()
        ;
//print_r($results);
        $businessUnit = array();
        foreach ($results as $bu) {
            $businessUnit[$bu->getLibelle()] = $bu->getLibelle();
        }

        return $businessUnit;
    }

    private function generateForm(Request $request) {
        $semaine = array();
        $formBuilder = $this->createFormBuilder($semaine)
                ->add('dateMenu', 'date')
                ->add('dateValidation', 'date')
                ->add('query', 'text');

        foreach (['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'] as $jour) {
            foreach (['A', 'B', 'C', 'D'] as $lettre) {
                $formBuilder->add($jour . $lettre, 'choice', array('choices' => $this->fillSemaine(2),
                            'label' => $lettre
                ));
            }

            foreach (['U', 'G', 'E'] as $lettre) {
                $formBuilder->add($jour . $lettre, 'choice', array('choices' => $this->fillSemaine(3),
                    'label' => $lettre
                ));
            }
            foreach (['H', 'O', 'S', 'I'] as $lettre) {
                $formBuilder->add($jour . $lettre, 'choice', array('choices' => $this->fillSemaine(4),
                    'label' => $lettre
                ));
            }

            foreach (['R', 'M', 'T'] as $lettre) {
                $formBuilder->add($jour . $lettre, 'choice', array('choices' => $this->fillSemaine(5),
                    'label' => $lettre
                ));
            }

            foreach (['F', 'L', 'X'] as $lettre) {
                $formBuilder->add($jour . $lettre, 'choice', array('choices' => $this->fillSemaine(1),
                    'label' => $lettre
                ));
            }
        }
        $formBuilder->add('ok', 'submit');



        $form = $formBuilder->getForm();

        if ($form->handleRequest($request)->isValid()) {
            $data = $form->getData();
            print_r($data);
        }

        return $form->createView();
    }

    public function addAction(Request $request) {
        $menu = new Menu();

        return $this->render('CAFPopoteBundle:Menu:add.html.twig', array(
                    'form' => $this->generateForm($request),
        ));
    }

    public function add2Action(Request $request) {
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

        foreach ($menu->getMp() as $mp) {
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
                    'id' => $menu->getId()
        ));
    }

    public function deleteAction(Menu $menu) {
        $em = $this->getDoctrine()->getManager();

        foreach ($menu->getMp() as $mp) {
            $menu->removeMp($mp);
            $em->remove($mp);
        }

        $em->persist($menu);
        $em->remove($menu);
        $em->flush();
        return $this->redirect($this->generateUrl('popote_menu_index'));
    }

}
