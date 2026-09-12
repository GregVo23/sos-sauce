<template>
    <div :class="mode ? 'bg-gray-600' : 'bg-white'">
        <Carousel :autoplay="4000" :wrap-around="true">
            <Slide v-for="slide in meals" :key="slide">
                <div
                    class="mt-12 mb-12 px-12 max-w-lg mx-auto grid gap-5 lg:grid-cols-4 lg:max-w-none"
                >
                    <div
                        :class="[
                            mode
                                ? 'bg-gray-700 hover:bg-gray-600'
                                : 'bg-white hover:bg-gray-100',
                            'flex flex-col rounded-lg shadow-lg overflow-hidden',
                        ]"
                        v-if="slide.length !== 0"
                        v-for="meal in slide"
                        :key="meal.id"
                    >
                        <router-link :to="`/meal/${meal.slug}`">
                            <div class="carousel__item">
                                <div class="flex-shrink-0">
                                    <img
                                        class="h-48 w-full object-cover"
                                        :src="URL + 'storage/meals/card/' + meal.picture"
                                        :alt="meal.name"
                                        loading="lazy"
                                    />
                                </div>
                                <div
                                    class="flex-1 p-6 flex flex-col justify-between"
                                >
                                    <div class="flex-1">
                                        <p
                                            v-if="meal.categories && meal.categories.length"
                                            class="text-sm font-medium text-red-600"
                                        >
                                            {{ meal.categories.map((c) => c.name).join(", ") }}
                                        </p>

                                        <p
                                            :class="[
                                                mode ? 'text-gray-100' : 'text-gray-900',
                                                'text-xl font-semibold',
                                            ]"
                                        >
                                            {{ meal.name }}
                                        </p>
                                        <p
                                            :class="[
                                                mode ? 'text-gray-300' : 'text-gray-500',
                                                'mt-3 text-base',
                                            ]"
                                        >
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
    </div>
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
    props: ["mode"],
    data() {
        return {
            URL: URL,
            meals: null,
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
