@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Sửa sản phẩm
            </h1>
        </div>
        <div class="col-lg-12">
            <form method="post" accept-charset="utf-8" action="/admin/products/{{$obj->id}}">
                @method('PUT')
                {{csrf_field()}}
                <div class="form-group">
                    <div class="input text required"><label for="name">Tên sản phẩm</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               required="required"
                               maxlength="120"
                               id="name" value="{{$obj->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input number"><label for="position">Thumbnail</label>
                        <input type="text"
                               name="thumbnail"
                               class="form-control"
                               id="position" value="{{$obj->thumbnail}}"></div>
                </div>
                <div class="form-group">
                    <div class="input number"><label for="position">Mô tả</label>
                        <textarea type="text"
                               name="description"
                               class="form-control"
                                  id="position" >{{$obj->description}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input number"><label for="position">Giá</label>
                        <input type="number"
                               name="price"
                               class="form-control"
                               id="position" value="{{$obj->price}}"></div>
                </div>
                <div class="form-group">
                    <div class="input number"><label for="position">Amount</label>
                        <input type="text"
                               name="amount"
                               class="form-control"
                               id="position" value="{{$obj->amount}}"></div>
                </div>
                <div class="form-group">
                    <div class="input number"><label for="position">Category</label>
                        <ul class="w-25">
                            {{--@foreach($categories as $item)--}}
                                {{--<option value="{{$item->id}}" {{$product_in_view -> categoryId == $item->id ? 'selected' : ''}} >{{$item->title}}</option>--}}
                            {{--@endforeach--}}
                            @foreach($categories as $item)
                                <li>
                                    <input name="category_id[]" type="checkbox" {{$obj -> category_id == $item->id ? 'selected' : ''}}
                                    value={{$item->id}}>{{$item->name}}
                                </li>
                            @endforeach()
                        </ul>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input number"><label for="position">Code</label>
                        <input type="text"
                               name="code"
                               class="form-control"
                               id="position" value="{{$obj->code}}"></div>
                </div>
                <button class="btn btn-primary right" id="check-save" type="submit">Lưu</button>
            </form>
        </div>
    </div>
@endsection

