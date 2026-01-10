<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'company_name',
        'country',
        'street_address',
        'postcode_zip',
        'town_city',
        'email',
        'phone',
        'payment_type',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getStatusLabelAttribute()
    {
        $statuses = [
            0 => ['text' => 'Đang chờ xử lý', 'badge' => 'badge-warning'],
            2 => ['text' => 'Đang xác nhận', 'badge' => 'badge-primary'], 
            1 => ['text' => 'Đang giao', 'badge' => 'badge-info'],       
            3 => ['text' => 'Đã giao', 'badge' => 'badge-success'],
            4 => ['text' => 'Đã hủy', 'badge' => 'badge-danger'],
            7 => ['text' => 'Đã hoàn thành', 'badge' => 'badge-success'],
        ];

        return $statuses[$this->status]
            ?? ['text' => 'Không xác định', 'badge' => 'badge-secondary'];
    }
}
