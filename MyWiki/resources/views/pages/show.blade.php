<x-layout>
    <x-slot name="title">
        {{ $page->title }} | My Wiki
    </x-slot>

    @if ($page->id)
        <h1>
            {{ $page->title }}
            <a href="{{ route('pages.edit', $page) }}">[edit]</a>
        </h1>
        <div>
            {!! $page->markdown_body !!}
        </div>
    @else
        <h1>
            {{ $page->title }}
        </h1>
        <div>
            この名前のページはまだ作成されていません
        </div>
        <a href="{{ route('pages.create', ['title' => $page->title]) }}">[新しく作成する]</a>
    @endif
</x-layout>
