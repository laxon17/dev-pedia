<x-layout>
    <h1 class="text-lg uppercase font-bold text-center my-20">{{ auth()->user()->name }}'s posts</h1>
    <main class="max-w-6xl mx-auto">
        @if (count($posts))
            <x-post-table :posts="$posts"></x-post-table>
            
            {{ $posts->links() }}
        @else
            <h1 class="text-center text-bold text-md uppercase">You haven't posted anything yet. <a class="underline text-indigo-600" href="{{ route('posts.create') }}">Create</a> post now!</h1>
        @endif
    </main>
</x-layout>