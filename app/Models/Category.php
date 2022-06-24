<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Todo;

class Category extends Model
{
    use HasFactory;

    // A partir de una categoria, retorna todos a los q ella pertenece
    public function todos()
    {
        return $this->HasMany(Todo::class);
    }
}
