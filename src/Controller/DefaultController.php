<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('index.html.twig');
    }

    public function cachedAction()
    {
        $response = new Response((new \DateTime())->format(\DateTime::ATOM));
        $response->setPublic()
            ->setSharedMaxAge(5 * 60);
        return $response;
    }
}
