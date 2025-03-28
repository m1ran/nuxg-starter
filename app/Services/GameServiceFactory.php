<?php

namespace App\Services;

class GameServiceFactory
{
    public static function create(string $gameType): GameServiceInterface
    {
        return match ($gameType) {
            'lucky' => new LuckyGameService(),
            default => throw new \InvalidArgumentException("Invalid game type: $gameType"),
        };
    }
}
