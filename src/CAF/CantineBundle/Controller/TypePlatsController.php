<?php

namespace CAF\CantineBundle\Controller;

use CAF\CantineBundle\Entity\TypePlat;
use CAF\CantineBundle\Form\TypePlatType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class TypePlatsController extends Controller {

    public function viewAction(Request $request) {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CAFCantineBundle:TypePlat')
        ;
        $typeplats = $repository->findAll();
        if (null === $typeplats) {
            throw new NotFoundHttpException("Pas de type de plat.");
        }

        $content = $this->renderView('CAFCantineBundle:TypePlats:view.html.twig', array(
            'typeplats' => $typeplats
        ));
        $tag = $request->query->get('tag');
        return new Response($content);
    }

    public function editAction($id, Request $request) {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CAFCantineBundle:TypePlat')
        ;
        $typeplat = $repository->find($id);
        if (null === $typeplat) {
            throw new NotFoundHttpException("Le typeplat d'id " . $id . " n'existe pas.");
        }

        $form = $this->createForm(new TypePlatType(), $typeplat);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeplat);
            $em->flush();

            return $this->redirect($this->generateUrl('caf_typeplats_view'));
        }

        return $this->render('CAFCantineBundle:TypePlats:edit.html.twig', array(
                    'form' => $form->createView(),
                    'id' => $typeplat->getId()
        ));
    }

    public function deleteAction($id, Request $request) {
        $em = $this->getDoctrine()->getManager();
        $typeplat = $em->getRepository('CAFCantineBundle:TypePlat')->find($id);

        if (null === $typeplat) {
            throw new NotFoundHttpException("Le typeplat d'id " . $id . " n'existe pas.");
        }

        $em->remove($typeplat);
        $em->flush();

        return $this->redirect($this->generateUrl('caf_typeplats_view'));
    }

    public function addAction($libelle = '', Request $request) {
        $typeplat = new TypePlat();

        $form = $this->createForm(new TypePlatType(), $typeplat);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeplat);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Type bien enregistrée.');
            return $this->redirect($this->generateUrl('caf_typeplats_view', array('id' => $typeplat->getId())));
        }

        return $this->render('CAFCantineBundle:TypePlats:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }

}
