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
    public function applicationsListAction(Request $request): Response
    {
        $applications = $this->applicationService->getApplicationsFilters($request);     
        
        return $this->render('applications/applications.html.twig', [
            'applications' => $applications,
        ]);
    }

    #[Route('/applications/details/{application}', name: 'application-details')]
    public function applicationsDetailsAction(Application $application, Request $request): Response
    {
        //retrieve application by id
        $job = $this->applicationService->getApplicationById($application->getId());

        return $this->render('applications/application-details.html.twig', [
            'application' => $application,            
        ]);
    }
}
