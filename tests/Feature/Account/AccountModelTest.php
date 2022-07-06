<?php

namespace Tests\Feature\Account;

use Tests\TestCase;
use App\Models\Account;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountModelTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_model_exist()
    {
        $this->assertTrue(class_exists(\App\Models\Account::class));
    }

    /**
     * @test
     */
    public function it_should_account_model_has_soft_delete(): void
    {
        $this->assertTrue(method_exists(\App\Models\Account::class, 'bootSoftDeletes'));
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
                'number',
                'password',
                'balance',
            ],
            (new Account)->getFillable()
        );
    }

    /**
     * @test
     */
    public function it_should_has_table(): void
    {
        $this->assertTrue(property_exists(Account::class, 'table'));
    }

    /**
     * @test
     */
    public function it_should_create_factory(): void
    {
        $account = Account::factory()->create();

        $this->assertInstanceOf(Account::class, $account);
        $this->assertDatabaseHas('accounts', $account->toArray());
    }

    /**
     * @test
     */
    public function it_should_belongs_to_user(): void
    {
        $relashionship = (new \App\Models\Account())->user();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $relashionship);
    }

    /**
     * @test
     */
    public function it_should_has_many_transfers(): void
    {
        $relashionship = (new \App\Models\Account())->transfers();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relashionship);
    }

    /**
     * @test
     */
    public function it_should_has_many_deposits(): void
    {
        $relashionship = (new \App\Models\Account())->deposits();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relashionship);
    }
}
