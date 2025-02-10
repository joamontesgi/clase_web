<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Item;

class ItemsControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_returns_items()
    {
        Item::factory()->count(10)->create();
        $response = $this->getJson('/api/items');
        $response->assertJsonCount(10, 'data');
        $response->assertStatus(200);
    }

    public function test_store_creates_new_item()
    {
        $data = [
            'category_id' => 8,
            'name' => 'new item',
            'description' => 'new item description',
            'base_stock' => 10,
            'min_stock' => 5,
            'stock' => 10,
            'photo' => 'https://via.placeholder.com/150',
        ];

        $response = $this->postJson('/api/items', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('items', $data);
    }

    public function test_show_returns_single_item()
    {
        $item = Item::factory()->create();
        $response = $this->get("/api/items/{$item->id}");
        $response->assertStatus(200);
        $response->assertJson([
            'id' => $item->id,
            'name' => $item->name,
        ]);
    }

    public function test_update_modifies_existing_item()
    {
        $item = Item::factory()->create();

        $updatedData = [
            'category_id' => 8,
            'name' => 'Updated Item',
            'description' => 'Updated Item Description',
            'base_stock' => 20,
            'min_stock' => 10,
            'stock' => 20,
            'photo' => 'https://via.placeholder.com/150',
        ];

        $response = $this->patchJson("/api/items/{$item->id}", $updatedData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('items', $updatedData);
    }

    public function test_delete_removes_item()
    {
        $item = Item::factory()->create();

        $response = $this->delete("/api/items/{$item->id}");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('items', ['id' => $item->id]);
    }
}
