<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    protected $fillable = ['name'];

    public function leftChild()
    {
        return $this->hasOne(Category::class, 'parent_id')->where('left', '<', $this->right);
    }

    public function rightChild()
    {
        return $this->hasOne(Category::class, 'parent_id')->where('right', '>', $this->left);
    }

   

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
