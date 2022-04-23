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
                                Jane Doe
                            </h1>
                            <h3
                                class="text-gray-600 font-lg text-semibold leading-6"
                            >
                                Owner at Her Company Inc.
                            </h3>
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
                                    <span>Status</span>
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
                                        user.created_at
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
                                <span class="tracking-wide">About</span>
                            </div>
                            <div class="text-gray-700">
                                <div class="grid md:grid-cols-2 text-sm">
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">
                                            First Name
                                        </div>
                                        <div class="px-4 py-2">
                                            {{ user.name }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">
                                            Last Name
                                        </div>
                                        <div class="px-4 py-2">
                                            {{ user.firstName }}
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">
                                            Gender
                                        </div>
                                        <div class="px-4 py-2">Female</div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">
                                            Email.
                                        </div>
                                        <div class="px-4 py-2">
                                            <a
                                                class="text-blue-800"
                                                :href="mailto"
                                                >{{ user.name }}</a
                                            >
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <div class="px-4 py-2 font-semibold">
                                            Birthday
                                        </div>
                                        <div class="px-4 py-2">
                                            Feb 06, 1998
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button
                                class="block w-full text-blue-800 text-sm font-semibold rounded-lg hover:bg-gray-100 focus:outline-none focus:shadow-outline focus:bg-gray-100 hover:shadow-xs p-3 my-4"
                            >
                                Show Full Information
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
                                            >Experience</span
                                        >
                                    </div>
                                    <ul class="list-inside space-y-2">
                                        <li>
                                            <div class="text-teal-600">
                                                Owner at Her Company Inc.
                                            </div>
                                            <div class="text-gray-500 text-xs">
                                                March 2020 - Now
                                            </div>
                                        </li>
                                        <li>
                                            <div class="text-teal-600">
                                                Owner at Her Company Inc.
                                            </div>
                                            <div class="text-gray-500 text-xs">
                                                March 2020 - Now
                                            </div>
                                        </li>
                                        <li>
                                            <div class="text-teal-600">
                                                Owner at Her Company Inc.
                                            </div>
                                            <div class="text-gray-500 text-xs">
                                                March 2020 - Now
                                            </div>
                                        </li>
                                        <li>
                                            <div class="text-teal-600">
                                                Owner at Her Company Inc.
                                            </div>
                                            <div class="text-gray-500 text-xs">
                                                March 2020 - Now
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
                                            >Education</span
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
            user: [],
            avatar: "",
        };
    },
    methods: {
        changeMode() {
            this.dark =
                window.sessionStorage.getItem("dark") == "true" ? true : false;
        },
        connectedUser() {
            axios
                .get("/api/user", this.CONFIG)
                .then(({ data }) => {
                    this.user = data.user;
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
