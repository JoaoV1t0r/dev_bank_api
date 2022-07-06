<?php

namespace Tests\Feature\Transfer;

use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransferMigrateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_should_table_exist()
    {
        $this->assertTrue(Schema::hasTable('transfers'));
    }

    /**
     * @test
     */
    public function it_should_columns_exists(): void
    {
        $this->assertTrue(
            Schema::hasColumns('transfers', [
                'id',
                'uuid',
                'origin_account',
                'destination_account',
                'amount',
                'created_at',
                'updated_at',
            ])
        );
    }
}
