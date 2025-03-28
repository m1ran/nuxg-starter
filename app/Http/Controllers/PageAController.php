<?php

namespace App\Http\Controllers;

use App\Jobs\SaveGameResult;
use App\Models\UserGameResult;
use Illuminate\Http\Request;
use App\Repositories\UserLinkRepository;
use App\Services\GameServiceInterface;

class PageAController extends Controller
{

    public function index(Request $request, $link, UserLinkRepository $userLinkRepository)
    {
        $user = $request->get('user');
        $links = $userLinkRepository->getUserLinks($user);

        return view('pages.page-a', compact('link', 'links'));
    }

    public function generateLink(Request $request, $link, UserLinkRepository $userLinkRepository)
    {
        $user = $request->get('user');
        $userLinkRepository->createNewLink($user);

        return redirect()->route('page.a.index', $link)
            ->with('message', 'New link has been generated successfully!');
    }

    public function deactivateLink(Request $request, $link, UserLinkRepository $userLinkRepository)
    {
        $request->validate([
            'link' => 'required|string',
        ]);
        // Prevent deleting the link if user is not owner
        $user = $request->get('user');
        $userLinkRepository->deactivateLink($user, $request->link);
        $message = 'Link has been deactivated successfully!';

        return $request->link === $link
          ? redirect()->route('registration.index')->with('message', $message)
          : redirect()->route('page.a.index', $link)->with('message', $message);
    }

    public function play(Request $request, $link, GameServiceInterface $gameService)
    {
        $user = $request->get('user');
        $gameResults = $gameService->play();

        SaveGameResult::dispatch($user->id, $gameResults['number'], $gameResults['win'], $gameResults['winAmount']);

        $message = 'Your number is: ' . $gameResults['number'] .
            ' You ' . ($gameResults['win'] ? 'Won: ' . $gameResults['winAmount'] : ' Lose');

        return redirect()->route('page.a.index', $link)
            ->with('message', $message);
    }

    public function history(Request $request, $link, UserLinkRepository $userLinkRepository)
    {
        $user = $request->get('user');
        $links = $userLinkRepository->getUserLinks($user);
        $games = UserGameResult::where('user_id', $user->id)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.page-a', compact('link', 'links', 'games'));
    }
}
