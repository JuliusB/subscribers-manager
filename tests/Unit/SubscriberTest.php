<?php

namespace Tests\Unit;

use App\Components\Subscribers\Contracts\FieldsRepositoryContract;
use App\Components\Subscribers\Contracts\SubscribersManagerContract;
use App\Components\Subscribers\Models\Field;
use App\Components\Subscribers\Models\Subscriber;
use App\Components\Subscribers\SubscribersManager;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriberTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testHostDomainValidation()
    {
        $response = $this->json('POST', '/api/subscribers',
            [
                'email' => 'testEmail@asdqwdqwd.com',
                'name' => 'TestName',
                'state' => 'unconfirmed'
            ]
        );

        $response
            ->assertStatus(422)
            ->assertJsonFragment(['Email domain is not active.']);
    }

    /** @test */
    public function testInvalidEmailValidation()
    {
        $response = $this->json('POST', '/api/subscribers',
            [
                'email' => 'invalidemail.com',
                'name' => 'TestName',
                'state' => 'unconfirmed'
            ]
        );

        $response
            ->assertStatus(422)
            ->assertJsonFragment(['The email must be a valid email address.']);
    }

    /** @test */
    public function testSubscriberCreatesCorrectly() {
        $this->beginDatabaseTransaction();

        /** @var Subscriber $subscriber */
        $subscriber = factory(Subscriber::class)->create([
            'email' => 'validEmail@gmail.com',
            'name' => 'TestName',
            'state' => SubscribersManager::STATE_ACTIVE
        ]);
        $subscriber->refresh();

        $this->assertEquals('validEmail@gmail.com', $subscriber->email);
        $this->assertEquals('TestName', $subscriber->name);
        $this->assertEquals(SubscribersManager::STATE_ACTIVE, $subscriber->state);
    }

    /** @test */
    public function testFieldGetsAttachedToSubscriber() {
        $this->beginDatabaseTransaction();
        $this->refreshDatabase();

        /** @var SubscribersManagerContract $subscribersManager */
        $subscribersManager= $this->app->make(SubscribersManagerContract::class);

        /** @var FieldsRepositoryContract $fieldsRepository */
        $fieldsRepository = $this->app->make(FieldsRepositoryContract::class);

        /** @var Field $field */
        factory(Field::class, 5)->create();

        $fields = $fieldsRepository->getFieldsList();

        /** @var Subscriber $subscriber */
        $subscriber = factory(Subscriber::class)->create([
            'email' => 'validEmail@gmail.com',
            'name' => 'TestName',
            'state' => SubscribersManager::STATE_ACTIVE
        ]);

        $data = [];
        foreach ($fields as $field) {
            $data[] = ['id' => $field->id, 'value' => 'random'];
        }


        $subscribersManager->attachFieldsToSubscriber($subscriber, $data);

        $this->assertCount(count($data), $subscriber->fields);
    }


}
