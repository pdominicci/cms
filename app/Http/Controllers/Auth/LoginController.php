<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserCompanies;
use App\Models\User;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    // public function index()
    // {
    //     $data = ["usercompanies" => []];
    //     return view('auth.login', $data);
    // }
    public function usercompanies(Request $request)
    {
        // $user = DB::table("users")->where('email', $request->email)->first();
        // dd("aaa " .$user);
        $user = User::where('email', $request->email)->first();

        //$user = User::find($request->email);
        if ($user) {
            $usercompanies = UserCompanies::where('user_id', $user->id)->get();
            $data = [];
            $item = [];
            foreach($usercompanies as $uc){
                $item = ["company_id" => $uc->company_id, "company" => $uc->companies->company];
                array_push($data, $item);
            }
        } else {
            $data = [];
        }
        return response()->json($data);
        //return view('auth.login'); //, $data);
    }
}
