<?php
/**
 * Created by PhpStorm.
 * User: julius
 * Date: 19.2.21
 * Time: 22.08
 */

namespace App\Components\Subscribers\Contracts;


use App\Components\Subscribers\Models\Field;
use Illuminate\Support\Collection;

/**
 * Interface FieldsManagerContract
 *
 * @package App\Components\Subscribers\Contracts
 */
interface FieldsManagerContract
{
    /**
     * @param Collection $data
     *
     * @return Field
     */
    public function createField(Collection $data): Field;

    /**
     * @param Collection $data
     * @param Field      $field
     *
     * @return Field
     */
    public function updateField(Collection $data, Field $field): Field;

    /**
     * @param Field $field
     *
     * @return void
     */
    public function deleteField(Field $field);

}
