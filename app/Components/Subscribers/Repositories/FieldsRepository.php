<?php declare(strict_types=1);

namespace App\Components\Subscribers\Repositories;


use App\Components\Subscribers\Contracts\FieldsRepositoryContract;
use App\Components\Subscribers\Models\Field;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class FieldsRepository
 *
 * @package App\Components\Subscribers\Repositories
 */
class FieldsRepository implements FieldsRepositoryContract
{

    /**
     * @param null $perPage
     *
     * @return Paginator
     */
    public function getFieldsList($perPage = null): Paginator
    {
        return Field::with([])->paginate($perPage);
    }

    /**
     * @param int $id
     *
     * @return Field
     * @throws ModelNotFoundException
     */
    public function getById(int $id): Field
    {
        $field = Field::find($id);
        if (!$field) {
            throw new ModelNotFoundException('Field not found');
        }

        return $field;
    }
}
