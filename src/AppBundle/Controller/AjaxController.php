<?php

namespace AppBundle\Controller;

use AppBundle\Service\FortuneMessageGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class AjaxController
 * @package AppBundle\Controller
 */
class AjaxController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function generateMessageAjaxAction()
    {
        $fortuneMessageGenerator = $this->get(FortuneMessageGenerator::class);
        $message = $fortuneMessageGenerator->generate();

        return new JsonResponse($message);
    }
}
