<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BlockRequest;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        $query = Block::with(['sector.town.city']);

        // Optional filter by parent:
        if ($request->filled('sector_id')) {
            $query->where('sector_id', $request->input('sector_id'));
        }

        return $query->get();
    }

    public function store(BlockRequest $request)
    {
        $block = Block::create($request->validated());
        return $block->load(['sector.town.city']);
    }

    public function show(Block $block)
    {
        return $block->load(['sector.town.city']);
    }

    public function update(BlockRequest $request, Block $block)
    {
        $block->update($request->validated());
        return $block->load(['sector.town.city']);
    }

    public function destroy(Block $block)
    {
        $this->ensureAdmin();
        $block->delete();
        return response()->noContent();
    }

    protected function ensureAdmin(): void
    {
                      if (!Auth::check() || Auth::user()->role !== 'Admin') {
        abort(403, 'Forbidden');
    }
    }
}
