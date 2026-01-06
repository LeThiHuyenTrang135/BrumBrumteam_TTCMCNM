<!-- Example: resources/views/components/role-example.blade.php -->

<div>
    {{-- Hiển thị cho user có role admin --}}
    @role('admin')
        <div class="admin-section" style="background-color: #f0f0f0; padding: 20px; margin: 10px 0;">
            <h3>Admin Panel</h3>
            <p>Bạn có quyền truy cập vào bảng quản trị</p>
            <a href="{{ route('admin.user.index') }}">Quản lý người dùng</a>
            <a href="{{ route('admin.product.index') }}">Quản lý sản phẩm</a>
        </div>
    @endrole

    {{-- Hiển thị cho user bình thường --}}
    @role('user')
        <div class="user-section" style="background-color: #e8f5e9; padding: 20px; margin: 10px 0;">
            <h3>User Dashboard</h3>
            <p>Bạn là một người dùng thường xuyên</p>
            <a href="{{ route('cart.index') }}">Xem giỏ hàng</a>
        </div>
    @endrole

    {{-- Hiển thị nếu có bất kỳ role nào trong danh sách --}}
    @hasanyrole('admin|writer')
        <div class="content-creator-section">
            <p>Bạn có thể tạo nội dung</p>
        </div>
    @endhasanyrole

    {{-- Kiểm tra permission --}}
    @can('manage products')
        <div class="permission-section">
            <p>Bạn có quyền quản lý sản phẩm</p>
        </div>
    @endcan

    {{-- Kiểm tra không có role --}}
    @unlessrole('admin')
        <div class="guest-section">
            <p>Bạn không phải là admin</p>
        </div>
    @endunlessrole
</div>
