@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title float-left">
                Danh Mục
                <small class="text-muted"></small>
            </h3>
            @if (Session::has('message'))
                <div class="alert {{ Session::get('message-class') }}">{{ Session::get('message') }}</div>
            @endif
            <a href="/admin/categories/create" class="btn float-right"><i
                    class="fas fa-plus-circle"></i>Create New</a>
            <div class="clearfix"></div>
            <div class="alert alert-success d-none" role="alert" id="messageSuccess"></div>
            <div class="alert alert-danger d-none" role="alert" id="messageError"></div>
            @if(count($list_obj)>0)
                <table class="table table-striped">
                    <thead>
                    <tr class="row">
                        <th class="col-md-1">No</th>
                        <th class="col-md-2">Hình ảnh</th>
                        <th class="col-md-2">Tên danh mục</th>
                        <th class="col-md-1">Trạng thái</th>
                        <th class="col-md-1">Thứ tự hiển thị</th>
                        <th class="col-md-3">Ngày cập nhật</th>
                        <th class="col-md-2"></th>
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
                            <td class="col-md-1">{{$item->status}}</td>
                            <td class="col-md-1">{{$item->status}}</td>
                            <td class="col-md-3">{{$item-> created_at -> format('d-m-Y H:i:s')}}</td>
                            <td class="col-md-2">
                                <a href="/admin/categories/{{$item -> id}}/edit"
                                   class="btn btn-link btn-edit">Edit</a>&nbsp;&nbsp;
                                <form id="delete-form" method="POST" action="/admin/categories/{{$item->id}}">
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
                    Hiện nay không có danh mục nào
                </div>
            @endif
        </div>
    </div>
@endsection
