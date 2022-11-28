<header class="max-w-xl mx-auto mt-20 text-center">
    <h1 class="text-4xl">
        Latest <span class="text-blue-500">Development</span> Topics
    </h1>

    <h2 class="inline-flex mt-2">By Laxon <img src="./images/lary-head.svg"
                                                       alt="Head of Lary the mascot"></h2>

    <p class="text-sm mt-14">
        Hello! We are DevPedia, the developer's encyclopedia! Come and Join our web-dev community and share your knowledge with us!
    </p>

    <div class="space-y-2 lg:space-y-0 lg:space-x-4 mt-8">
        <!--  Category -->
        <div class="relative lg:inline-flex bg-gray-100 rounded-xl">
           <x-category-dropdown />
        </div>

        <!-- Search -->
        <div class="relative flex lg:inline-flex items-center bg-gray-100 rounded-xl px-3 py-2">
            <form method="GET">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}" />
                @endif
                <input 
                    type="text" 
                    name="search"
                    value="{{ request('search') ?? '' }}"
                    placeholder="Find something..."
                    class="bg-transparent outline-none placeholder-black font-semibold text-sm"
                />
            </form>
        </div>
    </div>
</header>