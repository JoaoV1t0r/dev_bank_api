<?php

namespace Tests\Feature\Address;

use Tests\TestCase;
use App\Models\Address;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddressModelTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_model_exist()
    {
        $this->assertTrue(class_exists(\App\Models\Address::class));
    }

    /**
     * @test
     */
    public function it_should_address_model_has_soft_delete(): void
    {
        $this->assertTrue(method_exists(\App\Models\Address::class, 'bootSoftDeletes'));
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
                'street',
                'city',
                'state',
                'zip',
                'country',
            ],
            (new Address)->getFillable()
        );
    }

    /**
     * @test
     */
    public function it_should_has_table(): void
    {
        $this->assertTrue(property_exists(Address::class, 'table'));
    }

    /**
     * @test
     */
    public function it_should_create_factory(): void
    {
        $address = Address::factory()->create();

        $this->assertDatabaseHas(
            'addresses',
            [
                'uuid' => $address->uuid,
                'user_id' => $address->user_id,
                'street' => $address->street,
                'city' => $address->city,
                'state' => $address->state,
                'zip' => $address->zip,
                'country' => $address->country,
            ]
        );
    }

    /**
     * @test
     */
    public function it_should_belongs_to_user(): void
    {
        $relashionship = (new \App\Models\Address())->user();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relashionship);
    }
}
