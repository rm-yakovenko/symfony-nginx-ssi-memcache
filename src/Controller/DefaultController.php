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
        $timestamp = (new \DateTime())->format(\DateTime::ATOM);
        $response = new Response("Cached at: $timestamp");
        $response->setPublic()
            ->setSharedMaxAge(60 * 60);
        return $response;
    }
}
