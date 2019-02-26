<?php declare(strict_types=1);

namespace App\Components\Subscribers\Http\Requests;

use App\Components\Subscribers\Http\Rules\HostDomainActive;
use App\Components\Subscribers\SubscribersManager;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreSubscriber
 *
 * @package App\Components\Subscribers\Http\Requests
 */
class StoreSubscriber extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'unique:subscribers',
                new HostDomainActive(),
            ],
            'name' => 'required',
            'state' => [Rule::in(SubscribersManager::STATES)],
            'fields.*.id' => 'exists:fields|required_with:fields.*.value',
            'fields.*.value' => 'filled',
        ];
    }
}