<template>
    <Carousel>
        <Slide v-for="meal in meals" :key="meal.id">
            <div
                class="mt-12 mb-12 px-12 max-w-lg mx-auto grid gap-5 lg:grid-cols-4 lg:max-w-none"
            >
                <div
                    class="flex flex-col rounded-lg shadow-lg overflow-hidden"
                    v-for="slide in 4"
                    :key="slide"
                >
                    <div class="carousel__item">
                        <div class="flex-shrink-0">
                            <img
                                class="h-48 w-full object-cover"
                                :style="`background-image:url(http://localhost:8000/storage/meals/${meal.picture}); background-size: cover;`"
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
                                        {{ meal.name }}
                                    </a>
                                </p>
                                <a href="post.href" class="block mt-2">
                                    <p
                                        class="text-xl font-semibold text-gray-900"
                                    >
                                        {{ meal.name }}
                                    </p>
                                    <p class="mt-3 text-base text-gray-500">
                                        {{ meal.description }}
                                    </p>
                                </a>
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
    data() {
        return {
            meals: null,
            dark: false,
            charged: false,
        };
    },
    methods: {
        loadData() {
            axios
                .get("/api/meals/all")
                .then(({ data }) => {
                    (this.charged = true), (this.meals = data);
                })
                .catch((error) => console.log("error", error));
        },
    },
    created() {
        this.loadData();
    },
});
</script>

<style>
.carousel__prev--in-active,
.carousel__next--in-active {
    display: none;
}
</style>
