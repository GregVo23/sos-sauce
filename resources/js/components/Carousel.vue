<template>
    <Carousel :autoplay="4000" :wrap-around="true">
        <Slide v-for="slide in meals" :key="slide">
            <div
                class="mt-12 mb-12 px-12 max-w-lg mx-auto grid gap-5 lg:grid-cols-4 lg:max-w-none"
            >
                <div
                    class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-white hover:bg-gray-100"
                    v-if="slide.length !== 0"
                    v-for="meal in slide"
                    :key="meal.id"
                >
                    <router-link :to="`/meal/${meal.slug}`">
                        <div class="carousel__item">
                            <div class="flex-shrink-0">
                                <img
                                    class="h-48 w-full object-cover"
                                    :style="`background-image:url(http://localhost:8000/storage/meals/${meal.picture}); background-size: cover;`"
                                    alt=""
                                />
                            </div>
                            <div
                                class="flex-1 p-6 flex flex-col justify-between"
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

                                    <p
                                        class="text-xl font-semibold text-gray-900"
                                    >
                                        {{ meal.name }}
                                    </p>
                                    <p class="mt-3 text-base text-gray-500">
                                        {{ meal.description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </router-link>
                </div>
            </div>
        </Slide>

        <!--<template #addons>
            <Navigation />
            <Pagination />
        </template>-->
    </Carousel>
</template>

<script>
import { defineComponent } from "vue";
import { Carousel, Navigation, Slide, Pagination } from "vue3-carousel";
import { URL } from "../env.js";
import "vue3-carousel/dist/carousel.css";

export default defineComponent({
    name: "Breakpoints",
    components: {
        Carousel,
        Slide,
        Navigation,
        Pagination,
    },
    data() {
        return {
            URL: URL,
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
                    (this.charged = true),
                        (this.meals = this.spliceIntoChunks(data, 4));
                    //console.log(this.meals);
                })
                .catch((error) => console.log("error", error));
        },
        spliceIntoChunks(arr, chunkSize) {
            const res = [];

            while (arr.length > 0 && arr.length > chunkSize - 1) {
                const chunk = arr.splice(0, chunkSize);
                res.push(chunk);
            }
            return res;
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
