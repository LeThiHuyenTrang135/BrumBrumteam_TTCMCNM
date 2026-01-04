@extends('admin.layout.master')

@section('body')
<!-- Main -->
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-plus icon-gradient bg-happy-itmeo"></i>
                </div>
                <div>
                    Danh mục sản phẩm
                    <div class="page-title-subheading">Tạo danh mục mới</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">

                <div class="card-header">
                    Thông tin cơ bản
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.product-category.store') }}" method="POST">
                        @csrf

                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Tên danh mục <span class="text-danger">*</span></label>
                            <div class="col-md-9 col-xl-8">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <div class="col-md-9 col-xl-8 ml-md-auto">
                                <a href="{{ route('admin.product-category.index') }}" class="btn btn-secondary">Quay lại</a>
                                <button type="submit" class="btn btn-primary">Tạo mới</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
