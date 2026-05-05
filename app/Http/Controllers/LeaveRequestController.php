<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Models\LeaveRequest;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $query = LeaveRequest::with('user')->latest();

        if (auth()->user()->isRole('Driver')) {
            $query->where('user_id', auth()->id());
        }

        $leaveRequests = $query->paginate(10);

        return view('leave_requests.index', compact('leaveRequests'));
    }

    public function create()
    {
        return view('leave_requests.create');
    }

    public function store(StoreLeaveRequest $request)
    {
        auth()->user()->leaveRequests()->create([
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => LeaveRequest::STATUS_PENDING,
        ]);

        return redirect()->route('leave-requests.index')->with('success', 'Leave request submitted successfully.');
    }

    public function show(LeaveRequest $leaveRequest)
    {
        $this->authorizeRequestAccess($leaveRequest);

        return view('leave_requests.show', compact('leaveRequest'));
    }

    public function edit(LeaveRequest $leaveRequest)
    {
        $this->authorizeRequestAccess($leaveRequest);

        return view('leave_requests.edit', compact('leaveRequest'));
    }

    public function update(UpdateLeaveRequest $request, LeaveRequest $leaveRequest)
    {
        $this->authorizeRequestAccess($leaveRequest);

        $data = $request->validated();

        if (auth()->user()->isRole('Driver')) {
            unset($data['status']);
        }

        $leaveRequest->update($data);

        return redirect()->route('leave-requests.show', $leaveRequest)->with('success', 'Leave request updated successfully.');
    }

    public function destroy(LeaveRequest $leaveRequest)
    {
        $this->authorizeRequestAccess($leaveRequest);

        $leaveRequest->delete();

        return redirect()->route('leave-requests.index')->with('success', 'Leave request deleted successfully.');
    }

    protected function authorizeRequestAccess(LeaveRequest $leaveRequest): void
    {
        if (auth()->user()->isRole('Driver') && $leaveRequest->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
