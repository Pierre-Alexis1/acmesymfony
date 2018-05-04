<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @return Response
     */
    public function helloWorldAction()
    {
        return new Response('Hello World!');
    }

    /**
     * @param Request $request
     * @param int     $a
     * @param int     $b
     *
     * @return Response
     */
    public function additionAction(Request $request, int $a, int $b): Response
    {
        $request->query->get('a');  // $_GET['a']
        $request->request->get('b');  // $_POST['a']

        $result = $a + $b;

        return new Response($a.' + '.$b.' = '.$result);
    }

    /**
     * @param Request $request
     * @param string  $login
     *
     * @return Response
     */
    public function saveLoginAction(Request $request, $login)
    {
        $request->getSession()->set('login', $login);

        return new Response('Login enregistré');
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function showLoginAction(Request $request)
    {
        $login = $request->getSession()->get('login');

        return new Response('Login "'.$login.'" enregistré');
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function loginFormAction(Request $request)
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $login = $request->request->get('login');
            $request->getSession()->set('login', $login);

            return $this->redirectToRoute('app_default_show_login');
        } else {
            $login = 'Votre login';
        }

        return $this->render(
            '@App/Default/login_form.html.twig',
            [
                'login' => $login,
            ]
        );
    }

    /**
     * @return Response
     */
    public function fortuneMessageAction()
    {


    	return $this->render(
    		'@App/Default/fortune_message.html.twig',
    		array(

    		)
    	);
    }
}
