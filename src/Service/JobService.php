<?php
namespace App\Service;

use Doctrine\ODM\MongoDB\DocumentManager;
use App\Document\Job;

class JobService
{
    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    private $jobRepository;

    public function getJobRepository()
    {        
        return $this->jobRepository = $this->dm->getRepository(Job::class);
    }

    public function getAllJobs()
    {
        return $this->getJobRepository()->findAll();
    }

    public function getJobById($id)
    {
        return $this->getJobRepository()->find($id);
    }
    
    public function updateNumberOfApplications($id)
    {
        $job = $this->getJobRepository()->find($id);
        $numberOfApplications = $job->getNumberOfApplications();
        $numberOfApplications++;
        $job->setNumberOfApplications($numberOfApplications);
        $this->dm->flush();
    }
}
