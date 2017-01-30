<?php

namespace CAF\TestBundle\Controller;

use CAF\TestBundle\Entity\Plat;
use CAF\TestBundle\Form\PlatType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlatController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('CAFTestBundle:Plat')
        ;
        $plats = $repository->findAll();
        if (null === $plats) {
            throw new NotFoundHttpException("Pas de plat.");
        }

        return $this->render('CAFTestBundle:Plat:index.html.twig', array(
             'plats' => $plats
        ));
    }

    public function addAction(Request $request) {
        $plat = new Plat();
  
        $form = $this->createForm(new PlatType(), $plat);

         if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plat);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Plat bien enregistrée.');
            return $this->redirect($this->generateUrl('test_plat_add', array('id' => $plat->getId())));
        }

        return $this->render('CAFTestBundle:Plat:add.html.twig', array(
                    'form' => $form->createView(),
        ));
    }
}
