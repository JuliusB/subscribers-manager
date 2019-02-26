<?php
/**
 * Created by PhpStorm.
 * User: julius
 * Date: 19.2.21
 * Time: 22.08
 */

namespace App\Components\Subscribers\Contracts;


use Illuminate\Contracts\Pagination\Paginator;

/**
 * Interface SubscriberRepositoryContract
 *
 * @package App\Components\Subscribers\Contracts
 */
interface SubscriberRepositoryContract
{
    /**
     * @param int|null $perPage
     *
     * @return Paginator
     */
    public function getSubscribersList(int $perPage = null): Paginator;

}
