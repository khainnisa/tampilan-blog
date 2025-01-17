<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $primaryKey = 'id';

    public $fillable = [
        'title',
        'slug',
        'content',
        'category_id'
    ];


    protected function casts()
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime'
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function createUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $count = Blog::where('slug', 'like', $slug.'%')->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }

}
