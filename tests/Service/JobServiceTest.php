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
}
