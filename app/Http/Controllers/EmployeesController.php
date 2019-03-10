<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Company;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companyId = $request->company_id;
        $employeeName = $request->name;

        $employees = Employee::orderBy('first_name', 'asc')
            ->when($companyId, function ($query, $companyId) {
                return $query->where('company_id', $companyId);
            })
            ->when($employeeName, function ($query, $employeeName) {
                return $query->where('first_name', 'like', '%' . $employeeName . '%')
                    ->orWhere('last_name', 'like', '%' . $employeeName . '%');
            })
            ->paginate(10);

        $companies = $this->getCompanies();

        return view('admin.employees.index')->with('employees', $employees)->with('companies', $companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = $companies = $this->getCompanies();
        return view('admin.employees.create')->with('companies', $companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate data
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'nullable'],
            'phone' => ['string', 'max:255', 'nullable'],
            'company_id' => ['integer', 'nullable'],
        ]);

        // save Employee
        $Employee = new Employee([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'company_id' => $request->get('company_id'),
        ]);
        $Employee->save();

        return redirect('/admin/employees')->with('success', 'Employee has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $Employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee, $id = null)
    {
        if (!$employee->id) {
            $employee = Employee::find($id);
        }

        return view('admin.employees.show')->with('employee', $employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $Employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $companies = $this->getCompanies();

        return view('admin.employees.edit')->with('employee', $employee)->with('companies', $companies);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $Employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {

        $validatedData = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'nullable'],
            'phone' => ['string', 'max:255', 'nullable'],
            'company_id' => ['integer', 'nullable'],
        ]);

        // dd($request);
        $employee->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company_id' => $request->get('company_id'),
        ]);
        $employee->save();

        return redirect('/admin/employees')->with('success', 'Employee successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $Employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect('/admin/employees')->with('success', 'Employee has been deleted');
    }

    public function getCompanies()
    {
        $companies = Company::All()->map(function ($company) {
            return collect($company->toArray())
                ->only(['id', 'name'])
                ->all();
        });
        return $companies;
    }
}
