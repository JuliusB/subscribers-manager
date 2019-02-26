<?php declare(strict_types=1);

namespace App\Components\Subscribers;


use App\Components\Subscribers\Contracts\FieldsManagerContract;
use App\Components\Subscribers\Models\Field;
use Illuminate\Support\Collection;

/**
 * Class FieldsManager
 *
 * @package App\Components\Subscribers
 */
class FieldsManager implements FieldsManagerContract
{

    const TYPE_STRING = 'string';
    const TYPE_DATE = 'date';
    const TYPE_NUMBER = 'number';
    const TYPE_BOOLEAN = 'boolean';

    const TYPES
        = [
            self::TYPE_DATE,
            self::TYPE_NUMBER,
            self::TYPE_STRING,
            self::TYPE_BOOLEAN,
        ];

    /**
     * @param Collection $data
     *
     * @return Field
     */
    public function createField(Collection $data): Field
    {
        $field = new Field();
        $field->fill($data->toArray());
        $field->tag = str_slug($field->title);
        $field->save();

        return $field;
    }

    /**
     * @param Collection $data
     * @param Field      $field
     *
     * @return Field
     */
    public function updateField(Collection $data, Field $field): Field
    {
        $field->fill($data->toArray());
        $field->tag = str_slug($field->title);
        $field->update();

        return $field;
    }

    /**
     * @param Field $field
     *
     * @throws \Exception
     */
    public function deleteField(Field $field)
    {
        $field->delete();
    }
}
