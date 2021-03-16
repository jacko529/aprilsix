<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Customer extends Model
{
    use HasFactory, Searchable;

    protected $primaryKey = 'ref';

    public $incrementing = false;

    protected $fillable = [
        'ref',
        'name',
        'email',
        'address'
    ];

    public function customerSales(): HasMany
    {

        return $this->hasMany(CustomerSale::class);

    }
}
