<?php

namespace App\Http\Controllers\Salary;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\User;

use App\Models\Employee;
use App\Models\Salary\PayrollEmployee;
use App\Models\Salary\SalaryPayment;
use App\Models\Salary\SalaryPaymentEmployee;
use App\Models\Salary\SalaryManagement;

use App\Models\Inventory\Currency;

use App\Http\Controllers\Controller;

use App\Models\Inventory\Transaction;
use App\Models\Inventory\PaymentMethod;

class SalaryPaymentsController extends Controller
{
    public function index()
    {
        $salary_payments = SalaryPayment::paginate(25);
		
		return view('inventory.salary_payments.index', compact('salary_payments'));
    }
    

	public function create()
    {
        $currencies = Currency::where('active','=','1')->get();
		
		return view('inventory.salary_payments.create', compact('currencies'));
    }
    
    public function store(Request $request, SalaryPayment $salary_payment)
    {
        $requestData['user_id']			= $request->user_id;
        $requestData['currency']		= $request->currency;
        $requestData['comment']			= $request->comment;
        $requestData['payroll_id']		= $request->payroll_id;

        $salary_payment = $salary_payment->create($requestData);

        if($request->payroll_id)
        {
            $salaryEmployees = PayrollEmployee::where('payroll_id','=',$request->payroll_id)->get();
            foreach($salaryEmployees as $item)
            {
                SalaryPaymentEmployee::insert(['salary_payment_id'		=> $salary_payment->id,
                                            'employee_id'				=> $item->employee_id,
                                            'currency'					=> $item->currency,
                                            'salary'					=> $item->salary]);
            }
        }

		
		$salary_payment = $salary_payment->create($requestData);
        
		return redirect()->route('salary_payments.show', $salary_payment)->withStatus('SalaryPayment registered successfully, you can start adding the employees belonging to it.');
    }

    public function show(SalaryPayment $salary_payment)
    {
		return view('inventory.salary_payments.show', compact('salary_payment'));
    }

    public function destroy(SalaryPayment $salary_payment)
    {
        $salary_payment->delete();
        return redirect()->route('salary_payments.index')->withStatus('SalaryPayment successfully removed.');
    }
    
    /****/
    public static function employee_selector (Request $request, SalaryPayment $salary_payment)
    {
        $employees = Employee::all();

        return view('inventory.salary_payments.employee_selector', compact('salary_payment','employees'));
	}

    public static function salary_payment_add_employee(Request $request)
	{
		$edit = "false";
		$employee_id							= $request->employee_id;
		$salary_payment_id						= $request->salary_payment_id;

		$salary_payment							= SalaryPayment::where('id', $salary_payment_id)->first();		
		$employee								= Employee::where('id','=',$employee_id)->first()->toarray();
        
		$employee['salary_payment_id']			= $salary_payment_id;
		$employee['employee_id']				= $employee_id;

		return view('inventory.salary_payments.addemployee_modal', compact('employee','edit'));
	}

	public static function salary_payment_add_employee_store(Request $request)
	{
		//request data
		$employee_id					= $request->employee_id;
		$salary_payment_id				= $request->salary_payment_id;
		$salary							= floatval($request->salary);

        $salary_payment					= SalaryPayment::where('id', $salary_payment_id)->first();
        $employee						= Employee::where('id','=',$employee_id)->first();
        $created_at						= Carbon::now()->toDateTimeString();


		//writing into recieved_employees table
		$requesteddata['salary_payment_id']		= $salary_payment_id;
		$requesteddata['currency']			    = $salary_payment['currency'];
    	$requesteddata['employee_id']	    	= $employee_id;
		$requesteddata['salary']		    	= $salary;
		
		SalaryPaymentEmployee::create($requesteddata);

		return response()->json([
			'status'  => 1 , 
			'message' => ['Товар добавлен', 'success'],
			'info'    => [
				'employee_id'		    => $employee_id,
				'salary_payment_id'		=> $salary_payment_id,
				'firstname'		    	=> $employee->firstname,
				'lastname'		    	=> $employee->lastname,
				'secondname'	    	=> $employee->secondname,
				'salary'		    	=> $salary,
				'created_at'	    	=> $created_at,

			],
		]);
    }

