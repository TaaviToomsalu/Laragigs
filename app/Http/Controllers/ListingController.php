<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)]);
    }

    //Show single listing
            public function show(Listing $listing) {
                return view('listings.show', [
                    'listing' => $listing
                ]);
            }

    // Show create form 
    public function create() {
        return view('listings.create');
    }

    // Store listing data 
    public function store(Request $request){
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
                //listings - name of the table we are using, company - name of the field this should be unique for
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    //Show Edit Form 
    public function edit(Listing $listing){
        // dd($listing->title);
        return view('listings.edit', ['listing' => $listing]);
    }

    //Update Listing Data
    public function update(Request $request, Listing $listing){
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
                //listings - name of the table we are using, company - name of the field this should be unique for
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }
}