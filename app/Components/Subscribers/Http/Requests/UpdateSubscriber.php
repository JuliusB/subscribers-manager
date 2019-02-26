<?php declare(strict_types=1);

namespace App\Components\Subscribers\Http\Requests;

use App\Components\Subscribers\Http\Rules\HostDomainActive;
use App\Components\Subscribers\Http\Rules\ValidFieldType;
use App\Components\Subscribers\SubscribersManager;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateSubscriber
 *
 * @package App\Components\Subscribers\Http\Requests
 */
class UpdateSubscriber extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => '',
            'state' => [Rule::in(SubscribersManager::STATES)],
            'fields.*.id' => 'exists:fields|required_with:fields.*.value',
            'fields.*.value' => ['filled', app()->make(ValidFieldType::class)],
        ];
    }
}
