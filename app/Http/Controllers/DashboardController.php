<?php
namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Vacation;

class DashboardController extends Controller
{
    public function index()
    {
    
            $vacations = Vacation::where('employee_id', auth()->id())->get(); 
            $permissions = Permission::where('employee_id', auth()->id())->get();
            
            return view('dashboard', compact('vacations', 'permissions'));
        
    }
}
