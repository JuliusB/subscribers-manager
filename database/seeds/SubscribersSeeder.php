<?php

use App\Components\Subscribers\Models\Subscriber;
use Illuminate\Database\Seeder;

class SubscribersSeeder extends Seeder
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

        factory(Subscriber::class, 15)
            ->create();
    }
}
