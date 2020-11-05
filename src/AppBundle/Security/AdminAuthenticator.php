<?php


namespace AppBundle\Security;

use AppBundle\Form\Type\LoginType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Guard\AuthenticatorInterface;

final class AdminAuthenticator extends AbstractFormLoginAuthenticator implements AuthenticatorInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(
        FormFactoryInterface $formFactory,
        RouterInterface $router,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function supports(Request $request)
    {
        if ($request->getPathInfo() != '/admin/login' || $request->getMethod() != 'POST') {
            return false;
        }

        return true;
    }

    public function getCredentials(Request $request)
    {
        $form = $this->formFactory->create(LoginType::class);
        $form->handleRequest($request);

        $data = $form->getData();
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $data['email']
        );

        return $data;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return $userProvider->loadUserByUsername($credentials['email']);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        if (!$this->passwordEncoder->isPasswordValid($user, $credentials['password'])) {
            return false;
        }

        if (!$user->hasRole('ROLE_ADMIN')) {
            throw new CustomUserMessageAuthenticationException("You don't have permission to access that page.");
        }

        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $request->getSession()->set(Security::AUTHENTICATION_ERROR, $exception);

        return new RedirectResponse($this->router->generate('admin_login'));
    }

    protected function getLoginUrl()
    {
        return new RedirectResponse($this->router->generate('admin_login'));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return new RedirectResponse($this->router->generate('sonata_admin_dashboard'));
    }
}