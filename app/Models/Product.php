<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;

    protected $primaryKey = 'part_number';

    public $incrementing = false;

    protected $fillable = [
        'part_number',
        'description',
        'category',
        'sub_category'
    ];

    public function customerSales(): HasMany
    {

        return $this->hasMany(CustomerSale::class);

    }
}
