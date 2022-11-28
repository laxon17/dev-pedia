@props(['optionFor', 'action' => '', 'type' => 'text', 'value' => '', 'placeholder' => false])
<div
    x-data="{ show: false }"
    @click.away="show = false"
    class="w-full bg-white border border-gray-300 rounded-xl py-2 px-6 mb-6"
>
    <div @click="show = ! show"  class="cursor-pointer flex items-center justify-between">
        <p class="uppercase text-sm font-bold">{{ ucwords($optionFor) }}</p>
        <span class="material-symbols-outlined">
            expand_more
        </span>
    </div>
    <div x-show="show" style="display: none" class="mt-6 w-full flex justify-center">
        <form action="{{ $action }}" method="post" class="w-full flex justify-center items-center">
            @csrf
            @method('patch')
            <input type="{{ $type }}" name="{{ $optionFor }}" value="{{ $value }}" placeholder="{{ $placeholder ? 'Enter new password...' : '' }}" class="w-72 mr-2 rounded-xl px-3 py-2 border border-gray-500"/>
            @error("$optionFor")
                <p class="text-red-500">{{ $message }}</p>
            @enderror
            <button class="bg-blue-500 text-white uppercase text-sm rounded-2xl ml-4 py-2 px-6">UPDATE</button>
        </form>
    </div>
</div>