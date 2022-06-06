<template>
    <div :class="[dark ? 'bg-gray-600' : 'bg-white', 'overflow-hidden']">
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
        <div class="bg-gray-600">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2
                        class="text-base font-semibold text-red-600 tracking-wide uppercase"
                    >
                        Pricing
                    </h2>
                    <p
                        class="mt-1 text-4xl font-extrabold text-gray-100 sm:text-5xl sm:tracking-tight lg:text-6xl"
                    >
                        Take control of your team.
                    </p>
                    <p class="max-w-xl mt-5 mx-auto text-xl text-gray-300">
                        Start building for free, then add a site plan to go
                        live. Account plans unlock additional features.
                    </p>
                    <div class="mt-8 flex justify-center">
                        <div class="inline-flex rounded-md shadow">
                            <a
                                href="#"
                                class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700"
                            >
                                Get started
                            </a>
                        </div>
                        <div class="ml-3 inline-flex">
                            <a
                                href="#"
                                class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200"
                            >
                                Learn more
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Carousel></Carousel>
        <div
            class="bg-cover bg-center py-56"
            style="
                background-image: url('http://localhost:8000/images/meals/intro.jpg');
            "
        ></div>
    </div>
    <Footer :mode="this.dark"></Footer>
</template>

<script>
import axios from "axios";
import Header from "../components/Header.vue";
import Footer from "../components/Footer.vue";
import Slider from "../components/Slider.vue";
import Title from "../components/Title.vue";
import Statistic from "../components/Statistic.vue";
import Carousel from "../components/Carousel.vue";
import Notification from "../components/Notification.vue";
import { URL } from "../env.js";

export default {
    components: {
        Header,
        Footer,
        Notification,
        Slider,
        Title,
        Statistic,
        Carousel,
    },
    data() {
        return {
            URL: URL,
            dark: false,
            message: "",
            title: "",
            type: "",
            show: false,
            user: {},
            CONFIG: {
                headers: {
                    "Content-Type": "multipart/form-data",
                    "API-TOKEN": "",
                    "USER-TOKEN": "",
                },
            },
        };
    },
    props: ["mode"],
    methods: {
        ChangeMode() {
            this.dark =
                window.sessionStorage.getItem("dark") == "true" ? true : false;
        },
        notification(message, title, type) {
            this.message = message;
            this.title = title;
            this.type = type;
            this.show == true ? (this.show = false) : (this.show = true);
        },
        notify() {
            const urlSearchParams = new URLSearchParams(window.location.search);
            const params = Object.fromEntries(urlSearchParams.entries());

            switch (params.msg) {
                case "welcome":
                    this.notification(
                        "Bienvenue dans l'application de gestion de recettes SOS-Sauce !",
                        "Bienvenue " + params.name + " !",
                        "success"
                    );
                    break;
                case "hello":
                    this.notification(
                        "vous nous aviez manqué ! Qu'est ce qu'on mange aujourd'hui ?",
                        "Bonjour",
                        "success"
                    );
                    break;
            }
        },
        Cancel() {
            this.show = false;
        },
        connectedUser() {
            axios
                .get("/api/user", this.CONFIG)
                .then(({ data }) => {
                    this.user = data.user;
                })
                .catch((error) => console.error("error", error));
        },
    },
    created() {
        this.CONFIG.headers["API-TOKEN"] = localStorage.getItem("api_token");
        this.CONFIG.headers["USER-TOKEN"] = localStorage.getItem("user_token");
    },
    mounted() {
        this.ChangeMode();
        this.notify();
        this.connectedUser();
    },
};
</script>
