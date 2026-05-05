<?php

namespace Database\Seeders;

use App\Models\LeaveRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $driverRole = Role::firstOrCreate([
            'name' => 'Driver',
        ], [
            'description' => 'Driver can submit and manage their own leave requests.',
        ]);

        $fleetManagerRole = Role::firstOrCreate([
            'name' => 'Fleet Manager',
        ], [
            'description' => 'Fleet Manager can review and approve leave requests and view reports.',
        ]);

        $driver = User::firstOrCreate([
            'email' => 'driver@fleet.com',
        ], [
            'name' => 'Driver User',
            'password' => Hash::make('driver123'),
            'role_id' => $driverRole->id,
        ]);

        if ($driver->role_id !== $driverRole->id) {
            $driver->role_id = $driverRole->id;
            $driver->save();
        }

        $fleetManager = User::firstOrCreate([
            'email' => 'manager@fleet.com',
        ], [
            'name' => 'Fleet Manager User',
            'password' => Hash::make('manager123'),
            'role_id' => $fleetManagerRole->id,
        ]);

        if ($fleetManager->role_id !== $fleetManagerRole->id) {
            $fleetManager->role_id = $fleetManagerRole->id;
            $fleetManager->save();
        }

        LeaveRequest::firstOrCreate([
            'user_id' => $driver->id,
            'type' => 'Annual leave',
            'start_date' => '2026-05-10',
            'end_date' => '2026-05-12',
        ], [
            'reason' => 'Family vacation.',
            'status' => LeaveRequest::STATUS_PENDING,
        ]);
    }
}
