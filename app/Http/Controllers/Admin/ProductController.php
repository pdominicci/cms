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
use Illuminate\Http\File;

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
    public function upload(Request $request)
    {
        $id = $request->product_id;
        $img = $request->file('uploadImage')->getClientOriginalName();

        if($img){
            $p = Product::findOrFail($id);

            $g_ultimo_id = PGallery::where('product_id', $id)
               ->orderByDesc('id')
               ->first();

            if ($g_ultimo_id){
                $ultimo_id = $g_ultimo_id->id + 1;
            }else{
                $ultimo_id = 1;
            }

            // extraigo el nombre de la imagen para ponerles a todas las imagegallery el mismo nombre
            $nombreimagendestacada = substr($p->image, -14, 10);

            $img = $id.'-'.$ultimo_id . '-' .$request->sub_id.'-'.$nombreimagendestacada.'.'.$request->file('uploadImage')->clientExtension();
            $imgName = $img;

            $g = new PGallery;
            $g->product_id = $id;
            $g->cover_image = 'N';
            $c = Company::findOrFail($request->company_id);
            $this->relativeDirectory = 'products/'.$c->slug.'/';

            $g->file_path = $this->relativeDirectory;
            $g->file_name = $imgName;

            $g->save();
            if(!Storage::exists($this->relativeDirectory)) {
                //crea el directorio
                Storage::makeDirectory($this->relativeDirectory, 0775, true);
            }

            //http://mycms.com/storage/products/elplacarddemarita/rana3.jpg
            if (Storage::disk('local')->put($this->relativeDirectory.$imgName, file_get_contents($request->file('uploadImage')))){
                $path =  $this->relativeDirectory.$imgName;
            }

            // //$request->file('uploadImage')->move($this->relativeDirectory, $img);
            // // crear la miniatura con el mismo nombre que la imagen grande
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
                ];
        return $data;
    }
    public function progress(){
        //var_dump('aca');
    }
    public function deletePhoto(Request $request){

        $g = PGallery::findOrFail($request->id);
        $d = PGallery::where('id',$request->id)->delete();
        Storage::disk('local')->delete($g->file_path.$g->file_name);
    }
    private function uploadImage(Request $request)
    {
        //subir imagen si fue enviada
        //si enviaron archivo
        $img = $request->file('img');

        if( $request->file('img') ){
            //renombrar time() + extension
            $img = time().'.'.$request->file('img')->clientExtension();

            //subir
            $c = Company::findOrFail($request->company_id);

            $this->directory = public_path('products/'.$c->slug.'/');
            $this->relativeDirectory = 'products/'.$c->slug.'/';
            if(!Storage::exists($this->directory)) {
                //crea el directorio
                Storage::makeDirectory($this->directory, 0775, true);
            }

            $request->file('img')->move($this->directory, $img);
        }

        return $img;
    }
    private function uploadImageGallery(Request $request, $nombreimagendestacada)
    {
        //subir imagen si fue enviada
        //si enviaron archivo
        $img = $request->file('file_image');

        if($img){
            //renombrar time() + extension
            $img = $nombreimagendestacada.'-'.time().'.'.$request->file('file_image')->clientExtension();
            //subir
            $c = Company::findOrFail($request->company_id);
            $this->directory = public_path('products/'.$c->slug.'/');
            $this->relativeDirectory = 'products/'.$c->slug.'/';
            if(!Storage::exists($this->directory)) {
                //crea el directorio
                Storage::makeDirectory($this->directory, 0775, true);
            }

            $request->file('file_image')->move($this->directory, $img);
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
        $imagen = $this->uploadImage($request);
        $p->file_path = $this->relativeDirectory;
        $p->image = $imagen;
        if($p->save()){
            // open file image resource
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
    public function postProductGalleryAdd(Request $request, $id){
        $rules = [
            // el key deberia ser el nombre que le pusimos al componente del form
            'file_image' => 'required'
        ];

        $messages = [
            'file_image.required' => 'Seleccione una imagen',
        ];

        $request->validate($rules, $messages);

        $g = new PGallery;

        $p = Product::findOrFail($id);
        // extraigo el nombre de la imagen para ponerles a todas las imagegallery el mismo nombre
        $nombreimagendestacada = substr($p->image, -14, 10);
        $imagen = $this->uploadImageGallery($request, $nombreimagendestacada);
        // dd($imagen);
        $g->product_id = $id;
        $g->file_path = $this->relativeDirectory;
        $g->file_name = $imagen;
        if($g->save()){

            // open file a image resource
            $img = Image::make($this->directory.$g->file_name);
            $img->save($this->directory.$g->file_name);
            $img->fit(100,100,function($constraint){
                $constraint->upsize();
            });

            $img->save($this->directory.'t_'.$g->file_name);
        }
        return back()->with('message','La imagen se ha guardado exitosamente.')->with('typealert', 'success');
    }
}
