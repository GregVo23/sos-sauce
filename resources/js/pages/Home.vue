<template>
    <div :class="[dark ? 'bg-gray-600' : 'bg-white', 'overflow-hidden']">
        <GoToTopButton></GoToTopButton>
        <Header @ChangeMode="ChangeMode($event)" :profil="this.user"></Header>
        <Notification
            @Cancel="Cancel($event)"
            :message="this.message"
            :title="this.title"
            :type="this.type"
            :show="this.show"
            :mode="this.dark"
        ></Notification>
        <Slider :mode="this.dark"></Slider>
        <Title :mode="this.dark"></Title>
        <Statistic></Statistic>

        <div
            class="bg-cover bg-center py-56"
            style="
                background-image: url('http://localhost:8000/images/sauce.jpeg');
            "
        ></div>
        <div id="decouvrir" class="bg-gray-600">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2
                        class="text-base font-semibold text-red-600 tracking-wide uppercase"
                    >
                        En cuisine !
                    </h2>
                    <p
                        class="mt-1 text-4xl font-extrabold text-gray-100 sm:text-5xl sm:tracking-tight lg:text-6xl"
                    >
                        A la recherche d'une recette ?
                    </p>
                    <p class="max-w-xl mt-5 mx-auto text-xl text-gray-300">
                        Partager vos recettes avec vos amis, familles, collègues
                        ...
                    </p>
                    <div class="mt-8 flex justify-center">
                        <div class="inline-flex rounded-md shadow">
                            <router-link
                                to="/register"
                                class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700"
                            >
                                Je m'inscris
                            </router-link>
                        </div>
                        <div class="ml-3 inline-flex">
                            <router-link
                                to="/meals"
                                class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200"
                            >
                                Les recettes
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Carousel :mode="this.dark"></Carousel>
        <div
            class="bg-cover bg-center py-56"
            style="
                background-image: url('http://localhost:8000/images/meals/intro.jpg');
            "
        ></div>
    </div>
    <Footer :mode="this.dark"></Footer>
</template>

<script setup>
import axios from "axios";
import Header from "../components/Header.vue";
import Footer from "../components/Footer.vue";
import Slider from "../components/Slider.vue";
import Title from "../components/Title.vue";
import Statistic from "../components/Statistic.vue";
import Carousel from "../components/Carousel.vue";
import Notification from "../components/Notification.vue";
import GoToTopButton from "../components/GoToTopButton.vue";
//import { URL, CONFIG } from "../env.js";
import { onMounted, onBeforeMount, ref } from "vue";

//const CONFIG = ref(process.env.CONFIG);
//const URL = ref(URL);

const URL = ref("http://localhost:8000/");
let CONFIG = ref({
    headers: {
        "Content-Type": "multipart/form-data",
        "API-TOKEN": "",
        "USER-TOKEN": "",
    },
});

let dark = ref(false);
const message = ref("");
const title = ref("");
const type = ref("");
const show = ref(false);
let user = ref({});
const props = defineProps({
    mode: {
        type: String,
        required: true,
    },
});

const ChangeMode = () => {
    dark.value = window.sessionStorage.getItem("dark") == "true" ? true : false;
};

const notification = (msg, ttl, typ) => {
    message.value = msg;
    title.value = ttl;
    type.value = typ;
    show.value = true;
};

const notify = () => {
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());

    switch (params.msg) {
        case "welcome":
            notification(
                "Bienvenue dans l'application de gestion de recettes SOS-Sauce !",
                "Bienvenue " + params.name + " !",
                "success"
            );
            break;
        case "hello":
            notification(
                "vous nous aviez manqué ! Qu'est ce qu'on mange aujourd'hui ?",
                "Bonjour",
                "success"
            );
            break;
    }
};

const Cancel = () => {
    show.value = false;
};

const connectedUser = () => {
    axios
        .get("/api/user", CONFIG)
        .then(({ data }) => {
            user.value = data.user;
        })
        .catch((error) => console.error("error", error));
};
/*
onBeforeMount(() => {
    //CONFIG.headers["API-TOKEN"] = localStorage.getItem("api_token");
    //CONFIG.headers["USER-TOKEN"] = localStorage.getItem("user_token");
}),
*/
onMounted(() => {
    ChangeMode();
    notify();
    connectedUser();
});
</script>
