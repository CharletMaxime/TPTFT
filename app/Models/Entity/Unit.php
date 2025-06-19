<?php

namespace Models\Entity;

class Unit
{
    private string|null $id = null;
    private string $name;
    private int $cost;
    private array $origin;
    private string $url_img;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getCost(): int
    {
        return $this->cost;
    }

    /**
     * @param int $cost
     * @return void
     */
    public function setCost(int $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return string
     */
    public function getOrigin(): array
    {
        return $this->origin;
    }

    /**
     * @param string $origin
     * @return void
     */
    public function setOrigin(array $origin): void
    {
        $this->origin = $origin;
    }

    /**
     * @return string
     */
    public function getUrl_img(): string
    {
        return $this->url_img;
    }

    /**
     * @param string $url_img
     * @return void
     */
    public function setUrl_img(string $url_img): void
    {
        $this->url_img = $url_img;
    }

    /**
     * @return string|null
     */
    public function getId(): string|null
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     * @return void
     */
    public function setId(string|null $id): void
    {
        $this->id = $id;
    }

    /**
     * Formalise les données dans le constructeur
     * @param array $data
     * @return void
     */
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}