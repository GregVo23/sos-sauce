<template>
    <section class="h-screen flex justify-center items-center" style="background-image: url('http://www.localhost:8000/storage/meals/intro.jpeg'); background-position: center; background-size: cover; background-repeat: no-repeat;">
        <div class="lg:w-2/5 md:w-1/2 w-2/3">
            <form @submit="register($event)" :class="[dark ? 'bg-gray-600' : 'bg-white','p-10 rounded-lg shadow-lg min-w-full']">
                <div class="flex justify-center items-center">
                    <a :href="URL">
                        <img class="block h-24 w-auto" :src="URL + 'images/logo/sos-sauce.png'" alt="SOS sauce logo" />
                    </a>
                </div>
                <div>
                    <label :class="[dark ? 'text-gray-100' : 'text-gray-800' ,'font-semibold block my-3 text-md']" for="username">Username</label>
                    <input v-model="username" class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="username" id="username" :placeholder="[username ? username : 'username']" />
                </div>
                <div>
                    <label :class="[dark ? 'text-gray-100' : 'text-gray-800' ,'font-semibold block my-3 text-md']" for="email">Email</label>
                    <input v-model="email" class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="email" name="email" id="email" :placeholder="[email ? email : '@email']" />
                </div>
                <div>
                    <label :class="[dark ? 'text-gray-100' : 'text-gray-800' ,'font-semibold block my-3 text-md']" for="password">Password</label>
                    <input v-model="password" class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="password" name="password" id="password" placeholder="password" />
                </div>
                <div>
                    <label :class="[dark ? 'text-gray-100' : 'text-gray-800' ,'font-semibold block my-3 text-md']" for="confirm">Confirm password</label>
                    <input v-model="confirm" class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="password" name="confirm" id="confirm" placeholder="confirm password" />
                </div>
            
                <div class="my-6 flex items-start">
                    <div class="flex-shrink-0">
                        <Switch v-model="agreed" :class="[agreed ? 'bg-red-600' : 'bg-gray-200', 'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500']">
                        <span class="sr-only">Agree to policies</span>
                        <span aria-hidden="true" :class="[agreed ? 'translate-x-5' : 'translate-x-0', 'inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']" />
                        </Switch>
                    </div>
                    <div class="ml-3">
                        <p :class="[dark ? 'text-gray-100' : 'text-gray-500','text-base']">
                        By selecting this, you agree to the
                        {{ ' ' }}
                        <a href="#" :class="[dark ? 'text-gray-400 hover:text-gray-200' : 'text-gray-700 hover:text-black','font-medium underline']">Privacy Policy</a>
                        {{ ' ' }}
                        and
                        {{ ' ' }}
                        <a href="#" :class="[dark ? 'text-gray-400 hover:text-gray-200' : 'text-gray-700 hover:text-black','font-medium underline']">Cookie Policy</a>.
                        </p>
                    </div>
                </div>
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans">Register</button>
                    <button type="submit" class="w-full mt-6 mb-3 bg-gray-200 hover:bg-gray-300 rounded-lg px-4 py-2 text-lg text-gray-800 tracking-wide font-semibold font-sans">Login</button>
            </form>
        </div>
    </section>
    <Footer :mode="this.dark"></Footer>
</template>

<script>
import axios from "axios";
import Footer from './Footer.vue';
import { ref } from 'vue';
import { Switch } from '@headlessui/vue';
import { URL } from '../env.js';
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
            errors: []
        }
    },
    setup() {
        const agreed = ref(false)

        return {
            agreed,
        }
    },
    methods: {
      changeMode() {
          this.dark = (window.sessionStorage.getItem("dark") == "true") ? true : false;
      },
      checkUser() {
        if (this.username === "") {
            this.errors.push("Il faut un nom d'utilisateur !")
            return false;
        }
        if (this.username.length < 3) {
            this.errors.push("Il faut un nom d'utilisateur de plus de 3 caractères !")
            return false;
        }
        return true
      },
      checkEmail() {
        let regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (regex.test(this.email) != true) {
            this.errors.push("Votre email ne dispose pas d'un format valide !");
            return false;
        }
        return true;
      },
      checkPassword() {
        let regex = /(?=.*?[#?!@$%^&*-])/;
        if (regex.test(this.password) != true) {
            this.errors.push("Votre mot de passe doit contenir minimum un caractère spécial !");
            return false;
        }
        if (this.password.length < 8) {
            this.errors.push("Votre mot de passe doit contenir minimum 8 caractères !");
            return false;
        }
        return true
      },
      checkConfirm() {
        if (this.password !== this.confirm) {
            this.errors.push("Les deux mots de passe ne correspondent pas !");
            return false;
        }
        return true;
      },
      checkAgreed() {
        if (this.agreed !== true) {
            this.errors.push("Vous devez accepter les règles d'utilisation");
            return false;
        }
        return true;
      },
      register(event) {
        event.preventDefault()

        const config = {
          headers: {
            "content-type": "multipart/form-data",
            //"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
            //  .content,
          },
        };

        if (this.checkUser() && this.checkEmail() && this.checkPassword() && this.checkConfirm() && this.checkAgreed()){
            let data = new FormData()
            data.set('name', this.username)
            data.set('email', this.email)
            data.set('password', this.password)
            data.set('confirm_password', this.confirm)
            data.set('agreed', this.agreed)

            //console.log(URL + "/api/register");
            //console.log(data.get('name'));
            console.log(this.checkUser() && this.checkEmail() && this.checkPassword() && this.checkConfirm() && this.checkAgreed());

            axios.post("/api/register", data, config)
            .then(res => {
                console.log(res.data)
                window.localStorage.setItem("api_token", res.data.api_token)
                this.$router.push('/')
            })
            .catch(err => {
                console.log(err.response)
            })
        } else {
            console.log("Il y a des erreurs : " + this.errors)
            this.errors = [];
        }
      }
    },
    mounted() {
      this.changeMode();
    }
}
</script>