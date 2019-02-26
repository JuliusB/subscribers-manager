<?php declare(strict_types=1);

namespace App\Components\Subscribers\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Field
 *
 * @package App\Components\Subscribers\Models
 *
 * @property $id    int
 * @property $title string
 * @property $type  string
 * @property $tag   string
 * @property $pivot stdClass
 */
class Field extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'title',
            'type',
            'tag',
        ];
}
