<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;
use App\Services\Slug;
Use Image;

class PropertiesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::paginate(1);
        return view('properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasRole('admin')) {
            return view('properties.create');
        } else {
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Services\Slug  $slug
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Slug $slug)
    {
        if (auth()->user()->hasRole('admin')) {

            $attributes = $request->validate([
                'name' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
                'description' => 'required',
                'available_on' => 'required|date',
                'rating' => 'required|between:1,5',
                'price' => 'required|numeric',
                'country' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $property = new Property();
            $property->name = $request->name;
            $property->description = $request->description;
            $property->available_on = $request->available_on;
            $property->rating = $request->rating;
            $property->price = $request->price;
            $property->country = $request->country;
            $property->slug = $slug->createSlug($request->name);
            $property->admin_id = auth()->user()->id;

            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('/images/' . $filename);
                Image::make($image)->resize(800, 400)->save($location);
                $property->photo = $filename;
            }

            $property->save();
            return redirect("/properties/" . $property->slug);
        } else {
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $property = Property::where('slug', $slug)->firstOrFail();
        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //check if user is an admin
        if (auth()->user()->hasRole('admin')) {
            //show them the edit form
            $property = Property::where('slug', $slug)->firstOrFail();
            return view('properties.edit', compact('property'));
        } else {
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Slug $slug)
    {

        if (auth()->user()->hasRole('admin')) {

            $property = Property::findOrFail($id);
            $attributes = $request->validate([
                'name' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
                'description' => 'required',
                'available_on' => 'required|date',
                'rating' => 'required|between:1,5',
                'price' => 'required|numeric',
                'country' => 'required|max:255|regex:/^[\pL\s\-]+$/u',
            ]);

            $property->name = $request->name;
            $property->description = $request->description;
            $property->available_on = $request->available_on;
            $property->rating = $request->rating;
            $property->price = $request->price;
            $property->country = $request->country;
            $property->slug = $slug->createSlug($request->name);
            $property->admin_id = auth()->user()->id;

            if ($request->hasFile('photo')) {
                $imageValidation = $request->validate([
                   'photo' =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
                $image = $request->file('photo');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('/images/' . $filename);
                Image::make($image)->resize(800, 400)->save($location);
                $property->photo = $filename;
            }

            $property->save();
            return redirect("/properties/" . $property->slug);
        } else {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->hasRole('admin')) {
            Property::where('id', $id)->delete();
            return redirect('/properties');
        } else {
            return back();
        }
    }
}
