<template>
    <section class="h-screen flex justify-center items-center" style="background-image: url('http://www.localhost:8000/storage/meals/intro.jpeg'); background-position: center; background-size: cover; background-repeat: no-repeat;">
        <div class="lg:w-2/5 md:w-1/2 w-2/3">
            <form class="bg-white p-10 rounded-lg shadow-lg min-w-full">
                <div class="flex justify-center items-center">
                    <a href="http://localhost:8000/">
                        <img class="block h-24 w-auto" src="http://localhost:8000/images/logo/sos-sauce.png" alt="SOS sauce logo" />
                    </a>
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="username">Username</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="username" id="username" placeholder="username" />
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="email">Email</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="email" id="email" placeholder="@email" />
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="password">Password</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="password" id="password" placeholder="password" />
                </div>
                <div>
                    <label class="text-gray-800 font-semibold block my-3 text-md" for="confirm">Confirm password</label>
                    <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="confirm" id="confirm" placeholder="confirm password" />
                </div>
            
                <div class="my-6 flex items-start">
                    <div class="flex-shrink-0">
                        <Switch v-model="agreed" :class="[agreed ? 'bg-red-600' : 'bg-gray-200', 'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500']">
                        <span class="sr-only">Agree to policies</span>
                        <span aria-hidden="true" :class="[agreed ? 'translate-x-5' : 'translate-x-0', 'inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']" />
                        </Switch>
                    </div>
                    <div class="ml-3">
                        <p class="text-base text-gray-500">
                        By selecting this, you agree to the
                        {{ ' ' }}
                        <a href="#" class="font-medium text-gray-700 underline">Privacy Policy</a>
                        {{ ' ' }}
                        and
                        {{ ' ' }}
                        <a href="#" class="font-medium text-gray-700 underline">Cookie Policy</a>.
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
import { ref } from 'vue'
import { Switch } from '@headlessui/vue'

export default {
    components: { Footer, Switch },
    data() {
        return {
            message: "Hello"
        }
    },
    setup() {
        const agreed = ref(false)

        return {
            agreed,
        }
    },
    methods: {

    },
}
</script>