	public function salary_payment_edit_employee(Request $request)
    {
		$edit = "true";
		$salary_payment_id = $request->salary_payment_id;
		$employee_id = $request->employee_id;
		
		$employee = SalaryPaymentEmployee::select('salary_payment_employees.salary',
                                            'salary_payment_employees.currency',
                                            'salary_payment_employees.salary_payment_id',
                                            'employees.id as employee_id',
                                            'employees.firstname',
                                            'employees.lastname',
                                            'employees.secondname')
		->where('employee_id','=',$employee_id)
		->join('employees', 'employees.id', '=', 'salary_payment_employees.employee_id')
		->where('salary_payment_id','=',$salary_payment_id)
		->first();
		if($salary_payment_id)
		{
			$employee = $employee->toarray();
		}
        
		return view('inventory.salary_payments.addemployee_modal', compact('employee','edit'));
    }
	

	public function salary_payment_update_employee_store(Request $request)
	{
		$employee_id							= $request->employee_id;
		$salary_payment_id						= $request->salary_payment_id;
		$salary									= floatval($request->salary);//????

		$item = SalaryPaymentEmployee::where('salary_payment_id','=',$salary_payment_id)->where('employee_id','=',$employee_id)->get()->first();

		if ($item)
		{
            $old_salary    = $item->salary;
            $new_salary    = $request->salary;

            if ($old_salary != $new_salary)
			{
                $salary_payment = SalaryPayment::find($salary_payment_id);
                if ($salary_payment) {
                    $item = $item->update([
                        'salary' => $new_salary,
                    ]);

					if ($item) {
                        return response()->json([
                            'status'  => 1 , 
                            'message' => ['Обновлен', 'success'],
                            'info'    => [
                                    'employee_id'		=> $employee_id,
                                    'salary'			=> $new_salary,
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
    
	public function clear_employees_table(SalaryPayment $salary_payment, SalaryPaymentEmployee $salary_paymentEmployee)
    {
		SalaryPaymentEmployee::where('salary_payment_id','=',$salary_payment->id)->delete();
		return back()->withStatus('Products table cleared.');
    }
	
	public function salary_payment_delete_employee(Request $request)
    {
		if (!$request->ajax()) {
			abort('404');
		};

		$employee_id							= (int)$request->employee_id;
		$salary_payment_id						= (int)$request->salary_payment_id;

		$item = SalaryPaymentEmployee::where('salary_payment_id','=',$salary_payment_id)->where('employee_id','=',$employee_id)->get()->first();
		
		if ($item) {
			$old_salary			= $item->salary;

			$salary_payment		= SalaryPayment::find($salary_payment_id);

			if ($salary_payment)
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

    public function salary_payments_employees_clear(SalaryPayment $salary_payment, SalaryPaymentEmployee $salary_paymentEmployee)
    {
		SalaryPaymentEmployee::where('salary_payment_id','=',$salary_payment->id)->delete();
		
		return back()->withStatus('Products table cleared.');
    }

    public function finalize(SalaryPayment $salary_payment, SalaryPaymentEmployee $salary_paymentEmployee)
    {
        $finalized_at	= Carbon::now()->toDateTimeString();
        SalaryManagement::where('salary_payment_id','=', $salary_payment->id)->delete();
       
        foreach($salary_payment->employees as $item)
		{
			SalaryManagement::insert(['salary_payment_id'			=> $item->salary_payment_id,
								'employee_id'			        	=> $item->employee_id,
								'currency'			            	=> $item->currency,
								'total'			                	=> (-1)*$item->salary]);
        }

        $total_amount = SalaryPaymentEmployee::where('salary_payment_id','=',$salary_payment->id)->sum('salary');

        $salary_payment->total_amount = $total_amount;
		$salary_payment->finalized_at = $finalized_at;
        $salary_payment->save();
        
        return redirect()->route('salary_payments.index')->withStatus('Salary Payment successfully removed.');
    }

	//reciept payment
	public function pay(SalaryPayment $salary_payment)
    {
        $payment_methods = PaymentMethod::all();

        return view('inventory.salary_payments.addtransaction', compact('salary_payment', 'payment_methods'));
    }

    public function payment_store (Request $request, SalaryPayment $salary_payment, Transaction $transaction)
    {
        switch($request->all()['type'])
		{
			case 'income':
				$request->merge(['title' => 'Возврат оплаты по приходной накладной №: ' . $request->get('salary_payment_id')]);
				break;

            case 'expense':
                $request->merge(['title' => 'Списание по выплате заработной платы №: ' . $request->get('salary_payment_id')]);

                if($request->get('amount') > 0)
				{
                    $request->merge(['amount' => (float) $request->get('amount') * (-1) ]);
                }
                break;
        }
        $transaction->create($request->all());
		
		return redirect()->route('salary_payments.show', compact('salary_payment'))->withStatus('Successfully registered transaction.');
    }
}