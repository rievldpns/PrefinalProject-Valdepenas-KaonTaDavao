<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use Illuminate\Http\Request;

class EateryController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $districtId = $request->query('district');
        $featureName = $request->query('feature');

        $eateries = Eatery::with(['district', 'features'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($inner) use ($q) {
                    $inner->where('name', 'like', "%{$q}%")
                        ->orWhere('specialty', 'like', "%{$q}%");
                });
            })
            ->when($districtId, fn ($query) => $query->where('district_id', $districtId))
            ->when($featureName, function ($query) use ($featureName) {
                $query->whereHas('features', fn ($f) => $f->where('name', $featureName));
            })
            ->orderBy('name')
            ->paginate(6)
            ->withQueryString(); 

        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.index', compact('eateries', 'districts', 'features'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function show(Eatery $eatery)
    {
        $eatery->load([
            'district',
            'features',
            'permit',
            'dishes',
            'reviews' => fn ($query) => $query->latest(),
            'reviews.user',
        ]);

        return view('eateries.show', compact('eatery'));
    }

    public function edit(Eatery $eatery)
    {
       
    }

    public function update(Request $request, Eatery $eatery)
    {
        
    }

    public function destroy(Eatery $eatery)
    {
        
    }
}