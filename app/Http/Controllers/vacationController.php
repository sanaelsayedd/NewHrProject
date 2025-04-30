<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacation;

class vacationController extends Controller
{
    public function create()
    {
        return view('vacation.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:users,id',
            'VacationTypeID' => 'required|exists:vacation_types,id',
            'Start_Date' => 'required|date',
            'End_Date' => 'required|date|after_or_equal:Start_Date',
            'Duration' => 'required|integer|min:1',
            'Comments' => 'nullable|string',
        ]);

        $validated['RequestDate'] = now();
        //$validated['RequestDate'] = now();
        $validated['Status'] = 'Pending';

        Vacation::create($validated);

        return redirect()->back()->with('success', 'Vacation request submitted and awaiting approval.');
    }
}
