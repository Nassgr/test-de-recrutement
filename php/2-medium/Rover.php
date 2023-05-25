<?php

declare(strict_types=1);

namespace App;

class Rover
{
    private string $direction;
    private int $y;
    private int $x;

    public function __construct(int $x, int $y, string $direction)
    {
        $this->direction = $direction;
        $this->y = $y;
        $this->x = $x;
    }

    public function receive(string $commandsSequence): void
    {
        $commandsSequenceLength = strlen($commandsSequence);

        for ($i = 0; $i < $commandsSequenceLength; ++$i) {
            $command = $commandsSequence[$i];

            if ($command === "l" || $command === "r") {
                $this->rotateRover($command);
            } else {
                $this->displaceRover($command);
            }
        }
    }

    private function rotateRover(string $command): void
    {
        $rotations = [
            "N" => ["r" => "E", "l" => "W"],
            "E" => ["r" => "S", "l" => "N"],
            "S" => ["r" => "W", "l" => "E"],
            "W" => ["r" => "N", "l" => "S"],
        ];

        $this->direction = $rotations[$this->direction][$command];
    }

    private function displaceRover(string $command): void
    {
        $displacement = ($command === "f") ? 1 : -1;

        if ($this->direction === "N") {
            $this->y += $displacement;
        } else if ($this->direction === "S") {
            $this->y -= $displacement;
        } else if ($this->direction === "W") {
            $this->x -= $displacement;
        } else {
            $this->x += $displacement;
        }
    }
}

/* Explications : 
Dans cette Class, je propose un split de la function receive en 3 function distincte plus parlante 
(receive donc puis rotateRover et displaceRover).
La function rotateRover intégre la logique de rotation du rover dans un tableau associatif $rotations.
La function displaceRover intégre la logique du déplacement du rover en testant les conditions nord sud ouest est
