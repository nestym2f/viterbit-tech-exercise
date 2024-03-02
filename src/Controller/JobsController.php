<?php

namespace App\Controller;

use App\Document\Job;
use App\Document\Application;
use App\Service\JobService;
use App\Service\ApplicationService;
use App\Form\Type\ApplicationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class JobsController extends AbstractController
{
    private $jobService;
    private $applicationService;

    public function __construct(JobService $jobService, ApplicationService $applicationService)
    {
        $this->jobService = $jobService;
        $this->applicationService = $applicationService;
    }
    #[Route('/', name: 'home')]
    #[Route('/jobs', name: 'jobs')]
    public function jobsListAction(): Response
    {
        //retrieve all jobs
        $jobs = $this->jobService->getAllJobs();
        return $this->render('jobs/jobs.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    #[Route('/jobs/details/{job}', name: 'job-details')]
    public function jobDetailsAction(Job $job, Request $request): Response
    {
        //retrieve job by id
        $job = $this->jobService->getJobById($job->getId());

        // Create a new Application object
        $application = new Application(); 

        $form = $this->createForm(ApplicationType::class, $application);

        $form->handleRequest($request);        
        
        if ($form->isSubmitted() && $form->isValid()) {            
            // Save the application to the database
            $this->applicationService->saveApplication($application, $job->getTitle());
            $this->jobService->updateNumberOfApplications($job->getId());
            $this->addFlash('success', 'Your Application was successfully submitted!');
            return $this->redirectToRoute('jobs');
        }

        return $this->render('jobs/job-details.html.twig', [
            'job' => $job,
            'form' => $form->createView(),
        ]);
    }
}
