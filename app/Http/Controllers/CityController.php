<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Http\Requests\CityRequest;


class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return City::with('towns.sectors.blocks')->get();
    }

    public function store(CityRequest $request)
    {
        return City::create($request->validated());
    }

    public function show(City $city)
    {
        return $city->load('towns.sectors.blocks');
    }

    public function update(CityRequest $request, City $city)
    {
        $city->update($request->validated());
        return $city;
    }

    public function destroy(City $city)
    {
        $city->delete();
        return response()->noContent();
    }
}
