<?php

namespace Tests\Unit;

use App\Components\Subscribers\FieldsManager;
use App\Components\Subscribers\Models\Field;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FieldTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testFieldCreatesCorrectly() {
        $this->beginDatabaseTransaction();

        /** @var Field $field */
        $field = factory(Field::class)->create([
            'title' => 'Zip code',
            'tag' => str_slug('Zip code'),
            'type' => FieldsManager::TYPE_NUMBER
        ]);
        $field->refresh();

        $this->assertEquals('Zip code', $field->title);
        $this->assertEquals(FieldsManager::TYPE_NUMBER, $field->type);
        $this->assertEquals(str_slug('Zip code'), $field->tag);
    }

    /** @test */
    public function testFieldTagIsNotEmpty() {
        $this->beginDatabaseTransaction();

        /** @var Field $field */
        $field = factory(Field::class)->create([
            'title' => 'Zip code',
            'type' => FieldsManager::TYPE_NUMBER
        ]);
        $field->refresh();

        $this->assertNotEmpty($field->tag);
    }


}
