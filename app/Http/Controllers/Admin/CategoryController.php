<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator, Str;

use App\Http\Models\Category;


class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isadmin');
    }
    public function getHome($module){
        $cats = Category::where('module', $module)->orderBy('name', 'asc')->get();
        $data = ['cats'=> $cats];

        return view('admin.categories.home', $data);
    }
    public function categoryAdd(Request $request){
        $rules = [
            'name' => 'required',
            'icon' => 'required',
        ];
        $messages = [
            'name.required' => 'Se requiere de un nombre para la categoría',
            'icon.required' => 'Se requiere de un nombre para el icono',
            
        ];

        // $validator = Validator::make($request->all(), $rules, $messages);
        // if($validator->fails()):
        //     return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger');
        // else:
        // endif;

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger');
        else:
            $c = new Category;
            $c->module = $request->input('module');
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            $c->icono = e($request->input('icon'));
            if($c->save()):
                return back()->with('message','La categoría ' . $c->name . ' se ha guardado exitosamente.')->with('typealert', 'success');
            else:
            endif;
        endif;
    }
}
