<?php

use App\Components\Subscribers\Models\Field;
use Illuminate\Database\Seeder;

class FieldsSeeder extends Seeder
{
    use \Illuminate\Foundation\Testing\WithFaker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setUpFaker();

        factory(Field::class, 8)
            ->create();
    }
}
