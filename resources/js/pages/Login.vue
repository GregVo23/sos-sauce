<template>
    <section class="h-screen flex justify-center items-center" style="background-image: url('http://www.localhost:8000/storage/meals/intro.jpeg'); background-position: center; background-size: cover; background-repeat: no-repeat;">
        <div class="lg:w-2/5 md:w-1/2 w-2/3">
            <form @submit="login($event)" :class="[dark ? 'bg-gray-600' : 'bg-white' ,'p-10 rounded-lg shadow-lg min-w-full']">
                <div class="flex justify-center items-center">
                    <router-link to="/">
                        <img class="block h-24 w-auto" :src="URL + 'images/logo/sos-sauce.png'" alt="SOS sauce logo" />
                    </router-link>
                </div>
                <div>
                    <label :class="[dark ? 'text-gray-100' : 'text-gray-800' ,'font-semibold block my-3 text-md']" for="email">Email</label>
                    <input @keyup="checkEmail()" v-model="email" :class="[errors[0].email ? 'border border-red-600' : '','w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none']" type="email" name="email" id="email" placeholder="@email" />
                    <p id="errorEmail" class="text-red-600">{{ errors[0].email }}</p>
                </div>
                <div>
                    <label :class="[dark ? 'text-gray-100' : 'text-gray-800' ,'font-semibold block my-3 text-md']" for="password">Mot de passe</label>
                    <input @keyup="checkPassword()" v-model="password" :class="[errors[0].password ? 'border border-red-600' : '','w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none']" type="password" name="password" id="password" placeholder="password" />
                    <p id="errorPassword" class="text-red-600">{{ errors[0].password }}</p>
                </div>
                    <button type="submit" class="w-full mt-6 bg-red-600 hover:bg-red-700 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans">Je me connecte</button>
                    <button @click="goToRegister()" class="w-full mt-6 mb-3 bg-gray-200 hover:bg-gray-300 rounded-lg px-4 py-2 text-lg text-gray-800 tracking-wide font-semibold font-sans">Je n'ai pas de compte</button>
            </form>
        </div>
    </section>
    <Footer :mode="this.dark"></Footer>
</template>

<script>
import axios from "axios";
import Footer from '../components/Footer.vue';
import { URL } from '../env.js';

export default {
    components: { Footer },
    data() {
        return {
            URL: URL,
            dark: "false",
            email: "",
            password: "",
            errors: [
                {"email" : ""},
                {"password" : ""}
            ],
            canSubmit: false
        }
    },
    methods: {
        changeMode() {
            this.dark = (window.sessionStorage.getItem("dark") == "true") ? true : false;
        },
        checkPassword() {
            if (this.password === "") {
                this.errors[0].password = "Il faut votre mot de passe !";
                return false;
            } else {
                this.errors[0].password = "";
            }
            return true;
        },
        checkEmail() {
            if (this.email === "") {
                this.errors[0].email = "Il faut votre adresse email !";
                return false;
            } else {
                this.errors[0].email = "";
            }
            let regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (regex.test(this.email) != true) {
                this.errors[0].email = "Votre email ne dispose pas d'un format valide !";
                return false;
            } else {
                this.errors[0].email = "";
            }
            return true;
        },
        login(event) {
            event.preventDefault()

            const config = {
                headers: {
                    "content-type": "multipart/form-data",
                    //"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                    //  .content,
                },
            };

            this.canSubmit = this.checkEmail();      //TODO only the last one will be verified ...
            this.canSubmit = this.checkPassword();

            if (this.canSubmit){
                let data = new FormData()
                data.set('email', this.email)
                data.set('password', this.password)

                axios.post("/api/login", data, config)
                .then(res => {
                    //console.log(res.data)
                    window.localStorage.setItem("api_token", res.data.api_token)
                    window.localStorage.setItem("user_token", res.data.user_token)
                    this.$router.push('/?msg=hello')
                })
                .catch(err => {
                    //console.log(err.response.data.error)

                        this.errors[0].email = err.response.data.error
                        this.errors[0].password = err.response.data.error
                })
            }
        },
        goToRegister() {
            this.$router.push('/register')
        }
    },
    mounted() {
      this.changeMode();
    }
}
</script>