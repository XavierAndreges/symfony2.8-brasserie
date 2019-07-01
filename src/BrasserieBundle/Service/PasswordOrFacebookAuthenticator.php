<?php

namespace BrasserieBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\SimpleFormAuthenticatorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

/**
 * Custom authenticator to distinct every failed authentication case.
 */
class PasswordOrFacebookAuthenticator implements SimpleFormAuthenticatorInterface
{
    private $encoder;
    private $requestStack;
    //private $translateErrorMessage;
    private $container;
    protected $logger;

    public function __construct(
        UserPasswordEncoderInterface $encoder, 
        RequestStack $requestStack, 
        //TranslateErrorMessageService $translateErrorMessage,
        \Symfony\Component\DependencyInjection\ContainerInterface $container,
        LoggerInterface $logger)
    {
        $this->encoder = $encoder;
        $this->requestStack = $requestStack;
        //$this->translateErrorMessage = $translateErrorMessage;
        $this->container = $container;
        $this->logger = $logger;
    }

    /**
     * Authenticate User.
     *
     * @param TokenInterface        $token
     * @param UserProviderInterface $userProvider
     * @param string                $providerKey
     *
     * @throws DisabledException
     * @throws AuthenticationException
     *
     * @return UsernamePasswordToken
     */
    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        /*
         * 401 -> DisabledException
         * 402 -> AuthenticationException(1)
         * 403 -> AuthenticationException(4);
         * 404 -> AuthenticationException(3)
         * 405 -> AuthenticationException(2)
         */

        //************************* test USER in base *************************
        $this->logger->info(print_r($token, true));

        try
        {
            $user = $userProvider->loadUserByUsername($token->getUsername());
            $this->logger->info(print_r($user, true));     
        }

            //*************************  USER not in base : code 404 *************************

        catch (UsernameNotFoundException $exception)
        {
            //$locale = $this->requestStack->getMasterRequest()->get('locale');
            //$message = $this->translateErrorMessage->translateMessage('ERROR_UNKNOWN_USER', null, $locale);
            $message = 'ERROR_UNKNOWN_USER';
            $this->logger->info(print_r($message, true));    
            throw new AuthenticationException($message, 3);
        }


        //************************* test passWord if user exist *************************

        $passwordValid = $this->encoder->isPasswordValid($user, $token->getCredentials());

        $enabled = $user->isEnabled();


        //************************* passWord invalid : code 401 *************************

        if (!$enabled)
        {
            //$message = $this->translateErrorMessage->translateMessage('ERROR_DISABLED_USER', $user);
            $message = 'ERROR_DISABLED_USER';
            throw new DisabledException($message);
        }


        //************************* search FB code *************************

        if (false !== strpos($token->getCredentials(), '57445'))
        {
            $credentials = explode('57445', $token->getCredentials());
        }

        $facebookId = isset($credentials[1]) ? $credentials[1] : 0;


        //************************* if FB code but NO user association : code 405  *************************
/*
        if ((0 !== $facebookId) and (null === $user->getFacebookId()))
        {
            //$message = $this->translateErrorMessage->translateMessage('ERROR_UNAUTHORIZED_FB_NULL_USER', $user);
            $message = 'ERROR_UNAUTHORIZED_FB_NULL_USER';
            throw new AuthenticationException($message, 2);
        }
*/

        //************************* if FB code AND user association  *************************

        if ($passwordValid 
                //or $user->getFacebookId() === $facebookId
            )
        {
            $this->logger->info(print_r($passwordValid, true));   
            $this->logger->info("passwordValid");   
            return new UsernamePasswordToken(
                $user,
                $user->getPassword(),
                $providerKey,
                $user->getRoles()
            );
        }

        //************************* user created with FB : code 402  *************************
/*
        if (null !== $user->getFacebookId())
        {
            //$message = $this->translateErrorMessage->translateMessage('ERROR_UNAUTHORIZED_FB_USER', $user);
            $message = 'ERROR_UNAUTHORIZED_FB_USER';
            throw new AuthenticationException($message, 1);
        }
*/

        //************************* user exist but not validated : code 403 *************************

        //$message = $this->translateErrorMessage->translateMessage('ERROR_UNAUTHORIZED_USER', $user);
        $message = 'ERROR_UNAUTHORIZED_USER';
        throw new AuthenticationException($message, 4);
    }

    /**
     * Check if token is supported.
     *
     * @param TokenInterface $token
     * @param string         $providerKey
     *
     * @return bool
     */
    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof UsernamePasswordToken
            && $token->getProviderKey() === $providerKey;
    }

    /**
     * {@inheritdoc}
     */
    public function createToken(Request $request, $username, $password, $providerKey)
    {
        return new UsernamePasswordToken($username, $password, $providerKey);
    }
}
