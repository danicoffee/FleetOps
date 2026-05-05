@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid gap-6 lg:grid-cols-[1fr_320px]">
    <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="mb-4 text-2xl font-semibold">Dashboard</h1>
        <p class="mb-6 text-slate-600">Welcome back, {{ auth()->user()->name }}. Use the navigation above to submit or manage leave requests.</p>

        <div class="grid gap-4 sm:grid-cols-2">
            <article class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                <h2 class="font-semibold">Role</h2>
                <p class="mt-2 text-slate-700">{{ auth()->user()->role?->name ?? 'Unassigned' }}</p>
            </article>
            <article class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                <h2 class="font-semibold">Leave requests</h2>
                <p class="mt-2 text-slate-700">{{ auth()->user()->leaveRequests()->count() }} total</p>
            </article>
        </div>
    </section>

    <section class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="mb-4 text-xl font-semibold">Recent requests</h2>
        @if($leaveRequests->isEmpty())
            <p class="text-slate-600">No leave requests yet.</p>
        @else
            <ul class="space-y-3">
                @foreach($leaveRequests as $request)
                    <li class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                        <p class="font-semibold">{{ $request->type }}</p>
                        <p class="text-slate-600">{{ $request->start_date->format('M j, Y') }} — {{ $request->end_date->format('M j, Y') }}</p>
                        <span class="mt-2 inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs text-slate-700">{{ ucfirst($request->status) }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>
</div>
@endsection
