@extends('admin.layout.master')

@section('body')
<!-- Main -->
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-note2 icon-gradient bg-sunny-morning"></i>
                </div>
                <div>
                    Sản phẩm
                    <div class="page-title-subheading">Cập nhật sản phẩm</div>
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
                    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                            <div class="col-md-9 col-xl-8">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $product->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="price" class="col-md-3 text-md-right col-form-label">Giá <span class="text-danger">*</span></label>
                            <div class="col-md-9 col-xl-8">
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                       id="price" name="price" value="{{ old('price', $product->price) }}" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="qty" class="col-md-3 text-md-right col-form-label">Số lượng <span class="text-danger">*</span></label>
                            <div class="col-md-9 col-xl-8">
                                <input type="number" class="form-control @error('qty') is-invalid @enderror" 
                                       id="qty" name="qty" value="{{ old('qty', $product->qty) }}" required>
                                @error('qty')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="description" class="col-md-3 text-md-right col-form-label">Mô tả</label>
                            <div class="col-md-9 col-xl-8">
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="content" class="col-md-3 text-md-right col-form-label">Nội dung</label>
                            <div class="col-md-9 col-xl-8">
                                <textarea class="form-control" id="content" name="content" rows="3">{{ old('content', $product->content) }}</textarea>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="discount" class="col-md-3 text-md-right col-form-label">Giảm giá</label>
                            <div class="col-md-9 col-xl-8">
                                <input type="number" step="0.01" class="form-control" id="discount" name="discount" value="{{ old('discount', $product->discount) }}">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="weight" class="col-md-3 text-md-right col-form-label">Cân nặng (kg)</label>
                            <div class="col-md-9 col-xl-8">
                                <input type="number" step="0.01" class="form-control" id="weight" name="weight" value="{{ old('weight', $product->weight) }}">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="sku" class="col-md-3 text-md-right col-form-label">SKU</label>
                            <div class="col-md-9 col-xl-8">
                                <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku', $product->sku) }}">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="tag" class="col-md-3 text-md-right col-form-label">Tag</label>
                            <div class="col-md-9 col-xl-8">
                                <input type="text" class="form-control" id="tag" name="tag" value="{{ old('tag', $product->tag) }}" placeholder="Cách nhau bằng dấu phẩy">
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <div class="col-md-9 col-xl-8 ml-md-auto">
                                <a href="{{ route('product.index') }}" class="btn btn-secondary">Quay lại</a>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
