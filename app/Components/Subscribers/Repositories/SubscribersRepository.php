<?php declare(strict_types=1);

namespace App\Components\Subscribers\Repositories;


use App\Components\Subscribers\Contracts\SubscriberRepositoryContract;
use App\Components\Subscribers\Models\Subscriber;
use Illuminate\Contracts\Pagination\Paginator;

/**
 * Class SubscribersRepository
 *
 * @package App\Components\Subscribers\Repositories
 */
class SubscribersRepository implements SubscriberRepositoryContract
{

    /**
     * @param int|null $perPage
     *
     * @return Paginator
     */
    public function getSubscribersList(int $perPage = null): Paginator
    {
        return Subscriber::with('fields')->paginate($perPage);
    }
}
