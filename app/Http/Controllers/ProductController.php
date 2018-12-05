<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryProduct;
use App\Http\Requests\ProductBlogPost;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\In;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = 10;
        $categories = Category::all();
        $categoryId = Input::get('categoryId');
        if ($categoryId == null || $categoryId == 0) {
            $list_obj = Product::where('status', 1)->orderBy('created_at', 'DESC')->paginate($limit);
            return view('product.list')
                ->with('list_obj', $list_obj)
                ->with('categories', $categories)
                ->with('categoryId', $categoryId);
        } else {
            $list_obj = Product::where('categoryId', Input::get('categoryId'))
                ->orderBy('created_at', 'desc')->paginate($limit);
            return view('product.list')
                ->with('list_obj', $list_obj)
                ->with('categories', $categories)
                ->with('categoryId', $categoryId);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('product.form')->with('category', $category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obj = new Product();
        $obj->name = Input::get('name');
        $obj->thumbnail = Input::get('thumbnail');
        $obj->price = Input::get('price');
        $obj->amount = Input::get('amount');
        $obj->description = Input::get('description');
        $obj->code = Input::get('code');
        if($obj->save()) {
            foreach (Input::get('category_id') as $key => $value) {
                DB::table('category_product')->insert([
                   'category_id' => $value,
                    'product_id' => $obj->id
                ]);
            }
        }
        Session::flash('message', 'Thêm mới thành công');
        Session::flash('message-class', 'alert-success');
        return redirect('/admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj = Product::find($id);
        if ($obj == null) {
            return view('error.404');
        }
        return view('product.show')->with('obj', $obj);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obj = Product::find($id);
        if ($obj == null || $obj->status != 1) {
            return view('error.404');
        }
        $categoryId = Category::all();
        return view('product.edit')->with('obj', $obj) ->with('categories', $categoryId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $obj = Product::find($id);
        if ($obj == null || $obj->status != 1) {
            return view('error.404');
        }
        $obj->name = Input::get('name');
        $obj->thumbnail = Input::get('thumbnail');
        $obj->price = Input::get('price');
        $obj->amount = Input::get('amount');
        $obj->description = Input::get('description');
        $obj->code = Input::get('code');
        if($obj->save()) {
            foreach (Input::get('category_id') as $key => $value) {
                DB::table('category_product')->insert([
                    'category_id' => $value,
                    'product_id' => $obj->id
                ]);
            }
        }
        Session::flash('message', 'Sửa thành công');
        Session::flash('message-class', 'alert-success');
        return redirect('/admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Product::find($id);
        if ($obj == null) {
            return response()->json(['message' => 'Sản phẩm không tồn tại hoặc đã bị xóa'], 404);
        }
        $obj->status = 0;
        if ($obj->save()) {
            return redirect('/admin/products');
        }
    }
}
