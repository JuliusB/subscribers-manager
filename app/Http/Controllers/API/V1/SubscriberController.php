<?php declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Components\Subscribers\Contracts\SubscriberRepositoryContract;
use App\Components\Subscribers\Contracts\SubscribersManagerContract;
use App\Components\Subscribers\Http\Requests\StoreSubscriber;
use App\Components\Subscribers\Http\Requests\UpdateSubscriber;
use App\Components\Subscribers\Http\Resources\Subscriber as SubscriberResource;
use App\Components\Subscribers\Models\Subscriber;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class SubscriberController
 *
 * @package App\Http\Controllers\API\V1
 */
class SubscriberController extends Controller
{
    /** @var SubscriberRepositoryContract */
    protected $subscriberRepository;

    /** @var SubscribersManagerContract */
    protected $subscribersManager;

    public function __construct(
        SubscriberRepositoryContract $subscriberRepository,
        SubscribersManagerContract $subscribersManager
    ) {
        $this->subscriberRepository = $subscriberRepository;
        $this->subscribersManager = $subscribersManager;
    }

    /**
     * @param Request $request
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $subscribers = $this->subscriberRepository->getSubscribersList((int) $request->get('per_page'));

        return SubscriberResource::collection($subscribers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSubscriber $request
     *
     * @return SubscriberResource
     */
    public function store(StoreSubscriber $request): SubscriberResource
    {
        $subscriber
            = $this->subscribersManager->createSubscriber(collect($request->validated()));

        return new SubscriberResource($subscriber);
    }

    /**
     * Display the specified resource.
     *
     * @param  Subscriber $subscriber
     *
     * @return SubscriberResource
     */
    public function show(Subscriber $subscriber)
    {
        return new SubscriberResource($subscriber);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSubscriber $request
     * @param  Subscriber       $subscriber
     *
     * @return SubscriberResource
     */
    public function update(
        UpdateSubscriber $request,
        Subscriber $subscriber
    ): SubscriberResource {
        $subscriber = $this->subscribersManager->updateSubscriber(
            collect($request->validated()),
            $subscriber
        );

        return new SubscriberResource($subscriber);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Subscriber $subscriber
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriber $subscriber)
    {
        try {
            $this->subscribersManager->deleteSubscriber($subscriber);
        } catch (\Exception $exception) {
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true]);
    }
}
