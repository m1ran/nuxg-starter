<?php

namespace App\Services;

class LuckyGameService implements GameServiceInterface

{
    public function play(): array
    {
        $number = rand(1, 1000);
        $win = $number % 2 === 0;
        $winAmount = $win ? $this->calculateWinAmount($number) : 0;

        return compact('number', 'win', 'winAmount');
    }

    public function calculateWinAmount(int $number): float
    {
        return match (true) {
            $number > 900 => $number * 0.7,
            $number > 600 => $number * 0.5,
            $number > 300 => $number * 0.3,
            default => $number * 0.1,
        };
    }
}
