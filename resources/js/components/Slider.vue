<template>

    <section class="h-screen relative overflow-hidden">
        <div class="flex justify-between w-full">
            <div>
                <button class="h-16 w-16 absolute left-10 top-1/2 z-50 bg-gray-100 hover:bg-red-600 hover:text-white text-gray-800 font-bold py-2 px-4 rounded-full">
                    Prev
                </button>
            </div>
            <div>
                <button class="h-16 w-16 absolute right-10 top-1/2 z-50 bg-gray-100 hover:bg-red-600 hover:text-white text-gray-800 font-bold py-2 px-4 rounded-full">
                    Next
                </button>
            </div>
        </div>

        <div class="absolute z-20 w-full h-full bg-black">
            <img :class="[dark ? 'opacity-60' : 'opacity-80','w-full h-full object-cover']" :src="image" :alt="name" />
        </div>

        <div class="absolute z-30 top-1/3 left-1/2 transform -translate-x-1/2">
            <h1 class="text-8xl font-extrabold tracking-tight text-white text-center">
                <router-link
                    :to="slug"
                    >{{ name }}
                </router-link>
            </h1>
            <p class="mt-6 mx-auto text-2xl text-white text-center">{{ description }}</p>
        </div>
    </section>

</template>

<script>
import axios from "axios";
import { URL } from '../env.js';
export default {
    name: 'Slider',
    props: ['mode'],
    data() {
        return {
            URL: URL,
            name: "Maitre saucier",
            image: URL + "storage/meals/intro.jpg",
            description: "Accompagner vos plats de sauces aux milles saveurs !",
            slug: "/",
            dark:false,
            meals:{},
        }
    },
    props:['mode'],
    methods: {
        loadData(){
            axios
            .get('/api/meals')
            .then(
                ({ data }) => (
                    (this.meals = data.data)
                )
            )
            .catch((error) => console.log("error", error));
        },
        slider(){
            setInterval(() => {
                let i = Math.round(Math.random(0, this.meals.length*10));
                this.image = this.URL + "storage/meals/" + this.meals[i].picture;
                this.name = this.meals[i].name;
                this.description = this.meals[i].description;
                this.slug = "/meal/" + this.meals[i].slug;
            },2000)
        },
        ChangeMode() {
          this.dark = (window.sessionStorage.getItem("dark") == "true") ? true : false;
        }
    },
    created() {
        this.loadData();
    },
    mounted() {
        this.slider();
        this.ChangeMode();
    }
}
</script>

<style scoped>

</style>