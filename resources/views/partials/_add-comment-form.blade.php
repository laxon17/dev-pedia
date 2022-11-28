<form id="commentForm" class="relative mb-4 border border-gray-200 p-6 pb-14 rounded-xl">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    
    <header class="flex items-center ">
        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="rounded-xl" alt="Users avatar" width="60px"/>
        <h2 class="ml-4 cursor-pointer underline" id="commentTrigger">Want to participate?</h2>
    </header>

    <div class="mt-6" id="formBody">
        <textarea 
            name="commentBody"
            id="commentBody"
            class="w-full text-sm outline-none border-0 resize-none border-b-2 focus:border-blue-500" 
            placeholder="Say something..."
            rows="10"
        ></textarea>
        <div class="absolute right-6 bottom-3">
            <button id="submitComment" class="bg-blue-500 text-white text-sm py-2 px-4 rounded-xl">COMMENT</button>
        </div>
        <p id="errorBox" class="text-red-500"> {{-- Content injected through javaScript --}}
        </p>
    </div>
</form>