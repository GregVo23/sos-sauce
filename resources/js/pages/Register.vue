<template>
    <section
        class="h-screen flex justify-center items-center"
        style="
            background-image: url('http://www.localhost:8000/storage/meals/intro.jpg');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        "
    >
        <div class="lg:w-2/5 md:w-1/2 w-2/3">
            <form
                @submit="register($event)"
                :class="[
                    dark ? 'bg-gray-600' : 'bg-white',
                    'p-10 rounded-lg shadow-lg min-w-full',
                ]"
            >
                <div class="flex justify-center items-center">
                    <router-link to="/">
                        <img
                            class="block h-24 w-auto"
                            :src="URL + 'images/logo/sos-sauce.png'"
                            alt="SOS sauce logo"
                        />
                    </router-link>
                </div>
                <div>
                    <label
                        :class="[
                            dark ? 'text-gray-100' : 'text-gray-800',
                            'font-semibold block my-3 text-md select-none',
                        ]"
                        for="username"
                        >Nom</label
                    >
                    <input
                        @keyup="checkUser()"
                        v-model="username"
                        :class="[
                            errors[0].name ? 'border border-red-600' : '',
                            'w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none',
                        ]"
                        type="text"
                        name="username"
                        id="username"
                        :placeholder="[username ? username : 'username']"
                    />
                    <p id="errorName" class="text-red-600">
                        {{ errors[0].name }}
                    </p>
                </div>
                <div>
                    <label
                        :class="[
                            dark ? 'text-gray-100' : 'text-gray-800',
                            'font-semibold block my-3 text-md select-none',
                        ]"
                        for="email"
                        >Email</label
                    >
                    <input
                        @keyup="checkEmail()"
                        v-model="email"
                        :class="[
                            errors[0].email ? 'border border-red-600' : '',
                            'w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none',
                        ]"
                        type="email"
                        name="email"
                        id="email"
                        :placeholder="[email ? email : '@email']"
                    />
                    <p id="errorEmail" class="text-red-600">
                        {{ errors[0].email }}
                    </p>
                </div>
                <div>
                    <div class="flex items-center">
                        <label
                            :class="[
                                dark ? 'text-gray-100' : 'text-gray-800',
                                'font-semibold my-3 text-md select-none',
                            ]"
                            for="password"
                            >Mot de passe</label
                        >
                        <span
                            @click="showPassword = !showPassword"
                            class="ml-2"
                        >
                            <svg
                                v-if="!showPassword"
                                xmlns="http://www.w3.org/2000/svg"
                                :class="[
                                    dark ? 'text-white' : 'text-gray-800',
                                    'h-6 w-6 hover:fill-current hover:text-gray-300',
                                ]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                />
                            </svg>
                            <svg
                                v-else
                                xmlns="http://www.w3.org/2000/svg"
                                :class="[
                                    dark ? 'text-white' : 'text-gray-800',
                                    'h-6 w-6 hover:fill-current hover:text-gray-300',
                                ]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"
                                />
                            </svg>
                        </span>
                    </div>
                    <input
                        @keyup="checkPassword()"
                        v-model="password"
                        :class="[
                            errors[0].password ? 'border border-red-600' : '',
                            'w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none',
                        ]"
                        :type="[showPassword ? 'type' : 'password']"
                        name="password"
                        id="password"
                        placeholder="password"
                    />
                    <p id="errorPassword" class="text-red-600">
                        {{ errors[0].password }}
                    </p>
                </div>
                <div>
                    <label
                        :class="[
                            dark ? 'text-gray-100' : 'text-gray-800',
                            'font-semibold block my-3 text-md select-none',
                        ]"
                        for="confirm"
                        >Confirmez votre mot de passe</label
                    >
                    <input
                        @keyup="checkConfirm()"
                        v-model="confirm"
                        :class="[
                            errors[0].confirm ? 'border border-red-600' : '',
                            'w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none',
                        ]"
                        :type="[showPassword ? 'type' : 'password']"
                        name="confirm"
                        id="confirm"
                        placeholder="confirm password"
                    />
                    <p id="errorConfirm" class="text-red-600">
                        {{ errors[0].confirm }}
                    </p>
                </div>

                <div class="mt-6 mb-2 flex items-start">
                    <div class="flex-shrink-0">
                        <Switch
                            v-model="agreed"
                            :class="[
                                agreed ? 'bg-red-600' : 'bg-gray-200',
                                'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500',
                            ]"
                        >
                            <span class="sr-only">Agree to policies</span>
                            <span
                                aria-hidden="true"
                                :class="[
                                    agreed ? 'translate-x-5' : 'translate-x-0',
                                    'inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200',
                                ]"
                            />
                        </Switch>
                    </div>
                    <div class="ml-3">
                        <p
                            :class="[
                                dark ? 'text-gray-100' : 'text-gray-500',
                                'text-base',
                            ]"
                        >
                            En cochant cette case, j'accepte
                            {{ " " }}
                            <a
                                href="#"
                                :class="[
                                    dark
                                        ? 'text-gray-400 hover:text-gray-200'
                                        : 'text-gray-700 hover:text-black',
                                    'font-medium underline',
                                ]"
                                >Les conditions d'utilisations</a
                            >
                            {{ " " }}
                            et
                            {{ " " }}
                            <a
                                href="#"
                                :class="[
                                    dark
                                        ? 'text-gray-400 hover:text-gray-200'
                                        : 'text-gray-700 hover:text-black',
                                    'font-medium underline',
                                ]"
                                >La politique des coockies</a
                            >.
                        </p>
                    </div>
                </div>
                <p id="errorAgreed" class="text-red-600">
                    {{ errors[0].agreed }}
                </p>
                <button
                    type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 rounded-lg mt-4 px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans"
                >
                    Je m'enregistre
                </button>
                <button
                    @click="goToLogin()"
                    class="w-full mt-6 mb-3 bg-gray-200 hover:bg-gray-300 rounded-lg px-4 py-2 text-lg text-gray-800 tracking-wide font-semibold font-sans"
                >
                    J'ai déjà un compte
                </button>
            </form>
        </div>
    </section>
    <Footer :mode="this.dark"></Footer>
