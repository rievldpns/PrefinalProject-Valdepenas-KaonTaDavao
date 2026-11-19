@if (session('success'))
    <div class="mb-6 rounded-xl border border-sage/40 bg-sage/15 px-4 py-3 text-sm font-medium text-forest">
        {{ session('success') }}
    </div>
@endif