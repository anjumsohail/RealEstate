<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SectorRequest;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
    {
        $query = Sector::with(['town.city', 'blocks']);

        // Optional filter by parent:
        if ($request->filled('town_id')) {
            $query->where('town_id', $request->input('town_id'));
        }

        return $query->get();
    }

    public function store(SectorRequest $request)
    {
        $sector = Sector::create($request->validated());
        return $sector->load(['town.city', 'blocks']);
    }

    public function show(Sector $sector)
    {
        return $sector->load(['town.city', 'blocks']);
    }

    public function update(SectorRequest $request, Sector $sector)
    {
        $sector->update($request->validated());
        return $sector->load(['town.city', 'blocks']);
    }

    public function destroy(Sector $sector)
    {
        $this->ensureAdmin();
        $sector->delete();
        return response()->noContent();
    }

    protected function ensureAdmin(): void
    {
              if (!Auth::check() || Auth::user()->role !== 'Admin') {
        abort(403, 'Forbidden');
    }
    }
}
