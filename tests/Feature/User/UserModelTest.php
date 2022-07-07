<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_model_exist()
    {
        $this->assertTrue(class_exists(\App\Models\User::class));
    }

    /**
     * @test
     */
    public function it_should_user_model_has_soft_delete(): void
    {
        $this->assertTrue(method_exists(\App\Models\User::class, 'bootSoftDeletes'));
    }

    /**
     * @test
     */
    public function it_should_has_fillable_attributes(): void
    {
        $this->assertEquals(
            [
                'uuid',
                'name',
                'email',
                'password',
                'created_at',
                'updated_at',
                'deleted_at',
            ],
            (new User)->getFillable()
        );
    }

    /**
     * @test
     */
    public function it_should_has_table(): void
    {
        $this->assertTrue(property_exists(User::class, 'table'));
    }

    /**
     * @test
     */
    public function it_should_create_factory(): void
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', $user->toArray());
    }

    /**
     * @test
     */
    public function it_should_belongs_to_account(): void
    {
        $relashionship = (new \App\Models\User())->account();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relashionship);
    }
}
