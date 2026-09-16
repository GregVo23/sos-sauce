<template>
    <div :class="[dark ? 'bg-gray-700' : 'bg-gray-100']">
        <Header @ChangeMode="changeMode($event)"></Header>

        <div class="container mx-auto my-5 p-5 min-h-screen">
            <div class="md:flex no-wrap md:-mx-2 items-start">
                <!-- Left Side -->
                <div class="w-full md:w-3/12 md:mx-2">
                    <div class="flex justify-center">
                        <form
                            @submit="changeAvatar"
                            name="frmAvatar"
                            id="frmAvatar"
                            enctype="multipart/form-data"
                        >
                            <label>
                                <span
                                    title="Changer l'avatar"
                                    class="relative block w-36 h-36 rounded-full overflow-hidden cursor-pointer group"
                                >
                                    <img
                                        :src="user.avatar"
                                        alt=""
                                        class="w-full h-full object-cover"
                                    />
                                    <span
                                        class="absolute inset-0 flex items-center justify-center text-white font-semibold text-sm bg-black/0 group-hover:bg-black/45 opacity-0 group-hover:opacity-100 transition-all"
                                    >
                                        Changer
                                    </span>
                                </span>
                                <input
                                    v-on:change="onChange"
                                    class="hidden"
                                    type="file"
                                    accept="image/*"
                                    id="avatar"
                                    name="avatar"
                                />
                            </label>
                        </form>
                    </div>
                    <div class="text-center md:text-left mt-3">
                        <h1
                            :class="[
                                dark ? 'text-white' : 'text-gray-900',
                                'font-bold text-xl leading-8',
                            ]"
                        >
                            {{
                                profile.firstName != "my first name"
                                    ? profile.firstName
                                    : ""
                            }}
                            {{ profile.lastName }}
                        </h1>
                        <p
                            v-if="profile.about"
                            :class="[
                                dark ? 'text-gray-300' : 'text-gray-500',
                                'text-sm leading-6 mt-1',
                            ]"
                        >
                            {{ profile.about }}
                        </p>
                        <ul
                            :class="[
                                dark
                                    ? 'bg-gray-600 text-gray-200'
                                    : 'bg-white text-gray-600',
                                'py-2 px-3 mt-3 divide-y divide-gray-200/20 rounded-lg shadow-sm',
                            ]"
                        >
                            <li class="flex items-center py-3">
                                <span>Statut</span>
                                <span class="ml-auto">
                                    <span
                                        class="bg-green-500 py-1 px-2 rounded-full text-white text-xs font-semibold"
                                        >Actif</span
                                    >
                                </span>
                            </li>
                            <li class="flex items-center py-3">
                                <span>Membre depuis</span>
                                <span class="ml-auto">
                                    {{ memberSince }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Right Side -->
                <div class="w-full md:w-9/12 mx-2">
                    <!-- About Section -->
                    <div
                        :class="[
                            dark ? 'bg-gray-600' : 'bg-white',
                            'p-4 shadow-lg rounded-lg',
                        ]"
                    >
                        <div class="flex items-center justify-between mb-3">
                            <div
                                :class="[
                                    dark ? 'text-white' : 'text-gray-900',
                                    'flex items-center space-x-2 font-semibold leading-8',
                                ]"
                            >
                                <svg
                                    class="h-5 w-5 text-red-600"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                    />
                                </svg>
                                <span class="tracking-wide">À propos</span>
                            </div>
                            <button
                                type="button"
                                @click="toggleEdit"
                                :class="[
                                    dark
                                        ? 'text-gray-200 hover:bg-gray-700 hover:text-white'
                                        : 'text-gray-500 hover:bg-red-50 hover:text-red-600',
                                    'h-9 w-9 rounded-full flex items-center justify-center transition-colors',
                                ]"
                                :title="updateProfil ? 'Modifier' : 'Annuler'"
                            >
                                <svg
                                    v-if="updateProfil"
                                    class="h-5 w-5"
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
                                <svg
                                    v-else
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2.2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6 6l12 12M18 6L6 18"
                                    />
                                </svg>
                            </button>
                        </div>

                        <!-- Read-only view -->
                        <div v-if="updateProfil" :class="[dark ? 'text-gray-200' : 'text-gray-700']">
                            <div class="grid sm:grid-cols-2 text-sm gap-y-1">
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Nom</div>
                                    <div class="px-4 py-2">{{ profile.lastName }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Prénom</div>
                                    <div class="px-4 py-2">{{ profile.firstName }}</div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">Genre</div>
                                    <div class="px-4 py-2">
                                        {{
                                            profile.gender == "man"
                                                ? "Homme"
                                                : profile.gender == "woman"
                                                ? "Femme"
                                                : profile.gender == "other"
                                                ? "Autre"
                                                : "Non défini"
                                        }}
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">E-mail</div>
                                    <div class="px-4 py-2">
                                        <a
                                            class="text-red-600 hover:underline"
                                            :href="'mailto:' + profile.email"
                                            >{{ profile.email }}</a
                                        >
                                    </div>
                                </div>
                                <div class="grid grid-cols-2">
                                    <div class="px-4 py-2 font-semibold">
                                        Anniversaire
                                    </div>
                                    <div class="px-4 py-2">
                                        {{
                                            profile.birthday
                                                ? profile.birthday.split(" ")[0]
                                                : "Non défini"
                                        }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit form -->
                        <div v-else>
                            <div class="grid sm:grid-cols-2 gap-4 text-sm mb-4">
                                <div>
                                    <label
                                        :class="[
                                            dark ? 'text-gray-200' : 'text-gray-700',
                                            'block font-semibold mb-1',
                                        ]"
                                        for="last_name"
                                        >Nom</label
                                    >
                                    <input
                                        id="last_name"
                                        type="text"
                                        :class="[
                                            dark
                                                ? 'bg-gray-700 border-gray-500 text-white'
                                                : 'bg-white border-gray-300',
                                            'w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-600 focus:border-red-600',
                                        ]"
                                        v-model="profile.lastName"
                                    />
                                </div>
                                <div>
                                    <label
                                        :class="[
                                            dark ? 'text-gray-200' : 'text-gray-700',
                                            'block font-semibold mb-1',
                                        ]"
                                        for="first_name"
                                        >Prénom</label
                                    >
                                    <input
                                        id="first_name"
                                        type="text"
                                        :class="[
                                            dark
                                                ? 'bg-gray-700 border-gray-500 text-white'
                                                : 'bg-white border-gray-300',
                                            'w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-600 focus:border-red-600',
                                        ]"
                                        v-model="profile.firstName"
                                    />
                                </div>
                                <div>
                                    <label
                                        :class="[
                                            dark ? 'text-gray-200' : 'text-gray-700',
                                            'block font-semibold mb-1',
                                        ]"
                                        for="gender"
                                        >Genre</label
                                    >
                                    <select
                                        id="gender"
                                        :class="[
                                            dark
                                                ? 'bg-gray-700 border-gray-500 text-white'
                                                : 'bg-white border-gray-300',
                                            'w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-600 focus:border-red-600',
                                        ]"
                                        v-model="profile.gender"
                                    >
                                        <option value="">Non défini</option>
                                        <option value="woman">Femme</option>
                                        <option value="man">Homme</option>
                                        <option value="other">Autre</option>
                                    </select>
                                </div>
                                <div>
                                    <label
                                        :class="[
                                            dark ? 'text-gray-200' : 'text-gray-700',
                                            'block font-semibold mb-1',
                                        ]"
                                        for="email"
                                        >E-mail</label
                                    >
                                    <input
                                        id="email"
                                        type="email"
                                        :class="[
                                            dark
                                                ? 'bg-gray-700 border-gray-500 text-white'
                                                : 'bg-white border-gray-300',
                                            'w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-600 focus:border-red-600',
                                        ]"
                                        v-model="profile.email"
                                    />
                                </div>
                                <div>
                                    <label
                                        :class="[
                                            dark ? 'text-gray-200' : 'text-gray-700',
                                            'block font-semibold mb-1',
                                        ]"
                                        for="birthday"
                                        >Anniversaire</label
                                    >
                                    <input
                                        id="birthday"
                                        type="date"
                                        :class="[
                                            dark
                                                ? 'bg-gray-700 border-gray-500 text-white'
                                                : 'bg-white border-gray-300',
                                            'w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-red-600 focus:border-red-600',
                                        ]"
                                        v-model="birthdayDate"
                                    />
                                </div>
                            </div>
                            <p v-if="profileError" class="text-red-600 text-sm mb-3">
                                {{ profileError }}
                            </p>
                            <button
                                type="button"
                                class="inline-flex items-center px-6 py-2.5 rounded-full font-medium text-sm text-white bg-red-600 hover:bg-red-700"
                                @click="submitProfil"
                            >
                                Enregistrer les modifications
                            </button>
                        </div>
                    </div>
                    <!-- End of about section -->

                    <div class="my-4"></div>

                    <!-- Recipes and sauces -->
                    <div
                        :class="[
                            dark ? 'bg-gray-600' : 'bg-white',
                            'p-4 shadow-lg rounded-lg',
                        ]"
                    >
                        <div class="grid sm:grid-cols-2 gap-6">
                            <div>
                                <div
                                    :class="[
                                        dark ? 'text-white' : 'text-gray-900',
                                        'flex items-center space-x-2 font-semibold leading-8 mb-3',
                                    ]"
                                >
                                    <svg
                                        class="h-5 w-5 text-red-600"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                        />
                                    </svg>
                                    <span class="tracking-wide">Mes recettes</span>
                                </div>
                                <ul
                                    v-if="meals.length > 0"
                                    class="list-inside space-y-3"
                                >
                                    <li v-for="meal in meals" :key="meal.id">
                                        <router-link :to="`/meal/${meal.slug}`">
                                            <div class="text-red-600 hover:text-red-800 font-medium">
                                                {{ meal.name }}
                                            </div>
                                            <div
                                                :class="[
                                                    dark ? 'text-gray-300' : 'text-gray-500',
                                                    'text-xs',
                                                ]"
                                            >
                                                {{ meal.description }}
                                            </div>
                                        </router-link>
                                    </li>
                                </ul>
                                <p
                                    v-else
                                    :class="[dark ? 'text-gray-300' : 'text-gray-500', 'text-sm']"
                                >
                                    Pas encore de recettes.
                                </p>
                            </div>
                            <div>
                                <div
                                    :class="[
                                        dark ? 'text-white' : 'text-gray-900',
                                        'flex items-center space-x-2 font-semibold leading-8 mb-3',
                                    ]"
                                >
                                    <svg
                                        class="h-5 w-5 text-red-600"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 4.5C7 4.5 2.7 7.6 1 12c1.7 4.4 6 7.5 11 7.5s9.3-3.1 11-7.5c-1.7-4.4-6-7.5-11-7.5z"
                                        />
                                        <circle cx="12" cy="12" r="3" stroke-width="2" />
                                    </svg>
                                    <span class="tracking-wide">Mes sauces</span>
                                </div>
                                <p
                                    :class="[dark ? 'text-gray-300' : 'text-gray-500', 'text-sm']"
                                >
                                    Pas encore de sauces.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Footer :mode="this.dark"></Footer>
    </div>
