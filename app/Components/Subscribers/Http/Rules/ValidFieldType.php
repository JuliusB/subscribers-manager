<?php declare(strict_types=1);

namespace App\Components\Subscribers\Http\Rules;

use App\Components\Subscribers\Contracts\FieldTypeValidatorContract;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

/**
 * Class HostDomainActive
 *
 * @package App\Components\Subscribers\Http\Rules
 */
class ValidFieldType implements Rule
{
    /** @var FieldTypeValidatorContract  */
    protected $validator;

    /** @var  */
    protected $request;

    /**
     * ValidFieldType constructor.
     *
     * @param FieldTypeValidatorContract $validator
     * @param Request                    $request
     */
    public function __construct(
        FieldTypeValidatorContract $validator,
        Request $request
    )
    {
        $this->validator = $validator;
        $this->request = $request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $fields = $this->request->get('fields');

        foreach ($fields as $field) {
            if (array_key_exists('value', $field)) {
                if(!$this->validator->validate($field['id'], $field['value'])) {
                    return false;
                };
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return "Incorrect field value type";
    }
}
