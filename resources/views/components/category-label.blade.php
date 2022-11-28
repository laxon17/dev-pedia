@props(['category'])

<a 
    href="/?category={{ $category->slug }}"
    class="px-3 py-2 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
    style="font-size: 10px"
>
    {{ $category->title }}
</a>