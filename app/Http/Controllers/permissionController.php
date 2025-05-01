<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\PermissionType;
use Illuminate\Support\Facades\Auth;

class permissionController extends Controller
{
    public function create()
    {
        $PermissionTypes = PermissionType::all();
        return view('Permissions.create', compact('PermissionTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Permission_Type_id' => 'required|exists:permission_types,id',
            'StartDate' => 'required|date|after_or_equal:today',
            'EndDate' => 'required|date|after_or_equal:StartDate',
        ]);

        try {
            Permission::create([
                'Permission_Type_id' => $validated['Permission_Type_id'],
                'StartDate' => $validated['StartDate'],
                'EndDate' => $validated['EndDate'],
                'Status' => 2, // Pending by default
                'employee_id' => Auth::id(),
            ]);

            return redirect()->route('permissions.create')
                ->with('success', 'Permission request submitted successfully and is awaiting approval.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to submit permission request. Error: ' . $e->getMessage());
        }
    }
}
