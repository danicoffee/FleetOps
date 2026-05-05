@extends('layouts.app')

@section('title', 'New Leave Request')

@section('content')
<div class="mx-auto max-w-3xl rounded-xl border border-slate-200 bg-white p-8 shadow-sm">
    <h1 class="mb-6 text-2xl font-semibold">Submit a leave request</h1>

    <form method="POST" action="{{ route('leave-requests.store') }}" class="space-y-6">
        @csrf

        <div>
            <label for="type" class="block text-sm font-medium text-slate-700">Leave type</label>
            <input id="type" name="type" value="{{ old('type') }}" required class="mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" />
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label for="start_date" class="block text-sm font-medium text-slate-700">Start date</label>
                <input id="start_date" name="start_date" type="date" value="{{ old('start_date') }}" required class="mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" />
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-slate-700">End date</label>
                <input id="end_date" name="end_date" type="date" value="{{ old('end_date') }}" required class="mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500" />
            </div>
        </div>

        <div>
            <label for="reason" class="block text-sm font-medium text-slate-700">Reason</label>
            <textarea id="reason" name="reason" rows="4" class="mt-1 w-full rounded-md border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500">{{ old('reason') }}</textarea>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="rounded-md bg-slate-900 px-4 py-2 text-white hover:bg-slate-800">Submit request</button>
            <a href="{{ route('leave-requests.index') }}" class="text-slate-700 hover:text-slate-900">Cancel</a>
        </div>
    </form>
</div>
@endsection
