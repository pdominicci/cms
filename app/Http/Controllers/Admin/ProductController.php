<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\PGallery;
use App\Models\Company;

use Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
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
    public function upload(Request $request)
    {
        $id = $request->product_id;
        $img = $request->file('uploadImage')->getClientOriginalName();

        if($img){
            $p = Product::findOrFail($id);

            // extraigo el nombre de la imagen para ponerles a todas las imagegallery el mismo nombre
            $nombreimagendestacada = substr($p->image, -14, 10);

            $imgName = $id.'-'.time() . '-' .$request->sub_id.'-'.$nombreimagendestacada.'.'.$request->file('uploadImage')->clientExtension();

            $g = new PGallery;
            $g->product_id = $id;
            $g->cover_image = 'N';

            $c = Company::findOrFail($request->company_id);
            $this->relativeDirectory = 'products/'.$c->slug.'/';

            $g->file_path = $this->relativeDirectory;
            $g->file_name = $imgName;

            $g->save();

            $ultimo_id = DB::getPdo()->lastInsertId();

            if(!Storage::exists($this->relativeDirectory)) {
                //crea el directorio
                Storage::makeDirectory($this->relativeDirectory, 0775, true);
            }

            $img = $request->file('uploadImage');
            $img = Image::make($img);
            $img->save($this->relativeDirectory.$imgName);

            // crear la miniatura con el mismo nombre que la imagen grande
            $imgMin = $request->file('uploadImageMiniature');
            $imgMin = Image::make($imgMin);
            $imgMin->fit(100,100,function($constraint){
                 $constraint->upsize();
            });

            $imgMin->save($this->relativeDirectory.'t_'.$imgName);
        }

        $data = [
                    'file_name' => 't_'.$imgName,
                    'file_path' => $g->file_path,
                    'id' => $ultimo_id,
                    'cover' => $g->cover_image,
                ];
        return $data;
    }
    public function deletePhoto(Request $request){
        $g = PGallery::findOrFail($request->id);
        $d = PGallery::where('id',$request->id)->delete();
        // Storage::disk('local')->delete($g->file_path.$g->file_name);
        File::delete($g->file_path.$g->file_name);
        File::delete($g->file_path.'t_'.$g->file_name);
    }
    public function setCoverImage(Request $request){
        $id = $request->id;
        $g = PGallery::findOrFail($id);

        $this->unset_cover_image($g->product_id);

        $g->cover_image = 'S';
        $g->save();
    }
    private function unset_cover_image($product_id){
        $galleries = PGallery::where('product_id', $product_id)
                        ->where('cover_image','S')
                        ->get();

        $id_cover_image = 0;
        foreach($galleries as $g){
            $id_cover_image = $g->id;
        }

        if($id_cover_image){
            $g_cover = PGallery::findOrFail($id_cover_image);
            $g_cover->cover_image = 'N';
            $g_cover->save();
        }
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
        // levanto el company_id desde admin.js con localstorage y lo
        // oculto en este add para despues levantarlo por aca
        $p->company_id = $request->company_id;
        $p->status = '0';
        $p->name = e($request->input('name'));
        $p->slug = Str::slug($request->input('name'));
        $p->category_id = $request->input('category');
        $p->price = $request->input('price');
        $p->in_discount = $request->input('indiscount');
        $p->discount = $request->input('discount');
        $p->contenido = e($request->input('content'));
        $p->save();

        return redirect('admin/products')->with('message','El producto ' . $p->name . ' se ha guardado exitosamente.')->with('typealert', 'success');
    }
    public function getProductEdit($id)
    {
        $p = Product::findOrFail($id);
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

        $p = Product::findOrFail($id);
        // el company_id no cambia
        $p->status = $request->input('status');
        $p->name = e($request->name);
        $p->slug = Str::slug($request->input('name'));
        $p->category_id = $request->category;
        $p->price = $request->input('price');
        $p->in_discount = $request->input('indiscount');
        $p->discount = $request->input('discount');
        $p->contenido = e($request->input('content'));

        return redirect('admin/products')->with('message','El producto ' . $p->name . ' se ha modificado exitosamente.')->with('typealert', 'success');
    }
}
