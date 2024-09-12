<?php

namespace App\Models;

use App\Models\Relations\BranchRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    use BranchRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone',
        'address',
        'commercial_registration_number',
        'tax_number',
        'is_open',
        'lat',
        'lng',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'lat' => 'double',
        'lng' => 'double',
    ];

    /**
     * Determine whether the branch is open.
     *
     * @return bool
     */
    public function isOpen(): bool
    {
        return !!$this->is_open;
    }
}
