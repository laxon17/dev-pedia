<x-layout>
    <section class="px-6 py-8">
        <h1 class="text-center font-bold uppercase mb-10">Create post</h1>
        <main class="max-w-lg mx-auto bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <x-input-field fieldFor="title"></x-input-field>
                <x-text-field fieldFor="body"></x-text-field>
                <label  class="block uppercase mb-2 text-xs font-bold" for="categories">Choose category</label>
                <select name="category_id" id="categories" class="mb-6 w-full">
                    <option value="0" select>Choose...</option>
                    @foreach ($categories as $category)
                        <option 
                            value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >
                            {{ ucwords($category->title) }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 mb-6">{{ $message }}</p>
                @enderror
                <x-input-field fieldFor="thumbnail" type="file"></x-input-field>
                <x-button>POST</x-button>
            </form>
        </main>
    </section>
</x-layout>