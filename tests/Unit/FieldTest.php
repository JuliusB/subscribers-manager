<?php

namespace Tests\Unit;

use App\Components\Subscribers\Contracts\FieldTypeValidatorContract;
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
        $field = factory(Field::class)->create();
        $field->refresh();

        $this->assertNotEmpty($field->tag);
    }

    /** @test */
    public function testNumberFieldValidation() {
        /** @var FieldTypeValidatorContract $fieldsValidator */
        $fieldsValidator = $this->app->make(FieldTypeValidatorContract::class);

        $field = factory(Field::class)->create([
            'type' => FieldsManager::TYPE_NUMBER
        ]);

        $this->assertFalse($fieldsValidator->validate($field->id, 'string'));
        $this->assertTrue($fieldsValidator->validate($field->id, 123));
    }

    /** @test */
    public function testStringFieldValidation() {
        /** @var FieldTypeValidatorContract $fieldsValidator */
        $fieldsValidator = $this->app->make(FieldTypeValidatorContract::class);

        $field = factory(Field::class)->create([
            'type' => FieldsManager::TYPE_STRING
        ]);

        $this->assertFalse($fieldsValidator->validate($field->id, 123));
        $this->assertTrue($fieldsValidator->validate($field->id, 'string'));
    }

    /** @test */
    public function testDateFieldValidation() {
        /** @var FieldTypeValidatorContract $fieldsValidator */
        $fieldsValidator = $this->app->make(FieldTypeValidatorContract::class);

        $field = factory(Field::class)->create([
            'type' => FieldsManager::TYPE_DATE
        ]);

        $this->assertFalse($fieldsValidator->validate($field->id, '2013-13-01'));
        $this->assertFalse($fieldsValidator->validate($field->id, '2013-12-32'));
        $this->assertFalse($fieldsValidator->validate($field->id, '2013'));
        $this->assertTrue($fieldsValidator->validate($field->id, '2013-12-01'));
    }

    /** @test */
    public function testBooleanFieldValidation() {
        /** @var FieldTypeValidatorContract $fieldsValidator */
        $fieldsValidator = $this->app->make(FieldTypeValidatorContract::class);

        $field = factory(Field::class)->create([
            'type' => FieldsManager::TYPE_BOOLEAN
        ]);

        $this->assertFalse($fieldsValidator->validate($field->id, '2'));
        $this->assertTrue($fieldsValidator->validate($field->id, 0));
        $this->assertTrue($fieldsValidator->validate($field->id, 1));
        $this->assertTrue($fieldsValidator->validate($field->id, true));
        $this->assertTrue($fieldsValidator->validate($field->id, false));
        $this->assertTrue($fieldsValidator->validate($field->id, '1'));
        $this->assertTrue($fieldsValidator->validate($field->id, '0'));
    }
}
