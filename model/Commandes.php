<?php
class Commande
{
    private ?int $id;
    private DateTime $date;
    private string $paiement;
    private int $idService;

    public function __construct(?int $id, DateTime $date, string $paiement, int $idService)
    {
        $this->id = $id;
        $this->date = $date;
        $this->paiement = $paiement;
        $this->idService = $idService;
    }

    // Getters and setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getPaiement(): string
    {
        return $this->paiement;
    }

    public function getIdService(): int
    {
        return $this->idService;
    }
}
