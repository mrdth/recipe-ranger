<article class="recipe-card relative">
    <a href="#">
        <img
            alt="Lava"
            src="{{ $recipe->images[0] }}"
            class="h-48 w-full rounded-xl object-cover shadow-xl transition group-hover:grayscale-[50%] dark:shadow-gray-700/25"
        />
    </a>
    <div class="p-4">
        <a href="#">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                {{ $recipe->title }}
            </h3>
        </a>

        <p
            class="my-2 text-sm/relaxed text-gray-700 dark:text-gray-400"
        >
            {{ $recipe->description }}
        </p>
        <div class="text-sm text-gray-700 hover:text-gray-900 dark:text-gray-500 absolute bottom-0 right-0">
            <a href="{{ $site['url'] }}">{{ $site['name'] }}</a>
        </div>
    </div>

</article>
