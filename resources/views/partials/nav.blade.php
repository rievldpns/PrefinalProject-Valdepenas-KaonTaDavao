<nav class="flex flex-wrap items-center gap-1 text-sm">
    <a href="{{ route('home') }}"
       class="rounded-full px-3 py-1.5 hover:bg-forest/5 {{ request()->routeIs('home') ? 'font-semibold text-forest' : 'text-forest/60' }}">Home</a>

    <a href="{{ route('eateries.index') }}"
       class="rounded-full px-3 py-1.5 hover:bg-forest/5 {{ request()->routeIs('eateries.index', 'eateries.show', 'eateries.edit') ? 'font-semibold text-forest' : 'text-forest/60' }}">Eateries</a>

    <a href="{{ route('districts.index') }}"
       class="rounded-full px-3 py-1.5 hover:bg-forest/5 {{ request()->routeIs('districts.*') ? 'font-semibold text-forest' : 'text-forest/60' }}">Districts</a>

    <a href="{{ route('eateries.create') }}"
       class="ml-1 rounded-full bg-forest px-4 py-1.5 font-semibold text-lime hover:bg-forest/90">Add Eatery</a>
</nav>