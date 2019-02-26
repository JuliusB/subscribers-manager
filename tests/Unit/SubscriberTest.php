<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriberTest extends TestCase
{
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
}
