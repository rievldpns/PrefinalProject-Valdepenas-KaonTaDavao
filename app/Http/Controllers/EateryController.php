<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEateryRequest;
use App\Http\Requests\UpdateEateryRequest;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        return view('eateries.create', [
            'districts' => District::orderBy('name')->get(),
            'features' => Feature::orderBy('name')->get(),
        ]);
    }

    public function store(StoreEateryRequest $request)
    {
        $data = $request->validated();

        $eatery = Eatery::create([
            'district_id' => $data['district_id'],
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'address' => $data['address'],
            'price_range' => $data['price_range'],
            'specialty' => $data['specialty'] ?? null,
            'is_open' => $data['is_open'],
        ]);

        $eatery->permit()->create([
            'permit_no' => $data['permit_no'],
            'expires_on' => $data['expires_on'],
        ]);

        $eatery->features()->sync($data['features']);

        return redirect()->route('eateries.show', $eatery)->with('success', 'Eatery added.');
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

        // for the Reviewer select in the review form
        $users = User::orderBy('name')->get();

        return view('eateries.show', compact('eatery', 'users'));
    }

    public function edit(Eatery $eatery)
    {
        $eatery->load(['permit', 'features']);

        return view('eateries.edit', [
            'eatery' => $eatery,
            'districts' => District::orderBy('name')->get(),
            'features' => Feature::orderBy('name')->get(),
        ]);
    }

    public function update(UpdateEateryRequest $request, Eatery $eatery)
    {
        $data = $request->validated();

        $eatery->update([
            'district_id' => $data['district_id'],
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'address' => $data['address'],
            'price_range' => $data['price_range'],
            'specialty' => $data['specialty'] ?? null,
            'is_open' => $data['is_open'],
        ]);

        $eatery->permit()->updateOrCreate([], [
            'permit_no' => $data['permit_no'],
            'expires_on' => $data['expires_on'],
        ]);

        $eatery->features()->sync($data['features']);

        return redirect()->route('eateries.show', $eatery)->with('success', 'Eatery updated.');
    }

    public function destroy(Eatery $eatery)
    {
        $eatery->reviews()->delete();
        $eatery->dishes()->delete();
        $eatery->permit()->delete();
        $eatery->features()->detach();

        $eatery->delete();

        return redirect()->route('eateries.index')->with('success', 'Eatery deleted.');
    }
}