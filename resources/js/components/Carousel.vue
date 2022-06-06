<template>
    <Carousel class="mb-12">
        <Slide v-for="slide in 10" :key="slide">
            <div
                class="mt-12 max-w-lg mx-auto grid gap-5 lg:grid-cols-4 lg:max-w-none"
            >
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <div class="carousel__item">
                        <div class="flex-shrink-0">
                            <img
                                class="h-48 w-full object-cover"
                                src="post.imageUrl"
                                alt=""
                            />
                        </div>
                        <div
                            class="flex-1 bg-white p-6 flex flex-col justify-between"
                        >
                            <div class="flex-1">
                                <p class="text-sm font-medium text-red-600">
                                    <a
                                        href="post.category.href"
                                        class="hover:underline"
                                    >
                                        { post.category.name }
                                    </a>
                                </p>
                                <a href="post.href" class="block mt-2">
                                    <p
                                        class="text-xl font-semibold text-gray-900"
                                    >
                                        { post.title }
                                    </p>
                                    <p class="mt-3 text-base text-gray-500">
                                        { post.description }
                                    </p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <a href="post.author.href">
                                        <span class="sr-only"
                                            >{ post.author.name }</span
                                        >
                                        <img
                                            class="h-10 w-10 rounded-full"
                                            src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt=""
                                        />
                                    </a>
                                </div>
                                <div class="ml-3">
                                    <p
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        <a
                                            href="post.author.href"
                                            class="hover:underline"
                                        >
                                            { post.author.name }
                                        </a>
                                    </p>
                                    <div
                                        class="flex space-x-1 text-sm text-gray-500"
                                    >
                                        <time datetime="post.datetime">
                                            { post.date }
                                        </time>
                                        <span aria-hidden="true">
                                            &middot;
                                        </span>
                                        <span> { post.readingTime } read </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <div class="carousel__item">
                        <div class="flex-shrink-0">
                            <img
                                class="h-48 w-full object-cover"
                                src="post.imageUrl"
                                alt=""
                            />
                        </div>
                        <div
                            class="flex-1 bg-white p-6 flex flex-col justify-between"
                        >
                            <div class="flex-1">
                                <p class="text-sm font-medium text-red-600">
                                    <a
                                        href="post.category.href"
                                        class="hover:underline"
                                    >
                                        { post.category.name }
                                    </a>
                                </p>
                                <a href="post.href" class="block mt-2">
                                    <p
                                        class="text-xl font-semibold text-gray-900"
                                    >
                                        { post.title }
                                    </p>
                                    <p class="mt-3 text-base text-gray-500">
                                        { post.description }
                                    </p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <a href="post.author.href">
                                        <span class="sr-only"
                                            >{ post.author.name }</span
                                        >
                                        <img
                                            class="h-10 w-10 rounded-full"
                                            src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt=""
                                        />
                                    </a>
                                </div>
                                <div class="ml-3">
                                    <p
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        <a
                                            href="post.author.href"
                                            class="hover:underline"
                                        >
                                            { post.author.name }
                                        </a>
                                    </p>
                                    <div
                                        class="flex space-x-1 text-sm text-gray-500"
                                    >
                                        <time datetime="post.datetime">
                                            { post.date }
                                        </time>
                                        <span aria-hidden="true">
                                            &middot;
                                        </span>
                                        <span> { post.readingTime } read </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <div class="carousel__item">
                        <div class="flex-shrink-0">
                            <img
                                class="h-48 w-full object-cover"
                                src="post.imageUrl"
                                alt=""
                            />
                        </div>
                        <div
                            class="flex-1 bg-white p-6 flex flex-col justify-between"
                        >
                            <div class="flex-1">
                                <p class="text-sm font-medium text-red-600">
                                    <a
                                        href="post.category.href"
                                        class="hover:underline"
                                    >
                                        { post.category.name }
                                    </a>
                                </p>
                                <a href="post.href" class="block mt-2">
                                    <p
                                        class="text-xl font-semibold text-gray-900"
                                    >
                                        { post.title }
                                    </p>
                                    <p class="mt-3 text-base text-gray-500">
                                        { post.description }
                                    </p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <a href="post.author.href">
                                        <span class="sr-only"
                                            >{ post.author.name }</span
                                        >
                                        <img
                                            class="h-10 w-10 rounded-full"
                                            src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt=""
                                        />
                                    </a>
                                </div>
                                <div class="ml-3">
                                    <p
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        <a
                                            href="post.author.href"
                                            class="hover:underline"
                                        >
                                            { post.author.name }
                                        </a>
                                    </p>
                                    <div
                                        class="flex space-x-1 text-sm text-gray-500"
                                    >
                                        <time datetime="post.datetime">
                                            { post.date }
                                        </time>
                                        <span aria-hidden="true">
                                            &middot;
                                        </span>
                                        <span> { post.readingTime } read </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <div class="carousel__item">
                        <div class="flex-shrink-0">
                            <img
                                class="h-48 w-full object-cover"
                                src="post.imageUrl"
                                alt=""
                            />
                        </div>
                        <div
                            class="flex-1 bg-white p-6 flex flex-col justify-between"
                        >
                            <div class="flex-1">
                                <p class="text-sm font-medium text-red-600">
                                    <a
                                        href="post.category.href"
                                        class="hover:underline"
                                    >
                                        { post.category.name }
                                    </a>
                                </p>
                                <a href="post.href" class="block mt-2">
                                    <p
                                        class="text-xl font-semibold text-gray-900"
                                    >
                                        { post.title }
                                    </p>
                                    <p class="mt-3 text-base text-gray-500">
                                        { post.description }
                                    </p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <a href="post.author.href">
                                        <span class="sr-only"
                                            >{ post.author.name }</span
                                        >
                                        <img
                                            class="h-10 w-10 rounded-full"
                                            src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                            alt=""
                                        />
                                    </a>
                                </div>
                                <div class="ml-3">
                                    <p
                                        class="text-sm font-medium text-gray-900"
                                    >
                                        <a
                                            href="post.author.href"
                                            class="hover:underline"
                                        >
                                            { post.author.name }
                                        </a>
                                    </p>
                                    <div
                                        class="flex space-x-1 text-sm text-gray-500"
                                    >
                                        <time datetime="post.datetime">
                                            { post.date }
                                        </time>
                                        <span aria-hidden="true">
                                            &middot;
                                        </span>
                                        <span> { post.readingTime } read </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Slide>
    </Carousel>
</template>

<script>
import { defineComponent } from "vue";
import { Carousel, Navigation, Slide } from "vue3-carousel";

import "vue3-carousel/dist/carousel.css";

export default defineComponent({
    name: "Breakpoints",
    components: {
        Carousel,
        Slide,
        Navigation,
    },
});
</script>

<style>
.carousel__prev--in-active,
.carousel__next--in-active {
    display: none;
}
</style>
