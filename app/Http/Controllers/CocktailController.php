<?php

namespace App\Http\Controllers;

use App\Models\Cocktail;
use App\Services\CocktailService;
use Illuminate\Http\Request;

class CocktailController extends Controller
{
    protected $cocktailService;

    public function __construct(CocktailService $cocktailService)
    {
        $this->cocktailService = $cocktailService;
    }

    /**
     * Vista principal: explorar cócteles de la API
     */
    public function index(Request $request)
    {
        $cocktails = [];
        $search = $request->input('search', '');

        if ($search) {
            $cocktails = $this->cocktailService->searchByName($search);
        } else {
            $cocktails = $this->cocktailService->getRandomCocktails(12);
        }

        return view('cocktails.index', compact('cocktails', 'search'));
    }

    /**
     * Guardar cóctel favorito en BD
     */
    public function store(Request $request)
    {
        $request->validate([
            'api_id' => 'required|string',
        ]);

        $apiCocktail = $this->cocktailService->getById($request->api_id);

        if (!$apiCocktail) {
            return response()->json(['success' => false, 'message' => 'Cocktail not found'], 404);
        }

        $ingredients = $this->cocktailService->extractIngredients($apiCocktail);

        Cocktail::updateOrCreate(
            [
                'api_id' => $request->api_id,
                'user_id' => auth()->id()
            ],
            [
                'name' => $apiCocktail['strDrink'],
                'category' => $apiCocktail['strCategory'],
                'glass' => $apiCocktail['strGlass'],
                'instructions' => $apiCocktail['strInstructions'],
                'image_url' => $apiCocktail['strDrinkThumb'],
                'ingredients' => json_encode($ingredients)
            ]
        );

        return response()->json(['success' => true, 'message' => 'Cocktail saved successfully']);
    }

    /**
     * Vista: Mis cócteles guardados (favoritos)
     */
    public function show()
    {
        $cocktails = auth()->user()->cocktails()->orderBy('created_at', 'desc')->get();
        return view('cocktails.favorites', compact('cocktails'));
    }

    /**
     * Eliminar cóctel favorito
     */
    public function destroy(Cocktail $cocktail)
    {
        $this->authorize('delete', $cocktail);
        $cocktail->delete();
        return response()->json(['success' => true, 'message' => 'Cocktail deleted successfully']);
    }
}
