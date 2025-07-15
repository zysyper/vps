<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'grand_total',
        'payment_method',
        'payment_status',
        'status',
        'phone',
        'currency',
        'original_name',
        'file_path',
        'mime_type',
        'payment_proof_path',
        'payment_proof_name',
        'payment_proof_mime',
        'notes',
        'catatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(orderitem::class);
    }

    public function getStatusInIndonesianAttribute()
    {
        $statusMap = [
            'new' => 'Baru',
            'processing' => 'Sedang Diproses',
            'shipped' => 'Sedang Dikirim',
            'delivered' => 'Diterima',
            'canceled' => 'Dibatalkan',
        ];

        return $statusMap[$this->status] ?? 'Status Tidak Dikenal';
    }

    public function getPaymentStatusInIndonesianAttribute()
    {
        $paymentStatusMap = [
            'pending' => 'Belum Dibayar',
            'paid' => 'Sudah Dibayar',
            'failed' => 'Gagal',
        ];

        return $paymentStatusMap[$this->payment_status] ?? 'Status Pembayaran Tidak Dikenal';
    }
}
