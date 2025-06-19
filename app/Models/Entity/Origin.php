<?php

namespace Models\Entity;

class Origin
{

    private int|null $id;



    private string $name;

    private string $url_img;


    /**
     * Construis l'objet par l'hydrate
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }


    #region Assesseurs

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
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
     * @return string
     */
    public function getUrl_Img(): string
    {
        return $this->url_img;
    }

    /**
     * @param string $url_img
     * @return void
     */
    public function setUrl_Img(string $url_img): void
    {
        $this->url_img = $url_img;
    }
    #endregion

    /**
     * Set les données de l'origine
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