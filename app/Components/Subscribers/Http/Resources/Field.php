<?php declare(strict_types=1);

namespace App\Components\Subscribers\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Field
 *
 * @package App\Components\Subscribers\Http\Resources
 * @mixin \App\Components\Subscribers\Models\Field
 */
class Field extends JsonResource
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
            'title' => $this->title,
            'type' => $this->type,
            'tag' => $this->tag,
            'value' => $this->whenPivotLoaded('subscriber_fields', function () {
                return $this->pivot->value;
            }),
        ];
    }
}
