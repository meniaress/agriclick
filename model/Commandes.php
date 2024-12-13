<?php
class Commande
{
    private ?int $id;
    private DateTime $date;
    private string $paiement;
    private ?string $message;
    private int $idService;

    public function __construct(?int $id, DateTime $date, string $paiement, ?string $message, int $idService)
    {
        $this->id = $id;
        $this->date = $date;
        $this->paiement = $paiement;
        $this->message = $message;
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
    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getIdService(): int
    {
        return $this->idService;
    }
}
