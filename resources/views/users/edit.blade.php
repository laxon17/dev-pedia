<x-layout>
    <h1 class="text-lg uppercase font-bold text-center my-20">{{ auth()->user()->name }}'s settings</h1>
    <main class="max-w-6xl mx-auto flex">
        <section class="w-64 mr-16">
            <h2 class="text-sm text-center font-bold uppercase">Your avatar</h2>
            <div class="w-full my-3">
                <img src="{{ asset('storage/' . $user->avatar ) }}" class="object-contain rounded-xl border border-gray-200" alt="User's avatar">
            </div>
            <div 
                x-data="{ show: false }"
                class="relative"
                @click.away="show = false"
            >
                <p @click="show = ! show" class="text-center cursor-pointer uppercase text-sm mb-3 text-blue-600">Change avatar</p>
                <form style="display: none" class="absolute w-86 bg-white border border-gray-300 rounded-xl p-6" x-show="show" method="post" enctype="multipart/form-data" action="{{ route('users.update-picture', [ 'user' => $user ]) }}">
                    @csrf
                    @method('patch')
                    <x-input-field fieldFor="avatar" type="file"></x-input-field>
                    <x-button>Update</x-button>
                </form>
            </div>
        </section>
        <section class="w-full flex flex-col py-2 px-6 bg-gray-100 rounded-xl">
            <h1 class="text-sm text-center font-bold mb-6 uppercase">Your info</h1>
            <x-settings-option :action="route('users.update-name', [ 'user' => $user ])" optionFor="name" :value="$user->name" />
            <x-settings-option :action="route('users.update-username', [ 'user' => $user ])" optionFor="username" :value="$user->username" />
            <x-settings-option :action="route('users.update-email', [ 'user' => $user ])" optionFor="email" type="email" :value="$user->email" />
            <x-settings-option :action="route('users.update-password', [ 'user' => $user ])" optionFor="password" :placeholder="true" type="password" />
        </section>
    </main>
</x-layout>