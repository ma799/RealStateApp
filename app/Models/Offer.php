<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Offer extends Model
{
    protected $fillable = ['amount', 'accepted_at', 'rejected_at'];
 
    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    public function bidder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'bidder_id');
    }

   public function scopeByMe(Builder $query): Builder
     {
         return $query->where('bidder_id', Auth::user()?->id);
     }

     public function scopeExcept(Builder $query,$offerId) : Builder
     {
        return $query->where('id','!=',$offerId);
     }
}
