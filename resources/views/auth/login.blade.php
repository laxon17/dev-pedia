<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto my-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Log In!</h1>
            <form action="{{ route('session.store') }}" method="POST" class="mt-10">
                @csrf
                <x-input-field fieldFor="email" type="email" />
                <x-input-field fieldFor="password" type="password" />
                <x-button>LOG IN</x-button>
            </form>
        </main>
    </section>
</x-layout>