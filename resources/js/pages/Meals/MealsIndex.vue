<template>
    <div :class="[dark ? 'bg-gray-600' : 'bg-white']">
        <Header
            @ChangeMode="ChangeMode($event)"
            @Filter="Search($event)"
        ></Header>
        <GoToTopButton></GoToTopButton>
        <main :class="[dark ? 'bg-gray-600' : 'bg-white']">
            <Notification
                @Cancel="Cancel($event)"
                :message="this.message"
                :title="this.title"
                :type="this.type"
                :show="this.show"
                :mode="this.dark"
            ></Notification>
            <transition
                name="fade"
                enter-active-class="transition ease-out duration-500"
                enter-from-class="transform opacity-0 scale-95"
                enter-to-class="transform opacity-100 scale-100"
                leave-active-class="transition ease-in duration-1000"
                leave-from-class="transform opacity-100 scale-100"
                leave-to-class="transform opacity-0 scale-95"
            >
                <div
                    v-if="
                        meals.length == 0 &&
                        currentPage == 'meals' &&
                        this.charged == true
                    "
                    class="min-h-full h-screen bg-cover bg-top sm:bg-top"
                    style="
                        background-image: url('http://www.localhost:8000/storage/meals/intro.jpg');
                        background-position: center;
                        background-size: cover;
                        background-repeat: no-repeat;
                    "
                >
                    <div
                        class="max-w-7xl mx-auto px-4 py-16 text-center sm:px-6 sm:py-24 lg:px-8 lg:py-48"
                    >
                        <p
                            class="text-sm font-semibold text-gray-100 text-opacity-80 uppercase tracking-wide"
                        >
                            ...
                        </p>
                        <h1
                            class="mt-2 text-4xl font-extrabold text-white tracking-tight sm:text-5xl"
                        >
                            Aucun plat trouvé !
                        </h1>
                        <p
                            class="mt-2 text-lg font-medium text-gray-100 text-opacity-80"
                        >
                            Le plat que vous cherchez ne semble pas présent !
                        </p>
                        <div class="mt-6">
                            <router-link
                                to="/"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-black text-opacity-75 bg-white bg-opacity-70 sm:bg-opacity-70 sm:hover:bg-opacity-90"
                            >
                                Retour à l'accueil
                            </router-link>
                        </div>
                    </div>
                </div>

                <div
                    v-else-if="
                        meals.length == 0 &&
                        currentPage == 'favorite' &&
                        this.charged == true
                    "
                    class="min-h-full h-screen bg-cover bg-top sm:bg-top"
                    style="
                        background-image: url('http://www.localhost:8000/storage/meals/intro.jpg');
                        background-position: center;
                        background-size: cover;
                        background-repeat: no-repeat;
                    "
                >
                    <div
                        class="max-w-7xl mx-auto px-4 py-16 text-center sm:px-6 sm:py-24 lg:px-8 lg:py-48"
                    >
                        <p
                            class="text-sm font-semibold text-gray-100 text-opacity-80 uppercase tracking-wide"
                        >
                            ...
                        </p>
                        <h1
                            class="mt-2 text-4xl font-extrabold text-white tracking-tight sm:text-5xl"
                        >
                            Aucun plat correspondant dans vos favoris !
                        </h1>
                        <p
                            class="mt-2 text-lg font-medium text-gray-100 text-opacity-80"
                        >
                            Le plat que vous cherchez ne semble pas présent dans
                            vos favoris !
                        </p>
                        <div class="mt-6">
                            <router-link
                                to="/"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-black text-opacity-75 bg-white bg-opacity-70 sm:bg-opacity-70 sm:hover:bg-opacity-90"
                            >
                                Retour à l'accueil
                            </router-link>
                        </div>
                    </div>
                </div>

                <div
                    v-else-if="
                        meals.length == 0 &&
                        currentPage == 'mine' &&
                        this.charged == true
                    "
                    class="min-h-full h-screen bg-cover bg-top sm:bg-top"
                    style="
                        background-image: url('http://www.localhost:8000/storage/meals/intro.jpg');
                        background-position: center;
                        background-size: cover;
                        background-repeat: no-repeat;
                    "
                >
                    <div
                        class="max-w-7xl mx-auto px-4 py-16 text-center sm:px-6 sm:py-24 lg:px-8 lg:py-48"
                    >
                        <p
                            class="text-sm font-semibold text-gray-100 text-opacity-80 uppercase tracking-wide"
                        >
                            ...
                        </p>
                        <h1
                            class="mt-2 text-4xl font-extrabold text-white tracking-tight sm:text-5xl"
                        >
                            Aucun de vos plats ne correspond !
                        </h1>
                        <p
                            class="mt-2 text-lg font-medium text-gray-100 text-opacity-80"
                        >
                            Le plat que vous cherchez ne semble pas présent dans
                            vos plats !
                        </p>
                        <div class="mt-6">
                            <router-link
                                to="/"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-black text-opacity-75 bg-white bg-opacity-70 sm:bg-opacity-70 sm:hover:bg-opacity-90"
                            >
                                Retour à l'accueil
                            </router-link>
                        </div>
                    </div>
                </div>

                <div
                    v-else-if="this.charged == true"
                    class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8"
                >
                    <h2 class="sr-only text-red">Meals</h2>

                    <div
                        class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8"
                    >
                        <Suspense>
                            <template #default>
                                <AsyncMeals
                                    v-for="meal in meals"
                                    :key="meal.id"
                                    :meal="meal"
                                    :URL="URL"
                                ></AsyncMeals>
                            </template>
                            <template #fallback>
                                <Loading></Loading>
                            </template>
                        </Suspense>
                    </div>
                </div>
            </transition>
        </main>
        <Footer :mode="this.dark"></Footer>
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
}
</style>

