<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use App\Models\UserCompanies;
use Illuminate\Http\Request;

class UserCompaniesController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('auth');
        $this->middleware('isadmin');
        $this->company_id = $request->input('company_id');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $usercompanies = UserCompanies::where('user_id', $user_id)->with('companies')->get();
        $user = User::find($user_id);
        $data = [
                    'user_id' => $user_id,
                    'user'=>$user,
                    'usercompanies' => $usercompanies
                ];
        return view('admin.usercompanies.home', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        $user = User::find($user_id);
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        $data = [
                    'user_id'=>$user_id,
                    'user'=>$user,
                    'countries'=>$countries,
                    'states'=>$states,
                    'cities'=>$cities,
                ];

        return view('admin.usercompanies.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id)
    {
        $this->validar($request, $user_id);

        $UserCompanies = new UserCompanies;
        $UserCompanies->user_id = $user_id;
        $UserCompanies->company_id = $this->company_id;

        $UserCompanies->save();

        return redirect('admin/usercompanies/'.$user_id)->with('mensaje', 'La empresa '. $UserCompanies->companies->company .' se agregó correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User_Companies  $user_Companies
     * @return \Illuminate\Http\Response
     */
    public function show(UserCompanies $user_Companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User_Companies  $user_Companies
     * @return \Illuminate\Http\Response
     */
    public function edit(UserCompanies $user_Companies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User_Companies  $user_Companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserCompanies $user_Companies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User_Companies  $user_Companies
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserCompanies $user_Companies)
    {
        //
    }
    public function validar(Request $request, $user_id){
        $request->validate(
            [
                'country_id' => 'required',
                'state_id' => 'required',
                'city_id' => 'required',
                // notar que luego de UserCompanies, esta company_id que es la columna a la que se le esta haciendo unique
                // y recien ahi esta user_id
                'company_id' => 'required|unique:App\Models\UserCompanies,company_id,user_id,' . $user_id . ',company_id,' . $this->company_id,
            ],
            [
                'country_id.required' => 'El País es obligatorio',
                'state_id.required' => 'La Provincia es obligatoria',
                'city_id.required' => 'La Ciudad es obligatoria',
                'company_id.required' => 'La Empresa es obligatoria',
                'company_id.unique' => 'La Empresa ya existe para el usuario seleccionado',
            ]
        );
    }
}
