# Hướng dẫn sử dụng Spatie Permission (Roles & Permissions)

## ✅ Những gì đã thiết lập

### 1. Package cài đặt
- **spatie/laravel-permission** v6.24.0 - Thư viện quản lý roles và permissions

### 2. Migrations tạo
- `2026_01_06_000000_create_permission_tables.php` - Tạo bảng permissions, roles, và các bảng pivot
- `2026_01_06_000001_add_teams_fields.php` - Thêm hỗ trợ teams (nếu cần)

### 3. Model & Trait
- `app/Models/User.php` - Đã thêm trait `HasRoles` để user có thể quản lý roles/permissions

### 4. Roles & Permissions
**Roles:**
- `admin` - Người quản trị hệ thống
- `user` - Người dùng thường xuyên

**Permissions:**
- `manage products` - Quản lý sản phẩm
- `view products` - Xem sản phẩm
- `manage users` - Quản lý người dùng

### 5. User Test
Đã tạo 2 user test:
```
Email: admin@example.com
Password: password123
Role: admin

Email: user@example.com
Password: password123
Role: user
```

---

## 🚀 Cách sử dụng

### A. Gán Role cho User

**Cách 1: Sử dụng Command**
```bash
php artisan user:assign-role {userId} {role}

# Ví dụ
php artisan user:assign-role 1 admin
php artisan user:assign-role 2 user
```

**Cách 2: Sử dụng Tinker**
```bash
php artisan tinker
```
```php
$user = \App\Models\User::find(1);
$user->assignRole('admin');
```

**Cách 3: Trong Controller**
```php
$user->assignRole('admin');
// hoặc
$user->assignRole(['admin', 'editor']);
```

---

### B. Kiểm tra Role trong Controller

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PermissionService;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Kiểm tra user có role admin
        if ($request->user()->hasRole('admin')) {
            // Cho phép truy cập
        }

        // Hoặc dùng PermissionService helper
        if (PermissionService::isAdmin()) {
            // Cho phép truy cập
        }

        // Kiểm tra permission
        if ($request->user()->hasPermissionTo('manage products')) {
            // Cho phép quản lý sản phẩm
        }
    }
}
```

---

### C. Bảo vệ Route với Middleware

**1. Kiểm tra Role**
```php
// routes/web.php

// Route chỉ admin được truy cập
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('role:admin');

// Nhiều roles
Route::get('/content', [ContentController::class, 'index'])
    ->middleware('role:admin|editor|writer');
```

**2. Kiểm tra Permission**
```php
Route::post('/product/create', [ProductController::class, 'store'])
    ->middleware('permission:manage products');
```

**3. Kết hợp trong Route Group**
```php
Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('product', ProductController::class);
        Route::resource('product-category', ProductCategoryController::class);
    });
```

---

### D. Dùng Blade Directives

**1. Kiểm tra Role**
```blade
{{-- Hiển thị nếu user có role admin --}}
@role('admin')
    <div class="admin-panel">
        <h1>Admin Panel</h1>
        <a href="{{ route('admin.user.index') }}">Quản lý User</a>
    </div>
@endrole

{{-- Hiển thị nếu user không có role admin --}}
@unlessrole('admin')
    <p>Bạn không phải Admin</p>
@endunlessrole
```

**2. Kiểm tra Permission**
```blade
{{-- Hiển thị nếu user có permission --}}
@can('manage products')
    <button>Quản lý sản phẩm</button>
@endcan

@cannot('manage products')
    <p>Bạn không có quyền quản lý sản phẩm</p>
@endcannot
```

**3. Kiểm tra Bất kỳ Role**
```blade
{{-- Hiển thị nếu user có bất kỳ role nào trong danh sách --}}
@hasanyrole('admin|editor|writer')
    <p>Bạn có thể tạo nội dung</p>
@endhasanyrole
```

**4. Example Component**
```blade
<!-- File: resources/views/components/role-example.blade.php -->
@role('admin')
    <div class="admin-section">
        <h3>Admin Dashboard</h3>
        <!-- Admin content -->
    </div>
@endrole
```

---

### E. Trong Controller Construct (ProtectedController)

```php
<?php

namespace App\Http\Controllers;

