<?php

namespace App\Http\Controllers\Admin;

use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
    protected $id;
    protected $country_id;

    public function __construct(Request $request){
        $this->middleware('auth');
        $this->middleware('isadmin');
        $this->id = $request->input('id');
        $this->country_id = $request->input('country_id');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::orderBy('state', 'asc')->get();
        $data = ['states' => $states];
        return view('admin.states.home', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $data = ['countries'=>$countries];

        return  view('admin.states.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country_id = $request->input('country_id');
        $state = $request->input('state');

        $this->validar($request);

        //guardar en la bd
        $State = new State;
        $State->country_id = $country_id;
        $State->state = $state;
        $State->save();

        return redirect('admin/states')->with('mensaje', 'La provincia '. $state . ' se agregó correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        //
    }
    public function validar(Request $request){
        $request->validate(
            [
                'country_id' => 'required',
                // validar unique con clave compuesta 'no puede haber dos provincias iguales en el mismo pais'
                'state' => 'required|min:3|max:60|unique:App\Models\State,state,' . $this->id . ',id,country_id,' . $this->country_id
            ],
            [
                'country_id.required' => 'El País es obligatorio',
                'state.required' => 'La Provincia es obligatorio',
                'state.min'=> 'La provincia debe tener al menos tres caracteres',
                'state.max'=> 'La provincia debe tener como máximo 60 caracteres',
                'state.unique'=> 'La provincia ingresada ya existe para el país seleccionado'
            ]
        );




    }
}
