<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsFeedResource;
use App\Models\NewsFeed;
use Illuminate\Http\Request;

class NewsFeedController extends Controller
{
    /**
     * Display a listing of the resource (тільки активні).
     */
    public function index()
    {
        $news = NewsFeed::where('is_active', true)->latest()->get();

        return NewsFeedResource::collection($news);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'nullable|url|max:1024',
            'type' => 'nullable|in:promo,event,info',
            'is_active' => 'nullable|boolean',
        ]);

        $news = NewsFeed::create($validate);

        return new NewsFeedResource($news);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = NewsFeed::findOrFail($id);

        return new NewsFeedResource($news);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = NewsFeed::findOrFail($id);

        $validate = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'image_url' => 'nullable|url|max:1024',
            'type' => 'nullable|in:promo,event,info',
            'is_active' => 'nullable|boolean',
        ]);

        $news->update($validate);

        return new NewsFeedResource($news->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = NewsFeed::findOrFail($id);

        $news->delete();

        return response()->json([
            'success' => true,
            'message' => 'News deleted.',
        ]);
    }
}

