<template>
    <div :class="[dark ? 'bg-gray-600' : 'bg-white']">
        <Header @ChangeMode="ChangeMode($event)"></Header>
        <GoToTopButton></GoToTopButton>
        <Modal
            v-if="showModalDelete"
            @refuse="Cancel($event)"
            @accept="Delete($event)"
            :open="this.open"
            :message="this.message"
            :title="this.title"
            :type="this.type"
            :mode="this.dark"
        ></Modal>
        <Modal
            v-if="showModalLike"
            @refuse="Cancel($event)"
            @accept="Like($event)"
            :open="this.open"
            :message="this.message"
            :title="this.title"
            :type="this.type"
            :mode="this.dark"
        ></Modal>
        <Notification
            @Cancel="showToast = false"
            :message="toastMessage"
            :title="toastTitle"
            :type="toastType"
            :show="showToast"
            :mode="this.dark"
        ></Notification>
        <div :class="[dark ? 'bg-gray-600' : 'bg-white', 'xl:flex pt-6']">
            <div class="xl:w-1/2">
                <transition
                    name="filterSearch"
                    enter-active-class="transition ease-out duration-1000"
                    enter-from-class="transform opacity-0 scale-95"
                    enter-to-class="transform opacity-100 scale-100"
                    leave-active-class="transition ease-in duration-1000"
                    leave-from-class="transform opacity-100 scale-100"
                    leave-to-class="transform opacity-0 scale-95"
                >
                    <img
                        v-if="charged"
                        :src="URL + 'storage/meals/detail/' + meal.picture"
                        :alt="meal.name"
                        :class="[
                            dark ? 'opacity-80' : 'opacity-100',
                            'xl:rounded-tr-3xl w-full h-full object-center object-cover',
                        ]"
                    />
                </transition>
            </div>

            <div class="xl:w-1/2 p-8">
                <div class="flex items-center justify-between mb-6">
                    <button
                        type="button"
                        @click="goBack"
                        title="Retour"
                        :class="[
                            dark
                                ? 'text-gray-200 hover:bg-gray-700 hover:text-white'
                                : 'text-gray-600 hover:bg-red-50 hover:text-red-600',
                            'h-12 w-12 rounded-full flex items-center justify-center transition-colors',
                        ]"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2.2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15 19l-7-7 7-7"
                            />
                        </svg>
                    </button>
                    <div class="flex items-center gap-1">
                        <button
                            v-if="isOwner"
                            type="button"
                            @click="updateMeal(meal)"
                            title="Modifier"
                            :class="[
                                dark
                                    ? 'text-gray-200 hover:bg-gray-700 hover:text-white'
                                    : 'text-gray-600 hover:bg-red-50 hover:text-red-600',
                                'h-12 w-12 rounded-full flex items-center justify-center transition-colors',
                            ]"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                />
                            </svg>
                        </button>
                        <button
                            v-if="connected"
                            type="button"
                            @click="likeMeal(meal)"
                            title="Favoris"
                            :class="[
                                like
                                    ? 'text-red-600 hover:bg-red-50'
                                    : dark
                                    ? 'text-gray-200 hover:bg-gray-700 hover:text-white'
                                    : 'text-gray-600 hover:bg-red-50 hover:text-red-600',
                                'h-12 w-12 rounded-full flex items-center justify-center transition-colors',
                            ]"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                :fill="like ? 'currentColor' : 'none'"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                />
                            </svg>
                        </button>
                        <button
                            v-if="isOwner"
                            type="button"
                            @click="deleteMeal(meal)"
                            title="Supprimer"
                            :class="[
                                dark
                                    ? 'text-gray-200 hover:bg-gray-700 hover:text-white'
                                    : 'text-gray-600 hover:bg-red-50 hover:text-red-600',
                                'h-12 w-12 rounded-full flex items-center justify-center transition-colors',
                            ]"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
                <h1
                    :class="[
                        dark ? 'text-white' : 'text-gray-900',
                        'text-4xl font-extrabold',
                    ]"
                >
                    {{ meal.name }}
                </h1>
                <div
                    v-if="meal.categories && meal.categories.length"
                    class="flex flex-wrap gap-2 pt-4 pb-2"
                >
                    <span
                        v-for="category in meal.categories"
                        :key="category.id"
                        class="px-3 py-1 rounded-full text-sm font-medium bg-red-600 text-white"
                    >
                        {{ category.name }}
                    </span>
                </div>
                <p
                    :class="[
                        dark ? 'text-gray-300' : 'text-gray-500',
                        meal.categories && meal.categories.length ? 'mt-2' : 'mt-6',
                        'leading-relaxed',
                    ]"
                >
                    {{ meal.description }}
                </p>
                <RadioGroup class="mt-10">
                    <RadioGroupLabel class="sr-only">
                        Choose a size
                    </RadioGroupLabel>
                    <div class="grid grid-cols-3 gap-3 sm:grid-cols-6">
                        <RadioGroupOption
                            as="template"
                            v-for="person in nbPerson"
                            :key="nbPerson"
                            :value="person"
                            v-slot="{ active, checked }"
                            @click="adaptPerson(person)"
                        >
                            <div
                                :class="[
                                    active
                                        ? 'ring-4 ring-offset-2 ring-red-500'
                                        : '',
                                    checked
                                        ? 'bg-red-600 border-transparent text-white hover:bg-red-700'
                                        : 'bg-white border-gray-200 text-gray-900 hover:bg-gray-50',
                                    'border rounded-md py-3 px-3 flex items-center justify-center text-sm font-medium uppercase sm:flex-1',
                                ]"
                            >
                                <RadioGroupLabel as="span">
                                    {{ person }}
                                </RadioGroupLabel>
                            </div>
                        </RadioGroupOption>
                    </div>
                </RadioGroup>
                <p
                    v-if="meal.number"
                    :class="[dark ? 'text-white' : 'text-gray-800', 'mt-10']"
                >
                    {{ howMany }} personne{{ howMany > 1 ? "s" : "" }}
                </p>
                <p class="mt-8 mb-1 text-sm font-semibold text-red-600 uppercase tracking-wide">
                    Ingrédients
                </p>
                <ul v-for="ingredient in ingredients" :key="ingredient.id" class="space-y-2">
                    <li
                        :class="[dark ? 'text-gray-100' : 'text-gray-800', 'flex items-baseline gap-2.5']"
                    >
                        <span class="h-1.5 w-1.5 rounded-full bg-red-600 flex-shrink-0"></span>
                        <span>
                            {{ ingredient.name }} :
                            {{
                                Math.round(
                                    (ingredient.quantity / meal.number) *
                                        howMany *
                                        10
                                ) / 10
                            }}
                            {{ ingredient.unit }}.
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <StepRecipe
            :mode="this.dark"
            :URL="this.URL"
            :meal="this.meal"
        ></StepRecipe>
        <div class="flex justify-center pt-2 pb-10">
            <button
                @click="getRecipes()"
                class="z-10 p-3 bg-gray-100 hover:bg-red-600 text-gray-900 hover:text-white rounded-full shadow-md"
            >
                <svg
                    class="w-10 h-9"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2.5"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    ></path>
                </svg>
            </button>
        </div>
        <button @click="addStepRecipe()">add</button>
        <Footer :mode="this.dark"></Footer>
    </div>
