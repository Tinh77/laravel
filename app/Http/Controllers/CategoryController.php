<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
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
        $list_obj = Category::where('status', 1)->orderBy('created_at', 'DESC')->paginate($limit);
        return view('category.list')->with('list_obj', $list_obj);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $obj = new Category();
        $obj->name = $request->get('name');
        $obj->description = $request->get('description');
        $obj->thumbnail = $request->get('thumbnail');
        $obj->save();
        Session::flash('message', 'Thêm mới thành công');
        Session::flash('message-class', 'alert-success');
        return redirect('/admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj =Category::find($id);
        if ($obj == null){
            return view('error.404');
        }
        return view('category.show')->with('obj',$obj);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obj = Category::find($id);
        if ($obj == null || $obj->status != 1) {
            return view('error.404');
        }
        return view('category.edit')->with('obj', $obj);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $obj = Category::find($id);
        if ($obj == null || $obj->status != 1) {
            return view('error.404');
        }
        $obj->name = $request->get('name');
        $obj->description = $request->get('description');
        $obj->thumbnail = $request->get('thumbnail');
        $obj->save();
        Session::flash('message', 'Sửa thành công');
        Session::flash('message-class', 'alert-success');
        return redirect('/admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = Category::find($id);
        if ($obj == null) {
            return response()->json(['message' => 'Category không tồn tại hoặc đã bị xoá!'], 404);
        }
        $obj->status = 0;
        if ($obj->save()) {
            return redirect('/admin/categories');
        }

    }
}
