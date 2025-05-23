<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Auth;
use Illuminate\Http\Request;

class ListingController extends Controller
{

    
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['priceFrom' ,'priceTo' , 'beds' ,'baths' ,'areaFrom' , 'areaTo' ]);
        
        return inertia(
            'Listing/index',[
                'filters' => $filters,
                'listings' => Listing::latest()
                ->withoutSold()
                ->filter($filters)
                ->paginate(10)
                ->withQueryString()
            ]
        );
    }

  
    
    // use AuthorizesRequests;
    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        // if(Auth::user()->cannot('view',$listing)){
        //     abort(403);
        // }
        // $this->authorize('view', $listing);

        $listing->load('images');
        $offer = !Auth::user() ?
        null : $listing->offers()->byMe()->first();
        return inertia(
            'Listing/show',
            [
                'listing' => $listing,
                'offerMade' => $offer
                ]
        );
    }

    
}
