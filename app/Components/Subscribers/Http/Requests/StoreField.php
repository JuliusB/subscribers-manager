<?php declare(strict_types=1);

namespace App\Components\Subscribers\Http\Requests;

use App\Components\Subscribers\FieldsManager;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreField
 *
 * @package App\Components\Subscribers\Http\Requests
 */
class StoreField extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:fields',
            'type' => ['required', Rule::in(FieldsManager::TYPES)],
        ];
    }
}
