<?php

namespace Tests\Feature\Deposit;

use Tests\TestCase;
use App\Models\Deposit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepositModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_should_model_exist()
    {
        $this->assertTrue(class_exists(\App\Models\Deposit::class));
    }

    /**
     * @test
     */
    public function it_should_deposit_model_has_soft_delete(): void
    {
        $this->assertTrue(method_exists(\App\Models\Deposit::class, 'bootSoftDeletes'));
    }

    /**
     * @test
     */
    public function it_should_has_fillable_attributes(): void
    {
        $this->assertEquals(
            [
                'uuid',
                'user_id',
                'account_id',
                'amount',
                'created_at',
                'updated_at',
                'deleted_at',
            ],
            (new Deposit)->getFillable()
        );
    }

    /**
     * @test
     */
    public function it_should_has_table(): void
    {
        $this->assertTrue(property_exists(Deposit::class, 'table'));
    }

    /**
     * @test
     */
    public function it_should_create_factory(): void
    {
        $deposit = Deposit::factory()->create();

        $this->assertInstanceOf(Deposit::class, $deposit);
        $this->assertDatabaseHas('deposits', $deposit->toArray());
    }

    /**
     * @test
     */
    public function it_should_belongs_to_account(): void
    {
        $relashionship = (new \App\Models\Deposit())->account();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relashionship);
    }
}
