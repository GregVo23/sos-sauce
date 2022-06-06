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
        <Title></Title>
        <Statistic></Statistic>
        <Carousel></Carousel>
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
