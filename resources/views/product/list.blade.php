@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title float-left">
                Product
                <small class="text-muted"></small>
            </h3>
            @if (Session::has('message'))
                <div class="alert {{ Session::get('message-class') }}">{{ Session::get('message') }}</div>
            @endif
            <a href="/admin/products/create" class="btn float-right"><i
                    class="fas fa-plus-circle"></i>Create New</a>
            <div class="clearfix"></div>
            <div class="alert alert-success d-none" role="alert" id="messageSuccess"></div>
            <div class="alert alert-danger d-none" role="alert" id="messageError"></div>
            @if(count($list_obj)>0)
                <div class="row m-1">
                    <form action="/admin/product" method="GET" class="form-inline" name="category-form">
                        <div class="form-group">
                            <label>Choose a category: </label>
                            <select name="categoryId" class="form-control m-3">
                                <option value="0">All</option>
                                @foreach($categories as $item)
                                    <option value="{{$item->id}}" {{$categoryId == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr class="row">
                        <th class="col-md-1">No</th>
                        <th class="col-md-2">Hình ảnh</th>
                        <th class="col-md-2">Tên sản phẩm</th>
                        <th class="col-md-2">Danh Mục</th>
                        <th class="col-md-1">Prices</th>
                        <th class="col-md-3"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list_obj as $item)
                        <tr class="row" id="row-item-{{$item->id}}">
                            <td class="col-md-1">{{$item->id}}</td>
                            <td class="col-md-2">
                                <div class="card"
                                     style="background-image: url('{{$item->images}}'); background-size: cover; width: 60px; height: 60px;">
                                </div>
                            </td>
                            <td class="col-md-2">{{$item->name}}</td>
                            <td class="col-md-2">
                                {{--{{$item->getCategoriesName()->category_product()->name}}--}}
                            </td>
                            <td class="col-md-1">{{$item->price}}</td>
                            <td class="col-md-3">
                                <a href="/admin/products/{{$item -> id}}/edit"
                                   class="btn btn-link btn-edit">Edit</a>&nbsp;&nbsp;
                                <form id="delete-form" method="POST" action="/admin/products/{{$item->id}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <div class="form-group">
                                        <input type="submit" class="btn btn-danger" value="Delete" onclick="return confirm('OK?')">
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-info" role="alert">
                    Hiện nay không có sản phảm nào
                </div>
            @endif
        </div>
    </div>

@endsection
