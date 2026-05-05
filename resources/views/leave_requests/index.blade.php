@extends('layouts.app')

@section('title', 'Leave Requests')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-2xl font-semibold">Leave Requests</h1>
        <p class="mt-1 text-sm text-slate-600">Manage your leave history and submit new applications.</p>
    </div>
    <a href="{{ route('leave-requests.create') }}" class="rounded-md bg-slate-900 px-4 py-2 text-white hover:bg-slate-800">New request</a>
</div>

<div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
    <table class="w-full text-left text-sm text-slate-700">
        <thead class="bg-slate-50 text-slate-900">
            <tr>
                <th class="px-4 py-3">Type</th>
                <th class="px-4 py-3">Period</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Submitted by</th>
                <th class="px-4 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($leaveRequests as $request)
                <tr class="border-t border-slate-200 hover:bg-slate-50">
                    <td class="px-4 py-4">{{ $request->type }}</td>
                    <td class="px-4 py-4">{{ $request->start_date->format('M j, Y') }} — {{ $request->end_date->format('M j, Y') }}</td>
                    <td class="px-4 py-4">
                        <span class="rounded-full px-3 py-1 text-xs font-semibold text-slate-800 {{ $request->status === 'approved' ? 'bg-emerald-100' : ($request->status === 'rejected' ? 'bg-rose-100' : 'bg-amber-100') }}">{{ ucfirst($request->status) }}</span>
                    </td>
                    <td class="px-4 py-4">{{ $request->user->name }}</td>
                    <td class="px-4 py-4 space-x-2">
                        <a href="{{ route('leave-requests.show', $request) }}" class="text-slate-700 hover:text-slate-900">View</a>
                        <a href="{{ route('leave-requests.edit', $request) }}" class="text-slate-700 hover:text-slate-900">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-slate-600">No leave requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $leaveRequests->links() }}</div>
@endsection
