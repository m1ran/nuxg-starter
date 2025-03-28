@extends('layouts.app')

@section('title', 'Registration')

@section('content')
    <div class="w-full p-6 rounded-lg shadow-lg bg-blue-100">
        <h2 class="text-xl font-semibold text-center mb-4">Registration</h2>
        <form action="{{ route('registration.submit') }}" method="POST" class="space-y-4">
            @csrf
            @if (session('message'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg">
                    {!! session('message') !!}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div>
                <label class="block text-sm font-medium">Username</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border rounded-lg border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium">Phonenumber</label>
                <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full px-4 py-2 border rounded-lg border-blue-500">
            </div>
            <button type="submit" class="w-full px-4 py-2 border rounded-lg border-blue-500 bg-blue-400 text-white">
                Register
            </button>
        </form>
    </div>
@endsection
