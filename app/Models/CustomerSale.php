<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class CustomerSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_ref',
        'part_number',
        'date'
    ];

    public function setDateAttribute($value)
    {

        $this->attributes['date'] = Carbon::createFromFormat('d/m/Y', $value);

    }

    public function products(): BelongsTo
    {

        return $this->belongsTo(Product::class);

    }

    public function customers(): BelongsTo
    {

        return $this->belongsTo(Customer::class);

    }

    public function scopeTopCategory($query)
    {

        return  $query
            ->select('part_number', DB::raw('COUNT(part_number) as occurrences' ))
            ->orderBy('occurrences', 'desc')
            ->having('occurrences', '>', 1)
            ->groupBy('part_number')
            ->limit(1);
    }

    public function scopeTopProduct($query)
    {

        return  $query
         ->select('part_number', DB::raw('COUNT(part_number) as occurrences' ))
         ->orderBy('occurrences', 'desc')
         ->having('occurrences', '>', 1)
         ->groupBy('part_number')
         ->limit(1);

    }


    public function scopeWorstProduct($query)
    {

        // this is not a true representation of a 'worst' product as there is many products with 1
        // purchases
        return  $query
            ->select('part_number', DB::raw('COUNT(part_number) as occurrences' ))
            ->orderBy('occurrences', 'asc')
            ->having('occurrences', '>', 0)
            ->groupBy('part_number')
            ->limit(1);
    }


    public function scopeChartByMonth($query)
    {

        return  $query
            ->select(DB::raw(
            "COUNT(part_number) as occurrences, DATE_FORMAT(date, '%Y %M') as month"))
            ->orderBy('month', 'asc')
            ->groupBy('month');

    }
}