</template>

<script>
import axios from "axios";
import Footer from "../components/Footer.vue";
import { ref } from "vue";
import { Switch } from "@headlessui/vue";
import { URL } from "../env.js";
import router from "vue-router";

export default {
    components: { Footer, Switch },
    data() {
        return {
            URL: URL,
            dark: "false",
            username: "",
            password: "",
            email: "",
            confirm: "",
            errors: [
                { name: "" },
                { email: "" },
                { password: "" },
                { confirm: "" },
                { agreed: "" },
            ],
            canSubmit: [],
            showPassword: false,
        };
    },
    setup() {
        const agreed = ref(false);

        return {
            agreed,
        };
    },
    methods: {
        changeMode() {
            this.dark =
                window.sessionStorage.getItem("dark") == "true" ? true : false;
        },
        checkUser() {
            if (this.username === "") {
                this.errors[0].name = "Il faut un nom d'utilisateur !";
                return false;
            } else {
                this.errors[0].name = "";
            }
            if (this.username.length < 3) {
                this.errors[0].name =
                    "Il faut un nom d'utilisateur de plus de 3 caractères !";
                return false;
            } else {
                this.errors[0].name = "";
            }
            return true;
        },
        checkEmail() {
            if (this.email === "") {
                this.errors[0].email = "Il faut une adresse email !";
                return false;
            } else {
                this.errors[0].email = "";
            }
            let regex =
                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (regex.test(this.email) != true) {
                this.errors[0].email =
                    "Votre email ne dispose pas d'un format valide !";
                return false;
            } else {
                this.errors[0].email = "";
            }
            return true;
        },
        checkPassword() {
            if (this.password === "") {
                this.errors[0].password = "Il faut un mot de passe !";
                return false;
            } else {
                this.errors[0].password = "";
            }
            if (this.password.length < 8) {
                this.errors[0].password =
                    "Votre mot de passe doit contenir minimum 8 caractères !";
                return false;
            } else {
                this.errors[0].password = "";
            }
            let regex = /(?=.*?[#?!@$%^&*-])/;
            if (regex.test(this.password) != true) {
                this.errors[0].password =
                    "Votre mot de passe doit contenir minimum un caractère spécial !";
                return false;
            } else {
                this.errors[0].password = "";
            }
            return true;
        },
        checkConfirm() {
            if (this.confirm === "") {
                this.errors[0].confirm =
                    "Il faut confirmer votre mot de passe !";
                return false;
            } else {
                this.errors[0].confirm = "";
            }
            if (this.password !== this.confirm) {
                this.errors[0].confirm =
                    "Les deux mots de passe ne correspondent pas !";
                return false;
            } else {
                this.errors[0].confirm = "";
            }
            return true;
        },
        checkAgreed() {
            if (this.agreed !== true) {
                this.errors[0].agreed =
                    "Vous devez accepter les règles d'utilisation";
                return false;
            } else {
                this.errors[0].agreed = "";
            }
            return true;
        },
        register(event) {
            event.preventDefault();

            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                    //"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                    //  .content,
                },
            };

            this.canSubmit.push(
                this.checkUser(),
                this.checkEmail(),
                this.checkPassword(),
                this.checkConfirm(),
                this.checkAgreed()
            );

            if (this.canSubmit.every((condition) => condition === true)) {
                let data = new FormData();
                data.set("name", this.username);
                data.set("email", this.email);
                data.set("password", this.password);
                data.set("confirm_password", this.confirm);
                data.set("agreed", this.agreed);

                axios
                    .post("/api/register", data, config)
                    .then((res) => {
                        window.localStorage.setItem(
                            "api_token",
                            res.data.api_token
                        );
                        window.localStorage.setItem(
                            "user_token",
                            res.data.user_token
                        );
                        this.$router.push(
                            "/?msg=welcome&name=" + this.username
                        );
                    })
                    .catch((err) => {
                        console.log(err.response);
                    });
            }
        },
        goToLogin() {
            this.$router.push("/login");
        },
    },
    mounted() {
        this.changeMode();
    },
};
</script>
