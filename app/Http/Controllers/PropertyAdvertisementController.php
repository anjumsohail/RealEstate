<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Resources\PropertyAdvertisementResource;
use App\Models\PropertyAdvertisement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;



class PropertyAdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = PropertyAdvertisement::with('user.businessProfile');
        if (Auth::user()->role !== 'Admin') {
            $query->where('user_id', Auth::id());
        }
        return PropertyAdvertisementResource::collection($query->get());
    }

    public function add()
    {
        return view('pages.propertyadd');
    }

    public function MapSearch()
    {
        return view('pages.MapSearch');
    }

    public function store(Request $request)
    {
        
        //dd($request->all());  // pauses execution and shows data
        //$data = $request->validated();
        $data = $request->all();
        $data['user_id'] = Auth::id();
        dd($data);  // pauses execution and shows data
        $property = PropertyAdvertisement::create($data);

// Save pictures if uploaded
    if ($request->hasFile('pictures')) {
        foreach ($request->file('pictures') as $index => $file) {
            $path = $file->store('property_images', 'public');

            $property->pictures()->create([
                'title'      => $request->picture_titles[$index] ?? null,
                'image_path' => $path,
            ]);
        }
    }

        
        return new PropertyAdvertisementResource($property->load('user.businessProfile'));
    }

    public function show(PropertyAdvertisement $propertyAdvertisement)
    {
        if (Auth::user()->role !== 'Admin' && Auth::id() !== $propertyAdvertisement->user_id) {
            abort(403, 'Unauthorized');
        }
        return new PropertyAdvertisementResource($propertyAdvertisement->load('user.businessProfile'));
    }

    public function update(StorePropertyRequest $request, PropertyAdvertisement $propertyAdvertisement)
    {
        if (Auth::user()->role !== 'Admin' && Auth::id() !== $propertyAdvertisement->user_id) {
            abort(403, 'Unauthorized');
        }
        $propertyAdvertisement->update($request->validated());
        return new PropertyAdvertisementResource($propertyAdvertisement->load('user.businessProfile'));
    }

    public function destroy(PropertyAdvertisement $propertyAdvertisement)
    {
        if (Auth::user()->role !== 'Admin' && Auth::id() !== $propertyAdvertisement->user_id) {
            abort(403, 'Unauthorized');
        }
        $propertyAdvertisement->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }

       public function search(Request $request)
    {
        $query = PropertyAdvertisement::query();

        // Filter by purpose (sale/rent)
        if ($request->filled('purpose')) {
            $query->where('purpose', $request->purpose);
        }

        // Filter by category (Residential/Commercial)
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by type (Plot/Home/Apartment/Portion/Cottage)
        if ($request->filled('proptype')) {
            $query->where('proptype', $request->proptype);
        }

        // Filter by city
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Get results
        $properties = $query->paginate(10);

        // Return to a view (replace 'properties.search_results' with your blade file)
        return view('properties.search_results', compact('properties'));
    }

}
