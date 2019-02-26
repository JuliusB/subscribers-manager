<?php
/**
 * Created by PhpStorm.
 * User: julius
 * Date: 19.2.21
 * Time: 22.08
 */

namespace App\Components\Subscribers\Contracts;


use App\Components\Subscribers\Models\Field;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Interface FieldsRepositoryContract
 *
 * @package App\Components\Subscribers\Contracts
 */
interface FieldsRepositoryContract
{
    /**
     * @param null $perPage
     *
     * @return Paginator
     */
    public function getFieldsList($perPage = null): Paginator;

    /**
     * @param int $id
     *
     * @return Field
     * @throws ModelNotFoundException
     */
    public function getById(int $id): Field;

}
