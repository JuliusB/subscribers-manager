<?php declare(strict_types=1);

namespace App\Components\Subscribers\Http\Requests;

use App\Components\Subscribers\FieldsManager;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateField
 *
 * @package App\Components\Subscribers\Http\Requests
 */
class UpdateField extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
        ];
    }
}
