<?php 

namespace App\Models;

// use Illuminate\Support\Arr;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // protected $table = 'table_posts'; // protected $table jika nama table dengan model berbeda
    // protected $primarykey = 'blog_id'; // protected $primarykey jika field pertama tidak menggunakan 'id'
    // aturan penggunaan protected lengkap di dokumentasi laravel bagian eloquent

    protected $with = ['author', 'category'];
    // $with buat memperhemat jumlah query (eager loading default)
    protected $fillable = ['title', 'author_id', 'category_id', 'slug', 'body'];
    // $fillable buat allowed insert data ke database lewat php artisan tinker
    // $guarded kebalikannya, cuma field itu aja yang tidak boleh insert lewat tinker
    
    public function author(): BelongsTo { // function untuk membuat relasi antara model dengan tabel
        return $this->belongsTo(User::class);
    } // Lihat dokumentasi laravel11 eloquent relationship belongsto

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter(Builder $query, array $filter): void {
        $query->when(
        $filter['search'] ?? false, 
        fn ($query, $search)=>
            $query->where('title', 'like', '%' . $search . '%')
        );

        $query->when(
            $filter['category'] ?? false,
            fn($query, $category) =>
            $query->whereHas('category', fn ($query) => 
            $query->where('slug', $category))
        );

        $query->when(
            $filter['author'] ?? false,
            fn($query, $author) =>
            $query->whereHas('author', fn ($query) => 
            $query->where('username', $author))
        );
    }
}