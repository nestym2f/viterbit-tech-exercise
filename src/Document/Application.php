<?php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Date;

#[MongoDB\Document(collection: 'applications')]
class Application extends BaseDocument
{
    #[MongoDB\Field(type: 'string')]
    #[Assert\NotBlank]
    private $candidateName;

    #[MongoDB\Field(type: 'string')]
    #[Assert\NotBlank]
    #[Assert\Email]
    private $email;

    #[MongoDB\Field(type: 'string')]
    #[Assert\NotBlank]
    private $phone;

    #[MongoDB\Field(type: 'string')]
    #[Assert\NotBlank]
    private $positionAppliedFor;

    #[MongoDB\Field(type: 'date')]
    private $applicationDate;

    #[MongoDB\Field(type: 'string')]
    private $status;   

    #[MongoDB\Field(type: 'string')]
    private $job;

    //Functions
    public function getCandidateName(): ?string
    {
        return $this->candidateName;
    }

    public function setCandidateName(string $candidateName): void
    {
        $this->candidateName = $candidateName;        
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;        
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;        
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

    public function setApplicationDate(\DateTimeInterface $applicationDate): void
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

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): void
    {
        $this->job = $job;        
    }    
}
