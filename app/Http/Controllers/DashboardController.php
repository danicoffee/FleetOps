<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $leaveRequests = LeaveRequest::when($user->isRole('Driver'), function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->latest()
        ->take(5)
        ->get();

        return view('dashboard', compact('leaveRequests'));
    }
}
