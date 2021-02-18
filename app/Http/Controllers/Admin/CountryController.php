<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\State;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isadmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::orderBy('country', 'asc')->get();
        $data = ['countries' => $countries];
        return view('admin.countries.home', $data);
    }
    public function country(){
        $countries = Country::get();

        return view('country',['countries' => $countries]);
    }
    public function state(Request $request)
    {
        $country_id = $request->country_id;
        $states = Country::where('id',$country_id)
                         ->with('states')
                         ->get();
        $data = ['states' => $states];
        return response()->json($data);
    }
    public function city(Request $request)
    {
        $state_id = $request->state_id;
        $cities = State::where('id',$state_id)
                       ->with('cities')
                       ->get();
        $data = ['cities' => $cities];
        return response()->json($data);
    }
    public function company(Request $request)
    {
        $city_id = $request->city_id;

        $companies = Company::where('city_id',$city_id)
                       ->with('companies')
                       ->get();
        $data = ['companies' => $companies];
        return response()->json($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.countries.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = $request->input('country');

        $this->validar($request);

        //guardar en la bd
        $Country = new Country;
        $Country->country = $country;
        $Country->save();

        return redirect('admin/countries')->with('mensaje', 'El País '. $country . ' se agregó correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        //
    }
    public function validar(Request $request){
        $request->validate(
            [
                'country' => 'required|min:3|max:60|unique:App\Models\Country'
            ],
            [
                'country.required' => 'El país es obligatorio',
                'country.min'=> 'El país debe tener al menos dos caracteres',
                'country.max'=> 'El país debe tener como máximo 60 caracteres',
                'country.unique'=> 'El país ingresado ya existe',
            ]
        );

    }
}
