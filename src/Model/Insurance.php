<?php
namespace App\Model;

class Insurance
{


    public function __construct(
        private ?int $id,
        private string $name
    ) {
        $this->id = $id;
        $this->name = $name;

    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}