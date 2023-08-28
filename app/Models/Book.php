<?php

namespace App\Models;

use App\Events\BookCreated;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Events\BookCreated;

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
 * @property-read BookLog|null $bookLog
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
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();

        static::created(function ($book) {
            event(new BookCreated($book));
        });
    }
}
