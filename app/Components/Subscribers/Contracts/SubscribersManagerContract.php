<?php
/**
 * Created by PhpStorm.
 * User: julius
 * Date: 19.2.21
 * Time: 22.08
 */

namespace App\Components\Subscribers\Contracts;


use App\Components\Subscribers\Models\Subscriber;
use Illuminate\Support\Collection;

/**
 * Interface SubscribersManagerContract
 *
 * @package App\Components\Subscribers\Contracts
 */
interface SubscribersManagerContract
{
    /**
     * @param Collection $data
     *
     * @return Subscriber
     */
    public function createSubscriber(Collection $data): Subscriber;

    /**
     * @param Collection $data
     * @param Subscriber $subscriber
     *
     * @return Subscriber
     */
    public function updateSubscriber(
        Collection $data,
        Subscriber $subscriber
    ): Subscriber;

    /**
     * @param Subscriber $subscriber
     *
     * @return void
     */
    public function deleteSubscriber(Subscriber $subscriber);

}
