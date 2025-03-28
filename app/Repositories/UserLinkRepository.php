<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserLink;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class UserLinkRepository
{
    public function getUserLinks(User $user)
    {
        return Cache::remember("user_links:{$user->id}", now()->addHour(1), function () use ($user) {
            return $user->links()->where('expires_at', '>', now())->get();
        });
    }

    public function createNewLink(User $user): UserLink
    {
        $link = $user->links()->create([
            'link' => Str::uuid(),
            'expires_at' => Carbon::now()->addDays(7),
        ]);

        $this->clearUserLinksCache($user);

        return $link;
    }

    public function deactivateLink(User $user, string $link)
    {
        $linkToDeactivate = $user->links()->where('link', $link)->firstOrFail();
        $linkToDeactivate->update(['expires_at' => now()]);
        $this->clearUserLinksCache($linkToDeactivate->user);
    }

    public function getActiveLink(User $user): ?UserLink
    {
        return $user->links()->where('expires_at', '>', Carbon::now())->latest()->first();
    }

    public function getOwner(string $link): User
    {
        $link = UserLink::where(['link' => $link, ['expires_at', '>', now()]])->firstOrFail();
        return $link ? $link->user : null;
    }

    protected function clearUserLinksCache(User $user)
    {
        Cache::forget("user_links:{$user->id}");
    }
}
