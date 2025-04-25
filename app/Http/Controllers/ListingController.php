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
        $query = Listing::orderByDesc('created_at');
        $filters = $request->only(['priceFrom' ,'priceTo' , 'beds' ,'baths' ,'areaFrom' , 'areaTo' ]);
        
        if($filters['priceFrom'] ?? false){
            $query->where('price','>=',$filters['priceFrom']);
        }
      
        if($filters['priceTo'] ?? false){
            $query->where('price','<=',$filters['priceTo']);
        }

        if($filters['beds'] ?? false){
            $query->where('beds',$filters['beds']);
        }
      
        if($filters['baths'] ?? false){
            $query->where('baths',$filters['baths']);
        }

        if($filters['areaFrom'] ?? false){
            $query->where('area','>=',$filters['areaFrom']);
        }
      
        if($filters['areaTo'] ?? false){
            $query->where('area','<=',$filters['areaTo']);
        }

        return inertia(
            'Listing/index',[
                'filters' => $filters,
                'listings' => $query->paginate(10)
                     ->withQueryString()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia(
            'Listing/create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->user()->listings()->create(
           $request->validate([
                'beds' => 'integer|min:1|max:20|required',
                'baths' => 'integer|min:1|max:20|required',
                'area' => 'integer|min:50|max:1500|required',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nb' => 'integer|min:1|max:20|required',
                'price' => 'integer|min:50000|max:200000000|required',
                ])

        );
        return redirect()->route('listing.index')->with('success','listing created successfully');
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


        return inertia(
            'Listing/show',
            ['listing' => $listing]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
       return inertia(
        'Listing/edit',
        ['listing' => $listing]
       );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {

       $listing->update(
            $request->validate([
                'beds' => 'integer|min:1|max:20|required',
                'baths' => 'integer|min:1|max:20|required',
                'area' => 'integer|min:50|max:1500|required',
                'city' => 'required',
                'code' => 'required',
                'street' => 'required',
                'street_nb' => 'integer|min:1|max:20|required',
                'price' => 'integer|min:50000|max:200000000|required',
                ])
            );
            
        return redirect()->route('listing.index')->with('success','listing updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect()->back()->with('success','listing deleted successfully');
    }
}
