<?php declare(strict_types=1);

namespace App\Components\Subscribers;


use App\Components\Subscribers\Contracts\FieldsRepositoryContract;
use App\Components\Subscribers\Contracts\SubscribersManagerContract;
use App\Components\Subscribers\Models\Subscriber;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

/**
 * Class SubscribersManager
 *
 * @package App\Components\Subscribers
 */
class SubscribersManager implements SubscribersManagerContract
{
    const STATE_ACTIVE = 'active';
    const STATE_UNSUBSCRIBE = 'unsubscribe';
    const STATE_JUNK = 'junk';
    const STATE_BOUNCED = 'bounced';
    const STATE_UNCONFIRMED = 'unconfirmed';

    const STATES
        = [
            self::STATE_ACTIVE,
            self::STATE_BOUNCED,
            self::STATE_JUNK,
            self::STATE_UNCONFIRMED,
            self::STATE_UNSUBSCRIBE,
        ];

    /** @var FieldsRepositoryContract */
    protected $fieldRepository;

    public function __construct(
        FieldsRepositoryContract $fieldsRepository
    ) {
        $this->fieldRepository = $fieldsRepository;
    }

    /**
     * @param Collection $data
     *
     * @return Subscriber
     */
    public function createSubscriber(Collection $data): Subscriber
    {
        $subscriber = new Subscriber();

        // make subscriber active by default
        if (!$data->has('state')) {
            $data['state'] = self::STATE_ACTIVE;
        }

        $subscriber->fill($data->toArray());
        $subscriber->save();
        if ($data->has('fields')) {
            $this->attachFieldsToSubscriber($subscriber, $data->get('fields'));
        }
        $subscriber->load('fields');

        return $subscriber;
    }

    /**
     * @param Collection $data
     * @param Subscriber $subscriber
     *
     * @return Subscriber
     */
    public function updateSubscriber(
        Collection $data,
        Subscriber $subscriber
    ): Subscriber {
        $subscriber->fill($data->toArray());

        $this->attachFieldsToSubscriber($subscriber, $data->get('fields'));

        $subscriber->update();

        return $subscriber;
    }

    /**
     * @param Subscriber $subscriber
     *
     * @throws \Exception
     */
    public function deleteSubscriber(Subscriber $subscriber): void
    {
        $subscriber->fields()->detach();
        $subscriber->delete();
    }

    /**
     * @param Subscriber $subscriber
     * @param array      $fields
     */
    public function attachFieldsToSubscriber(
        Subscriber $subscriber,
        array $fields
    ): void {
        $subscriber->fields()->detach();
        foreach ($fields as $data) {
            if (!array_key_exists('value', $data)) {
                continue;
            }
            try {
                $field = $this->fieldRepository->getById($data['id']);
            } catch (ModelNotFoundException $exception) {
                continue;
            }
            $subscriber->fields()
                ->attach($field->id, ['value' => $data['value']]);
        }
    }
}
