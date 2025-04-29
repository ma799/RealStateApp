<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RealtorListingController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(Request $request)
    {
        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by','order'])
        ];
        return inertia(
            'Realtor/index',
            [
                'filters' => $filters,
                'listings' => Auth::user()->listings()
                ->realtorFilter($filters)
                ->paginate(6)
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
            'Realtor/create'
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
        return redirect()->route('realtor.listing.index')->with('success','listing created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
       return inertia(
        'Realtor/edit',
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
            
        return redirect()->route('realtor.listing.index')->with('success','listing updated successfully');
    }

    public function restore(Listing $listing)
    {
        $listing->restore();
        return redirect()->back()->with('success','listing restored successfully');
    }

    public function destroy(Listing $listing)
    {
        $listing->deleteOrFail();
        return redirect()->back()->with('success','listing deleted successfully');
    }

}
