<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto my-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Send us a message!</h1>
            <form action="/contact" method="POST" class="mt-10">
                @csrf
                <x-input-field fieldFor="email" type="email" :value="$email" />
                <x-input-field fieldFor="subject" />
                <x-text-field fieldFor="message" />
                <x-button>SEND</x-button>
            </form>
        </main>
    </section>
</x-layout>