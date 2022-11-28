@props(['comment'])

<article class="flex space-x-4 bg-gray-100 rounded-xl p-6 border border-gray-200 mb-4">
    <div class="flex-shrink-0">
        <img src="{{ asset('storage/' . $comment->user->avatar ) }}" class="rounded-xl" alt="Users avatar" width="60px"/>
    </div>
    <div>
        <header class="mb-4">
            <h6 class="font-bold">{{ $comment->user->name }}</h6>
            <p class="text-xs">Posted <time>{{ $comment->created_at->diffForHumans() }}</time>.</p>
        </header>
        <p class="text-sm">
            {{ $comment->body }}
        </p>
    </div>
</article>