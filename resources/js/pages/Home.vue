<template>
    <Header @ChangeMode="ChangeMode($event)"></Header>
    <Notification @Cancel="Cancel($event)" :message="this.message" :title="this.title" :type="this.type" :show="this.show" :mode="this.dark"></Notification>
    <section class="h-screen relative">
        
        <div class="absolute w-full h-full bg-black">
            <img :class="[dark ? 'opacity-50' : 'opacity-75','w-full h-full object-cover']" :src="image" :alt="name" />
        </div>

        <div class="absolute top-1/3 left-1/2 transform -translate-x-1/2">
            <h1 class="text-8xl font-extrabold tracking-tight text-white text-center">
                <router-link
                    :to="slug"
                    >{{ name }}
                </router-link>
            </h1>
            <p class="mt-6 mx-auto text-2xl text-white text-center">{{ description }}</p>
        </div>

    </section>
    <Footer :mode="this.dark"></Footer>
</template>

<script>
import axios from "axios";
import Header from '../components/Header.vue';
import Footer from '../components/Footer.vue';
import Notification from '../components/Notification.vue';
import { URL } from '../env.js';

export default {
    components: { Header, Footer, Notification },
    data() {
        return {
            URL: URL,
            name: "Maitre saucier",
            image: URL + "storage/meals/intro.jpeg",
            description: "Accompagner vos plats de sauces aux milles saveurs !",
            slug: "/",
            dark:false,
            meals:{},
            message: "",
            title: "",
            type: "",
            show: false,
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
                let i = Math.round(Math.random(0, this.meals.length)*10);
                this.image = this.URL + "storage/meals/" + this.meals[i].picture;
                this.name = this.meals[i].name;
                this.description = this.meals[i].description;
                this.slug = "/meal/" + this.meals[i].slug;
            },2000)
        },
        ChangeMode() {
          this.dark = (window.sessionStorage.getItem("dark") == "true") ? true : false;
        },
        notification(message, title, type) {
            this.message = message;
            this.title = title;
            this.type = type;
            this.show == true ? this.show = false : this.show = true;
        },
        notify() {
            //TODO mounted where query string ...
            const urlSearchParams = new URLSearchParams(window.location.search);
            const params = Object.fromEntries(urlSearchParams.entries());

            switch (params.msg) {
              case "welcome":
                this.notification("Bienvenue dans l'application de gestion de recettes SOS-Sauce !", "Bienvenue " + params.name + " !" , "success");
                break;
              case "hello":
                this.notification("vous nous aviez manqué ! Qu'est ce qu'on mange aujourd'hui ?", "Bonjour", "success");
                break;
            }
        },
        Cancel() {
            this.show = false;
        }
    },
    created() {
        this.loadData();
    },
    mounted() {
        this.slider();
        this.ChangeMode();
        this.notify();
    }
}
</script>