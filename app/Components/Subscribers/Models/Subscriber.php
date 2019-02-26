<?php declare(strict_types=1);

namespace App\Components\Subscribers\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Subscriber
 *
 * @package        App\Components\Subscribers
 *
 * @property string                                                                                    $state
 * @property string                                                                                    $email
 * @property int                                                                                       $id
 * @property string                                                                                    $name
 * @property Carbon                                                                                    $created_at
 * @property-read  \Illuminate\Database\Eloquent\Collection|\App\Components\Subscribers\Models\Field[] $fields
 */
class Subscriber extends Model
{
    const PIVOT_FIELDS_TABLE = 'subscriber_fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'email',
            'name',
            'state',
        ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fields(): BelongsToMany
    {
        return $this->belongsToMany(Field::class, self::PIVOT_FIELDS_TABLE)
            ->withPivot('value');
    }
}
