<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CocktailService
{
    private $baseUrl = 'https://www.thecocktaildb.com/api/json/v1/1/';

    /**
     * Buscar cócteles por nombre
     */
    public function searchByName($name)
    {
        try {
            $response = Http::withoutVerifying()->get($this->baseUrl . 'search.php', [
                's' => $name
            ]);

            return $response->json()['drinks'] ?? [];
        } catch (\Exception $e) {
            \Log::error('Error searching cocktails: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtener cócteles aleatorios
     */
    public function getRandomCocktails($count = 12)
    {
        $cocktails = [];
        for ($i = 0; $i < $count; $i++) {
            try {
                $response = Http::withoutVerifying()->get($this->baseUrl . 'random.php');
                $drink = $response->json()['drinks'][0] ?? null;
                if ($drink) {
                    $cocktails[] = $drink;
                }
            } catch (\Exception $e) {
                \Log::error('Error fetching random cocktail: ' . $e->getMessage());
                continue;
            }
        }
        return $cocktails;
    }

    /**
     * Obtener cóctel por ID
     */
    public function getById($id)
    {
        try {
            $response = Http::withoutVerifying()->get($this->baseUrl . 'lookup.php', [
                'i' => $id
            ]);

            return $response->json()['drinks'][0] ?? null;
        } catch (\Exception $e) {
            \Log::error('Error fetching cocktail by ID: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Extraer ingredientes de la respuesta de la API
     */
    public function extractIngredients($drink)
    {
        $ingredients = [];

        for ($i = 1; $i <= 15; $i++) {
            $ingredient = $drink["strIngredient{$i}"] ?? null;
            $measure = $drink["strMeasure{$i}"] ?? null;

            if ($ingredient) {
                $ingredients[] = [
                    'ingredient' => $ingredient,
                    'measure' => $measure
                ];
            }
        }

        return $ingredients;
    }
}
