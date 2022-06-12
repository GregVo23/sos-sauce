<template>
    <div :class="[dark ? 'bg-gray-600' : 'bg-white']">
        <Header @ChangeMode="changeMode($event)"></Header>
        <div :class="[dark ? 'bg-gray-700' : 'bg-gray-100']">
            <div class="container mx-auto my-5 p-5 min-h-screen">
                <div class="md:flex no-wrap md:-mx-2">
                    <!-- Left Side -->
                    <div class="w-full md:w-3/12 md:mx-2">
                        <!-- Profile Card -->

                        <div class="hover:bg-red-700 cursor-pointer">
                            <form
                                @submit="changeAvatar"
                                name="frmAvatar"
                                id="frmAvatar"
                                method="POST"
                                enctype="multipart/form-data"
                                action="./api/avatar"
                            >
                                <label>
                                    <span
                                        className="relative"
                                        title="changer l'avatar"
                                        class="image overflow-hidden cursor-pointer"
                                    >
                                        <img
                                            :src="user.avatar"
                                            alt=""
                                            className="hover:opacity-25 transition-opacity duration-1000 ease-out"
                                            style="object-fit: cover"
                                        />
                                    </span>
                                    <input
                                        v-on:change="onChange"
                                        class="hidden"
                                        type="file"
                                        id="avatar"
                                        name="avatar"
                                    />
                                </label>
                            </form>
                        </div>
                        <div>
                            <h1
                                class="text-gray-900 font-bold text-xl leading-8 my-1"
                            >
                                {{
                                    profile.firstName != "my first name"
                                        ? profile.firstName
                                        : ""
                                }}
                                {{ profile.lastName }}
                            </h1>
                            <p
                                class="text-sm text-gray-500 hover:text-gray-600 leading-6"
                            >
                                Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Reprehenderit, eligendi
                                dolorum sequi illum qui unde aspernatur non
                                deserunt
                            </p>
                            <ul
                                class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm"
                            >
                                <li class="flex items-center py-3">
                                    <span>Statut</span>
                                    <span class="ml-auto"
                                        ><span
                                            class="bg-green-500 py-1 px-2 rounded text-white text-sm"
                                            >Active</span
                                        ></span
                                    >
                                </li>
                                <li class="flex items-center py-3">
                                    <span>Member since</span>
                                    <span class="ml-auto">{{
                                        profile.createdAt
                                    }}</span>
                                </li>
                            </ul>
                        </div>

                        <!-- End of profile card -->
                        <div class="my-4"></div>
                    </div>
                    <!-- Right Side -->
                    <div class="w-full md:w-9/12 mx-2 h-64">
                        <!-- Profile tab -->
                        <!-- About Section -->
                        <div class="bg-white p-3 shadow-sm rounded-sm">
                            <div
                                class="flex items-center space-x-2 font-semibold text-gray-900 leading-8"
                            >
                                <span clas="text-green-500">
                                    <svg
                                        class="h-5"
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
                                </span>
                                <span class="tracking-wide">A propos</span>
                            </div>
                            <div class="text-gray-700" v-if="updateProfil">
                                <div class="grid md:grid-cols-2 text-sm">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">
                                            Nom
                                        </div>
                                        <div
                                            @click="
                                                (updateProfil = !updateProfil),
                                                    updateSelectedInputProfil(
                                                        'last_name'
                                                    )
                                            "
                                            class="px-4 py-2"
                                        >
                                            {{ profile.lastName }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">
                                            Prénom
                                        </div>
                                        <div
                                            @click="
                                                (updateProfil = !updateProfil),
                                                    updateSelectedInputProfil(
                                                        'first_name'
                                                    )
                                            "
                                            class="px-4 py-2"
                                        >
                                            {{ profile.firstName }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">
                                            Genre
                                        </div>
                                        <div
                                            @click="
                                                (updateProfil = !updateProfil),
                                                    updateSelectedInputProfil(
                                                        'gender'
                                                    )
                                            "
                                            class="px-4 py-2"
                                        >
                                            {{
                                                profile.gender != null
                                                    ? profile.gender == "man"
                                                        ? "homme"
                                                        : profile.gender ==
                                                          "woman"
                                                        ? "femme"
                                                        : "autres"
                                                    : "Définir votre genre"
                                            }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">
                                            E-mail
                                        </div>
                                        <div
                                            @click="
                                                (updateProfil = !updateProfil),
                                                    updateSelectedInputProfil(
                                                        'email'
                                                    )
                                            "
                                            class="px-4 py-2"
                                        >
                                            <a
                                                class="text-blue-800"
                                                :href="mailto"
                                                >{{ profile.email }}</a
                                            >
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">
                                            Anniversaire
                                        </div>
                                        <div
                                            @click="
                                                (updateProfil = !updateProfil),
                                                    updateSelectedInputProfil(
                                                        'birthday'
                                                    )
                                            "
                                            class="px-4 py-2"
                                        >
                                            {{ profile.birthday.split(" ")[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-gray-700" v-if="!updateProfil">
                                <div class="grid md:grid-cols-2 text-sm">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">
                                            Nom
                                        </div>
                                        <div class="px-4 py-2">
                                            <input
                                                id="last_name"
                                                type="text"
                                                name="name"
                                                v-model="profile.lastName"
                                            />
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">
                                            Prénom
                                        </div>
                                        <div class="px-4 py-2">
                                            <input
                                                id="first_name"
                                                type="text"
                                                name="firstname"
                                                v-model="profile.firstName"
                                            />
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">
                                            Genre
                                        </div>
                                        <div class="px-4 py-2">
                                            <select name="gender" id="gender">
                                                <option
                                                    :value="
                                                        profile.gender != null
                                                            ? profile.gender ==
                                                              'man'
                                                                ? 'man'
                                                                : profile.gender ==
                                                                  'woman'
                                                                ? 'woman'
                                                                : 'other'
                                                            : null
                                                    "
                                                >
                                                    {{
                                                        profile.gender != null
                                                            ? profile.gender ==
                                                              "man"
                                                                ? "homme"
                                                                : profile.gender ==
                                                                  "woman"
                                                                ? "femme"
                                                                : "autres"
                                                            : "Définir votre genre"
                                                    }}
                                                </option>
                                                <option value="woman">
                                                    Femme
                                                </option>
                                                <option value="man">
                                                    Homme
                                                </option>
                                                <option value="other">
                                                    Autre
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">
                                            E-mail
                                        </div>
                                        <div class="px-4 py-2">
                                            <input
                                                id="email"
                                                type="text"
                                                name="email"
                                                v-model="profile.email"
                                            />
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">
                                            Anniversaire
                                        </div>
                                        <div class="px-4 py-2">
                                            <input
                                                id="birthday"
                                                type="date"
                                                name="birthday"
                                                v-model="profile.birthday"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button
                                :class="[
                                    updateProfil
                                        ? 'bg-gray-100 hover:bg-gray-300 focus:outline-none focus:shadow-outline'
                                        : 'bg-red-300 hover:bg-red-500 focus:outline-none focus:shadow-outline',
                                    'block w-full text-blue-800 text-sm font-semibold rounded-lg focus:outline-none focus:shadow-outline hover:shadow-xs p-3 my-4',
                                ]"
                                @click="
                                    (updateProfil = !updateProfil), saveProfil()
                                "
                            >
                                {{
                                    updateProfil
                                        ? "Modifier profil"
                                        : "Sauvegarder profil"
                                }}
                            </button>
                        </div>
                        <!-- End of about section -->

                        <div class="my-4"></div>

                        <!-- Experience and education -->
                        <div class="bg-white p-3 shadow-sm rounded-sm">
                            <div class="grid grid-cols-2">
                                <div>
                                    <div
                                        class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3"
                                    >
                                        <span clas="text-green-500">
                                            <svg
                                                class="h-5"
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
                                        </span>
                                        <span class="tracking-wide"
                                            >Mes recettes</span
                                        >
                                    </div>
                                    <ul
                                        class="list-inside space-y-2"
                                        v-for="meal in meals"
                                        :id="meal.id"
                                    >
                                        <li>
                                            <div class="text-teal-600">
                                                {{ meal.name }}
                                            </div>
                                            <div class="text-gray-500 text-xs">
                                                {{ meal.description }}
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <div
                                        class="flex items-center space-x-2 font-semibold text-gray-900 leading-8 mb-3"
                                    >
                                        <span clas="text-green-500">
                                            <svg
                                                class="h-5"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    fill="#fff"
                                                    d="M12 14l9-5-9-5-9 5 9 5z"
                                                />
                                                <path
                                                    fill="#fff"
                                                    d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"
                                                />
                                            </svg>
                                        </span>
                                        <span class="tracking-wide"
                                            >Mes sauces</span
                                        >
                                    </div>
                                    <ul class="list-inside space-y-2">
                                        <li>
                                            <div class="text-teal-600">
                                                Masters Degree in Oxford
                                            </div>
                                            <div class="text-gray-500 text-xs">
                                                March 2020 - Now
                                            </div>
                                        </li>
                                        <li>
                                            <div class="text-teal-600">
                                                Bachelors Degreen in LPU
                                            </div>
                                            <div class="text-gray-500 text-xs">
                                                March 2020 - Now
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End of Experience and education grid -->
                        </div>
                        <!-- End of profile tab -->
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
import { useField, useForm } from "vee-validate";

export default {
    components: { Header, Footer },
    data() {
        return {
            dark: false,
            filter: "test",
            CONFIG: {
                headers: {
                    "Content-Type": "multipart/form-data",
                    "API-TOKEN": "",
                    "USER-TOKEN": "",
                },
            },
            user: "",
            meals: [],
            avatar: "",
            updateProfil: true,
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
    methods: {
        updateSelectedInputProfil(id) {
            setTimeout(() => {
                document.querySelector("#" + id).focus();
            }, 400);
        },
        saveProfil() {
            let data = new FormData();
            data.append("user", this.profile);
            axios
                .post("/api/profile/" + this.user.id, data, this.CONFIG)
                .then((res) => {
                    console.log(res);
                })
                .catch((error) => {
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
                    this.profile.lastName = this.user.last_name;
                    this.profile.firstName = this.user.first_name;
                    this.profile.email = this.user.email;
                    this.profile.gender = this.user.gender;
                    this.profile.lastName = this.user.last_name;
                    this.profile.memberSince = this.user.member_since;
                    this.profile.birthday = this.user.birthday;
                    this.profile.about = this.user.about;
                    this.profile.createdAt = this.user.created_at;
                })
                .catch((error) => console.error("error", error));
        },
        getUserMeals() {
            axios
                .get("/api/user/meals", this.CONFIG)
                .then((data) => {
                    this.meals = data.data;
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
                    console.log(res);
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

<style>
:root {
    --main-color: #4a76a8;
}

.bg-main-color {
    background-color: var(--main-color);
}

.text-main-color {
    color: var(--main-color);
}

.border-main-color {
    border-color: var(--main-color);
}
</style>
