<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyCategory extends Model
{
    protected $table = 'property_category';
    protected $primaryKey = 'pid';
    public $timestamps = false;
}