class ProductController extends Controller
{
    public function __construct()
    {
        // Chỉ cho admin truy cập create, store, edit, update, destroy
        $this->middleware('role:admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
        
        // Cho phép user bình thường xem danh sách
        $this->middleware('auth')->only(['index', 'show']);
    }

    public function index()
    {
        // Public hoặc authenticated user có thể xem
    }

    public function create()
    {
        // Chỉ admin có thể tạo
    }

    public function store(Request $request)
    {
        // Chỉ admin có thể lưu
    }
}
```

---

## 📝 Quản lý Roles & Permissions

### Tạo Role mới
```php
use Spatie\Permission\Models\Role;

$role = Role::create(['name' => 'editor', 'guard_name' => 'web']);
```

### Tạo Permission mới
```php
use Spatie\Permission\Models\Permission;

$permission = Permission::create(['name' => 'edit posts', 'guard_name' => 'web']);
```

### Gán Permission cho Role
```php
$role = Role::findByName('editor');
$role->givePermissionTo('edit posts');

// Hoặc
$role->givePermissionTo(['edit posts', 'delete posts']);
```

### Gán Role cho User
```php
$user->assignRole('editor');

// Hoặc nhiều roles
$user->assignRole(['editor', 'writer']);
```

### Gán Permission trực tiếp cho User
```php
$user->givePermissionTo('edit posts');
```

### Kiểm tra
```php
// Role
$user->hasRole('admin');
$user->hasAnyRole(['admin', 'editor']);

// Permission
$user->hasPermissionTo('edit posts');
$user->can('edit posts');
```

### Loại bỏ Role/Permission
```php
$user->removeRole('admin');
$user->revokePermissionTo('edit posts');
```

---

## 🔧 Cấu hình nâng cao

Nếu bạn cần tùy chỉnh, sửa file `config/permission.php`:

```php
'table_names' => [
    'roles' => 'roles',
    'permissions' => 'permissions',
    'model_has_permissions' => 'model_has_permissions',
    'model_has_roles' => 'model_has_roles',
    'role_has_permissions' => 'role_has_permissions',
],

'cache' => [
    'expiration_time' => \DateInterval::createFromDateString('24 hours'),
    'key' => 'spatie.permission.cache',
],

'enable_caching' => true,
'teams' => false,
```

---

## 💡 Tips & Tricks

1. **Cache Permissions**: Spatie tự động cache permissions - nếu cập nhật roles/permissions mà không thấy thay đổi, chạy:
   ```bash
   php artisan cache:clear
   ```

2. **Xem tất cả Roles & Permissions**:
   ```bash
   php artisan tinker
   >>> \Spatie\Permission\Models\Role::all();
   >>> \Spatie\Permission\Models\Permission::all();
   ```

3. **Xem Roles của User**:
   ```php
   $user->roles;          // Collection of roles
   $user->getRoleNames(); // Array of role names
   $user->getPermissions(); // Collection of permissions
   ```

4. **Breadcrumb trong Navigation**:
   ```blade
   <nav>
       @role('admin')
           <a href="{{ route('admin.dashboard') }}">Admin</a>
       @endrole
       
       @auth
           <a href="{{ route('account.profile') }}">Profile</a>
           <a href="{{ route('logout') }}">Logout</a>
       @endauth
   </nav>
   ```

---

## 🎯 Trường hợp sử dụng phổ biến

### 1. E-commerce (Sản phẩm, Đơn hàng)
```php
// Roles
admin   - Quản lý toàn bộ
vendor  - Quản lý sản phẩm của mình
customer- Mua hàng

// Permissions
create_product, edit_product, delete_product
view_orders, manage_orders
```

### 2. Blog/CMS
```php
// Roles
admin    - Quản lý mọi thứ
editor   - Quản lý bài viết
writer   - Viết bài
viewer   - Xem bài

// Permissions
create_post, edit_post, delete_post, publish_post
```

### 3. SaaS
```php
// Roles
owner       - Sở hữu tài khoản
admin       - Quản lý thành viên
member      - Thành viên bình thường
viewer      - Chỉ xem

// Permissions
manage_team, manage_billing, manage_content, create_content
```

---

## ⚠️ Chú ý

- Route admin đã bảo vệ với middleware `['auth', 'role:admin']`
- Nếu user không có role, sẽ nhận HTTP 403 Unauthorized
- Luôn xác thực user trước khi kiểm tra role: `@auth @role(...) @endauth`
- Cache 24 giờ - nếu update roles/permissions, clear cache: `php artisan cache:clear`

---

**Chúc bạn sử dụng Spatie Permission vui vẻ! 🎉**
