<?php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Validator\Constraints as Assert;

#[MongoDB\Document(collection: 'jobs')]
class Job extends BaseDocument
{
    #[MongoDB\Field(type: 'string')]
    private $title;

    #[MongoDB\Field(type: 'string')]
    private $description;

    /**
     * @MongoDB\Field(type="int")
     * @Assert\GreaterThan(value=0, message="Salary must be greater than 0.")
    */
    private $salary;

    #[MongoDB\Field(type: 'string')]
    private $location;

    #[MongoDB\Field(type: 'int')]
    private $numberOfApplications;

    #[MongoDB\Field(type: 'string')]
    private $notes;    

    //Functions
    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;        
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;        
    }

    public function getSalary(): ?int
    {
        return $this->salary;
    }

    public function setSalary(int $salary): void
    {
        $this->salary = $salary;        
    }

    public function getNumberOfApplications(): ?int
    {
        return $this->numberOfApplications;
    }

    public function setNumberOfApplications(int $numberOfApplications): void
    {
        $this->numberOfApplications = $numberOfApplications;        
    }
    
    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;        
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): void
    {
        $this->notes = $notes;        
    }    
}
