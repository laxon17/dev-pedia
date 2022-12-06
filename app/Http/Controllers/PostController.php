<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    final public function index(): View
    {
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'user'])
            )->paginate(10)->withQueryString()
        ]);
    }

    final public function getPosts()
    {
        return response()->json([
            'posts' => Post::with(['category', 'user'])->latest()->filter(
                request(['search', 'category', 'user'])
            )->paginate(10)->withQueryString()
        ]);
    }

    final public function show(string $slug): View
    {
        return view('posts.show', [
            'post' => Post::where('slug', $slug)->firstOrFail(),
        ]);
    }

    final public function create()
    {
        return view('posts.create', [
            'categories' => Category::all()
        ]);
    }

    final public function store()
    {
        $attributes = request()
            ->merge(['slug' => '', 'excerpt' => '', 'user_id' => ''])
            ->validate([
                'title' => ['required', 'string', 'min:3', 'max:255'],
                'body' => ['required', 'string', 'min:50'],
                'category_id' => ['required', 'exists:categories,id'],
                'slug' => ['unique:posts,slug'],
                'excerpt' => ['min:15'],
                'user_id' => ['exists:users,id']
            ]);
        
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails', 'public');

        $post = Post::create($attributes);

        return redirect(
            route('posts.show', [
                'post' => $post->slug
            ])
        )->with('success', 'Post created successfully!');
    }

    final public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    final public function update(Post $post)
    {
        $this->authorize('update', $post);
        
        $attributes = request()
            ->merge(['slug' => '', 'excerpt' => ''])
            ->validate([
                'title' => ['required', 'string', 'min:3', 'max:255'],
                'body' => ['required', 'string', 'min:50'],
                'category_id' => ['required', 'exists:categories,id'],
                'slug' => ['unique:posts,slug'],
                'excerpt' => ['min:15'],
                'user_id' => ['exists:users,id']
            ]);
        
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails', 'public');
        $attributes['slug'] = Str::slug($attributes['title']);
        $attributes['excerpt'] = Str::words($attributes['body'], 20);

        $post->update($attributes);

        return redirect(
            route('posts.show', [
                'post' => $post->slug
            ])
        )->with('success', 'Post updated successfully!');
    }

    final public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        
        if($post->thumbnail !== 'thumbnails/default.png') {
            unlink('storage/' . $post->thumbnail);
        }
        
        $post->delete();

        return redirect(route('home'))->with(['success' => 'Post deleted successfully!']);
    }
}
