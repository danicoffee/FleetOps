<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'FleetOps') }} - @yield('title')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.4/dist/tailwind.min.css">
</head>
<body class="bg-slate-50 text-slate-900">
    <div class="min-h-screen">
        <header class="bg-white border-b border-slate-200 shadow-sm">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6">
                <a href="{{ route('dashboard') }}" class="font-semibold text-lg text-slate-900">FleetOps</a>

                <nav class="space-x-4 text-sm text-slate-700">
                    @auth
                        <span>Welcome, {{ auth()->user()->name }}</span>
                        <a href="{{ route('dashboard') }}" class="hover:text-slate-900">Dashboard</a>
                        <a href="{{ route('leave-requests.index') }}" class="hover:text-slate-900">Leave Requests</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login.show') }}" class="hover:text-slate-900">Login</a>
                        <a href="{{ route('register.show') }}" class="hover:text-slate-900">Register</a>
                    @endauth
                </nav>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6">
            @if (session('success'))
                <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-emerald-900">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-900">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('warning'))
                <div class="mb-6 rounded-lg border border-amber-200 bg-amber-50 p-4 text-amber-900">
                    {{ session('warning') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-900">
                    <strong>There were some issues with your submission:</strong>
                    <ul class="mt-2 list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
