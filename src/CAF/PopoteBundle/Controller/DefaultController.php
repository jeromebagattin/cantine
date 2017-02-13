<?php

namespace CAF\PopoteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction(Request $request) {
        $user = $this->get('security.token_storage')->getToken();
        return $this->render('default/index.html.twig', array(
                    'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
                    'user' => $user,
        ));
    }

    public function loginAction(Request $request) {
        $user = $this->getUser();
       
        if ($user instanceof UserInterface) {
            return $this->redirectToRoute('caf_popote_homepage');
        }

        /** @var AuthenticationException $exception */
        $exception = $this->get('security.authentication_utils')
                ->getLastAuthenticationError();

        return $this->render('CAFPopoteBundle::login.html.twig', [
                    'error' => $exception ? $exception->getMessage() : NULL,
        ]);
    }

    public function logoutAction() {
        
    }

}
