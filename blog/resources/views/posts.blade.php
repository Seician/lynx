<x-layout>

    @include ('_posts-header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        <x-post-featured-card :post="$latest_post" />

        <div class="lg:grid lg:grid-cols-2">
            @foreach ($posts->skip(1) as $post)
            <x-post-card :post="$post" />
            @endforeach
        </div>

    </main>


</x-layout>