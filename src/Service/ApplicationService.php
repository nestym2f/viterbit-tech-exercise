<?php
namespace App\Service;

use Doctrine\ODM\MongoDB\DocumentManager;
use App\Document\Application;
use Symfony\Component\HttpFoundation\Request;
use MongoDB\BSON\Regex;

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
        $query = $this->dm->createQueryBuilder(Application::class)
        ->sort('applicationDate', 'DESC')
        ->getQuery();

        $applications = $query->execute();
        return $applications;
    }

    public function getApplicationsFilters(Request $request)
    {        
        $positionString = $request->get('position-string');
        $status = $request->get('status');
        
        $queryBuilder = $this->dm->createQueryBuilder(Application::class);
        if (!empty($positionString)) {                        
            $queryBuilder->field('positionAppliedFor')->equals($positionString);
           }
        if (!empty($status)) {            
            $queryBuilder->field('status')->equals($status);
        }
        $queryBuilder->sort('applicationDate', 'DESC');        
        $applications = $queryBuilder->getQuery()->execute();         
        
        return $applications;
    }
    public function getApplicationById($id)
    {
        return $this->getApplicationRepository()->find($id);
    }

    public function saveApplication(Application $application, $jobId)    
    {
        $application->setApplicationDate(new \DateTime());
        $application->setJobId($jobId);
        $application->setStatus('Pending');
        $this->dm->persist($application);
        $this->dm->flush();
    }
    
}
