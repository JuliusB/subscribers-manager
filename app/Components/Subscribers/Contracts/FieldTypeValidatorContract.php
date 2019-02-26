<?php declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: julius
 * Date: 19.2.21
 * Time: 22.08
 */

namespace App\Components\Subscribers\Contracts;

/**
 * Interface FieldsManagerContract
 *
 * @package App\Components\Subscribers\Contracts
 */
interface FieldTypeValidatorContract
{
    /**
     * @param mixed $value
     * @param int   $id
     *
     * @return boolean
     */
    public function validate(int $id, $value): bool;

}
