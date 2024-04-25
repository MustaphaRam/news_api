<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorie;
use Ramsey\Uuid\Uuid;

class News extends Model
{
    use HasFactory;

    public function __construct() 
    {
        $this->attributes['id'] = Uuid::uuid4()->toString();
    }
    
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function categories()
    {
        return $this->belongsToMany(Categorie::class);
    }
}
