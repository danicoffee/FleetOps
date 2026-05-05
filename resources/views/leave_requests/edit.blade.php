@extends('layouts.app')

@section('title', 'Edit Leave Request')

@section('content')
<div class="mx-auto max-w-3xl rounded-xl border border-slate-200 bg-white p-8 shadow-sm">
    <h1 class="mb-6 text-2xl font-semibold">Edit leave request</h1>

    <form method="POST" action="{{ route('leave-requests.update', $leaveRequest) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="type" class="block text-sm font-medium text-slate-700">Leave type</label>
            <input id="type" name="type" value="{{ old('type', $leaveRequest->type) }}" required class="mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" />
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="start_date" class="block text-sm font-medium text-slate-700">Start date</label>
                <input id="start_date" name="start_date" type="date" value="{{ old('start_date', $leaveRequest->start_date->toDateString()) }}" required class="mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" />
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-slate-700">End date</label>
                <input id="end_date" name="end_date" type="date" value="{{ old('end_date', $leaveRequest->end_date->toDateString()) }}" required class="mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" />
            </div>
        </div>

        <div>
            <label for="reason" class="block text-sm font-medium text-slate-700">Reason</label>
            <textarea id="reason" name="reason" rows="4" class="mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">{{ old('reason', $leaveRequest->reason) }}</textarea>
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-slate-700">Status</label>
            <select id="status" name="status" class="mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">
                @foreach(['pending', 'approved', 'rejected'] as $status)
                    <option value="{{ $status }}" {{ old('status', $leaveRequest->status) === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="rounded-md bg-slate-900 px-4 py-2 text-white hover:bg-slate-800">Update request</button>
            <a href="{{ route('leave-requests.show', $leaveRequest) }}" class="text-slate-700 hover:text-slate-900">Cancel</a>
        </div>
    </form>
</div>
@endsection
