<?php

namespace App\Http\Controllers;


use App\Models\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TownRequest;

class TownController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
    {
        $query = Town::with(['city', 'sectors.blocks']);

        // Optional filter by parent:
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->input('city_id'));
        }

        return $query->get();
    }

    public function store(TownRequest $request)
    {
        $town = Town::create($request->validated());
        return $town->load(['city', 'sectors.blocks']);
    }

    public function show(Town $town)
    {
        return $town->load(['city', 'sectors.blocks']);
    }

    public function update(TownRequest $request, Town $town)
    {
        $town->update($request->validated());
        return $town->load(['city', 'sectors.blocks']);
    }

    public function destroy(Town $town)
    {
        $this->ensureAdmin();
        $town->delete();
        return response()->noContent();
    }

    protected function ensureAdmin(): void
    {
       if (!Auth::check() || Auth::user()->role !== 'Admin') {
        abort(403, 'Forbidden');
    }
    }
}
