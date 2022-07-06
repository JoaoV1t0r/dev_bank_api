<?php

namespace Tests\Feature\Address;

use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressMigrateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_should_table_exist()
    {
        $this->assertTrue(Schema::hasTable('addresses'));
    }

    /**
     * @test
     */
    public function it_should_columns_exists(): void
    {
        $this->assertTrue(
            Schema::hasColumns('addresses', [
                'id',
                'uuid',
                'user_id',
                'street',
                'number',
                'complement',
                'neighborhood',
                'city',
                'state',
                'zip_code',
                'created_at',
                'updated_at',
            ])
        );
    }
}
