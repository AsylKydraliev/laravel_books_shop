<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 * @property-read User|null $user
 * @property-read BookLog|null $logs
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

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function logs(): HasMany
    {
        return $this->hasMany(BookLog::class);
    }


    /**
     * @param Builder $query
     * @param array $data
     * @return void
     */
    public function scopeFilter(Builder $query, array $data = []): void
    {
        if (isset($data['title'])) {
            $query->where('title', 'like', '%' . $data['title'] . '%');
        }

        if (isset($data['description'])) {
            $query->where('description', 'like', '%' . $data['description'] . '%');
        }

        if (isset($data['price'])) {
            $query->where('price', 'like', '%' . $data['price'] . '%');
        }

        if (isset($data['category'])) {
            $category = $data['category'];
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('title', 'like', '%' . $category . '%');
            });
        }

        if (isset($data['author'])) {
            $author = $data['author'];
            $query->whereHas('author', function ($query) use ($author) {
                $query->where('name', 'like', '%' . $author . '%');
            });
        }
    }
}
