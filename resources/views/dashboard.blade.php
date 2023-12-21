<x-app-layout>
    <!-- search button -->

    {{-- {{ dd($userInfo) }} --}}
    {{-- @foreach ($userInfo as $userInfo1)
        <p>{{ $userInfo1->username }}</p>
        <p>{{ $userInfo1->name }}</p>
        <p>{{ $userInfo1->email }}</p>
    @endforeach --}}

    <form action="{{ route('dashboard') }}" method="get">
        <div class="flex items-center max-w-md mx-auto bg-white rounded-lg " x-data="{ search: '' }">
            <div class="w-full">
                <input name ="search" type="search" class="w-full px-4 py-1 text-gray-800 rounded-full focus:outline-none"
                    placeholder="search" x-model="search">
            </div>
            <div>
                <button type="submit"
                    class="flex items-center bg-grey-500 justify-center w-12 h-12 text-white rounded-r-lg"
                    :class="(search.length > 0) ? 'bg-purple-500' : 'bg-gray-500 cursor-not-allowed'"
                    :disabled="search.length == 0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </form>

    <!-- search button -->
    <main class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
        <!-- Barta Create Post Card -->
        <form method="POST" enctype="multipart/form-data"
            class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3"
            action="{{ route('posts.store') }}">
            @csrf
            <!-- Create Post Card Top -->
            <div>
                <div class="flex items-start /space-x-3/">
                    <!-- User Avatar -->
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full object-cover"
                            src="https://avatars.githubusercontent.com/u/831997" alt="Ahmed Shamim" />
                    </div>
                    <!-- /User Avatar -->
                    <!-- Content -->
                    <div class="text-gray-700 font-normal w-full">
                        <textarea
                            class="block w-full p-2 pt-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
                            name="post_content" rows="2" placeholder="What's going on, Shamim?"></textarea>
                    </div>
                </div>
            </div>
            <!-- Create Post Card Bottom -->
            <div>
                <!-- Card Bottom Action Buttons -->
                <div class="flex items-center justify-between">
                    <div class="flex gap-4 text-gray-600">
                        <!-- Upload Picture Button -->
                        <div>
                            <input type="file" name="post_image" id="post_image" class="hidden" />

                            <label for="post_image"
                                class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800 cursor-pointer">
                                <span class="sr-only">Post_image</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                            </label>
                        </div>
                        <!-- /Upload Picture Button -->
                    </div>
                    <div>
                        <!-- Post Button -->
                        <button type="submit"
                            class="-m-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                            Post
                        </button>
                        <!-- /Post Button -->
                    </div>
                </div>
                <!-- /Card Bottom Action Buttons -->
            </div>
            <!-- /Create Post Card Bottom -->
        </form>
        <!-- /Barta Create Post Card -->
        <!-- Newsfeed -->
        <section id="newsfeed" class="space-y-6">
            @isset($posts)
                @foreach ($posts as $post)
                    <!-- Barta Card With Image -->
                    <article class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
                        <!-- Barta Card Top -->
                        <header>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <!-- User Avatar -->
                                    <div class="flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full object-cover"
                                            src="https://avatars.githubusercontent.com/u/61485238" alt="Al Nahian" />
                                    </div>
                                    <!-- /User Avatar -->

                                    <!-- User Info -->
                                    <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                                        <a href="#"class="hover:underline font-semibold line-clamp-1">
                                            {{ $post->user->name }}
                                        </a>

                                        <a href="#" class="hover:underline text-sm text-gray-500 line-clamp-1">
                                            {{ $post->user->email }}
                                        </a>
                                    </div>
                                    <!-- /User Info -->
                                </div>
                                <!-- Card Action Dropdown -->
                                <div class="flex flex-shrink-0 self-center" x-data="{ open: false }">
                                    <div class="relative inline-block text-left">
                                        <div>
                                            <button @click="open = !open" type="button"
                                                class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                                                id="menu-0-button">
                                                <span class="sr-only">Open options</span>
                                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                    aria-hidden="true">
                                                    <path
                                                        d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                        <!-- Dropdown menu -->
                                        <div x-show="open" @click.away="open = false"
                                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                            tabindex="-1">
                                            {{-- @dd($post) --}}

                                            <a href="{{ route('posts.edit', $post->id) }}"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                role="menuitem" tabindex="-1" id="user-menu-item-0">Edit</a>

                                            <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit"
                                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                    role="menuitem" tabindex="-1" id="user-menu-item-1">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Card Action Dropdown -->
                            </div>
                        </header>
                        <!-- Content -->
                        <div class="py-4 text-gray-700 font-normal space-y-2">
                            <a href="{{ route('posts.show', $post->id) }}">
                                @if ($post->post_image)
                                    <img src="{{ asset('storage/images/' . $post->post_image) }}"
                                        class="min-h-auto w-full rounded-lg object-cover max-h-64 md:max-h-72"
                                        alt="" />
                                @else
                                    <p>No Image Found</p>
                                @endif
                                <p> {{ $post->post_content }}</p>
                            </a>
                        </div>
                        <!-- Date Created & View Stat -->
                        <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
                            <span class="">{{ $post->created_at }}</span>
                            <span class="">•</span>
                            <span>
                                {{ $post->views_count }} views
                            </span>
                        </div>
                        <!-- Barta Card Bottom -->
                        <footer class="border-t border-gray-200 pt-2">
                            <!-- Card Bottom Action Buttons -->
                            <div class="flex items-center justify-between">
                                <div class="flex gap-8 text-gray-600">
                                    <!-- Heart Button -->
                                    <form action="{{ route('likes.store', $post->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <button type="submit"
                                            class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                                            <span class="sr-only">Like</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                            </svg>
                                            <p>{{ $post->likes_count }}</p>
                                        </button>

                                    </form>


                                    <!-- /Heart Button -->
                                    <!-- Comment Button -->

                                    <button type="button"
                                        class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                                        <span class="sr-only">{{ $post->comments_count }}Comment</span>
                                        <p>{{ $post->comments_count }}</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                                        </svg>


                                    </button>
                                    <!-- /Comment Button -->
                                </div>
                                <div>
                                    <!-- Share Button  -->
                                    <button type="button"
                                        class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800">
                                        <span class="sr-only">Share</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
                                        </svg>
                                    </button>
                                    <!-- /Share Button -->
                                </div>
                            </div>
                            <!-- /Card Bottom Action Buttons -->
                        </footer>
                        <!-- /Barta Card Bottom -->
                        {{-- < class="w-full bg-white rounded-lg border p-2 my-4 mx-6"> --}}
                        @foreach ($post->comments as $comment)
                            <div class="flex flex-col">
                                <div class="border rounded-md p-3 ml-3 my-3">
                                    <div class="flex gap-3 items-center">
                                        <img src="https://avatars.githubusercontent.com/u/22263436?v=4"
                                            class="object-cover w-8 h-8 rounded-full
                                         border-2 border-emerald-400  shadow-emerald-400
                                             ">
                                        <h3 class="font-bold">
                                            {{ $comment->user->name }}
                                        </h3>
                                    </div>
                                    <p class="text-gray-600 mt-2">
                                        {{ $comment->comment_content }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                        <form method="post" enctype="multipart/form-data"
                            action="{{ route('comments.store', ['id' => $post->id]) }}">
                            @csrf
                            <div class="w-full px-3 my-2">
                                <textarea
                                    class="bg-gray-100 rounded border border-gray-400 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-700 focus:outline-none focus:bg-white"
                                    name="comment_content" placeholder='Type Your Comment' required></textarea>
                            </div>
                            <div class="w-full flex justify-end px-3">
                                <button type='submit'
                                    class="-m-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                                    Post Comment
                                </button>
                            </div>

                        </form>

                    </article>
                @endforeach
            @else
                <p>No posts available.</p>
            @endisset
            <!-- /Barta Card With Image -->
        </section>
        <!-- /Newsfeed -->
    </main>
</x-app-layout>
