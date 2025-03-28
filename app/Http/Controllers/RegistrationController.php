<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegistrationRequest;
use App\Repositories\UserLinkRepository;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('pages.registration');
    }

    public function submit(RegistrationRequest $request, UserLinkRepository $userLinkRepository)
    {
        try {
            // check if user already exists
            $user = User::where(['name' => $request->name, 'phone' => $request->phone])->first();
            // create a new one if not exists
            if (!$user) {
                $user = User::create($request->only('name', 'phone'));
            }
            // get or create a new link for the user
            $activeLink = $userLinkRepository->getActiveLink($user);
            if (!$activeLink) {
                $activeLink = $userLinkRepository->createNewLink($user);
            }

            $linkUrl = url('/page-a/' . $activeLink->link);
            $message = 'You have signed up/in successfully! Your link is:
                 <a href="' . $linkUrl . '" class="text-blue-500 underline">'. $linkUrl . '</a>';
            return redirect()->route('registration.index')
                ->with('message', $message);
        } catch (\Exception $e) {
            return redirect()->route('registration.index')
                ->with('message', 'Something went wrong');
        }
    }
}
