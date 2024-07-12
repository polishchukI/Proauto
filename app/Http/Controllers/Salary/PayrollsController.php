<?php

namespace App\Http\Controllers\Salary;

use Carbon\Carbon;

use App\User;
use App\Models\Employee;
use App\Models\Salary\Payroll;
use App\Models\Salary\SalaryPayment;
use App\Models\Salary\PayrollEmployee;
use App\Models\Salary\SalaryManagement;

use App\Models\Inventory\Currency;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class PayrollsController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::paginate(25);
		
		return view('inventory.payrolls.index', compact('payrolls'));
    }
    

	public function create()
    {
        $currencies = Currency::where('active','=','1')->get();
		
		return view('inventory.payrolls.create', compact('currencies'));
    }
    
    public function store(Request $request, Payroll $payroll)
    {
        $requestData['user_id']				= $request->user_id;
        $requestData['period_start']		= Carbon::parse($request->period_start)->startOfDay();       
        $requestData['period_end']			= Carbon::parse($request->period_end)->endOfDay();
        $requestData['currency']			= $request->currency;
        $requestData['comment']				= $request->comment;

		$payroll = $payroll->create($requestData);
        
		return redirect()->route('payrolls.show', $payroll)->withStatus('Payroll registered successfully, you can start adding the employees belonging to it.');
    }

    public function show(Payroll $payroll)
    {
		return view('inventory.payrolls.show', compact('payroll'));
    }

    public function destroy(Payroll $payroll)
    {
		$payroll->delete();
		
		return redirect()->route('payrolls.index')->withStatus('Payroll successfully removed.');
    }
    
    /****/
    public static function employee_selector (Request $request, Payroll $payroll)
    {
        $employees = Employee::all();

        return view('inventory.payrolls.employee_selector', compact('payroll','employees'));
	}

    public static function payroll_add_employee(Request $request)
	{
		$edit = "false";
		$employee_id					= $request->employee_id;
		$payroll_id						= $request->payroll_id;

		$payroll						= Payroll::where('id', $payroll_id)->first();		
		$employee						= Employee::where('id','=',$employee_id)->first()->toarray();
        
		$employee['payroll_id']			= $payroll_id;
		$employee['employee_id']		= $employee_id;

		return view('inventory.payrolls.addemployee_modal', compact('employee','edit'));
	}

	public static function payroll_add_employee_store(Request $request)
	{
		//request data
		$employee_id					= $request->employee_id;
		$payroll_id						= $request->payroll_id;
		$salary							= floatval($request->salary);

        $payroll						= Payroll::where('id', $payroll_id)->first();
        $employee						= Employee::where('id','=',$employee_id)->first();
        $created_at						= Carbon::now()->toDateTimeString();


		//writing into recieved_employees table
		$requesteddata['payroll_id']		= $payroll_id;
		$requesteddata['currency']			= $payroll['currency'];
    	$requesteddata['employee_id']		= $employee_id;
		$requesteddata['salary']			= $salary;
		
		PayrollEmployee::create($requesteddata);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'info'    => [
				'employee_id'		=> $employee_id,
				'payroll_id'		=> $payroll_id,
				'firstname'			=> $employee->firstname,
				'lastname'			=> $employee->lastname,
				'secondname'		=> $employee->secondname,
				'salary'			=> $salary,
				'created_at'		=> $created_at,

			],
		]);
    }

	public function payroll_edit_employee(Request $request)
    {
		$edit = "true";
		$payroll_id = $request->payroll_id;
		$employee_id = $request->employee_id;
		
		$employee = PayrollEmployee::select('payroll_employees.salary',
                                            'payroll_employees.currency',
                                            'payroll_employees.payroll_id',
                                            'employees.id as employee_id',
                                            'employees.firstname',
                                            'employees.lastname',
                                            'employees.secondname')
		->where('employee_id','=',$employee_id)
		->join('employees', 'employees.id', '=', 'payroll_employees.employee_id')
		->where('payroll_id','=',$payroll_id)
		->first();
		if($payroll_id)
		{
			$employee = $employee->toarray();
		}
        
		return view('inventory.payrolls.addemployee_modal', compact('employee','edit'));
    }
	

	public function payroll_update_employee_store(Request $request)
	{
		$employee_id						= $request->employee_id;
		$payroll_id						= $request->payroll_id;
		$salary							= floatval($request->salary);//????

		$item = PayrollEmployee::where('payroll_id','=',$payroll_id)->where('employee_id','=',$employee_id)->get()->first();

		if ($item)
		{
            $old_salary    = $item->salary;
            $new_salary    = $request->salary;

            if ($old_salary != $new_salary)
			{
                $payroll = Payroll::find($payroll_id);
                if ($payroll) {
                    $item = $item->update([
                        'salary' => $new_salary,
                    ]);

					if ($item) {
                        return response()->json([
                            'status'  => 1 , 
                            'message' => ['Обновлен', 'success'],
                            'info'    => [
                                    'employee_id'    => $employee_id,
                                    'salary' => $new_salary,
                            ],
                        ]);
                    }
                    $error_message = 'Ошибка обновления';
                }
                $error_message = 'Неверный номер заказа';
            }
            $error_message = 'Вы не изменили значения';
        }
	}
    
	public function clear_employees_table(Payroll $payroll, PayrollEmployee $payrollEmployee)
    {
		PayrollEmployee::where('payroll_id','=',$payroll->id)->delete();
		
		return back()->withStatus('Products table cleared.');
    }
	
	public function payroll_delete_employee(Request $request)
    {
		if (!$request->ajax())
		{
			abort('404');
		};

		$employee_id					= (int)$request->employee_id;
		$payroll_id						= (int)$request->payroll_id;

		$item = PayrollEmployee::where('payroll_id','=',$payroll_id)->where('employee_id','=',$employee_id)->get()->first();
		
		if ($item)
		{
			$old_salary    = $item->salary;

			$payroll = Payroll::find($payroll_id);
			if ($payroll)
			{
				$item = $item->delete();
				return response()->json([
					'status'  => 1 , 
					'message' => ['Удалено', 'success'],
					'info'    => [
							'employee_id'    => $employee_id,
						],
					]);
			}
		}
    }

    public function payrolls_employees_clear(Payroll $payroll, PayrollEmployee $payrollEmployee)
    {
		PayrollEmployee::where('payroll_id','=',$payroll->id)->delete();

		return back()->withStatus('Products table cleared.');
    }

    public function finalize(Payroll $payroll, PayrollEmployee $payrollEmployee)
    {
        $finalized_at = Carbon::now()->toDateTimeString();
        SalaryManagement::where('payroll_id','=', $payroll->id)->delete();
       
        foreach($payroll->employees as $item)
		{
			//product stocks
			SalaryManagement::insert(['payroll_id'			=> $item->payroll_id,
								'employee_id'				=> $item->employee_id,
								'currency'					=> $item->currency,
								'total'						=> $item->salary]);
        }
        // dd(compact('period_end'));

        $total_amount = PayrollEmployee::where('payroll_id','=',$payroll->id)->sum('salary');
        $payroll->total_amount = $total_amount;
		$payroll->finalized_at = $finalized_at;
        $payroll->save();
        
        return redirect()->route('payrolls.index')->withStatus('Payroll successfully removed.');
    }
}
