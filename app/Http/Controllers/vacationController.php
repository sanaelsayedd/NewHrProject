<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacation;
use App\Models\VacationType;
use Illuminate\Support\Facades\Auth;

class vacationController extends Controller
{
    public function create()
    {
        $vacationTypes = VacationType::all();
        return view('vacation.create', compact('vacationTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'VacationTypeID' => 'required|exists:vacation_types,id',
            'Start_Date' => 'required|date|after_or_equal:today',
            'End_Date' => 'required|date|after_or_equal:Start_Date',
            'Duration' => 'required|integer|min:1',
            'Comments' => 'nullable|string|max:500',
        ]);

        // Add the logged-in user's ID
        $validated['employee_id'] = Auth::id();
        $validated['RequestDate'] = now();
        $validated['Status'] = 'Pending';

        try {
            Vacation::create($validated);
            return redirect()->route('vacation.create')
                           ->with('success', 'Vacation request submitted successfully and is awaiting approval.');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Failed to submit vacation request. Please try again.');
        }
    }
}
