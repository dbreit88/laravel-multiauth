<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Bitfumes\Multiauth\Model\Admin;
use Illuminate\Database\Eloquent\Factory;
use Faker\Generator as Faker;

abstract class MultiauthTestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setup()
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        $this->app->singleton(Factory::class, function ($app) {
            $faker = $app->make(Faker::class);
            return Factory::construct($faker, __DIR__ . ('/../vendor/bitfumes/laravel-multiauth/src/database/factories'));
        });
    }

    public function logInAdmin($args = [])
    {
        $admin = factory(Admin::class)->create($args);
        $this->actingAs($admin, 'admin');
    }
}
