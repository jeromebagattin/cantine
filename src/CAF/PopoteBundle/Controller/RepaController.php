<?php

namespace CAF\PopoteBundle\Controller;

use CAF\PopoteBundle\Entity\Repa;
use CAF\PopoteBundle\Entity\Menu;
use CAF\PopoteBundle\Form\RepaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class RepaController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $repas = $em->getRepository('CAFPopoteBundle:Repa')->findAll();

        if (null === $repas) {
            throw new NotFoundHttpException("Pas de Repa.");
        }

        $content = $this->get('templating')->render('CAFPopoteBundle:Repa:index.html.twig', array(
            'repas' => $repas
        ));
        return new Response($content);
    }

    public function viewAction(Repa $repa) {
        $content = $this->get('templating')->render('CAFPopoteBundle:Repa:view.html.twig', array(
            'repa' => $repa,
        ));
        return new Response($content);
    }

    private function generateForm(Request $request, Menu $menu) {
        $semaine = array();
        $cases = Array(
            'Entree' => ['A', 'B', 'C', 'D'],
            'Plat' => ['U', 'G', 'E'],
            'Legume' => ['H', 'O', 'S', 'I'],
            'Laitage' => ['R', 'M', 'T'],
            'Dessert' => ['F', 'L', 'X']
        );

        if (null !== $menu->getDateMenu()) {
            $defautDateMenu = $menu->getDateMenu();
            $defautDateValidation = $menu->getDateValidation();
        } else {
            $defautDateMenu = $defautDateValidation = new \DateTime('now');
        }

        $formBuilder = $this->createFormBuilder($semaine);
        $formBuilder->add('dateMenu', 'date', array('data' => $defautDateMenu,
                    'format' => 'yyyy-MM-dd'
                ))
                ->add('dateValidation', 'date', array('data' => $defautDateValidation,
                    'format' => 'yyyy-MM-dd'
        ));

        $indexPlat = 0;
        foreach ([0, 1, 2, 3, 4] as $jour) {  // Lundi ... Vendredi
            foreach ($cases as $typePlat => $lettres) {
                foreach ($lettres as $key => $lettre) {
                    $defautPlat = '';
                    if (isset($menu->getMp()[$indexPlat])) {
                        $defautPlat = $menu->getMp()[$indexPlat]->getPlat()->getId();
                    }
                    $formBuilder->add($jour . $typePlat . $lettre, 'choice', array(
                        'choices' => [$menu->getMp()[$indexPlat]->getPlat()->getId() => $menu->getMp()[$indexPlat]->getPlat()->getLibelle()],
                        'property_path' => '[' . $jour . '][' . $typePlat . '][' . $lettre . ']',
                        'label' => $lettre,
                        'expanded' => true,
                        'required' => false,
//                        'multiple' => 'true',
//                        'data' => $defautPlat
                    ));

                    $indexPlat ++;
                }
            }
        }

        $formBuilder->add('ok', 'submit');

        $form = $formBuilder->getForm();
        return $form;
    }
    
    /**
     * @ParamConverter("menu", options={"mapping": {"idMenu": "id"}})
     */
    public function addAction(Menu $menu, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('CAFPopoteBundle:Plat');
        
        $repa = new Repa($menu);
//        print_r($menu->getMp()[0]->getPlat()->getLibelle());

        $form = $this->generateForm($request, $menu);
        

        if ($form->handleRequest($request)->isValid()) {
            $data = $form->getData();
//            print_r($data);exit;
            $repa->setDateMenu($data['dateMenu']);
            $repa->setDateValidation($data['dateValidation']);

            $date = new \DateTime($data['dateMenu']->format('Y-m-d H:i:s'));
            foreach ($data as $jour => $dataJour) {
                if (is_array($dataJour)) {
                    foreach ($dataJour as $typePlat => $dataType) {
                        foreach ($dataType as $lettre => $idPlat) {
                            $plat = $repository->findById($idPlat);
                            $date = new \DateTime($data['dateMenu']->format('Y-m-d H:i:s'));
                            $date->add(new \DateInterval('P' . $jour . 'D'));
                            $repa->setPlats($plat, $lettre, $date);
                        }
                    }
                }
            }
            
            $em->persist($repa);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Repa bien enregistrée.');
            return $this->redirect($this->generateUrl('popote_repa_index', array('id' => $repa->getId())));
        }

        return $this->render('CAFPopoteBundle:Repa:add.html.twig', array(
                    'form' => $form->createView(),
                    'menu' => $menu
        ));
    }

    public function editAction(Repa $repa, Request $request) {

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(new RepaType(), $repa);

        foreach ($repa->getMp() as $mp) {
            $repa->removeMp($mp);
            $em->remove($mp);
        }
        $em->persist($repa);

        if ($form->handleRequest($request)->isValid()) {
            $em->persist($repa);
            $em->flush();
            return $this->redirect($this->generateUrl('popote_repa_index'));
        }

        return $this->render('CAFPopoteBundle:Repa:edit.html.twig', array(
                    'form' => $form->createView(),
                    'id' => $repa->getId()
        ));
    }

    public function deleteAction(Repa $repa) {
        $em = $this->getDoctrine()->getManager();

        foreach ($repa->getMp() as $mp) {
            $repa->removeMp($mp);
            $em->remove($mp);
        }

        $em->persist($repa);
        $em->remove($repa);
        $em->flush();
        return $this->redirect($this->generateUrl('popote_repa_index'));
    }

}
