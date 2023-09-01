<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'is_published',
        'deleted_at',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function scopeCategoryId(Builder $query, $categoryId = null)
    {
        if ($categoryId) {
            return $query->whereRelation('categories', 'category_id', $categoryId);
        }
    }

    public function scopeCategoryName(Builder $query, $categoryName = null)
    {
        if ($categoryName) {
            $category = Category::query()
                ->where('name', $categoryName)
                ->first();

            if ($category) {
                return $query->whereRelation('categories', 'category_id', $category->id);

            }

            return $query;
        }
    }
}
