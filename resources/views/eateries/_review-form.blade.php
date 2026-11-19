@php
    $input = 'h-10 w-full rounded-lg border border-forest/20 bg-white px-3 text-sm focus:border-forest focus:outline-none focus:ring-2 focus:ring-forest/15';
@endphp

<form method="POST" action="{{ route('eateries.reviews.store', $eatery) }}" class="mb-6 space-y-4 rounded-xl bg-sand p-4">
    @csrf

    @if ($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div>
        <label for="user_id" class="mb-1 block text-sm font-semibold">Reviewer</label>
        <select id="user_id" name="user_id" class="{{ $input }}">
            <option value="">Choose a reviewer</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>{{ $user->name }}</option>
            @endforeach
        </select>
        @error('user_id')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="rating" class="mb-1 block text-sm font-semibold">Rating</label>
        <select id="rating" name="rating" class="{{ $input }}">
            <option value="">Choose a rating</option>
            @for ($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" @selected(old('rating') == $i)>{{ $i }} {{ $i === 1 ? 'star' : 'stars' }}</option>
            @endfor
        </select>
        @error('rating')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="body" class="mb-1 block text-sm font-semibold">Review</label>
        <textarea id="body" name="body" rows="3" class="w-full rounded-lg border border-forest/20 bg-white px-3 py-2 text-sm focus:border-forest focus:outline-none focus:ring-2 focus:ring-forest/15">{{ old('body') }}</textarea>
        @error('body')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="rounded-full bg-forest px-5 py-2 text-sm font-semibold text-lime hover:bg-forest/90">Post review</button>
</form>