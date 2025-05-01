<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing)
     {
        $listing->load('images');
         return inertia(
             'Realtor/ListingImage/Create',
             ['listing' => $listing]
         );
     }
 
     public function store(Listing $listing, Request $request)
     {
            $request->validate([
                'images.*' => 'mimes:jpg,jpeg,png,webp|max:5528', // 2MB max
            ],[
                'images.*.mimes' => 'The image must be a file of type: jpg, jpeg, png, webp.',
                'images.*.max' => 'The image must not be greater than 5MB.',
            ]
        );
         if($request->hasFile('images')){
             foreach($request->file('images') as $image){
                $path = $image->store('images','public');
                $listing->images()->create([
                    'filename' => $path
                ]);
            }
         }
        return  redirect()->back()->with('success', 'Images uploaded successfully.');
     }

     public function destroy(Listing $listing, ListingImage $image)
     {
         $listing->images()->find($image->id)->delete();
         Storage::disk('public')->delete($image->filename);
         return redirect()->back()->with('success', 'Image deleted successfully.');
     }
}