<script>
import axios from "axios";
import Header from "../../components/Header.vue";
import Footer from "../../components/Footer.vue";
import GoToTopButton from "../../components/GoToTopButton.vue";
import MealList from "../../components/MealList.vue";
import Loading from "../../components/Loading.vue";
import Notification from "../../components/Notification.vue";
import { URL } from "../../env.js";
import { defineAsyncComponent } from "vue";

const AsyncMeals = defineAsyncComponent({
    loader: () =>
        import("../../components/MealList.vue" /* webpackChunkName: "meal" */),
    loadingComponent: Loading,
    delay: 2000,
    //suspensible: false,
});

export default {
    components: {
        Header,
        Footer,
        Notification,
        MealList,
        AsyncMeals,
        Loading,
        GoToTopButton,
    },
    data() {
        return {
            URL: URL,
            user: {},
            list: {},
            meals: {},
            allMeals: {},
            favorite: [],
            mine: [],
            charged: false,
            dark: false,
            filter: "",
            searching: false,
            message: "",
            title: "",
            type: "",
            show: false,
            currentPage: "",
            CONFIG: {
                headers: {
                    "Content-Type": "multipart/form-data",
                    "API-TOKEN": "",
                    "USER-TOKEN": "",
                },
            },
        };
    },
    props: ["mode", "letters"],

    methods: {
        async loadData() {
            try {
                const resp = await axios.get("/api/meals", this.CONFIG);

                (this.list = resp.data.data),
                    (this.meals = resp.data.data),
                    (this.allMeals = resp.data.data),
                    // Favorite
                    Object.keys(this.list).forEach((key) => {
                        if (this.list[key].like == true) {
                            this.favorite.push(this.list[key]);
                        }
                    }),
                    this.connectedUser(this.allMeals);
                this.charged = true;
            } catch (error) {
                console.log(error);
            }
        },
        ChangeMode() {
            this.dark =
                window.sessionStorage.getItem("dark") == "true" ? true : false;
        },
        Search($event = null) {
            this.filter =
                typeof $event == "string"
                    ? $event
                    : window.sessionStorage.getItem("search");
            if (this.filter != null) {
                if (this.filter.length > 2) {
                    this.searching = true;
                    this.meals = [];
                    console.log(this.meals);
                    for (let i = 0; i < this.list.length; i++) {
                        if (
                            this.list[i].name
                                .toLowerCase()
                                .indexOf(this.filter.toLowerCase()) != -1
                        ) {
                            this.meals.push(this.list[i]);
                        }
                    }
                } else {
                    this.searching = false;
                    this.meals = this.list;
                    window.sessionStorage.removeItem("search");
                }
            }
        },
        notification(message, title, type) {
            this.message = message;
            this.title = title;
            this.type = type;
            this.show == true ? (this.show = false) : (this.show = true);
        },
        notify() {
            //TODO mounted where query string ...
            const urlSearchParams = new URLSearchParams(window.location.search);
            const params = Object.fromEntries(urlSearchParams.entries());

            switch (params.msg) {
                case "deleteSuccess":
                    this.notification(
                        "Votre plat a été supprimé avec succès, toutes les données associées également.",
                        "Suppression effectuée !",
                        "success"
                    );
                    break;
                case "deleteError":
                    this.notification(
                        "Une erreur est survenue lors de la suppression de votre plat, veuillez réessayer plus tard.",
                        "Suppression échouée !",
                        "error"
                    );
                    break;
                case "mealsuccess":
                    this.notification(
                        "Votre nouveau plat a été ajouté : " + params.name,
                        "Nouveau plat ajouté !",
                        "success"
                    );
                    break;
                case "favoritesuccess":
                    this.notification(
                        "Le plat a été ajouté aux favoris : " + params.name,
                        "Nouveau plat ajouté !",
                        "success"
                    );
                    break;
                case "favoriteError":
                    this.notification(
                        "Le plat n'a pas pu être ajouté aux Favoris : " +
                            params.name,
                        "Ajout aux favoris échoué !",
                        "error"
                    );
                    break;
            }
        },
        Cancel() {
            this.show = false;
        },
        connectedUser(mealList) {
            axios
                .get("/api/user", this.CONFIG)
                .then(({ data }) => {
                    (this.user = data.user),
                        Object.keys(mealList).forEach((key) => {
                            if (mealList[key].user_id == this.user.id) {
                                this.mine.push(mealList[key]);
                            }
                        }),
                        this.choicePage();
                    this.Search();
                })
                .catch((error) => console.log("error", error));
        },
        choicePage() {
            if (
                this.$router.currentRoute.value.name == "favorite" &&
                this.currentPage != "favorite" &&
                this.searching == false
            ) {
                this.currentPage = "favorite";
                this.list = this.favorite;
                this.meals = this.favorite;
            } else if (
                this.$router.currentRoute.value.name == "meals" &&
                this.currentPage != "meals" &&
                this.searching == false
            ) {
                this.currentPage = "meals";
                this.list = this.allMeals;
                this.meals = this.allMeals;
            } else if (
                this.$router.currentRoute.value.name == "mine" &&
                this.currentPage != "mine" &&
                this.searching == false
            ) {
                this.currentPage = "mine";
                this.list = this.mine;
                this.meals = this.mine;
            } else {
                this.currentPage = this.$router.currentRoute.value.name;
            }
        },
    },
    created() {
        this.CONFIG.headers["API-TOKEN"] = localStorage.getItem("api_token");
        this.CONFIG.headers["USER-TOKEN"] = localStorage.getItem("user_token");
        this.loadData();
    },
    mounted() {
        this.ChangeMode();
        this.notify();
    },
    beforeUpdate() {
        this.choicePage();
    },
};
</script>