</template>

<script>
import axios from "axios";
import Header from "../../components/Header.vue";
import Footer from "../../components/Footer.vue";
import { useUserStore } from "../../stores/user";

export default {
    components: { Header, Footer },
    data() {
        return {
            dark: false,
            CONFIG: {
                headers: {
                    "API-TOKEN": "",
                    "USER-TOKEN": "",
                },
            },
            user: "",
            meals: [],
            avatar: "",
            memberSince: "",
            updateProfil: true,
            profileError: null,
            profile: {
                lastName: "",
                firstName: "",
                email: "",
                birthday: "",
                gender: "",
                about: "",
                memberSince: "",
            },
        };
    },
    computed: {
        birthdayDate: {
            get() {
                return this.profile.birthday
                    ? this.profile.birthday.split(" ")[0]
                    : "";
            },
            set(value) {
                this.profile.birthday = value;
            },
        },
    },
    methods: {
        toggleEdit() {
            this.updateProfil = !this.updateProfil;
            this.profileError = null;
        },
        submitProfil() {
            this.saveProfil();
        },
        saveProfil() {
            let data = new FormData();
            data.append("last_name", this.profile.lastName || "");
            data.append("first_name", this.profile.firstName || "");
            data.append("email", this.profile.email || "");
            data.append("gender", this.profile.gender || "");
            data.append("birthday", this.profile.birthday || "");

            axios
                .post("/api/profile/" + this.user.id, data, this.CONFIG)
                .then((res) => {
                    if (res.data.type === "error") {
                        this.profileError =
                            typeof res.data.message === "string"
                                ? res.data.message
                                : "Certains champs sont invalides.";
                        return;
                    }
                    this.profileError = null;
                    this.updateProfil = true;
                    this.connectedUser();
                })
                .catch((error) => {
                    this.profileError =
                        "Une erreur est survenue, veuillez réessayer.";
                    console.log("error", error);
                });
        },
        changeMode() {
            this.dark =
                window.sessionStorage.getItem("dark") == "true" ? true : false;
        },
        connectedUser() {
            axios
                .get("/api/user", this.CONFIG)
                .then(({ data }) => {
                    this.user = data.user;
                    useUserStore().setUser(data.user);
                    this.profile.lastName = this.user.last_name;
                    this.profile.firstName = this.user.first_name;
                    this.profile.email = this.user.email;
                    this.profile.gender = this.user.gender;
                    this.profile.memberSince = this.user.member_since;
                    this.profile.birthday = this.user.birthday;
                    this.profile.about = this.user.about;
                    this.profile.createdAt = this.user.created_at;
                    this.memberSince = this.user.created_at
                        ? this.user.created_at.slice(0, 10)
                        : "";
                })
                .catch((error) => console.error("error", error));
        },
        getUserMeals() {
            axios
                .get("/api/user/meals", this.CONFIG)
                .then(({ data }) => {
                    this.meals = data;
                })
                .catch((error) => console.error("error", error));
        },
        onChange(e) {
            this.avatar = e.target.files[0];
            this.avatarName = e.target.files[0].name;
            this.changeAvatar(e);
        },
        changeAvatar(e) {
            e.preventDefault();

            let data = new FormData();
            data.append("file", this.avatar);

            axios
                .post("/api/avatar/" + this.user.id, data, this.CONFIG)
                .then((res) => {
                    this.connectedUser();
                })
                .catch((error) => {
                    console.log("error", error);
                });
        },
    },
    created() {
        this.CONFIG.headers["API-TOKEN"] = localStorage.getItem("api_token");
        this.CONFIG.headers["USER-TOKEN"] = localStorage.getItem("user_token");
    },
    mounted() {
        this.changeMode();
        this.connectedUser();
        this.getUserMeals();
    },
};
</script>
