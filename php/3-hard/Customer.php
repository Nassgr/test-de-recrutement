<?php

declare(strict_types=1);


namespace App;


class Customer
{
    public function __construct(String $name)
    {
        $this->name = $name;
    }

    public function addRental(Rental $rental)
    {
        return $this->rentals[] = $rental;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function statement(): string 
    {
        $totalAmount = 0.0;
        $frequentRenterPoints = 0;
        $result = "Rental Record for " . $this->getName() . "\n";

        foreach ($this->rentals as $rental) {
            $thisAmount = $this->RentalAmount($rental);
            $frequentRenterPoints += $this->RenterPoints($rental);

            $result .= "\t" . $rental->getMovie()->getTitle() . "\t"
                . number_format($thisAmount, 1) . "\n";
            $totalAmount += $thisAmount;
        }

        $result .= "You owed " . number_format($totalAmount, 1) . "\n";
        $result .= "You earned " . $frequentRenterPoints . " frequent renter points\n";

        return $result;
    }

    private function RentalAmount(Rental $rental): float
    {
        $amount = 0.0;
        
        switch ($rental->getMovie()->getPriceCode()) {
            case Movie::REGULAR:
                $amount += 2;
                if ($rental->getDaysRented() > 2) {
                    $amount += ($rental->getDaysRented() - 2) * 1.5;
                }
                break;
            case Movie::NEW_RELEASE:
                $amount += $rental->getDaysRented() * 3;
                break;
            case Movie::CHILDREN:
                $amount += 1.5;
                if ($rental->getDaysRented() > 3) {
                    $amount += ($rental->getDaysRented() - 3) * 1.5;
                }
                break;
        }

        return $amount;
    }

    private function RenterPoints(Rental $rental): int
    {
        $RenterPoints = 1;

        if ($rental->getMovie()->getPriceCode() === Movie::NEW_RELEASE
            && $rental->getDaysRented() > 1) {
            $RenterPoints++;
        }

        return $RenterPoints;
    }
    
    private string $name;
    private array $rentals = [];
}

/*
Pour réduire la complexité de la fonction, j'ai déplacé la logique de calcul du montant de la location dans la fonction RentalAmount.
J'ai également déplacé la logique de calcul des points de fidélité du locataire dans la fonction RenterPoints. 
Cela améliore la lisibilité et facilite la maintenance du code. Modification de noms de variable pour une meilleure compréhension.
*/
