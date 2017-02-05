<?php

namespace CAF\PopoteBundle\Controller;

use CAF\PopoteBundle\Entity\TypePlat;
use CAF\PopoteBundle\Form\TypePlatType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TypePlatController extends Controller {

    public function indexAction(Request $request) {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CAFPopoteBundle:TypePlat')
        ;
        $typeplat = $repository->findAll();
        if (null === $typeplat) {
            throw new NotFoundHttpException("Pas de type de plat.");
        }

        $content = $this->renderView('CAFPopoteBundle:TypePlat:index.html.twig', array(
            'typeplat' => $typeplat
        ));
        $tag = $request->query->get('tag');
        return new Response($content);
    }

    public function viewAction(TypePlat $typeplat) {
        return $this->render('CAFPopoteBundle:TypePlat:view.html.twig', array(
                    'typeplat' => $typeplat
        ));
    }
    
    public function editAction(TypePlat $typeplat, Request $request) {
        $form = $this->createForm(new TypePlatType(), $typeplat);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeplat);
            $em->flush();

            return $this->redirect($this->generateUrl('popote_typeplat_index'));
        }

        return $this->render('CAFPopoteBundle:TypePlat:edit.html.twig', array(
                    'form' => $form->createView(),
                    'id' => $typeplat->getId()
        ));
    }

    public function deleteAction(TypePlat $typeplat) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($typeplat);
        $em->flush();

        return $this->redirect($this->generateUrl('popote_typeplat_index'));
    }

    public function addAction($libelle = '', Request $request) {
        $typeplat = new TypePlat();

        $form = $this->createForm(new TypePlatType(), $typeplat);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeplat);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Type bien enregistrée.');
            return $this->redirect($this->generateUrl('popote_typeplat_index', array('id' => $typeplat->getId())));
        }

        return $this->render('CAFPopoteBundle:TypePlat:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

}
