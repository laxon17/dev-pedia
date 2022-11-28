@props(['fieldFor', 'type' => 'text', 'value' => ''])

<div class="mb-6">
    <label
        for="{{ $fieldFor }}"
        class="block uppercase mb-2 text-xs font-bold"
    >
        {{ $fieldFor }}
    </label>
    <input
        class="outline-none p-1 mb-2 w-full"
        type="{{ $type }}"
        value="{{ old("$fieldFor") ?? $value }}"
        id="{{ $fieldFor }}"
        name="{{ $fieldFor }}"
        required
    />
    @error("$fieldFor")
        <p class="text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>