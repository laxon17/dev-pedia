@props(['fieldFor'])

<div class="mb-6">
    <label
        for="{{ $fieldFor }}"
        class="block uppercase mb-2 text-xs font-bold"
    >
        {{ $fieldFor }}
    </label>
    <textarea
        class="outline-none p-1 mb-2 w-full resize-none"
        rows="10"
        id="{{ $fieldFor }}"
        name="{{ $fieldFor }}"
        required
    >{{ old("$fieldFor") ?? $slot }}</textarea>
    @error("$fieldFor")
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>