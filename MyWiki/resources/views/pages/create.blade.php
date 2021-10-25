<x-layout>
    <x-slot name="title">
        form | My Wiki
    </x-slot>

    <h1>Form</h1>

    @if (count($errors) > 0)
        <div class="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($page->id)
        <form action="/pages/{{ $page->title }}" method="POST">
    @else
        <form action="/pages" method="POST">
    @endif
        @csrf
        <div>
            <label class="control-label">Title</label>
            <input name="title" type="text" class="form-control" value="{{ old('title', $page->title) }}">
        </div>

        <div>
            <label class="control-label">Body</label>
            <textarea name="body" class="form-control" id="" cols="30" rows="10">
                {{ old('title', $page->title) }}
            </textarea>
        </div>
        <input type="submit" class="form-control">
    </form>

</x-layout>
