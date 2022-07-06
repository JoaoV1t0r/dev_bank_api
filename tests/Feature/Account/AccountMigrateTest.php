<?php

namespace Tests\Feature\Account;

use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountMigrateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_should_table_exist()
    {
        $this->assertTrue(Schema::hasTable('accounts'));
    }

    /**
     * @test
     */
    public function it_should_columns_exists(): void
    {
        $this->assertTrue(
            Schema::hasColumns('accounts', [
                'id',
                'uuid',
                'user_id',
                'number',
                'password',
                'balance',
                'created_at',
                'updated_at',
                'deleted_at',
            ])
        );
    }
}
