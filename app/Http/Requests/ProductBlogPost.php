<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductBlogPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'categoryId' => 'required',
            'collectionId' => 'required',
            'name' => 'required|max:50|min:10|unique:collections',
            'images' => 'required',
            'price' => 'required',
            'description' => 'required',
            'detail' => 'required',
            'colors' => 'required',
            'sizes' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'categoryId.required'=>'Vui lòng nhập mã danh mục',
            'collectionId.required'=>'Vui lòng nhập mã bộ sưu tập',
            'name.required' => 'Vui lòng nhập tên cho sản phẩm.',
            'name.min' => 'Tên quá ngắn, vui lòng nhập ít nhất 10 ký tự.',
            'name.max' => 'Tên quá dài, vui lòng nhập nhiều nhất 50 ký tự.',
            'name.unique' => 'Tên đã được sử dụng, vui lòng chọn tên khác.',
            'images.required' => 'Vui lòng nhập ảnh cho sản phẩm',
            'price.required' => 'Vui lòng nhập giá cho sản phẩm',
            'description.required' => 'Vui lòng nhập mô tả cho sản phẩm',
            'detail.required' => 'Vui lòng nhập chi tiết cho sản phẩm',
            'colors.required' => 'Vui lòng nhập màu cho sản phẩm',
            'sizes.required' => 'Vui lòng nhập cỡ cho sản phẩm',
        ];
    }
}
