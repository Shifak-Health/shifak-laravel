<?php

namespace App\Models;

use App\Http\Filters\DrugTypeFilter;
use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugType extends Model
{
    use Filterable;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'unit',
    ];

    /**
     * The model filter name.
     *
     * @var string
     */
    protected $filter = DrugTypeFilter::class;
}
