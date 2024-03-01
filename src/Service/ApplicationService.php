<?php
namespace App\Service;

use Doctrine\ODM\MongoDB\DocumentManager;
use App\Document\Application;

class ApplicationService
{
    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    private $ApplicationRepository;

    public function getApplicationRepository()
    {        
        return $this->ApplicationRepository = $this->dm->getRepository(Application::class);
    }

    public function getAllApplications()
    {
        return $this->getApplicationRepository()->findAll();
    }

    public function getApplicationById($id)
    {
        return $this->getApplicationRepository()->find($id);
    }

    public function saveApplication(Application $application, $jobId)    
    {
        $application->setApplicationDate(new \DateTime());
        $application->setJobId($jobId);
        $this->dm->persist($application);
        $this->dm->flush();
    }
    
}
