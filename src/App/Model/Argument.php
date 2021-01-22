<?php


namespace App\Model;


class Argument
{
    /**
     * @var mixed
     */
    private $type;

    private ?string $name = null;

    /**
     * @return mixed
     */
    public function getType(): mixed
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Argument
     */
    public function setType(mixed $type): Argument
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
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
