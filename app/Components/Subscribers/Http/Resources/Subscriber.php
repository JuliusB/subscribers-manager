<?php declare(strict_types=1);

namespace App\Components\Subscribers\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Components\Subscribers\Models\Subscriber as SubscriberModel;

/**
 * Class Subscriber
 *
 * @package App\Components\Subscribers\Http\Resources
 *
 * @mixin SubscriberModel
 */
class Subscriber extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'state' => $this->state,
            'created_at' => $this->created_at->toDateTimeString(),
            'fields' => Field::collection($this->fields),
        ];
    }
}
