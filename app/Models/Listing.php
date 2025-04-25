<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = ['beds', 'baths', 'area', 'city', 'code', 'street', 'street_nb', 'price'];

    public function owner() : BelongsTo {
        return $this->belongsTo(
            \App\Models\User::class,
            'by_user_id'
        );
    }

    public function scopeLatest(Builder $query) : Builder {
        return $query->latest();
    }

    public function scopeFilter(Builder $query, array $filters) : Builder {
       return $query->when($filters['priceFrom'] ?? false,
            fn($query, $priceFrom) => $query->where('price', '>=', $priceFrom))
            ->when($filters['priceTo'] ?? false,
                fn($query, $priceTo) => $query->where('price', '<=', $priceTo))
                ->when($filters['beds'] ?? false,
                    fn($query, $beds) => $query->where('beds', (int)$beds < 6 ? '=' : ">=" , $beds))
                    ->when($filters['baths'] ?? false,
                        fn($query, $baths) => $query->where('baths',(int)$baths < 6 ? '=' : ">=" , $baths))
                        ->when($filters['areaFrom'] ?? false,
                            fn($query, $areaFrom) => $query->where('area', '>=', $areaFrom))
                            ->when($filters['areaTo'] ?? false,
                                fn($query, $areaTo) => $query->where('area', '<=', $areaTo));
    }

}
