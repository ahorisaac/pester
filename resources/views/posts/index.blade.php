<x-guest-layout>
    <div class="">
        @foreach ($posts as $post)
            <h3> {{ $post->title }} </h3>
            <p> {{ $post->body }} </p>
        @endforeach
    </div>
</x-guest-layout>
