<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Entity\PhoneNumber;
use AppBundle\Entity\User;
use AppBundle\Form\Type\User\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 * @package AppBundle\Controller
 */
class UserController extends Controller
{
    /**
     * @return Response
     */
    public function helloWorldAction()
    {
        $address = new Address();
        $address->setStreet('...')->setNumber(5)->setCity('Clermont-Ferrand');

        $user = new User();
        $user->setFirstName('Pierre-Alexis')->setLastName('Roche')->setAddress($address);

        return new Response('ok', 200);
    }

    /**
     * @return Response
     */
    public function createRandomUserAction()
    {
        $address = new Address();
        $address->setNumber(21)->setStreet('Rue de nohanent')->setCity('Clermont-Ferrand');

        $mobileNumber = new PhoneNumber();
        $mobileNumber->setNumber(1234567890);

        $user = new User();
        $user->setFirstName('Alison')->setLastName('Jouanet')->setAddress($address)->addPhoneNumber($mobileNumber);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);

        $em->flush();

        return new Response('ok', 200);
    }

    /**
     * @return Response
     */
    public function removeRandomUserAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();
        if (isset($users[0])) {
            $em->remove($users[0]);
            $em->flush();
        }

        return new Response('ok', 200);
    }

    /**
     * @return Response
     */
    public function listUsersAction()
    {
        $em = $this->getDoctrine()->getManager();

//    	  $users = $em->getRepository('AppBundle:User')->findAll();
//    	  $users = $em->getRepository('AppBundle:User')->findAllHavingPhoneNumberStartingWith06();
//        $users = $em->getRepository('AppBundle:User')->findAllWithPhoneNumberStartingWith06Only();
//        $users = $em->getRepository('AppBundle:User')->findAllWithCompositeFirstName();
        $users = $em->getRepository('AppBundle:User')->findAllWithCompositeNameOlderThan(18);

//        $users = $em->getRepository('AppBundle:User')->findBy([
//            'firstName' => 'Pierre-Alexis',
//            'lastName' => 'Roche',
//        ]);

        return $this->render(
            '@App/User/list_users.html.twig',
            array(
                'users' => $users,
            )
        );
    }
    
    /**
     * @return Response
     */
    public function registerAction(Request $request)
    {
    	$user = new User();
    	$form = $this->createForm(RegisterType::class, $user);
    	$form->handleRequest($request);

    	if ($form->isValid()) {
    	    $em = $this->getDoctrine()->getManager();
    	    $em->persist($user);
    	    $em->flush();

    	    return new Response('ok', 200);
        }
    
    	return $this->render(
    		'@App/User/register.html.twig',
    		array(
    			'form' => $form->createView(),
    		)
    	);
    }
}
