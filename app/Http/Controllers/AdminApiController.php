<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Product;
use App\Models\NewsFeed;
use App\Models\Promotion;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\NewsFeedRequest;
use App\Http\Requests\PromotionRequest;

class AdminApiController extends Controller
{
    private function handleImageUpload(Request $request, &$validated)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }
        unset($validated['image']);
    }

    // === FEEDBACKS ===
    public function getFeedbacks()
    {
        return response()->json(
            Feedback::orderBy('created_at', 'desc')->get()
        );
    }

    // === CATEGORIES ===
    public function getCategories()
    {
        return response()->json(Category::all()->map(function($cat) {
            $cat->image_url = $cat->icon_path;
            return $cat;
        }));
    }

    public function storeCategory(CategoryRequest $request)
    {
        $validated = $request->validated();
        $this->handleImageUpload($request, $validated);
        if (isset($validated['image_url'])) {
            $validated['icon_path'] = $validated['image_url'];
        }
        $category = Category::create($validated);
        $category->image_url = $category->icon_path;
        Cache::flush();
        return response()->json($category, 201);
    }
    
    public function updateCategory(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $validated = $request->validated();
        $this->handleImageUpload($request, $validated);
        if (isset($validated['image_url'])) {
            $validated['icon_path'] = $validated['image_url'];
        }
        $category->update($validated);
        $category->image_url = $category->icon_path;
        Cache::flush();
        return response()->json($category);
    }
    
    public function destroyCategory($id)
    {
        Category::findOrFail($id)->delete();
        Cache::flush();
        return response()->json(null, 204);
    }

    // === PRODUCTS (Menu Items) ===
    public function getProducts()
    {
        return response()->json(Product::with('category')->get());
    }

    public function storeProduct(ProductRequest $request)
    {
        $validated = $request->validated();
        
        $this->handleImageUpload($request, $validated);
        $validated['description'] = $validated['description'] ?? '';
        $validated['tag'] = $validated['tag'] ?? '';

        // Populate required fields that might not be in the form
        $validated['price_it_coins'] = 0;
        $validated['cashback_percent'] = 0;
        $validated['is_active'] = true;

        $item = Product::create($validated);
        Cache::flush();
        return response()->json($item, 201);
    }

    public function updateProduct(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validated();
        
        $this->handleImageUpload($request, $validated);
        $validated['description'] = $validated['description'] ?? '';
        $validated['tag'] = $validated['tag'] ?? '';
        
        $product->update($validated);
        Cache::flush();
        return response()->json($product);
    }

    public function destroyProduct($id)
    {
        Product::findOrFail($id)->delete();
        Cache::flush();
        return response()->json(null, 204);
    }

    // === NEWS FEED ===
    public function getNews()
    {
        return response()->json(NewsFeed::all());
    }

    public function storeNews(NewsFeedRequest $request)
    {
        $validated = $request->validated();
        
        $this->handleImageUpload($request, $validated);
        $validated['description'] = $validated['description'] ?? '';

        $validated['type'] = $validated['type'] ?? 'info';
        $validated['is_active'] = $validated['is_active'] ?? true;

        $news = NewsFeed::create($validated);
        return response()->json($news, 201);
    }

    public function updateNews(NewsFeedRequest $request, $id)
    {
        $news = NewsFeed::findOrFail($id);
        $validated = $request->validated();
        
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

    public function storePromotion(PromotionRequest $request)
    {
        $validated = $request->validated();
        
        $this->handleImageUpload($request, $validated);
        $validated['description'] = $validated['description'] ?? '';

        $promo = Promotion::create($validated);
        return response()->json($promo, 201);
    }

    public function updatePromotion(PromotionRequest $request, $id)
    {
        $promo = Promotion::findOrFail($id);
        $validated = $request->validated();
        
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
