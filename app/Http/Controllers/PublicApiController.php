<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Feedback;

class PublicApiController extends Controller
{
    /**
     * GET /api/categories
     * Public list of categories with icon_path
     */
    public function getCategories()
    {
        $categories = Category::select('id', 'name', 'icon_path')->get();
        return response()->json($categories);
    }

    /**
     * GET /api/catalog/products
     * Public product list; supports ?tag=top for highlights
     */
    public function getProducts(Request $request)
    {
        $query = Product::with('category')->select(
            'id', 'name', 'description', 'price_uah', 'image_url', 'tag', 'category_id'
        );

        if ($request->has('tag') && $request->tag !== '') {
            $query->where('tag', $request->tag);
        }

        return response()->json($query->get());
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
