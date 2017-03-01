<?php

namespace CAF\PopoteBundle\Controller;

use CAF\PopoteBundle\Entity\Menu;
// use CAF\PopoteBundle\Entity\MenuPlat;
use CAF\PopoteBundle\Form\MenuType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use CAF\PopoteBundle\Entity\Plat;

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

        $results = $repository->createQueryBuilder('p')
                ->leftJoin('p.typePlat', 'typePlat')
                ->where('typePlat.libelle = :libelle')
                ->setParameter('libelle', $type)
                ->getQuery()
                ->getResult()
        ;

        $menu = array();
        foreach ($results as $plat) {
            $menu[$plat->getId()] = $plat->getLibelle();
        }

        return $menu;
    }

    private function generateForm(Request $request) {
        $semaine = array();
        $cases = Array(
            'Entree' => ['A', 'B', 'C', 'D'],
            'Plat' => ['U', 'G', 'E'],
            'Legume' => ['H', 'O', 'S', 'I'],
            'Laitage' => ['R', 'M', 'T'],
            'Dessert' => ['F', 'L', 'X']
        );

        $formBuilder = $this->createFormBuilder($semaine);
        $formBuilder->add('dateMenu', 'date', array('data' => new \DateTime('now'),
                    'format' => 'yyyy-MM-dd'
                ))
                ->add('dateValidation', 'date', array('data' => new \DateTime('now'),
                    'format' => 'yyyy-MM-dd'
        ));

        foreach ([0, 1, 2, 3, 4] as $jour) {  // Lundi ... Vendredi
            foreach ($cases as $typePlat => $lettres) {
                foreach ($lettres as $key => $lettre) {
                    $formBuilder->add($jour . $typePlat . $lettre, 'choice', array(
                        'choices' => $this->fillSemaine($typePlat),
                        'property_path' => '[' . $jour . '][' . $typePlat . '][' . $lettre . ']',
                        'label' => $lettre
                    ));
                }
            }
        }

        $formBuilder->add('ok', 'submit');

        $form = $formBuilder->getForm();
        return $form;
    }

    public function addAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CAFPopoteBundle:Plat');

        $menu = new Menu();
        $form = $this->generateForm($request);

        if ($form->handleRequest($request)->isValid()) {
            $data = $form->getData();
            $menu->setDateMenu($data['dateMenu']);
            $menu->setDateValidation($data['dateValidation']);

            $date = new \DateTime($data['dateMenu']->format('Y-m-d H:i:s'));
            foreach ($data as $jour => $dataJour) {
                if (is_array($dataJour)) {
                    foreach ($dataJour as $typePlat => $dataType) {
                        foreach ($dataType as $lettre => $idPlat) {
                            $plat = $repository->findById($idPlat);
                            $date = new \DateTime($data['dateMenu']->format('Y-m-d H:i:s'));
                            $date->add(new \DateInterval('P' . $jour . 'D'));
                            $menu->setPlats($plat, $lettre, $date);
                        }
                    }
                }
            }

            $em->persist($menu);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Menu bien enregistrée.');
            return $this->render('CAFPopoteBundle:Menu:add.html.twig', array(
                        'form' => $form->createView(),
            ));
            return $this->redirect($this->generateUrl('popote_menu_index', array('id' => $menu->getId())));
        }

        return $this->render('CAFPopoteBundle:Menu:add.html.twig', array(
                    'form' => $form->createView(),
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
