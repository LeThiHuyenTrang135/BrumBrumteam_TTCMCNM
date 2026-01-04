@extends('admin.layout.master')

@section('title', 'Sửa người dùng')

@section('body')
<div class="app-main__inner">

    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-user icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Sửa người dùng
                    <div class="page-title-subheading">
                        Cập nhật thông tin người dùng
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

                    <form method="POST" action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Avatar --}}
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
                                    src="{{ $user->avatar ? asset($user->avatar) : asset('front/img/user/default-avatar.png') }}" 
                                    alt="Avatar"
                                    onclick="document.querySelector('.image').click()"
                                    onerror="this.src='{{ asset('front/img/user/default-avatar.png') }}'">
                                    
                                <input name="image" 
                                    type="file" 
                                    onchange="changeImg(this)"
                                    class="image form-control-file" 
                                    style="display: none;" 
                                    accept="image/*">
                                    
                                <input type="hidden" name="image_old" value="{{ $user->avatar }}">
                                
                                <small class="form-text text-muted">
                                    Click vào ảnh để thay đổi (không bắt buộc)
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
                                <input required 
                                    name="name" 
                                    id="name" 
                                    placeholder="Tên người dùng" 
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror" 
                                    value="{{ old('name', $user->name) }}">
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
                                <input required 
                                    name="email" 
                                    id="email" 
                                    placeholder="Email" 
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror" 
                                    value="{{ old('email', $user->email) }}">
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
                                <input name="phone" 
                                    id="phone" 
                                    placeholder="Số điện thoại"
                                    type="text" 
                                    class="form-control @error('phone') is-invalid @enderror" 
                                    value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="position-relative row form-group">
                            <label for="password" class="col-md-3 text-md-right col-form-label">
                                Mật khẩu mới
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <input name="password" 
                                    id="password" 
                                    placeholder="Để trống nếu không đổi mật khẩu" 
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                <small class="form-text text-muted">
                                    Để trống nếu không muốn thay đổi mật khẩu
                                </small>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="position-relative row form-group">
                            <label for="password_confirmation" class="col-md-3 text-md-right col-form-label">
                                Xác nhận mật khẩu
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <input name="password_confirmation" 
                                    id="password_confirmation" 
                                    placeholder="Xác nhận mật khẩu mới" 
                                    type="password"
                                    class="form-control">
                            </div>
                        </div>

                        {{-- Level --}}
                        <div class="position-relative row form-group">
                            <label for="level" class="col-md-3 text-md-right col-form-label">
                                Quyền <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
                                    @foreach(\App\Utilities\Constant::$user_level as $key => $value)
                                        <option value="{{ $key }}" 
                                            {{ old('level', $user->level) == $key ? 'selected' : '' }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('level')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Additional fields if exists in your database --}}
                        @if(Schema::hasColumn('users', 'company_name'))
                        <div class="position-relative row form-group">
                            <label for="company_name" class="col-md-3 text-md-right col-form-label">
                                Tên công ty
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <input name="company_name" 
                                    id="company_name"
                                    placeholder="Tên công ty" 
                                    type="text" 
                                    class="form-control"
                                    value="{{ old('company_name', $user->company_name ?? '') }}">
                            </div>
                        </div>
                        @endif

                        {{-- Description --}}
                        @if(Schema::hasColumn('users', 'description'))
                        <div class="position-relative row form-group">
                            <label for="description" class="col-md-3 text-md-right col-form-label">
                                Mô tả
                            </label>
                            <div class="col-md-9 col-xl-8">
                                <textarea name="description" 
                                    id="description" 
                                    class="form-control" 
                                    rows="4">{{ old('description', $user->description ?? '') }}</textarea>
                            </div>
                        </div>
                        @endif

                        {{-- Action Buttons --}}
                        <div class="position-relative row form-group">
                            <div class="col-md-9 col-xl-8 offset-md-3">
                                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-times"></i> Hủy
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-check"></i> Cập nhật
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function changeImg(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.querySelector('.thumbnail').setAttribute('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
@endpush

@endsection