<nav class="md:flex md:justify-between md:items-center">
    <div>
        <a href="{{ route('home') }}" class="flex items-center">
            <img src="/images/logo.png" alt="DevPedia Logo" width="65" height="16">
            <p class="text-lg">Dev <span class="text-blue-500">Pedia</span></p>
        </a>
    </div>

    <div class="mt-8 md:mt-0 flex items-center">
        @auth
            <x-dropdown>
                <x-slot name="trigger">
                    <button class="text-xs font-bold uppercase">Welcome, {{ auth()->user()->name }}!</button>
                </x-slot>
                @administrator
                    <x-dropdown-item href="{{ route('admin.home') }}">Admin Dashboard</x-dropdown-item>
                @endadministrator
                <x-dropdown-item href="{{ route('users.show', ['user' => auth()->user()->username ]) }}" :active="request()->routeIs('users.show')">Your posts</x-dropdown-item>
                <x-dropdown-item href="{{ route('posts.create') }}" :active="request()->routeIs('posts.create')">Create post</x-dropdown-item>
                <x-dropdown-item href="{{ route('users.edit', [ 'user' => auth()->user()->username ]) }}">Settings</x-dropdown-item>
                <x-dropdown-item
                    x-data="{}"
                    @click.prevent="document.querySelector('#logOutForm').submit()"
                >Log Out</x-dropdown-item>
                <form id="logOutForm" action="{{ route('session.destroy') }}" method="POST">
                    @csrf
                </form>
            </x-dropdown>
        @else
            <div class="mt-1">
                <a href="{{ route('registration.create') }}" class="text-xs mr-2 font-bold uppercase">Register</a>
                <a href="{{ route('session.create') }}" class="text-xs font-bold uppercase">Log in</a>
            </div>
        @endauth

        <a href="{{ route('contact.create') }}" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
            Contact Us
        </a>
    </div>
</nav>