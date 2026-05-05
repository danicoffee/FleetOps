@extends('layouts.app')

@section('title', 'Leave Request Details')

@section('content')
<div class="mx-auto max-w-3xl rounded-xl border border-slate-200 bg-white p-8 shadow-sm">
    <div class="mb-6 flex items-start justify-between gap-4">
        <div>
            <h1 class="text-2xl font-semibold">{{ $leaveRequest->type }}</h1>
            <p class="mt-1 text-sm text-slate-600">Submitted by {{ $leaveRequest->user->name }}</p>
        </div>
        <span class="rounded-full bg-slate-100 px-3 py-1 text-sm text-slate-800">{{ ucfirst($leaveRequest->status) }}</span>
    </div>

    <div class="grid gap-4 sm:grid-cols-2">
        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
            <h2 class="font-semibold">Period</h2>
            <p class="mt-2 text-slate-700">{{ $leaveRequest->start_date->format('M j, Y') }} — {{ $leaveRequest->end_date->format('M j, Y') }}</p>
        </div>
        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
            <h2 class="font-semibold">Requested on</h2>
            <p class="mt-2 text-slate-700">{{ $leaveRequest->created_at->format('M j, Y') }}</p>
        </div>
    </div>

    <div class="mt-6 rounded-xl border border-slate-200 bg-slate-50 p-4">
        <h2 class="font-semibold">Reason</h2>
        <p class="mt-2 text-slate-700 whitespace-pre-line">{{ $leaveRequest->reason }}</p>
    </div>

    <div class="mt-6 flex items-center gap-3">
        <a href="{{ route('leave-requests.edit', $leaveRequest) }}" class="rounded-md bg-slate-900 px-4 py-2 text-white hover:bg-slate-800">Edit</a>
        <form method="POST" action="{{ route('leave-requests.destroy', $leaveRequest) }}" onsubmit="return confirm('Delete this request?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="rounded-md bg-rose-600 px-4 py-2 text-white hover:bg-rose-700">Delete</button>
        </form>
        <a href="{{ route('leave-requests.index') }}" class="text-slate-700 hover:text-slate-900">Back to list</a>
    </div>
</div>
@endsection
