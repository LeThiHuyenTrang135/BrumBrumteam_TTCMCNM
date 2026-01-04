@extends('admin.layout.master')

@section('title', 'Danh sách người dùng')

@section('body')

<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                </div>
                <div>
                    Người dùng
                    <div class="page-title-subheading">
                        Xem chi tiết, Tạo mới, Cập nhật, Xóa.
                    </div>
                </div>
            </div>

            <div class="page-title-actions">
                <a href="{{ route('admin.user.create') }}" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus fa-w-20"></i>
                    </span>
                    Tạo mới
                </a>
            </div>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('notification'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Thành công!</strong> {{ session('notification') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-header">
                    <form>
                        <div class="input-group">
                            <input type="search" name="search" id="search"
                                placeholder="Nhập tên người dùng" class="form-control"
                                value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>&nbsp;
                                    Tìm kiếm
                                </button>
                            </span>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Họ tên</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Quyền</th>
                                <th class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td class="text-center text-muted">#{{ $user->id }}</td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="widget-content-left">
                                                    <img width="40" class="rounded-circle"
                                                        data-toggle="tooltip" title="Avatar"
                                                        data-placement="bottom"
                                                        src="{{ $user->avatar ? asset($user->avatar) : asset('front/img/user/default-avatar.png') }}" 
                                                        alt="{{ $user->name }}"
                                                        onerror="this.src='{{ asset('front/img/user/default-avatar.png') }}'">
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{ $user->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">
                                    <span class="badge badge-{{ $user->level == 1 ? 'success' : 'secondary' }}">
                                        {{ \App\Utilities\Constant::$user_level[$user->level] ?? 'Unknown' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.user.show', $user->id) }}"
                                        class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                        Chi tiết
                                    </a>
                                    <a href="{{ route('admin.user.edit', $user->id) }}" 
                                        data-toggle="tooltip" title="Sửa"
                                        data-placement="bottom" 
                                        class="btn btn-outline-warning border-0 btn-sm">
                                        <span class="btn-icon-wrapper opacity-8">
                                            <i class="fa fa-edit fa-w-20"></i>
                                        </span>
                                    </a>
                                    <form class="d-inline" action="{{ route('admin.user.destroy', $user->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                            type="submit" data-toggle="tooltip" title="Xóa"
                                            data-placement="bottom"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                                            <span class="btn-icon-wrapper opacity-8">
                                                <i class="fa fa-trash fa-w-20"></i>
                                            </span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    <p class="text-muted my-3">Không có dữ liệu</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if(method_exists($users, 'links'))
                <div class="d-block card-footer">
                    {{ $users->links() }}
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
@endpush

@endsection