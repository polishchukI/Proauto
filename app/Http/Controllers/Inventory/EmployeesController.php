<?php

namespace App\Http\Controllers\Inventory;


use Carbon\Carbon;

use App\User;
use App\Models\Employee;
use App\Models\Salary\Payroll;
use App\Models\Salary\SalaryManagement;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(25);

        return view('inventory.employees.index', compact('employees'));
    }

    public function create()
    {
        $users = User::get();
		
		return view('inventory.employees.create', compact('users'));
    }
    
    public function store(Request $request, Employee $employee)
    {
        $requestData = $request->all();
        $requestData['fullname'] = $request->lastname . " " . $request->firstname . " " . $request->secondname;
        
		$employee = $employee->create($requestData);
        
		return redirect()->route('employees.show', $employee)->withStatus('Новый сотрудник успешно зарегистрирован');
    }
    
    public function show(Employee $employee)
    {
		return view('inventory.employees.show', compact('employee'));
    }
    
    public function edit(Employee $employee)
    {
		$users = User::get();
		
        return view('inventory.employees.edit', compact('employee','users'));
    }

    public function update(Request $request, Employee $employee)
    {
        $requestData = $request->all();
        $requestData['fullname'] = $request->lastname . " " . $request->firstname . " " . $request->secondname;
        
		$employee = $employee->update($requestData);

        return redirect()->route('employees.index')->withStatus('Данные сотрудника успешно обновлены');
    }
    
    public function fire(Employee $employee)
    {
		$fired_at = Carbon::now()->toDateTimeString();
		
		$employee->fired_at = $fired_at;
        $employee->save();
        
        return back()->withStatus('Сотруднику присвоен статус "Уволен"');
    }
    
    //////////////////////////////////////////////////////////////////// ** employee Live Search ** ////////////////////////////////////////////////////////////////////
	public static function workerLiveSearch(Request $request)
	{
        $search = strip_tags($request->workerLive);        
        if ($search)
		{
            $data = Employee::where('fullname', 'LIKE', "%${search}%")->where('isworker', '=', "True")->limit(10)->get(['id', 'fullname']);
        }
		else
		{
            $data = Employee::where('id', 'LIKE', "%%")->where('isworker', '=', "True")->limit(15)->get(['id', 'fullname']);
        }
        return response()->json($data);
	}
}
