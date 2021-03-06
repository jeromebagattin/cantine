<?php

namespace CAF\PopoteBundle\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class FormAuthenticator extends AbstractGuardAuthenticator {

    /**
     * @var \Symfony\Component\Routing\RouterInterface
     */
    private $router;

    /**
     * Default message for authentication failure.
     *
     * @var string
     */
    private $failMessage = 'Invalid credentials';

    /**
     * Creates a new instance of FormAuthenticator
     */
    public function __construct(RouterInterface $router) {
        $this->router = $router;
    }

    public function getCredentials(Request $request) {
        if ($request->getPathInfo() != '/login' || !$request->isMethod('POST')) {
            return;
        }

        return array(
            'username' => $request->request->get('username'),
            'password' => $request->request->get('password'),
        );
    }

    public function getUser($credentials, UserProviderInterface $userProvider) {
        if (is_null($credentials['username'])) {
            return null;
        }

//        if ($userProvider->getProviders()[0] instanceof InMemoryUserProvider) {
//            return $userProvider->loadUserByUsername($credentials['username']);
//        }
        
        return $userProvider->loadUserByUsername($credentials['username']);
    }

    public function checkCredentials($credentials, UserInterface $user) {
       return true;
        $baseDN = "dc=cafbayonne,dc=cnaf";
        $ldapServer = "SDC1A641.cafbayonne.cnaf";
        $ldapServerPort = 389;
        $password = $credentials['password'];
        $dn = $credentials['username'];

        if (!($conn = @ldap_connect($ldapServer, $ldapServerPort))) {
            throw new AuthenticationException('Can\'t reach LDAP');
        }

        if (!@ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3)) {
            throw new AuthenticationException('Can\'t use LDAP V3');
        }

        if (!@ldap_bind($conn, $dn, $password)) {
            throw new AuthenticationException('LDAP bind error:' . ldap_error($conn));
        }

        @ldap_close($conn);
        
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey) {
        $url = $this->router->generate('caf_popote_homepage');
        return new RedirectResponse($url);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception) {
        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);
        $url = $this->router->generate('login');
        return new RedirectResponse($url);
    }

    public function start(Request $request, AuthenticationException $authException = null) {
        $url = $this->router->generate('login');
        return new RedirectResponse($url);
    }

    public function supportsRememberMe() {
        return false;
    }

}
