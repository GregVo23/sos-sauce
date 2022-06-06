<template>
    <div class="flex justify-between w-full">
        <div>
            <button
                @click="previous()"
                class="h-16 w-16 absolute left-10 top-1/2 z-50 bg-gray-100 hover:bg-red-600 hover:text-white text-gray-800 font-bold py-2 px-4 rounded-full"
            >
                Prev
            </button>
        </div>
        <div>
            <button
                @click="next()"
                class="h-16 w-16 absolute right-10 top-1/2 z-50 bg-gray-100 hover:bg-red-600 hover:text-white text-gray-800 font-bold py-2 px-4 rounded-full"
            >
                Next
            </button>
        </div>
    </div>
    <div class="slider">
        <div
            :class="[mode ? 'bg-gray-600' : 'bg-white', 'container-slide']"
            :style="{
                transform: `translateX(${index}px)`,
                transition: `${transition}`,
            }"
        >
            <div
                v-for="meal in meals"
                :key="meal.id"
                :class="[mode ? 'opacity-80' : '', 'div-slider']"
                :style="`width:100vw; height:100vh; background-image:url(http://localhost:8000/storage/meals/${meal.picture}); background-size: cover;`"
            >
                <h1
                    class="titre mt-52 text-8xl px-10 font-extrabold tracking-tight text-white text-center"
                >
                    <router-link :to="`/meal/${meal.slug}`"
                        >{{ meal.name }}
                    </router-link>
                </h1>

                <p
                    class="mt-6 mx-auto px-12 text-2xl text-white text-center truncate"
                >
                    {{ meal.description }}
                </p>
                <div class="flex justify-center h-full">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="fixed bottom-28 h-16 w-16 animate-bounce text-white"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="4"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 9l-7 7-7-7"
                        />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { URL } from "../env.js";
export default {
    name: "Slider",
    props: ["mode"],
    data() {
        return {
            URL: URL,
            name: "Maitre saucier",
            image: URL + "storage/meals/intro.jpg",
            description: "Accompagner vos plats de sauces aux milles saveurs !",
            index: 0,
            slug: "/",
            dark: false,
            meals: [],
            transition: "transform 0.4s ease",
        };
    },
    methods: {
        loadData() {
            axios
                .get("/api/meals")
                .then(({ data }) => (this.meals = data.data))
                .catch((error) => console.log("error", error));
        },
        slider() {
            setInterval(() => {
                this.next();
            }, 5000);
        },
        ChangeMode() {
            this.dark =
                window.sessionStorage.getItem("dark") == "true" ? true : false;
        },
        next() {
            if (
                Math.abs(this.index / window.screen.availWidth) + 1 ===
                this.meals.length
            ) {
                this.transition = "";
                this.index = 0;
            } else {
                this.transition = "transform 0.4s ease";
                this.index -= window.screen.availWidth;
                let x = Math.abs(this.index / window.screen.availWidth) + 1;
                let image = document.querySelector(
                    "#app > section > div > div > img:nth-child(" + x + ")"
                );
                //console.log("h " + x);
                //console.log("i " + this.meals.length);
            }
            console.log(this.index);
        },
        previous() {
            if (Math.abs(this.index / window.screen.availWidth) + 1 === 1) {
                this.transition = "";
                this.index = 0;
            } else {
                this.transition = "transform 0.4s ease";
                this.index += window.screen.availWidth;
            }
            //console.log(Math.abs(this.index / window.screen.availWidth) + 1);
            //console.log("i " + this.meals.length);
        },
    },
    created() {
        this.loadData();
    },
    mounted() {
        this.slider();
        this.ChangeMode();
        document.body.style.overflowX = "hidden";
    },
};
</script>

<style scoped>
.slider {
    width: 100vw;
    height: 100vh;
    background: #888;
    /*position: relative;*/
}

.container-slide {
    display: inline-flex;
    flex-wrap: nowrap;
}

.img-slider {
    width: 100vw;
    height: 100vh;
    /*margin-left: 1000px;*/
    /*object-fit: cover;*/
}
.div-slider {
    width: 100vw;
    height: 100vh;
}
.titre {
    text-shadow: 0 8px 12px rgba(0, 0, 0, 0.3);
}
</style>
