<?php

namespace Tests\App\Service;

use App\Service\ApplicationService;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Query\Builder;
use Doctrine\ODM\MongoDB\Query\Query;
use App\Document\Application;
use Symfony\Component\HttpFoundation\Request;
use PHPUnit\Framework\TestCase;


class QueryWrapper
{
    private $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function execute()
    {
        return $this->query->execute();
    }
}
class ApplicationServiceTest extends TestCase
{
    private $dm;
    private $applicationService;

    protected function setUp(): void
    {
        $this->dm = $this->createMock(DocumentManager::class);
        $this->applicationService = new ApplicationService($this->dm);
    }

    public function testGetApplicationsFilters()
    {
        $request = new Request();
        $request->request->add(['position-string' => 'Position', 'status' => 'Pending']);

        $application = new Application();
        $application->setPositionAppliedFor('Position');
        $application->setStatus('Pending');

        $queryBuilder = $this->createMock(Builder::class);
        $query = $this->createMock(Query::class);        

        $this->dm->expects($this->once())
            ->method('createQueryBuilder')
            ->with(Application::class)
            ->willReturn($queryBuilder);

        $queryBuilder->expects($this->exactly(2))
            ->method('field')
            ->withConsecutive(['positionAppliedFor'], ['status'])
            ->willReturnSelf();

        $queryBuilder->expects($this->exactly(2))
            ->method('equals')
            ->withConsecutive(['Position'], ['Pending'])
            ->willReturnSelf();

        $queryBuilder->expects($this->once())
            ->method('sort')
            ->with('applicationDate', 'DESC')
            ->willReturnSelf();
        dump($query);
        $queryBuilder->expects($this->once())
            ->method('getQuery')
            ->willReturn($query);

        $query->expects($this->once())
            ->method('execute')
            ->willReturn([$application]);

        $applications = $this->applicationService->getApplicationsFilters($request);

        $this->assertCount(1, $applications);
        $this->assertEquals('Position', $applications[0]->getPositionAppliedFor());
        $this->assertEquals('Pending', $applications[0]->getStatus());
    }
}
