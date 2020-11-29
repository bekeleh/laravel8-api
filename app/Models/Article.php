<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Article
 * @package App\Models
 *
 * @property int author_id,
 * @property string title,
 * @property string slug,
 * @property string body,
 * @property Carbon created_at,
 * @property Carbon updated_at,
 * @property Carbon deleted_at,
 *
 */
class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'author_id',
        'title',
        'slug',
        'body',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
