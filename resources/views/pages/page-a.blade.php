@extends('layouts.app')

@section('title', 'Page  A')

@section('content')
    <div class="w-full p-6 rounded-lg shadow-lg bg-blue-100">
        <h2 class="text-xl font-semibold text-center mb-4">Page A</h2>
        @if (session('message'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                {!! session('message') !!}
            </div>
        @endif

        <div class="w-full flex space-x-2 items-center">
            <form action="{{ route('page.a.generate', $link) }}" method="POST" class="space-y-4">
                @csrf
                <button type="submit" class="px-4 py-2 border rounded-lg border-blue-500 bg-blue-400 text-white">
                    Generate
                </button>
            </form>

            <form action="{{ route('page.a.play', $link) }}" method="POST" class="space-y-4">
                @csrf
                <button type="submit" class="px-4 py-2 border rounded-lg border-green-500 bg-green-400 text-white">
                    Imfeelinglucky
                </button>
            </form>

            <div>
                <a href="{{ route('page.a.history', $link) }}" class="text-blue-500 hover:underline">
                    History
                </a>
            </div>
        </div>

        @if (isset($games) && count($games))
            <div class="mt-6">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 border-b">Number</th>
                            <th class="px-4 py-2 border-b">Win</th>
                            <th class="px-4 py-2 border-b">Amount</th>
                            <th class="px-4 py-2 border-b">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($games as $game)
                            <tr>
                                <td class="px-4 py-2 border-b text-center">
                                    {{ $game->number }}
                                </td>
                                <td class="px-4 py-2 border-b text-center">
                                    {{ $game->win ? 'Win' : 'Lose' }}
                                </td>
                                <td class="px-4 py-2 border-b text-center">
                                    {{ $game->win_amount }}
                                </td>
                                <td class="px-4 py-2 border-b text-center">
                                    {{ $game->created_at->format('Y-m-d H:i') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if (count($links) > 0)
            <div class="mt-6">
                <h4 class="text-lg font-semibold mb-2">Generated Links</h4>
                <table class="w-full border-collapse border border-gray-300">
                    <tbody>
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2 border-b">Link</th>
                                <th class="px-4 py-2 border-b">Expires At</th>
                                <th class="px-4 py-2 border-b"></th>
                            </tr>
                        </thead>
                        @foreach ($links as $userLink)
                            <tr>
                                <td class="px-4 py-2 border-b">
                                    <a href="{{ route('page.a.index', $userLink->link) }}" class="text-blue-500 hover:underline">
                                        {{ route('page.a.index', $userLink->link) }}
                                    </a>
                                </td>
                                <td class="px-4 py-2 border-b">
                                    {{ $userLink->expires_at->format('Y-m-d H:i') }}
                                </td>
                                <td>
                                    <form action="{{ route('page.a.deactivate', $link) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="link" value="{{ $userLink->link }}">
                                        <button type="submit" class="text-red-500 hover:underline">
                                            Deactivate
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
