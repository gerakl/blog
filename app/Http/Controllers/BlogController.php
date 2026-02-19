<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('user')->latest()->paginate(10);
        
        if (request()->wantsJson()) {
            return response()->json($blogs);
        }
        
        return view('blogs.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        $blog->load('user');

        if (request()->wantsJson()) {
            return response()->json([
                'blog' => $blog,
                'formatted_content' => nl2br(e($blog->content)),
            ]);
        }

        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blog->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Blog updated successfully!',
                'blog' => $blog
            ]);
        }

        return redirect()->route('blog.show', $blog)->with('success', 'Blog updated successfully!');
    }

    public function getData(Blog $blog)
    {
        return response()->json([
            'title' => $blog->title,
            'content' => nl2br(e($blog->content)),
            'updated_at' => $blog->updated_at->toIso8601String(),
        ]);
    }
}
