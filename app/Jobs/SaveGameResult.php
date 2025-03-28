<?php

namespace App\Jobs;

use App\Models\UserGameResult;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveGameResult implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels, InteractsWithQueue;

    protected $userId;
    protected $number;
    protected $win;
    protected $winAmount;

    /**
     * Create a new job instance.
     */
    public function __construct($userId, $number, $win, $winAmount)
    {
        $this->userId = $userId;
        $this->number = $number;
        $this->win = $win;
        $this->winAmount = $winAmount;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        UserGameResult::create([
            'user_id' => $this->userId,
            'number' => $this->number,
            'win' => $this->win,
            'win_amount' => $this->winAmount,
        ]);
    }
}
