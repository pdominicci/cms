<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('auth');
        $this->middleware('isadmin');
        $this->id = $request->input('id');
        $this->state_id = $request->input('state_id');
        $this->country_id = $request->input('country_id');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::orderBy('city', 'asc')->get();
        $data = ['cities' => $cities];
        return view('admin.cities.home', $data);
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
        $data = [
                    'countries'=>$countries,
                    'states'=>$states
                ];

        return view('admin.cities.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city = $request->input('city');
        $this->validar($request);

        //guardar en la bd
        $City = new City;
        $City->country_id = $this->country_id;
        $City->state_id = $this->state_id;
        $City->city = $city;
        $City->save();

        return redirect('admin/cities')->with('mensaje', 'La ciudad '. $city . ' se agregó correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
    public function validar(Request $request){
        $request->validate(
            [
                'country_id' => 'required',
                'state_id' => 'required',
                // validar unique con clave compuesta 'no puede haber dos ciudades iguales en la misma provincia en el mismo pais'
                'city' => 'min:3|max:60|unique:App\Models\City,city,id,' . $this->id . ',state_id,' . $this->state_id . ',country_id,' . $this->country_id
            ],
            [
                'country_id.required' => 'El País es obligatorio',
                'state_id.required' => 'La Provincia es obligatoria',
                'city.min'=> 'La ciudad debe tener al menos tres caracteres',
                'city.max'=> 'La ciudad debe tener como máximo 60 caracteres',
                'city.unique'=> 'La ciudad ingresada ya existe para la provincia y país seleccionados'
            ]
        );
    }
}
