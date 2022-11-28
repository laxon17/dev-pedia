<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto my-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Register!</h1>
            <form action="{{ route('registration.store') }}" method="POST" class="mt-10">
                @csrf
                <x-input-field fieldFor="name" />
                <x-input-field fieldFor="username" />
                <x-input-field fieldFor="email" type="email" />
                <x-input-field fieldFor="password" type="password" />
                <x-button>REGISTER</x-button>
            </form>
        </main>
    </section>
</x-layout>