<?php

namespace Tests\Feature\Deposit;

use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepositMigrateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_should_table_exist()
    {
        $this->assertTrue(Schema::hasTable('deposits'));
    }

    /**
     * @test
     */
    public function it_should_columns_exists(): void
    {
        $this->assertTrue(
            Schema::hasColumns('deposits', [
                'id',
                'amount',
                'account_id',
                'created_at',
                'updated_at',
            ])
        );
    }
}
