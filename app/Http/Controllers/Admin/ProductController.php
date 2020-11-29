<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Models\Category, App\Http\Models\Product;

use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isadmin');
    }
    public function getHome(){
        return view('admin.products.home');
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
            $request->file('img')->move( public_path('products/'), $img);
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
            //'img.image' => 'El archivo no es una imagen',
            'price.required' => 'Ingrese el precio del producto',
        ];

        $request->validate($rules, $messages);
        // $validator = Validator::make($request->all(), $rules, $messages);
        // if($validator->fails()):
        //     return back()->withErrors($validator)
        //     ->with('message','Se ha producido un error')
        //     ->with('typealert', 'danger')
        //     ->withInput();
        // else:
            $path = '/'.date('Y-m-d');
            $fileExt = trim($request->file('img')->getClientOriginalExtension());
            $upload_path = Config::get('filesystems.disks.uploads.url');
            $name = Str::slug(str_replace($fileExt,'',$request->file('img')->getClientOriginalName()));

            $filename = rand(1, 999).'-'.$name.'.'.$fileExt;
            $file_file = $upload_path .'/'.$path.'/'.$filename;

            $p = new Product;
            $p->status = '0';
            $p->name = e($request->input('name'));
            $p->slug = Str::slug($request->input('name'));
            $p->category_id = $request->input('category');
            $p->file_path = date('Y-m-d');
            // $p->image = $filename;
            $p->price = $request->input('price');
            $p->in_discount = $request->input('indiscount');
            $p->discount = $request->input('discount');
            $p->contenido = e($request->input('content'));
            $img = $this->uploadImage($request);
            $p->image = $img;
            // if($p->save()):
            //     if($request->hasFile('img')):
            //         $fl = $request->img->storeAs($path, $filename, 'uploads');
            //         $img = Image::make($file_file);
            //         $img->fit(256,256,function($constraint){
            //             $constraint->upsize();
            //         });
            //         $img->save($upload_path.'/'.$path.'/t_'.$filename);
            //     endif;
            //     return redirect('admin/products')->with('message','El producto ' . $p->name . ' se ha guardado exitosamente.')->with('typealert', 'success');
            // else:
            // endif;

        // endif;

    }
}
