@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Thêm / cập nhật danh mục
            </h1>
        </div>
        <div class="col-lg-12">
            <form method="post" accept-charset="utf-8" action="/admin/categories">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="input text required"><label for="name">Tên danh mục</label>
                        <input type="text"
                               name="name"
                               class="form-control"
                               required="required"
                               maxlength="120"
                               id="name" value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input number"><label for="position">Thumbnail</label>
                        <input type="text"
                               name="thumbnail"
                               class="form-control"
                               id="position"></div>
                </div>
                <div class="form-group">
                    <div class="input number"><label for="position">Mô tả</label>
                        <input type="text"
                               name="description"
                               class="form-control"
                               id="position"></div>
                </div>
                <button class="btn btn-primary right" type="submit">Lưu</button>
            </form>
        </div>
    </div>
@endsection
