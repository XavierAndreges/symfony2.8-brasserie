<?php

namespace BrasserieBundle\EventListener;

use FOS\UserBundle\Model\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Serializer\Serializer;

/**
 * Catch FOSUser Authentication success on login_check and add user to response.
 */
class AuthenticationSuccessListener
{
    protected $serializer;
    
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }
    
    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        $_user = [
            "id" => $user->getId(), 
            "username" => $user->getUsername(),
            "email" => $user->getEmail()]; 
                
        $_user = $this->serializer->normalize(
            $_user,
            'json-ld',
            []
        );
  
        $data['user'] = $_user;
        
        $event->setData($data);
    }
}
