<template>
    <Header @ChangeMode="ChangeMode($event)"></Header>
    <section class="h-screen relative">
        
        <div class="absolute w-full h-full bg-black">
            <img class="w-full h-full object-cover opacity-75" :src="image" :alt="name" />
        </div>

        <div class="absolute top-1/3 left-1/2 transform -translate-x-1/2">
            <h1 class="text-8xl font-extrabold tracking-tight text-white text-center">
                <router-link
                    to="/login"
                    >{{ name }}
                </router-link></h1>
            <p class="mt-6 mx-auto text-2xl text-white text-center">{{ description }}</p>
        </div>

    </section>
    <Footer :mode="this.dark"></Footer>
</template>

<script>
import axios from "axios";
import Header from './Header.vue';
import Footer from './Footer.vue';

export default {
    components: { Header, Footer },
    data() {
        return {
            name: "Maitre saucier",
            image: "http://www.localhost:8000/storage/meals/intro.jpeg",
            description: "Accompagner vos plats de sauces aux milles saveurs !",
            dark:false,
            meals:{}
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
                let i = Math.round(Math.random(0, this.meals.length));
                this.image = "http://www.localhost:8000/storage/meals/" + this.meals[i].picture;
                this.name = this.meals[i].name;
                this.description = this.meals[i].description;
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