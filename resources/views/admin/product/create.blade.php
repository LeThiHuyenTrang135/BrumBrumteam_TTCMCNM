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
                    Sản phẩm
                    <div class="page-title-subheading">Tạo sản phẩm mới</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">

                <div class="card-header">
                    Thông tin sản phẩm
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">
                                Tên sản phẩm <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="product_category_id" class="col-md-3 text-md-right col-form-label">
                                Danh mục <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <select class="form-control @error('product_category_id') is-invalid @enderror" 
                                        id="product_category_id" name="product_category_id" required>
                                    <option value="">-- Chọn danh mục --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="price" class="col-md-3 text-md-right col-form-label">
                                Giá <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                       id="price" name="price" value="{{ old('price') }}" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="qty" class="col-md-3 text-md-right col-form-label">
                                Số lượng <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <input type="number" class="form-control @error('qty') is-invalid @enderror" 
                                       id="qty" name="qty" value="{{ old('qty') }}" required>
                                @error('qty')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="weight" class="col-md-3 text-md-right col-form-label">Trọng lượng (kg)</label>
                            <div class="col-md-9 col-xl-8">
                                <input type="number" step="0.01" class="form-control @error('weight') is-invalid @enderror" 
                                       id="weight" name="weight" value="{{ old('weight') }}">
                                @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="description" class="col-md-3 text-md-right col-form-label">Mô tả ngắn</label>
                            <div class="col-md-9 col-xl-8">
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="content" class="col-md-3 text-md-right col-form-label">Nội dung chi tiết</label>
                            <div class="col-md-9 col-xl-8">
                                <textarea class="form-control @error('content') is-invalid @enderror" 
                                          id="content" name="content" rows="5">{{ old('content') }}</textarea>
                                @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="images" class="col-md-3 text-md-right col-form-label">
                                Hình ảnh <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <input type="file" class="form-control-file @error('images.*') is-invalid @enderror" 
                                       id="images" name="images[]" multiple accept="image/*" required onchange="previewImages(event)">
                                <small class="form-text text-muted">Chọn nhiều ảnh (JPEG, PNG, JPG, GIF - Max 2MB/ảnh)</small>
                                @error('images.*')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                
                                <div id="image-preview" class="mt-3 row"></div>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <label for="featured" class="col-md-3 text-md-right col-form-label">Sản phẩm nổi bật</label>
                            <div class="col-md-9 col-xl-8">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="featured" name="featured" 
                                           value="1" {{ old('featured') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="featured">Đánh dấu là sản phẩm nổi bật</label>
                                </div>
                            </div>
                        </div>

                        <div class="position-relative row form-group">
                            <div class="col-md-9 col-xl-8 ml-md-auto">
                                <a href="{{ route('admin.product.index') }}" class="btn btn-secondary">Quay lại</a>
                                <button type="submit" class="btn btn-primary">Tạo mới</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImages(event) {
    const previewContainer = document.getElementById('image-preview');
    previewContainer.innerHTML = '';
    
    const files = event.target.files;
    
    if (files) {
        Array.from(files).forEach((file, index) => {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-md-3 mb-3';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-thumbnail';
                img.style.width = '100%';
                img.style.height = '200px';
                img.style.objectFit = 'cover';
                
                col.appendChild(img);
                previewContainer.appendChild(col);
            }
            
            reader.readAsDataURL(file);
        });
    }
}
</script>
@endsection