<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function getCategoryEdit($id){
        $cat = Category::find($id);
        $data = ['cat' => $cat];
        return view('admin.categories.edit', $data);
    }
    public function postCategoryEdit(Request $request, $id){
        $rules = [
            'name' => 'required',
            'icon' => 'required',
        ];
        $messages = [
            'name.required' => 'Se requiere de un nombre para la categoría',
            'icon.required' => 'Se requiere de un nombre para el ícono',            
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message','Se ha producido un error')->with('typealert', 'danger');
        else:
            // se puede hacer con query builder
            // DB::table('categories')
            // ->where('id', $id)
            // ->update([
            //             'name' => e($request->input('name')),
            //             'module' => $request->input('module'),
            //             //'slug' => Str::slug($request->input('name')),
            //             'icono' => e($request->input('icon')),
            //         ]);
            
            $c = Category::find($id);
            $c->module = $request->input('module');
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            $c->icono = e($request->input('icon'));

            if($c->save()):
                return back()->with('message','La categoría ' . $c->name . ' se ha guardado exitosamente.')->with('typealert', 'success');
            endif;
        endif;       
    }
    public function categoryAdd(Request $request){
        $rules = [
            'name' => 'required',
            'icon' => 'required',
        ];
        $messages = [
            'name.required' => 'Se requiere de un nombre para la categoría',
            'icon.required' => 'Se requiere de un nombre para el ícono',            
        ];

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
    public function getCategoryDelete(Request $request, $id){
        $c = Category::find($id);
        if($c->delete()):
            return back()->with('message','La categoría ' . $c->name . ' se ha eliminado exitosamente.')->with('typealert', 'success');
        endif;
    }
}
