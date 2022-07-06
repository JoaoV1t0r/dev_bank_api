<?php

namespace Tests\Feature\Transfer;

use Tests\TestCase;
use App\Models\Transfer;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransferModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_should_model_exist()
    {
        $this->assertTrue(class_exists(\App\Models\Transfer::class));
    }

    /**
     * @test
     */
    public function it_should_transfer_model_has_soft_delete(): void
    {
        $this->assertTrue(method_exists(\App\Models\Transfer::class, 'bootSoftDeletes'));
    }

    /**
     * @test
     */
    public function it_should_has_fillable_attributes(): void
    {
        $this->assertEquals(
            [
                'uuid',
                'origin_account',
                'destination_account',
                'amount',
                'created_at',
                'updated_at',
            ],
            (new Transfer)->getFillable()
        );
    }

    /**
     * @test
     */
    public function it_should_has_table(): void
    {
        $this->assertTrue(property_exists(Transfer::class, 'table'));
    }

    /**
     * @test
     */
    public function it_should_create_factory(): void
    {
        $transfer = Transfer::factory()->create();

        $this->assertInstanceOf(Transfer::class, $transfer);
        $this->assertDatabaseHas('transfers', $transfer->toArray());
    }

    /**
     * @test
     */
    public function it_should_belongs_to_origin_account(): void
    {
        $relashionship = (new \App\Models\Transfer())->originAccount();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relashionship);
    }

    /**
     * @test
     */
    public function it_should_belongs_to_destination_account(): void
    {
        $relashionship = (new \App\Models\Transfer())->destinationAccount();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relashionship);
    }
}
