<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserMigrateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_should_table_exist()
    {
        $this->assertTrue(Schema::hasTable('users'));
    }

    /**
     * @test
     */
    public function it_should_columns_exists(): void
    {
        $this->assertTrue(
            Schema::hasColumns('users', [
                'id',
                'uuid',
                'name',
                'email',
                'password',
                'remember_token',
                'phone',
                'cpf',
                'rg',
                'created_at',
                'updated_at',
                'deleted_at',
            ])
        );
    }
}
