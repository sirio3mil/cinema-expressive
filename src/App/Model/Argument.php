<?php


namespace App\Model;


class Argument
{
    /**
     * @var mixed
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Argument
     */
    public function setType($type): Argument
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Argument
     */
    public function setName(string $name): Argument
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->name && $this->type;
    }
}
