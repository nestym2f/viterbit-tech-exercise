<?php
namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

class BaseDocument
{
    /**
     * @MongoDB\Id
     */
    #[MongoDB\Id]    
    protected $id;

    public function getId(): ?string
    {
        return $this->id;
    }
}
