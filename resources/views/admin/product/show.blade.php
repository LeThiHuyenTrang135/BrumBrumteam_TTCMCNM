@extends('admin.layout.master')

@section('body')
<!-- Main -->
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-box2 icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Sản phẩm
                    <div class="page-title-subheading">
                        {{ $product->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
        <li class="nav-item">
            <a href="{{ route('product.edit', $product->id) }}" class="nav-link">
                <span class="btn-icon-wrapper pr-2 opacity-8">
                    <i class="fa fa-edit fa-w-20"></i>
                </span>
                <span>Sửa</span>
            </a>
        </li>

        <li class="nav-item delete">
            <form action="{{ route('product.destroy', $product->id) }}" method="post">
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
                            Tên sản phẩm
                        </label>
                        <div class="col-md-9 col-xl-8">
                            <p><strong>{{ $product->name }}</strong></p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="price" class="col-md-3 text-md-right col-form-label">Giá</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{ number_format($product->price, 0, ',', '.') }}đ</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="qty" class="col-md-3 text-md-right col-form-label">Số lượng</label>
                        <div class="col-md-9 col-xl-8">
                            <p>
                                <span class="badge badge-primary badge-lg">{{ $product->qty }}</span>
                            </p>
                        </div>
                    </div>

                    @if($product->discount)
                    <div class="position-relative row form-group">
                        <label for="discount" class="col-md-3 text-md-right col-form-label">Giảm giá</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{ number_format($product->discount, 0, ',', '.') }}đ</p>
                        </div>
                    </div>
                    @endif

                    @if($product->weight)
                    <div class="position-relative row form-group">
                        <label for="weight" class="col-md-3 text-md-right col-form-label">Cân nặng</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{ $product->weight }} kg</p>
                        </div>
                    </div>
                    @endif

                    @if($product->sku)
                    <div class="position-relative row form-group">
                        <label for="sku" class="col-md-3 text-md-right col-form-label">SKU</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{ $product->sku }}</p>
                        </div>
                    </div>
                    @endif

                    @if($product->description)
                    <div class="position-relative row form-group">
                        <label for="description" class="col-md-3 text-md-right col-form-label">Mô tả</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                    @endif

                    @if($product->content)
                    <div class="position-relative row form-group">
                        <label for="content" class="col-md-3 text-md-right col-form-label">Nội dung</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{ $product->content }}</p>
                        </div>
                    </div>
                    @endif

                    @if($product->tag)
                    <div class="position-relative row form-group">
                        <label for="tag" class="col-md-3 text-md-right col-form-label">Tag</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{ $product->tag }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="position-relative row form-group">
                        <label for="created_at" class="col-md-3 text-md-right col-form-label">Ngày tạo</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{ $product->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="updated_at" class="col-md-3 text-md-right col-form-label">Cập nhật</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{ $product->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
