<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
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
        // $query = $request->query;

        // dd($request->get('company_id'));
        // $compTest = Company::query()->where('id', $query->id);
        // dd($comspTest);
        $companies = Company::orderBy('name', 'asc')->paginate(10);
        return view('admin.companies.index')->with('companies', $companies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.create')->with('success', 'Company has been created');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'nullable'],
            'website' => ['string', 'url', 'max:255', 'nullable'],
        ]);

        // save company
        $company = new Company([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'logo' => $request->file('logo')->store('public'),
            'website' => $request->get('website'),
        ]);

        if (!empty($request->file('logo'))) {
            $company->logo = $request->file('logo')->store('public');
        }

        $company->save();

        return redirect('/admin/companies')->with('success', 'Company has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company, $id = null)
    {
        if (!$company->id) {
            $company = Company::find($id);
        }

        return view('admin.companies.show')->with('company', $company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit')->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'nullable'],
            'logo' => ['dimensions:min_width=100,min_height=100', 'max:2000', 'nullable'],
            'website' => ['string', 'url', 'max:255', 'nullable'],
        ]);

        $company->update([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
        ]);

        if (!empty($request->file('logo'))) {
            $company->logo = $request->file('logo')->store('public');
        }

        $company->save();

        return redirect('/admin/companies')->with('success', 'Company successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect('/admin/companies')->with('success', 'Company has been deleted');
    }
}
