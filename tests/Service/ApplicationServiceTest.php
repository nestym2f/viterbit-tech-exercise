<?php

namespace App\Tests\Service;

use App\Service\ApplicationService;
use Doctrine\ODM\MongoDB\DocumentManager;
use App\Document\Application;
use App\Document\Job;
use PHPUnit\Framework\TestCase;

class ApplicationServiceTest extends TestCase
{
    private $dm;
    private $ApplicationService;
    private $applicationRepository;

    public function setUp(): void
    {
        $this->dm = $this->getMockBuilder(DocumentManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->ApplicationService = new ApplicationService($this->dm);

        $this->applicationRepository = $this->getMockBuilder('Doctrine\ODM\MongoDB\Repository\DocumentRepository')
            ->disableOriginalConstructor()
            ->getMock();        
    } 
}
