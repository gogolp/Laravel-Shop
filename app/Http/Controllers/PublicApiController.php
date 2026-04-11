<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Feedback;
use Illuminate\Support\Facades\Cache;

class PublicApiController extends Controller
{
    /**
     * GET /api/categories
     * Public list of categories with icon_path
     */
    public function getCategories()
    {
        $categories = Cache::remember('categories_public', 3600, function () {
            return Category::select('id', 'name', 'icon_path')->get();
        });
        
        return response()->json($categories);
    }

    /**
     * GET /api/catalog/products
     * Public product list; supports ?tag=top for highlights
     */
    public function getProducts(Request $request)
    {
        $tag = $request->query('tag', '');
        $cacheKey = 'products_public_' . ($tag ? 'tag_'.$tag : 'all');

        $products = Cache::remember($cacheKey, 3600, function () use ($tag) {
            $query = Product::with('category')->select(
                'id', 'name', 'description', 'price_uah', 'image_url', 'tag', 'category_id'
            );

            if ($tag !== '') {
                $query->where('tag', $tag);
            }

            return $query->get();
        });

        return response()->json($products);
    }

    /**
     * POST /api/feedback
     * Store a visitor feedback message
     */
    public function storeFeedback(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'nullable|string|max:100',
            'email'   => 'nullable|email|max:150',
            'message' => 'required|string|min:5|max:2000',
        ]);

        Feedback::create($validated);

        return response()->json(['success' => true, 'message' => 'Дякуємо за ваш відгук!']);
    }
}
