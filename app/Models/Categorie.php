<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\News;

class Categorie extends Model
{
    use HasFactory;

    public function parent()
    {
        return $this->belongsTo(Categorie::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Categorie::class, 'parent_id');
    }

    public function news()
    {
        return $this->belongsToMany(News::class);
    }

    public function getAllchildren($categories = [])
    {
        foreach ($this->children as $child) {
            $categories[] = $child;
            $categories = $child->getAllchildren($categories);
        }

        return $categories;
    }
}
