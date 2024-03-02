<?php

namespace App\Tests\Service;

use App\Service\JobService;
use Doctrine\ODM\MongoDB\DocumentManager;
use App\Document\Job;
use PHPUnit\Framework\TestCase;

class JobServiceTest extends TestCase
{
    private $dm;
    private $jobService;
    private $jobRepository;

    public function setUp(): void
    {
        $this->dm = $this->getMockBuilder(DocumentManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jobService = new JobService($this->dm);

        $this->jobRepository = $this->getMockBuilder('Doctrine\ODM\MongoDB\Repository\DocumentRepository')
            ->disableOriginalConstructor()
            ->getMock();        
    }  
    
    public function testGetAllJobs()
    {
        $job = new Job();
        
        $this->jobRepository->expects($this->once())
            ->method('findAll')
            ->will($this->returnValue([$job]));

        $this->dm->expects($this->once())
            ->method('getRepository')
            ->with($this->equalTo(Job::class))
            ->will($this->returnValue($this->jobRepository));

        $jobs = $this->jobService->getAllJobs();
        dump($jobs);
        $this->assertCount(1, $jobs);
        $this->assertSame($job, $jobs[0]);
    }
}
