<template>
    <Header></Header>
    <section class="h-screen relative">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" :src="image" :alt="name" />
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                <router-link
                    to="/login"
                    >{{ name }}
                </router-link></h1>
            <p class="mt-6 text-xl text-indigo-100 max-w-3xl">Mattis amet hendrerit dolor, quisque lorem pharetra. Pellentesque lacus nisi urna, arcu sociis eu. Orci vel lectus nisl eget eget ut consectetur. Sit justo viverra non adipisicing elit distinctio.</p>
        </div>
    </section>
</template>

<script>
import axios from "axios";
import Header from './Header.vue';

export default {
    components: { Header },
    data() {
        return {
            name: "Image de recette",
            image: "https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80",
            images: [
                {
                    nom: "Superbe recette",
                    image: "https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80"
                },
                                {
                    nom: "Pas mal",
                    image: "https://images.unsplash.com/photo-1520333789090-1afc82db536a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2102&q=80"
                },
            ]
        }
    },
    methods: {
        slider(){
            setInterval(() => {
                let i = Math.round(Math.random(0, this.images.length));
                this.image = this.images[i].image;
                this.name = this.images[i].nom;
            },2000)
        }
    },
    created() {
        this.slider();
    }
}
</script>