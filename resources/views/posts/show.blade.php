<x-layout :pageTitle="$post->title">
    <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
        @auth
            <div title="Report this post" class="cursor-pointer bg-red-300 w-8 border border-red-500 flex items-center justify-center px-6 rounded">
                <span class="material-symbols-outlined text-red-900">
                    warning
                </span>
            </div>
        @endauth
        <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
            <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" width="500" height="500" alt="Post's thumbnail" class="rounded-xl" />

                <p class="mt-4 block text-gray-400 text-xs">
                    Published <time>{{ $post->created_at->diffForHumans() }}</time>
                </p>

                <div class="flex items-center lg:justify-center text-sm mt-4">
                    <img src="{{ asset('storage/' . $post->user->avatar ) }}" class="rounded-xl" width="50" height="50" alt="User's avatar" />
                    <div class="ml-3 text-left">
                        <a href="/?user={{ $post->user->username }}">
                            <h5 class="font-bold">{{ $post->user->name }}</h5>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-span-8">
                <div class="hidden lg:flex justify-between mb-6">
                    <a href="/"
                        class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                        <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                            <g fill="none" fill-rule="evenodd">
                                <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                </path>
                                <path class="fill-current"
                                    d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                </path>
                            </g>
                        </svg>

                        Back to Posts
                    </a>

                    <div class="flex space-x-2 items-center">
                        <div>
                            <x-category-label :category="$post->category" />
                        </div>
                        @administrator
                            <div title="Delete this post" class="cursor-pointer bg-red-300 border border-red-500 px-6 rounded-full">
                                <form action="{{ route('posts.destroy', [ 'post' => $post ]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="flex justify-center items-center py-1">
                                        <span class="material-symbols-outlined text-red-900">
                                            close
                                        </span>
                                    </button>
                                </form>
                            </div>
                        @endadministrator
                    </div>
                </div>

                <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                    {{ $post->title }}
                </h1>

                <div class="space-y-4 lg:text-lg leading-loose">
                    {{ $post->body }}
                </div>
            </div>
            <section class="col-span-8 col-start-5 mt-10">
                @auth
                    @include('partials._add-comment-form')
                @else
                    <h3 class="mb-4">Please <a href="{{ route('session.create') }}" class="text-blue-500 underline">login</a> or <a class="text-blue-500 underline" href="{{ route('registration.create') }}">register</a> to comment!</h3>
                @endauth
                @if (count($post->comments))
                    <div id="commentArea">
                        @foreach ($post->comments->sortByDesc('created_at') as $comment)
                            <x-post-comment :comment="$comment" />
                        @endforeach
                    </div>
                @endif
            </section>
        </article>
    </main>
</x-layout>