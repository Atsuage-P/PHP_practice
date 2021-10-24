<x-layout>
    <x-slot name="title">
        My Wiki
    </x-slot>

    <h1>
        <span>My Wiki</span>
        {{-- <a href="{{ route('pages.create') }}">[Add]</a> --}}
    </h1>
    <ul>
        @forelse ($pages as $page)
            <li>
                {{-- <a href="{{ route('pages.show', $page) }}"> --}}
                <a href="{{ $page->url }}">
                    {{ $page->title }}
                </a>
            </li>
        @empty
            <li>No posts yet!</li>
        @endforelse
    </ul>

</x-layout>
