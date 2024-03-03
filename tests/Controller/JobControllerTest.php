<?php

namespace Tests\App\Controller;

use App\Controller\JobsController;
use App\Document\Job;
use App\Document\Application;
use App\Service\JobService;
use App\Service\ApplicationService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class JobsControllerTest extends WebTestCase
{
    public function testJobDetailsActionSubmitForm()
    {        
        $request = new Request();        
        
        //set test data
        $job = new Job();        
        $job->setTitle('Test job');        
        $application = new Application();
        $application->setJob('Test Job');
        $application->setCandidateName('Test candidate');
        $application->setEmail('test@candidate.com');
        
        $jobService = $this->createMock(JobService::class);
        $jobService->expects($this->once())
            ->method('getJobById')
            ->with($this->equalTo($job->getId()))
            ->willReturn($job);
        
        $applicationService = $this->createMock(ApplicationService::class);
        $applicationService->expects($this->once())
            ->method('saveApplication')
            ->with($this->equalTo($application), $this->equalTo($job->getTitle()));


        $formFactory = $this->createMock(\Symfony\Component\Form\FormFactoryInterface::class);
        $formFactory->expects($this->any())
            ->method('create')
            ->willReturn($this->createMock(\Symfony\Component\Form\FormInterface::class));


        $controller = $this->getMockBuilder(JobsController::class)
            ->setConstructorArgs([$jobService, $applicationService, $formFactory])
            ->onlyMethods(['createForm', 'render'])
            ->getMock();

        $controller->method('createForm')
            ->willReturn($this->createMock(\Symfony\Component\Form\FormInterface::class));

        $controller->method('render')
        ->willReturn(new \Symfony\Component\HttpFoundation\Response('', 302));

        $container = $this->createMock(\Symfony\Component\DependencyInjection\ContainerInterface::class);
        $container->expects($this->any())
            ->method('has')
            ->willReturn(true);

        $controller->setContainer($container);

        $twig = $this->createMock(\Twig\Environment::class);
        $twig->expects($this->any())
            ->method('render')
            ->willReturn('');


        $container->set('twig', $twig);
        $response = $controller->jobDetailsAction($job, $request);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/jobs', $response->headers->get('Location'));
    }
}
