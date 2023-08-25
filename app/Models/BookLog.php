<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $content
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read User|null $user
 * @property-read Book|null $bookLog
 *
 * @mixin Builder
 */
class BookLog extends Model
{
    protected $fillable = [
        'id',
        'book_id',
        'user_id',
        'content',
        'created_at',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
