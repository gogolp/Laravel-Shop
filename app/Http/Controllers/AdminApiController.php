<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Product;
use App\Models\NewsFeed;
use App\Models\Promotion;

class AdminApiController extends Controller
{
    private function handleImageUpload(Request $request, &$validated)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }
    }

    // === CATEGORIES ===
    public function getCategories()
    {
        return response()->json(Category::all());
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|max:5120',
        ]);
        $this->handleImageUpload($request, $validated);
        if (isset($validated['image_url'])) {
            $validated['icon_path'] = $validated['image_url'];
            unset($validated['image_url']);
        }
        $category = Category::create($validated);
        return response()->json($category, 201);
    }
    
    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|max:5120',
        ]);
        $this->handleImageUpload($request, $validated);
        if (isset($validated['image_url'])) {
            $validated['icon_path'] = $validated['image_url'];
            unset($validated['image_url']);
        }
        $category->update($validated);
        return response()->json($category);
    }
    
    public function destroyCategory($id)
    {
        Category::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    // === PRODUCTS (Menu Items) ===
    public function getProducts()
    {
        return response()->json(Product::with('category')->get());
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_uah' => 'required|numeric',
            'tag' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
        ]);
        
        $this->handleImageUpload($request, $validated);
        $validated['description'] = $validated['description'] ?? '';
        $validated['tag'] = $validated['tag'] ?? '';

        // Populate required fields that might not be in the form
        $validated['price_it_coins'] = 0;
        $validated['cashback_percent'] = 0;
        $validated['is_active'] = true;

        $item = Product::create($validated);
        return response()->json($item, 201);
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_uah' => 'required|numeric',
            'tag' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
        ]);
        
        $this->handleImageUpload($request, $validated);
        $validated['description'] = $validated['description'] ?? '';
        $validated['tag'] = $validated['tag'] ?? '';
        
        $product->update($validated);
        return response()->json($product);
    }

    public function destroyProduct($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    // === NEWS FEED ===
    public function getNews()
    {
        return response()->json(NewsFeed::all());
    }

    public function storeNews(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'image' => 'nullable|image|max:5120',
        ]);
        
        $this->handleImageUpload($request, $validated);
        $validated['description'] = $validated['description'] ?? '';

        $validated['type'] = 'info';
        $validated['is_active'] = true;

        $news = NewsFeed::create($validated);
        return response()->json($news, 201);
    }

    public function updateNews(Request $request, $id)
    {
        $news = NewsFeed::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'image' => 'nullable|image|max:5120',
        ]);
        
        $this->handleImageUpload($request, $validated);
        $validated['description'] = $validated['description'] ?? '';
        
        $news->update($validated);
        return response()->json($news);
    }

    public function destroyNews($id)
    {
        NewsFeed::findOrFail($id)->delete();
        return response()->json(null, 204);
    }

    // === PROMOTIONS ===
    public function getPromotions()
    {
        return response()->json(Promotion::all());
    }

    public function storePromotion(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'valid_until' => 'nullable|date',
            'image' => 'nullable|image|max:5120',
        ]);
        
        $this->handleImageUpload($request, $validated);
        $validated['description'] = $validated['description'] ?? '';

        $promo = Promotion::create($validated);
        return response()->json($promo, 201);
    }

    public function updatePromotion(Request $request, $id)
    {
        $promo = Promotion::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'valid_until' => 'nullable|date',
            'image' => 'nullable|image|max:5120',
        ]);
        
        $this->handleImageUpload($request, $validated);
        $validated['description'] = $validated['description'] ?? '';
        
        $promo->update($validated);
        return response()->json($promo);
    }

    public function destroyPromotion($id)
    {
        Promotion::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
