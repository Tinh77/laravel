@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Thêm sản phẩm
            </h1>
        </div>
        <div class="col-lg-12">
            <form method="post" accept-charset="utf-8" action="/admin/products">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="input text required"><label for="name">Tên sản phẩm</label>
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
                <div class="form-group">
                    <div class="input number"><label for="position">Giá</label>
                        <input type="number"
                               name="price"
                               class="form-control"
                               id="position"></div>
                </div>
                <div class="form-group">
                    <div class="input number"><label for="position">Amount</label>
                        <input type="text"
                               name="amount"
                               class="form-control"
                               id="position"></div>
                </div>
                <div class="form-group">
                    <div class="input number"><label for="position">Category</label>
                        <ul class="w-25">
                            @foreach($category as $item)
                                <li>
                                    <input name="category_id[]" type="checkbox" id="check-id-{{$item->id}}"
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
                               id="position"></div>
                </div>
                <button class="btn btn-primary right" id="check-save" type="submit">Lưu</button>
            </form>
        </div>
    </div>

    <script>
        var deleteAll = document.getElementById("check-save");
        deleteAll.onclick = function () {
            var checkedItems = document.querySelectorAll(".check-item:checked");
            var checkIds = new Array();
            for (var i = 0; i < checkedItems.length; i++) {
                checkIds.push(checkedItems[i].id.replace("check-id-", ""));
            }
            console.log(checkIds);
            if (checkIds.length === 0) {
                alert("Please choose at least 1 item.");
                return;
            }
            $.ajax({
                url: '/admin/products ',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    alert('sccees')
                },
                error: (response) => console.log("fail")
            });


            // var deleteIds = new Array();
            // for (var i = 0; i < checkedItems.length; i++) {
            //     deleteIds.push(checkedItems[i].id.replace("check-id-", ""));
            // }
            // console.log(deleteIds);
            // if (deleteIds.length === 0) {
            //     alert("Please choose at least 1 item.");
            //     return;
            // }
            // // call ajax.
            // var xmlHttpRequest = new XMLHttpRequest();
            // xmlHttpRequest.onreadystatechange = function () {
            //     if (this.readyState === 4 && this.status === 200) {
            //         alert("Delete success");
            //         location.reload();
            //     }
            // }
            // xmlHttpRequest.open("DELETE", "/Marks/DeleteMany?ids=" + deleteIds, true);
            // xmlHttpRequest.send();

        }
    </script>
@endsection

