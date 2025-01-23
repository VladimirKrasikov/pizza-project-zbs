<?php

namespace Tests\Feature;

use App\Models\Drink;
use App\Models\Pizza;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppTest extends TestCase
{
    use RefreshDatabase, WithFaker;


    public function test_pizzas_index_success()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('pizzas.index'));
        $response->assertStatus(200);
        $response->assertSee('Список пицц');
    }

    public function test_pizzas_index_unauthenticated()
    {
        $response = $this->get(route('pizzas.index'));
        $response->assertStatus(302);
        $response->assertRedirect('/login');

    }

    public function test_pizzas_create_success()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('pizzas.create'));
        $response->assertStatus(200);
        $response->assertSee('Создание пиццы');
    }

    public function test_pizzas_create_unauthenticated()
    {
        $response = $this->get(route('pizzas.create'));
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_pizzas_store_success()
    {
        $user = User::factory()->create();
        $pizza = Pizza::factory()->create();
        $response = $this->actingAs($user)->post(route('pizzas.store'), $pizza->toArray());
        $response->assertStatus(302);
        $this->assertDatabaseHas('pizzas', ['name' => $pizza->name]);
    }

    public function test_pizzas_store_unauthenticated()
    {
        $pizza = Pizza::factory()->make();
        $response = $this->post(route('pizzas.store'), $pizza->toArray());
        $response->assertStatus(302);
        $this->assertDatabaseMissing('pizzas', ['name' => $pizza->name]);
    }

    public function test_pizzas_update_not_found()
    {
        $user = User::factory()->create();
        $updatedPizza = Pizza::factory()->make();
        $response = $this->actingAs($user)->put(route('pizzas.update', 9999), $updatedPizza->toArray());
        $response->assertStatus(404);
    }

    public function test_pizzas_destroy_success()
    {
        $user = User::factory()->create();
        $pizza = Pizza::factory()->create();
        $response = $this->actingAs($user)->delete(route('pizzas.destroy', $pizza->id));
        $response->assertStatus(302);
        $this->assertDatabaseMissing('pizzas', ['id' => $pizza->id]);

    }

    public function test_pizzas_destroy_not_found()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->delete(route('pizzas.destroy', 9999));
        $response->assertStatus(404);
    }

    public function test_pizzas_show_not_found()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('pizzas.edit', 9999));
        $response->assertStatus(404);
    }


}

