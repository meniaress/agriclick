<?php

class Service {
    private ?int $id;
    private ?string $title;
    private ?string $description;
    private ?string $category;
    private ?string $localisation;
    private ?string $type;
    private ?DateTime $date;
    private ?float $tarif;

    // Constructor
    public function __construct(?int $id, ?string $title, ?string $description, ?string $category, ?string $localisation, ?string $type, ?float $tarif, ?DateTime $date = null) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->category = $category;
        $this->localisation = $localisation;
        $this->tarif = $tarif;
        $this->type = $type;
        $this->date = $date ?? new DateTime(); 
    }
    

    // Getters and Setters

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getTitle(): ?string {
        return $this->title;
    }

    public function setTitle(?string $title): void {
        $this->title = $title;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): void {
        $this->description = $description;
    }

    public function getDate(): ?DateTime {
        return $this->date;
    }

    public function setDate(?DateTime $date): void {
        $this->date = $date;
    }


    public function getTarif(): ?float {
        return $this->tarif;
    }

    public function setTarif(float $tarif): void {
        $this->tarif = $tarif;
    }

    public function getLocalisation(): string {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): void {
        $this->localisation = $localisation;
    }

    public function getType(): string {
        return $this->type;
    }

    public function setType(string $type): void {
        $this->type = $type;
    }

    public function getCategory(): string {
        return $this->category;
    }

    public function setCategory(string $category): void {
        $this->category = $category;
    }
}

?>
