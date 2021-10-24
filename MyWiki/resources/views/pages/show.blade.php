<x-layout>
    <x-slot name="title">
        {{ $page->title }} | My Wiki
    </x-slot>

    <h1>{{ $page->title }}</h1>
    <div>
        {{ $page->body }}
    </div>
</x-layout>
