<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Category, App\Http\Models\Product;

use Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $directory;
    private $relativeDirectory;

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isadmin');
    }
    public function getHome(){
        $products = Product::with('relCategory')->orderBy('id','desc')->paginate(25);
        $data = ['products' => $products];
        return view('admin.products.home', $data);
    }
    public function getProductAdd(){
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats];
        return view('admin.products.add', $data);
    }
    private function uploadImage(Request $request)
    {
        //si no enviaron imagen
        $prdImage = 'noDisponible.jpg';

        //subir imagen si fue enviada
        //si enviaron archivo
        $img = $request->file('img');

        if( $request->file('img') ){
            //renombrar time() + extension
            $img = time().'.'.$request->file('img')->clientExtension();
            //subir
            $c = Category::find($request->category);

            $slug = Str::slug($c->name, '_');

            $this->directory = public_path('products/'.$slug.'/');
            $this->relativeDirectory = 'products/'.$slug.'/';
            if(!Storage::exists($this->directory)) {
                //crea el directorio
                Storage::makeDirectory($this->directory, 0775, true);
            }

            $request->file('img')->move($this->directory, $img);
        }

        return $img;
    }
    public function postProductAdd(Request $request){
        $rules = [
            // el key deberia ser el nombre que le pusimos al componente del form
            'name' => 'required',
            'img' => 'required',
            'price' => 'required',
        ];

        $messages = [
            'name.required' => 'El nombre del producto es obligatorio',
            'img.required' => 'Seleccione una imagen destacada',
            'price.required' => 'Ingrese el precio del producto',
        ];

        $request->validate($rules, $messages);
        $p = new Product;
        $p->status = '0';
        $p->name = e($request->input('name'));
        $p->slug = Str::slug($request->input('name'));
        $p->category_id = $request->input('category');
        // $p->image = $filename;
        $p->price = $request->input('price');
        $p->in_discount = $request->input('indiscount');
        $p->discount = $request->input('discount');
        $p->contenido = e($request->input('content'));
        $imagen = $this->uploadImage($request);
        $p->file_path = $this->relativeDirectory;
        $p->image = $imagen;
        if($p->save()){
            // open file a image resource
            $img = Image::make($this->directory.$p->image);
            $img->fit(100,100,function($constraint){
                $constraint->upsize();
            });

            $img->save($this->directory.'t_'.$p->image);
        }

        return redirect('admin/products')->with('message','El producto ' . $p->name . ' se ha guardado exitosamente.')->with('typealert', 'success');
    }
    public function getProductEdit($id)
    {
        $p = Product::find($id);
        $cats = Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats, 'p' => $p];
        return view('admin.products.edit', $data);
    }
    public function postProductEdit(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'price' => 'required',
        ];
        $messages = [
            'name.required' => 'El nombre del producto es obligatorio',
            'price.required' => 'Ingrese el precio del producto',
        ];

        $request->validate($rules, $messages);

        $p = Product::find($id);

        $p->status = $request->input('status');
        $p->name = e($request->name);
        $p->category_id = $request->category;
        $p->price = $request->input('price');
        $p->in_discount = $request->input('indiscount');
        $p->discount = $request->input('discount');
        $p->contenido = e($request->input('content'));
        if($request->hasFile('img')){
            $imagen = $this->uploadImage($request);
            $p->image = $imagen;
        }
        if($p->save()){
            // open file a image resource
            if($request->hasFile('img')){
                $img = Image::make($p->file_path.$p->image);
                $img->fit(100,100,function($constraint){
                    $constraint->upsize();
                });
                $img->save($p->file_path.'t_'.$p->image);
            }
        }

        return redirect('admin/products')->with('message','El producto ' . $p->name . ' se ha modificado exitosamente.')->with('typealert', 'success');
    }
}
