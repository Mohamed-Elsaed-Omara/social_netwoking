<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Connection extends Model
{
    use HasFactory;
    
    protected $table = 'connections';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'status',
    ];


    // العلاقة مع المستخدم الذي أرسل طلب الصداقة
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // العلاقة مع المستخدم الذي تلقى طلب الصداقة
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    
}
