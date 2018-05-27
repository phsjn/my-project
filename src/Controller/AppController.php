<?php

// src/Controller/AppController.php
namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{

    private $logger;

    public function __construct(LoggerInterface $logger, \Swift_Mailer $mailer)
    {
        $this->logger = $logger;
        $this->mailer = $mailer;
    }
    /**
     * @Route("/app/{page}", name="app_list", requirements={"page"="\d+"})
     */
    public function list($page)
    {
        $this->logger->info('Teste Pedro!');

  
        $message = (new \Swift_Message('Site update just happened!'))
            ->setFrom('ph_sjn@yahoo.com.br')
            ->setTo('pohenrique@gmail.com')
            ->addPart(
                'Someone just updated the site. We told them: '
            );

        $this->mailer->send($message);

        $this->logger->info($this->mailer->send($message));

        return $this->render('lucky/number.html.twig', array(
            'number' => $page,
        ));
    }

    /**
     * @Route("/app/{slug}", name="app_show")
     */
    public function show($slug)
    {
        // ...
    }
}