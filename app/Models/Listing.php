<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['beds', 'baths', 'area', 'city', 'code', 'street', 'street_nb', 'price','sold_at' ];
    protected $orderKeys = ['created_at', 'price'];

    public function owner() : BelongsTo {
        return $this->belongsTo(
            User::class,
            'by_user_id'
        );
    }

    public function images() : HasMany {
        return $this->hasMany(
            ListingImage::class
        );
    }
    public function offers() : HasMany {
        return $this->hasMany(
            Offer::class,
            'listing_id'
        );
    }









    //      Scopes


    public function scopeMostRecent(Builder $query) : Builder {
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


    public function scopeRealtorFilter(Builder $query, array $filters) : Builder {
        return $query->when($filters['deleted'] ?? false,
                            fn($query) => $query->withTrashed()
                            )->when($filters['by'] ?? false,
                        fn($query, $by) => !in_array($by, $this->orderKeys) ? $query->orderBy('created_at', 'desc') :
                        $query->orderBy($by, $filters['order'] ?? 'desc'));

    }


    public function scopeWithoutSold(Builder $query): Builder
    {
        // return $query->doesntHave('offers')
        //     ->orWhereHas(
        //         'offers',
        //         fn (Builder $query) => $query->whereNull('accepted_at')
        //             ->whereNull('rejected_at')
        //     );

        return $query->whereNull('sold_at');
    }

}
