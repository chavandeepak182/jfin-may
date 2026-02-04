<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'properties';
    protected $primaryKey = 'properties_id';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = false; // because created_at is datetime, not managed by Laravel

    protected $guarded = [];

    /**
     * Soft delete safe scope
     */
    public function scopeActive($query)
    {
        return $query
            ->where('is_active', 1)
            ->whereNull('is_deleted');
    }
    
}
