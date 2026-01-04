@extends('admin.layout.master')

@section('body')
<!-- Main -->
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-folder icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Danh mục sản phẩm
                    <div class="page-title-subheading">
                        {{ $productCategory->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
        <li class="nav-item">
            <a href="{{ route('admin.product-category.edit', $productCategory->id) }}" class="nav-link">
                <span class="btn-icon-wrapper pr-2 opacity-8">
                    <i class="fa fa-edit fa-w-20"></i>
                </span>
                <span>Sửa</span>
            </a>
        </li>

        <li class="nav-item delete">
            <form action="{{ route('admin.product-category.destroy', $productCategory->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button class="nav-link btn" type="submit"
                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                    <span class="btn-icon-wrapper pr-2 opacity-8">
                        <i class="fa fa-trash fa-w-20"></i>
                    </span>
                    <span>Xóa</span>
                </button>
            </form>
        </li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body display_data">
                    <div class="position-relative row form-group">
                        <label for="name" class="col-md-3 text-md-right col-form-label">
                            Tên danh mục
                        </label>
                        <div class="col-md-9 col-xl-8">
                            <p><strong>{{ $productCategory->name }}</strong></p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="created_at" class="col-md-3 text-md-right col-form-label">Ngày tạo</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{ $productCategory->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="updated_at" class="col-md-3 text-md-right col-form-label">Cập nhật</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{ $productCategory->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    @if($productCategory->products()->count() > 0)
                    <div class="position-relative row form-group">
                        <label for="products" class="col-md-3 text-md-right col-form-label">Sản phẩm</label>
                        <div class="col-md-9 col-xl-8">
                            <p>
                                <span class="badge badge-success">{{ $productCategory->products()->count() }} sản phẩm</span>
                            </p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
