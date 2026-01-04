@extends('admin.layout.master')

@section('title', 'Tạo người dùng mới')

@section('body')
<!-- Main -->
<div class="app-main__inner">
    
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-user icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Người dùng
                    <div class="page-title-subheading">
                        Tạo mới người dùng
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    
                    {{-- Display Success Message --}}
                    @if(session('notification'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Thành công!</strong> {{ session('notification') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    {{-- Display Error Message --}}
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Lỗi!</strong> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    {{-- Display Validation Errors --}}
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Có lỗi xảy ra!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    {{-- Form Start --}}
                    <form method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Avatar Upload --}}
                        <div class="position-relative row form-group">
                            <label for="image" class="col-md-3 text-md-right col-form-label">
                                Avatar
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <img style="height: 200px; cursor: pointer;"
                                    class="thumbnail rounded-circle" 
                                    data-toggle="tooltip"
                                    title="Click để thay đổi ảnh" 
                                    data-placement="bottom"
                                    src="{{ asset('dashboard/assets/images/add-image-icon.jpg') }}" 
                                    alt="Avatar"
                                    onclick="document.querySelector('.image').click()">
                                    
                                <input name="image" 
                                    type="file" 
                                    onchange="changeImg(this)"
                                    class="image form-control-file" 
                                    style="display: none;" 
                                    accept="image/*">
                                    
                                <small class="form-text text-muted">
                                    Click vào ảnh để thay đổi (không bắt buộc). Định dạng: JPG, PNG, GIF. Tối đa 2MB.
                                </small>
                                
                                @error('image')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Name --}}
                        <div class="position-relative row form-group">
                            <label for="name" class="col-md-3 text-md-right col-form-label">
                                Tên <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <input type="text" 
                                    name="name" 
                                    id="name"
                                    class="form-control @error('name') is-invalid @enderror" 
                                    placeholder="Nhập tên người dùng"
                                    value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="position-relative row form-group">
                            <label for="email" class="col-md-3 text-md-right col-form-label">
                                Email <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <input type="email" 
                                    name="email" 
                                    id="email"
                                    class="form-control @error('email') is-invalid @enderror" 
                                    placeholder="example@email.com"
                                    value="{{ old('email') }}"
                                    required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="position-relative row form-group">
                            <label for="phone" class="col-md-3 text-md-right col-form-label">
                                Số điện thoại
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <input type="text" 
                                    name="phone" 
                                    id="phone"
                                    class="form-control @error('phone') is-invalid @enderror" 
                                    placeholder="0912345678"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="position-relative row form-group">
                            <label for="password" class="col-md-3 text-md-right col-form-label">
                                Mật khẩu <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <input type="password" 
                                    name="password" 
                                    id="password"
                                    class="form-control @error('password') is-invalid @enderror" 
                                    placeholder="Tối thiểu 6 ký tự"
                                    required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="position-relative row form-group">
                            <label for="password_confirmation" class="col-md-3 text-md-right col-form-label">
                                Xác nhận mật khẩu <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <input type="password" 
                                    name="password_confirmation" 
                                    id="password_confirmation"
                                    class="form-control" 
                                    placeholder="Nhập lại mật khẩu"
                                    required>
                            </div>
                        </div>

 

                        {{-- Action Buttons --}}
                        <div class="position-relative row form-group mb-1">
                            <div class="col-md-9 col-xl-8 offset-md-3">
                                <a href="{{ route('admin.user.index') }}" 
                                    class="border-0 btn btn-outline-danger mr-1">
                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                        <i class="fa fa-times fa-w-20"></i>
                                    </span>
                                    <span>Hủy</span>
                                </a>

                                <button type="submit"
                                    class="btn-shadow btn-hover-shine btn btn-primary">
                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                        <i class="fa fa-check fa-w-20"></i>
                                    </span>
                                    <span>Lưu</span>
                                </button>
                            </div>
                        </div>
                    </form>
                    {{-- Form End --}}
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main -->

@push('scripts')
<script>
    // Function to preview image
    function changeImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                document.querySelector('.thumbnail').setAttribute('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Auto dismiss alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
@endpush

@endsection