<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="bg-red-800">
        <div
            class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8 lg:py-20"
        >
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    Qu'est ce qu'on mange ?
                </h2>
                <p class="mt-3 text-xl text-indigo-200 sm:mt-4">
                    SOS-sauce vous propose d'enregistrer vos recettes et vous
                    permets d'accéder aux recettes des autres utilisateurs mais
                    pas seulement ...
                </p>
            </div>
            <dl
                class="mt-10 text-center sm:max-w-3xl sm:mx-auto sm:grid sm:grid-cols-3 sm:gap-8"
            >
                <div class="flex flex-col">
                    <dt
                        class="order-2 mt-2 text-lg leading-6 font-medium text-indigo-200"
                    >
                        Nombre de recettes
                    </dt>
                    <dd class="order-1 text-5xl font-extrabold text-white">
                        {{ nbMeals }}
                    </dd>
                </div>
                <div class="flex flex-col mt-10 sm:mt-0">
                    <dt
                        class="order-2 mt-2 text-lg leading-6 font-medium text-indigo-200"
                    >
                        Nombre de saucier
                    </dt>
                    <dd class="order-1 text-5xl font-extrabold text-white">
                        {{ nbUsers }}
                    </dd>
                </div>
                <div class="flex flex-col mt-10 sm:mt-0">
                    <dt
                        class="order-2 mt-2 text-lg leading-6 font-medium text-indigo-200"
                    >
                        Satisfaction
                    </dt>
                    <dd class="order-1 text-5xl font-extrabold text-white">
                        {{ satisfaction }} %
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    name: "Slider",
    props: ["mode"],
    data() {
        return {
            nbMeals: 0,
            nbUsers: 0,
            satisfaction: 0,
            dark: false,
        };
    },
    methods: {
        loadNbMeals() {
            axios
                .get("/api/meals/count")
                .then(({ data }) => (this.nbMeals = data))
                .catch((error) => console.log("error", error));
        },
        loadNbUsers() {
            axios
                .get("/api/users/count")
                .then(({ data }) => (this.nbUsers = data))
                .catch((error) => console.log("error", error));
        },
        ChangeMode() {
            this.dark =
                window.sessionStorage.getItem("dark") == "true" ? true : false;
        },
    },
    created() {
        this.loadNbMeals();
        this.loadNbUsers();
    },
    mounted() {
        this.ChangeMode();
        document.body.style.overflowX = "hidden";
    },
};
</script>
