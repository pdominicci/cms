<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('auth');
        $this->middleware('isadmin');
        $this->company = $request->input('company');
        $this->email = $request->input('email');
        $this->phone = $request->input('phone');
        $this->city_id = $request->input('city_id');
        $this->address = $request->input('address');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('company', 'asc')->get();
        $data = ['companies' => $companies];
        return view('admin.companies.home', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $data = [
                    'countries' => $countries,
                    'states' => $states,
                    'cities' => $cities
                ];

        return view('admin.companies.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validar($request);

        $Company = new Company;
        $Company->company = $this->company;
        $Company->slug = Str::slug($Company->company, '');
        $Company->email = $this->email;
        $Company->phone = $this->phone;
        $Company->city_id = $this->city_id;
        $Company->address = $this->address;

        $Company->save();

        return redirect('admin/companies')->with('mensaje', 'La empresa '. $this->company . ' se agregó correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
    public function validar(Request $request){
        $request->validate(
            [
                'company' => 'required|min:2|max:100',
                'email' => 'required|email|unique:App\Models\Company',
                'phone' => 'required',
                'country_id' => 'required',
                'state_id' => 'required',
                'city_id' => 'required',
                'address' => 'required',
            ],
            [
                'company.required' => 'El nombre de la empresa es obligatorio',
                'company.min' => 'El nombre de la empresa debe tener al menos 2 caracteres',
                'company.max' => 'El nombre de la empresa debe tener como máximo 100 caracteres',
                'email.required' => 'El e-mail es obligatorio',
                'email.email' => 'El formato del e-mail es inválido',
                'email.unique' => 'El e-mail ingresado ya existe',
                'country_id.required' => 'El País es obligatorio',
                'state_id.required' => 'La Provincia es obligatoria',
                'city_id.required'=> 'La Ciudad es obligatoria',
            ]
        );
    }
}
