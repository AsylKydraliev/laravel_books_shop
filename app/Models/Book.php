<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $title
 * @property string $image
 * @property integer $price
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Category|null $category
 * @property-read Author|null $author
 *
 * @mixin Builder
 */
class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'description',
        'price',
        'image',
        'author_id',
        'category_id',
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
