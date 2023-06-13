<article class="recipe-card">
    <img
        alt="Lava"
        src="https://images.unsplash.com/photo-1631451095765-2c91616fc9e6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
        class="h-56 w-full rounded-xl object-cover shadow-xl transition group-hover:grayscale-[50%] dark:shadow-gray-700/25"
    />

    <div class="p-4">
        <a href="#">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                {{ $recipe->title }}
            </h3>
        </a>

        <p
            class="mt-2 line-clamp-3 text-sm/relaxed text-gray-500 dark:text-gray-400"
        >
            {{ $recipe->description }}
        </p>
    </div>
</article>
