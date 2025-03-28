<?php

namespace App\Services;

interface GameServiceInterface
{
    public function play(): array;

    public function calculateWinAmount(int $number): float;
}
