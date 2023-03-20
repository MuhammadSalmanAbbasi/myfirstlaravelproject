<?php

namespace App\Http\Controllers;

use App\Models\listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{

//  Common Resources Routes
// index - Show All Resources
// show - Show Single Listing
// create - Show form to create new listing
// store -  Store new listing
// edit - Show form to edit listing
//  update - Update Existing listing
//  destroy - Delete Listing


    //Showing all Listing here
    public function index(){
        // dd(request('tag'));
        return view('listings.index', [
            'listings' => Listing::latest()->filter
            (request(['tag' , 'search']))->paginate(6)
        ]);
    }

    //  Shwing Single Listing Here
    public function show(listing $listing){
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    public function create() {
        return view('listings.create');
    }

    // Store Listing Data
    public function store(Request $request){
        // dd($request->file('logo'));

        // // dd($request->all());
        $formFieleds = $request->validate([
            'name' => ['required', Rule::unique('listings','name')],
            'title' => 'required',
            'company' => ['required', Rule::unique('listings','company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFieleds['logo'] = $request->file('logo')->store('logos','public');
        }

        $formFieleds['user_id'] = auth()->id();
        // dd($formFieleds);
        Listing ::create($formFieleds);

        return redirect ('/')->with('message', 'listing created Successfully !');
    }

    // Show Edit Form
    public function edit(Listing $listing){
        return view('listings.edit',['listing' => $listing]);
    }



      // Update Listing Data
    public function update(Request $request, Listing $listing)
    {
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }


        // dd($request->$id);
        $formFieleds = $request->validate([
            'name' => 'required',
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFieleds['logo'] = $request->file('logo')->store('logos','public');
        }
    //    dd($formFieleds);
       $listing->update($formFieleds);

        return back()->with('message', 'listing Updated Successfully!');
    }


    // Delete Listing
    public function destroy(Listing $listing) {
         // Make sure logged in user is owner
         if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $listing->delete();
        return redirect('/')->with('message', "Listing deleted successfully");
    }

    // Manage Listings
    public function manage() {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
