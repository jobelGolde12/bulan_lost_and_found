<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrashModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'trash';

    protected $fillable = [
        'user_id',
        'lost_found_item_id',
        'title',
        'description',
        'category',
        'status',
        'contact_info',
        'image_url',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lostFoundItem()
    {
        return $this->belongsTo(ItemModel::class);
    }
}
