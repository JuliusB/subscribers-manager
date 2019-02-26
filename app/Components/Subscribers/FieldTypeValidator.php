<?php
/**
 * Created by PhpStorm.
 * User: julius
 * Date: 19.2.26
 * Time: 11.39
 */

namespace App\Components\Subscribers;


use App\Components\Subscribers\Contracts\FieldsRepositoryContract;
use App\Components\Subscribers\Contracts\FieldTypeValidatorContract;
use App\Components\Subscribers\Models\Field;
use DateTime;

class FieldTypeValidator implements FieldTypeValidatorContract
{
    /** @var FieldsRepositoryContract */
    protected $fieldsRepository;

    public function __construct(
        FieldsRepositoryContract $fieldsRepository
    ) {
        $this->fieldsRepository = $fieldsRepository;
    }

    /**
     * @param int   $id
     * @param mixed $value
     *
     * @return bool
     */
    public function validate(int $id, $value): bool
    {
        try {
            $field = $this->fieldsRepository->getById($id);
        } catch (\Exception $e) {
            return false;
        }

        switch ($field->type) {
            case FieldsManager::TYPE_BOOLEAN:
                {
                    return is_bool($value) || in_array($value, [0, 1, '0', '1']);
                }
            case FieldsManager::TYPE_DATE:
                {
                    $d = DateTime::createFromFormat('Y-m-d', $value);

                    return $d && $d->format('Y-m-d') === $value;
                }
            case FieldsManager::TYPE_NUMBER:
                {
                    return is_numeric($value);
                }
            case FieldsManager::TYPE_STRING:
                {
                    return is_string($value);
                }
        }

        return false;
    }
}
