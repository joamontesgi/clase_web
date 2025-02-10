<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;

class CategoriesControllerTest extends TestCase
{
    public function test_index_returns_categories()
    {
        Category::factory()->count(3)->create(); // Crear 3 categorías
        $response = $this->getJson('/api/categories'); // Realizar petición GET a la ruta /api/categories
        $response->assertJsonCount(3, 'data'); // Verificar que se retornan 3 categorías
        $response->assertStatus(200); // Verificar que la respuesta tiene un estado 200
    }

    public function test_store_creates_new_category()
    {
        $data = [
            'name' => 'nueva',
        ]; // Datos de la nueva categoría

        $response = $this->postJson('/api/categories', $data);  // Realizar petición POST a la ruta /api/categories
        $response->assertStatus(201); // Verificar que la respuesta tiene un estado 201
        $this->assertDatabaseHas('categories', $data); // Verificar que la categoría se ha creado en la base de datos
    }

    public function test_show_returns_single_category()
    {
        $category = Category::factory()->create(); // Crear una categoría
        $response = $this->get("/api/categories/{$category->id}");  // Realizar petición GET a la ruta /api/categories/{id}
        $response->assertStatus(200); // Verificar que la respuesta tiene un estado 200
        $response->assertJson([
            'id' => $category->id,
            'name' => $category->name,
        ]); // Verificar que la respuesta contiene los datos de la categoría
    }

    public function test_update_modifies_existing_category()
    {
        $category = Category::factory()->create();

        $updatedData = [
            'name' => 'Updated Category',
        ];

        $response = $this->patchJson("/api/categories/{$category->id}", $updatedData); // Realizar petición PATCH a la ruta /api/categories/{id}
        $response->assertStatus(200); // Verificar que la respuesta tiene un estado 200
        $this->assertDatabaseHas('categories', $updatedData); // Verificar que la categoría se ha actualizado en la base de datos
    }

    public function test_delete_removes_category()
    {
        $category = Category::factory()->create();

        $response = $this->delete("/api/categories/{$category->id}"); // Realizar petición DELETE a la ruta /api/categories/{id}
        $response->assertStatus(200); // Verificar que la respuesta tiene un estado 200
        $this->assertDatabaseMissing('categories', ['id' => $category->id]); // Verificar que la categoría se ha eliminado de la base de datos
    }

}
