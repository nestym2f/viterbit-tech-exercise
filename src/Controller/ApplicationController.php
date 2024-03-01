<?php

namespace App\Controller;

use App\Document\Application;
use App\Service\ApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApplicationController extends AbstractController
{    
    private $applicationService;

    public function __construct(ApplicationService $applicationService)
    {        
        $this->applicationService = $applicationService;
    }

    #[Route('/applications', name: 'applications')]
    public function jobsListAction(): Response
    {
        //retrieve all applications
        $applications = $this->applicationService->getAllApplications();
        return $this->render('applications/applications.html.twig', [
            'applications' => $applications,
        ]);
    }
}
