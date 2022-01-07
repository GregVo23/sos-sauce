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
                    <input v-model="email" class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="email" name="email" id="email" placeholder="@email" />
                </div>
                <div>
                    <label :class="[dark ? 'text-gray-100' : 'text-gray-800' ,'font-semibold block my-3 text-md']" for="password">Password</label>
                    <input v-model="password" class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="password" name="password" id="password" placeholder="password" />
                </div>
                    <button type="submit" class="w-full mt-6 bg-red-600 hover:bg-red-700 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans">Login</button>
                    <button @click="goToRegister()" class="w-full mt-6 mb-3 bg-gray-200 hover:bg-gray-300 rounded-lg px-4 py-2 text-lg text-gray-800 tracking-wide font-semibold font-sans">Register</button>
            </form>
        </div>
    </section>
    <Footer :mode="this.dark"></Footer>
</template>

<script>
import axios from "axios";
import Footer from './Footer.vue';
import { URL } from '../env.js';

export default {
    components: { Footer },
    data() {
        return {
            URL: URL,
            dark: "false",
            email: "",
            password: "",
            canSubmit: false
        }
    },
    methods: {
        changeMode() {
            this.dark = (window.sessionStorage.getItem("dark") == "true") ? true : false;
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

            this.canSubmit = true;
            if (this.canSubmit){
                let data = new FormData()
                data.set('email', this.email)
                data.set('password', this.password)

                axios.post("/api/login", data, config)
                .then(res => {
                    //console.log(res.data)
                    window.localStorage.setItem("api_token", res.data.api_token)
                    window.localStorage.setItem("user_token", res.data.user_token)
                    this.$router.push('/')
                })
                .catch(err => {
                    console.log(err.response)
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