</template>

<script>
import axios from "axios";
import Header from "../../components/Header.vue";
import Footer from "../../components/Footer.vue";
import Modal from "../../components/Modal.vue";
import Notification from "../../components/Notification.vue";
import { URL } from "../../env.js";
import StepRecipe from "../../components/StepRecipe.vue";
import GoToTopButton from "../../components/GoToTopButton.vue";
import { RadioGroup, RadioGroupLabel, RadioGroupOption } from "@headlessui/vue";
import { useUserStore } from "../../stores/user";

export default {
    components: {
        Header,
        Footer,
        Modal,
        Notification,
        RadioGroup,
        RadioGroupLabel,
        RadioGroupOption,
        StepRecipe,
        GoToTopButton,
    },
    setup() {
        return {
            userStore: useUserStore(),
        };
    },
    computed: {
        isOwner() {
            return (
                !!this.userStore.user &&
                !!this.meal &&
                this.userStore.user.id === this.meal.user_id
            );
        },
    },
    data() {
        return {
            howMany: 1,
            nbPerson: [1, 2, 3, 4, 5, 6],
            URL: URL,
            meal: {},
            ingredients: {},
            like: false,
            dark: false,
            message: "",
            title: "",
            type: "",
            open: false,
            charged: false,
            showModalDelete: false,
            showModalLike: false,
            showToast: false,
            toastMessage: "",
            toastTitle: "",
            toastType: "",
            connected: false,
            current: {
                recipe: {
                    ingredient_id: 2,
                    quantity: 1,
                    picture: "picture",
                    meal_id: "",
                    step: 1,
                    description: "super plat",
                    time: 10000,
                },
            },
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
        loadData() {
            axios
                .get("/api/meal/" + this.$route.params.slug, this.CONFIG)
                .then(({ data }) => {
                    (this.charged = true),
                        (this.meal = data[0]),
                        (this.current.recipe.meal_id = data[0].id),
                        (this.ingredients = data[1]),
                        (this.like = data[2].like);
                })
                .catch((error) => console.log("error", error));
        },
        ChangeMode() {
            this.dark =
                window.sessionStorage.getItem("dark") == "true" ? true : false;
        },
        notification(message, title, type) {
            this.message = message;
            this.title = title;
            this.type = type;
            this.open == true ? (this.open = false) : (this.open = true);
        },
        notify() {
            switch (this.$route.query.msg) {
                case "mealsuccess":
                    this.toastMessage = "Votre nouveau plat a été ajouté !";
                    this.toastTitle = "Plat ajouté";
                    this.toastType = "success";
                    this.showToast = true;
                    break;
                case "mealupdated":
                    this.toastMessage = "Votre plat a été mis à jour.";
                    this.toastTitle = "Modifications enregistrées";
                    this.toastType = "success";
                    this.showToast = true;
                    break;
            }
        },
        updateMeal(meal) {
            this.$router.push("/meal/" + meal.slug + "/edit");
        },
        likeMeal(meal) {
            this.showModalDelete = false;
            this.showModalLike = true;
            if (this.like == false) {
                this.notification(
                    "Ajouter un plat à vos favoris vous permet de le retrouver plus facilement par la suite.",
                    "Ajouter " + meal.name + " à vos plats favoris ?",
                    "like"
                );
            } else {
                this.notification(
                    "Retirer définitivement le plat de vos favoris.",
                    "Retirer " + meal.name + " de vos plats favoris ?",
                    "like"
                );
            }
        },
        Like() {
            this.like = !this.like;
            this.open = false;
            axios
                .get("/api/favorite/" + this.meal.id, this.CONFIG)
                .then(({ data }) => {
                    if (this.like == false) {
                        this.$router.push(
                            "/meal/" + this.meal.slug + "?msg=favoriteSuccess"
                        );
                    } else {
                        this.$router.push(
                            "/meal/" +
                                this.meal.slug +
                                "?msg=favoriteRemoveSuccess"
                        );
                    }
                })
                .catch((error) => {
                    this.$router.push(
                        "/meal/" + this.meal.slug + "?msg=favoriteError"
                    );
                });
        },
        deleteMeal(meal) {
            this.showModalLike = false;
            this.showModalDelete = true;
            this.notification(
                "Cette action est irréversible, soyez certain de vouloir effacer le plat suivant : " +
                    meal.name +
                    ".",
                "Etes vous sur de supprimer : " + meal.name + " ?",
                "delete"
            );
        },
        Delete() {
            if (true) {
                this.open = false;

                axios
                    .delete("/api/meal/" + this.meal.slug, this.CONFIG)
                    .then(this.$router.push("/meals?msg=deleteSuccess"))
                    .catch((error) => {
                        console.log("error", error);
                        this.$router.push("/meals?msg=deleteError");
                    });
            }
        },
        goBack() {
            return this.$router.go(-1);
        },
        Cancel() {
            this.open = false;
        },
        isConnected() {
            if (
                localStorage.getItem("api_token") &&
                localStorage.getItem("user_token")
            ) {
                this.CONFIG.headers["API-TOKEN"] =
                    localStorage.getItem("api_token");
                this.CONFIG.headers["USER-TOKEN"] =
                    localStorage.getItem("user_token");
                this.connected = true;
            }
        },
        increaseNbPerson() {
            this.howMany++;
            console.log("+");
        },
        decreaseNbPerson() {
            this.howMany--;
            console.log("-");
        },
        adaptPerson(person) {
            console.log(person);
            while (person > this.howMany) {
                this.increaseNbPerson();
            }
            while (person < this.howMany) {
                this.decreaseNbPerson();
            }
            console.log(this.howMany);
        },
        addStepRecipe() {
            let formData = new FormData();
            formData.append("ingredient_id", this.current.recipe.ingredient_id);
            formData.append("quantity", this.current.recipe.quantity);
            formData.append("picture", this.current.recipe.picture);
            formData.append("meal_id", this.current.recipe.meal_id);
            formData.append("step", this.current.recipe.step);
            formData.append("description", this.current.recipe.description);
            formData.append("time", this.current.recipe.time);

            axios
                .post(
                    "/api/recipe/" + this.$route.params.slug,
                    formData,
                    this.CONFIG
                )
                .then((res) => this.loadData())
                //.catch((error) => console.log("error", error))
                .catch(function (error) {
                    if (error.response.status == 403) {
                        router.push("/login?msg=notconnected");
                    } else {
                        console.log(error.response.status);
                        console.log(error.response.data);
                    }
                });
        },
        getRecipes() {
            axios
                .get("/api/recipes/" + this.$route.params.slug, this.CONFIG)
                .then(({ data }) => {
                    console.log(data);
                })
                .catch((error) => console.log("error", error));
        },
    },
    created() {
        this.isConnected();
        this.loadData();
    },
    mounted() {
        this.ChangeMode();
        this.userStore.fetchUser();
        this.notify();
    },
};
</script>
