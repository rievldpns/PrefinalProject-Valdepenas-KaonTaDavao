@php
    $selectedFeatures = old('features', $eatery ? $eatery->features->pluck('id')->all() : []);
    $input = 'h-10 w-full rounded-lg border border-forest/20 bg-white px-3 text-sm focus:border-forest focus:outline-none focus:ring-2 focus:ring-forest/15';
@endphp

<form method="POST" action="{{ $action }}" class="space-y-5 rounded-2xl border border-forest/10 bg-white p-6">
    @csrf
    @if (($method ?? 'POST') === 'PUT')
        @method('PUT')
    @endif

    @if ($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <p class="font-semibold">Please fix these first:</p>
            <ul class="mt-1 list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <label for="name" class="mb-1 block text-sm font-semibold">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $eatery?->name) }}" class="{{ $input }}">
        @error('name')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="district_id" class="mb-1 block text-sm font-semibold">District</label>
        <select id="district_id" name="district_id" class="{{ $input }}">
            <option value="">Choose a district</option>
            @foreach ($districts as $district)
                <option value="{{ $district->id }}" @selected(old('district_id', $eatery?->district_id) == $district->id)>{{ $district->name }}</option>
            @endforeach
        </select>
        @error('district_id')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="address" class="mb-1 block text-sm font-semibold">Address</label>
        <input type="text" id="address" name="address" value="{{ old('address', $eatery?->address) }}" class="{{ $input }}">
        @error('address')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="price_range" class="mb-1 block text-sm font-semibold">Price range</label>
        <select id="price_range" name="price_range" class="{{ $input }}">
            <option value="">Choose a price range</option>
            <option value="budget" @selected(old('price_range', $eatery?->price_range) == 'budget')>Budget (₱)</option>
            <option value="mid" @selected(old('price_range', $eatery?->price_range) == 'mid')>Mid (₱₱)</option>
            <option value="splurge" @selected(old('price_range', $eatery?->price_range) == 'splurge')>Splurge (₱₱₱)</option>
        </select>
        @error('price_range')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="specialty" class="mb-1 block text-sm font-semibold">Specialty</label>
        <input type="text" id="specialty" name="specialty" value="{{ old('specialty', $eatery?->specialty) }}" class="{{ $input }}">
        @error('specialty')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="flex items-center gap-2 text-sm font-semibold">
            <input type="checkbox" name="is_open" value="1" @checked(old('is_open', $eatery ? $eatery->is_open : true))>
            Open
        </label>
        @error('is_open')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <p class="mb-2 text-sm font-semibold">Features</p>
        <div class="flex flex-wrap gap-x-5 gap-y-2">
            @foreach ($features as $feature)
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="features[]" value="{{ $feature->id }}" @checked(in_array($feature->id, $selectedFeatures))>
                    {{ $feature->name }}
                </label>
            @endforeach
        </div>
        @error('features')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
        @error('features.*')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="permit_no" class="mb-1 block text-sm font-semibold">Permit number</label>
        <input type="text" id="permit_no" name="permit_no" value="{{ old('permit_no', $eatery?->permit?->permit_no) }}" placeholder="DVO-2026-0509" class="{{ $input }}">
        @error('permit_no')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="expires_on" class="mb-1 block text-sm font-semibold">Permit expiry date</label>
        <input type="date" id="expires_on" name="expires_on" value="{{ old('expires_on', $eatery?->permit?->expires_on?->format('Y-m-d')) }}" class="{{ $input }}">
        @error('expires_on')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex gap-2">
        <button type="submit" class="rounded-full bg-forest px-5 py-2 text-sm font-semibold text-lime hover:bg-forest/90">{{ $submitLabel }}</button>
        <a href="{{ route('eateries.index') }}" class="rounded-full border border-forest/30 px-5 py-2 text-sm font-semibold hover:bg-forest/5">Cancel</a>
    </div>
</form>