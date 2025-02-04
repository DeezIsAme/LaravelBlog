<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/about', function () {
    return view('about', ['name' => 'Ammar Hilmy'], ['title' => 'About']);
});

Route::get('/posts', function () {
    return view('posts', ['title' => 'Blog'], ['posts'
    => Post::filter(request(['search', 'category', 'author']))->latest()->paginate(9)->withQueryString()]);
});

Route::get('/posts/{post:slug}', function (Post $post) {
    // tidak menggunakan function find lagi karena menggunakan 'route model binding' (cari di dokumentasi laravel)
    // $post = Post::find($slug);

    return view('post', ['title' => $post['title'], 'post' => $post]);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});

Route::get('/authors/{user:username}', function (User $user) {
    // $posts = $user->posts->load('category', 'author');

    return view('posts', ['title' => count($user->posts) . ' Articles by ' . $user->name, 'posts' => $user->posts]);
    // 'title' => 'Articles by ' . $user->name untuk menampilkan judul yg dinamis sesuai nama user dari banyak post yang ditampilkane
});

Route::get('/categories/{category:slug}', function (Category $category) {
    // $posts = $category->posts->load('category', 'author');

    return view('posts', ['title' => count($category->posts) . ' Articles in: ' . $category->name, 'posts' => $category->posts]);
});
