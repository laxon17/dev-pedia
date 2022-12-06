@props(['posts'])

<div class="lg:grid lg:grid-cols-2" id="postGrid">
    @foreach ($posts->skip(1) as $post)
        <x-post-card 
            :post="$post" 
            class="{{ $loop->iteration < 3 ? 'col-span-3' : 'col-span-2' }}" 
        />    
    @endforeach
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchField = document.getElementById('searchField')
        const categoryField = document.getElementById('categorySelect')
        const postGrid = document.getElementById('postGrid')

        fetch('/posts')
            .then(response => response.json())
            .then(data => definePostCard(data.posts.data) )

        searchField.addEventListener('keyup', () => {
                fetch(`/posts?search=${searchField.value}`)
                    .then(response => response.json())
                    .then(data =>  definePostCard(data.posts.data) )
        })

        categoryField.addEventListener('change', () => {
            if(categoryField.value == 'all') {
                fetch(`/posts`)
                    .then(response => response.json())
                    .then(data =>  definePostCard(data.posts.data) )
            } else {
                fetch(`/posts?category=${categoryField.value}`)
                    .then(response => response.json())
                    .then(data =>  definePostCard(data.posts.data) )
            }
        })

        function definePostCard(posts) {
            let postString = ''
            
            for(let post of posts) {
                postString += `
                    <article
                        class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl"
                    >
                        <div class="py-6 px-5">
                            <div>
                                <img src="storage/${post.thumbnail}" alt="Blog Post illustration" class="rounded-xl">
                            </div>

                            <div class="mt-8 flex flex-col justify-between">
                                <header>

                                    <div class="mt-4">
                                        <h1 class="text-3xl">
                                            ${ post.title }
                                        </h1>

                                        <span class="mt-2 block text-gray-400 text-xs">
                                            Published <time>${ post.created_at }</time>
                                        </span>
                                    </div>
                                </header>

                                <div class="text-sm mt-4">
                                    <p>
                                        ${ post.excerpt }
                                    </p>
                                </div>

                                <footer class="flex justify-between items-center mt-8">
                                    <div class="flex items-center text-sm">
                                        <img src="storage/${ post.user.avatar }" class="rounded-xl" width="50" height="50" alt="Lary avatar" />
                                        <div class="ml-3">
                                            <a href="?user=${ post.user.username }">
                                                <h5 class="font-bold">
                                                    ${ post.user.name }
                                                </h5>
                                            </a>
                                        </div>
                                    </div>

                                    <div>
                                        <a 
                                            href="/posts/${ post.slug }"
                                            class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8"
                                        >
                                            Read More
                                        </a>
                                    </div>
                                </footer>
                            </div>
                        </div>
                    </article>
                `
            }
            postGrid.innerHTML = postString.length ? postString : 'There are no posts!'
        }
    })

</script>
