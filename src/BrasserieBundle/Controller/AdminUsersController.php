<?php

namespace BrasserieBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class AdminUsersController extends Controller
{

    /**
     * Lists all users
     *
     * @Route("/user/all", name="admin_users")
     * @Method("GET")
     */
    public function getAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('BrasserieBundle:User')->findAll();

        dump($users[0]);
        dump($users[0]->getRoles());
        dump($users[0]->hasRole('ROLE_USER'));
        dump($users[0]->hasRole('ROLE_ADMIN'));

        dump($users[1]);
        dump($users[1]->getRoles());
        dump($users[1]->hasRole('ROLE_USER'));
        dump($users[1]->hasRole('ROLE_ADMIN'));

        return $this->render('BrasserieBundle:User:users.html.twig', array(
            'users' => $users
        ));
    }


    /**
     * promote user to ROLE_ADMIN
     *
     * @Route("/user/{id}/promote", name="admin_user_promote")
     * @Method("GET")
     */
    public function promoteUserAction(Request $request, $id){

        $userManager = $this->get('fos_user.user_manager');    
        $user = $userManager->findUserBy(array('id' => $id));
        $user->addRole('ROLE_ADMIN');
        $userManager->updateUser($user);
    
        return $this->redirect($this->generateUrl('admin_users'));
    } 

    
    /**
     * promote user to ROLE_ADMIN
     *
     * @Route("/user/{id}/demote", name="admin_user_degrade")
     * @Method("GET")
     */
    public function demoteUserAction(Request $request, $id){

        $userManager = $this->get('fos_user.user_manager');    
        $user = $userManager->findUserBy(array('id' => $id));
        $user->removeRole('ROLE_ADMIN');
        $userManager->updateUser($user);
    
        return $this->redirect($this->generateUrl('admin_users'));
    } 


    /**
     * Activates the given user.
     *
     * @param string $username
     * @Route("/user/{id}/activate", name="admin_user_activate")
     * @Method("GET")
     */
    public function activate(Request $request, $id)
    {
        $userManager = $this->get('fos_user.user_manager'); 
        $user = $userManager->findUserBy(array('id' => $id));
        $user->setEnabled(true);
        $userManager->updateUser($user);

        return $this->redirect($this->generateUrl('admin_users'));
    }


    /**
     * Deactivates the given user.
     *
     * @param string $username
     * @Route("/user/{id}/deactivate", name="admin_user_deactivate")
     * @Method("GET")
     */
    public function deactivate(Request $request, $id)
    {
        $userManager = $this->get('fos_user.user_manager'); 
        $user = $userManager->findUserBy(array('id' => $id));
        $user->setEnabled(false);
        $userManager->updateUser($user);

        return $this->redirect($this->generateUrl('admin_users'));
    }


    /**
     * Changes the password for the given user.
     *
     * @param string $username
     * @param string $password
     */
    public function changePassword($username, $password)
    {
        $user = $this->findUserByUsernameOrThrowException($username);
        $user->setPlainPassword($password);
        $this->userManager->updateUser($user);

        $event = new UserEvent($user, $this->getRequest());
        $this->dispatcher->dispatch(FOSUserEvents::USER_PASSWORD_CHANGED, $event);
    }


}