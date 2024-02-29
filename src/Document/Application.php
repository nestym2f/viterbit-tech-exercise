<?php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Date;

#[MongoDB\Document(collection: 'applications')]
class Application extends BaseDocument
{
    #[MongoDB\Field(type: 'string')]
    private $candidateName;

    #[MongoDB\Field(type: 'string')]
    private $contactInformation;

    #[MongoDB\Field(type: 'string')]
    private $positionAppliedFor;

    #[MongoDB\Field(type: 'date')]
    private $applicationDate;

    #[MongoDB\Field(type: 'string')]
    private $status;    

    //Functions
    public function getCandidateName(): ?string
    {
        return $this->candidateName;
    }

    public function setCandidateName(string $candidateName): void
    {
        $this->candidateName = $candidateName;        
    }

    public function getContactInformation(): ?string
    {
        return $this->contactInformation;
    }

    public function setContactInformation(string $contactInformation): void
    {
        $this->contactInformation = $contactInformation;        
    }

    public function getPositionAppliedFor(): ?string
    {
        return $this->positionAppliedFor;
    }

    public function setPositionAppliedFor(string $positionAppliedFor): void
    {
        $this->positionAppliedFor = $positionAppliedFor;        
    }

    public function getApplicationDate(): ?\DateTimeInterface
    {
        return $this->applicationDate;
    }

    public function setApplicationDate(string $applicationDate): void
    {
        $this->applicationDate = $applicationDate;        
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;        
    }    
}
