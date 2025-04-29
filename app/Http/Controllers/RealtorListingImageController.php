<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing)
     {
         return inertia(
             'Realtor/ListingImage/Create',
             ['listing' => $listing]
         );
     }
 
     public function store(Listing $listing, Request $request)
     {
         if($request->hasFile('images')){
             foreach($request->file('images') as $image){
                $path = $image->store('images','public');
                $listing->images()->create([
                    'filename' => $path
                ]);
            }
         }
         return redirect()->back()->with('success', 'Images uploaded successfully.');
     }
}
