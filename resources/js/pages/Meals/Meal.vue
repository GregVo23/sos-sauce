<template>
    <Header @ChangeMode="ChangeMode($event)"></Header>
    <Modal v-if="showModalDelete" @refuse="Cancel($event)" @accept="Delete($event)" :open="this.open" :message="this.message" :title="this.title" :type="this.type" :mode="this.dark" ></Modal>
    <Modal v-if="showModalLike" @refuse="Cancel($event)" @accept="Like($event)" :open="this.open" :message="this.message" :title="this.title" :type="this.type" :mode="this.dark" ></Modal>
    <div :class="[dark ? 'bg-gray-600' : 'bg-white','xl:flex pt-6']">
        
        <div class="xl:w-1/2">
        <transition name="filterSearch" enter-active-class="transition ease-out duration-1000" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-1000" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
            <img v-if="charged" :src="URL + 'storage/meals/' + meal.picture" :alt="meal.name" :class="[dark ? 'opacity-80' : 'opacity-100', 'xl:rounded-tr-3xl w-full h-full object-center object-cover']" />
        </transition>
        </div>

        <div class="xl:w-1/2 p-8">
            <div class="flex justify-between">
            <router-link to="/meals">
                <svg xmlns="http://www.w3.org/2000/svg" :class="[dark ? 'text-white' : 'text-gray-800','h-20 w-20 hover:fill-current hover:text-red-600']" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z" />
                </svg>
            </router-link>
            <a @click="updateMeal(meal)">
                <svg xmlns="http://www.w3.org/2000/svg" :class="[dark ? 'text-white' : 'text-gray-800','h-20 w-20 hover:fill-current hover:text-red-600']" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </a>
            <a @click="likeMeal(meal)">
                <svg xmlns="http://www.w3.org/2000/svg" :class="[dark ? 'text-white' : 'text-gray-800','h-20 w-20 hover:fill-current hover:text-red-600']" :fill="like ? 'currentColor' : 'none'" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </a>
            <a @click="deleteMeal(meal)">
                <svg xmlns="http://www.w3.org/2000/svg" :class="[dark ? 'text-white' : 'text-gray-800','h-20 w-20 hover:fill-current hover:text-red-600']" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </a>
            </div>
            <h1 :class="[dark ? 'text-white' : 'text-gray-800','text-4xl font-bold pt-16 pb-10']">{{ meal.name }}</h1>
            <p :class="[dark ? 'text-white' : 'text-gray-800']">{{ meal.description }}</p>

            <p v-if="meal.number" :class="[dark ? 'text-white' : 'text-gray-800', 'mt-10']">{{ meal.number }} personne{{ (meal.number > 1) ? 's' :'' }}</p>
            <h2 :class="[dark ? 'text-white' : 'text-gray-800' ,'mt-4 mb-4 text-3xl font-bold underline']">Ingrédients:</h2>
            <ul v-for="ingredient in ingredients" :key="ingredient.id">
                <li :class="[dark ? 'text-gray-200' : 'text-gray-800']">{{ ingredient.name }} : {{ ingredient.quantity }} {{ ingredient.unit }}.</li>
            </ul>
        </div>
    </div>

    <div :class="[dark ? 'bg-gray-600' : 'bg-white','xl:flex justify-around p-8 lg:px-24 xl:px-48']">
        <div class="mt-16 space-y-16">
            <h2 :class="[dark ? 'text-white' : 'text-gray-800' ,'text-center mt-10 mb-4 text-3xl font-bold underline']">Préparation:</h2>
            <div v-for="(step, featureIdx) in meal.recipes" :key="step.id" class="flex flex-col-reverse lg:grid lg:grid-cols-12 lg:gap-x-8 lg:items-center">
            <div :class="[featureIdx % 2 === 0 ? 'lg:col-start-1' : 'lg:col-start-8 xl:col-start-9', 'mt-6 lg:mt-0 lg:row-start-1 lg:col-span-5 xl:col-span-4']">
                <h3 :class="[dark ? 'text-white' : 'text-gray-900', 'text-2xl font-medium']">Etape {{ step.step }}.</h3>
                <div  class="flex my-2">
                    <svg xmlns="http://www.w3.org/2000/svg" :class="[dark ? 'text-white' : 'text-gray-900', 'h-6 w-6']" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg><span :class="[dark ? 'text-white' : 'text-gray-900','pl-1']"> {{ new Date(meal.time).getMinutes() }} minutes</span>
                </div>
                <p :class="[dark ? 'text-gray-300' : 'text-gray-900', 'mt-2 text-lg']">{{ step.description }}</p>
            </div>
            <div :class="[featureIdx % 2 === 0 ? 'lg:col-start-6 xl:col-start-5' : 'lg:col-start-1', 'flex-auto lg:row-start-1 lg:col-span-7 xl:col-span-8']">
                <div class="aspect-w-5 aspect-h-2 rounded-3xl bg-gray-500 overflow-hidden">
                    <img :src="URL + 'storage/meals/' + meal.picture" :alt="meal.name" :class="[dark ? 'opacity-80' : 'opacity-100', 'object-center object-cover']" />
                </div>
            </div>
            </div>
        </div>
    </div>

    <Footer :mode="this.dark"></Footer>
</template>

<script>
import axios from "axios";
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';
import Modal from '../../components/Modal.vue';
import { URL } from '../../env.js';

export default {
  components: { Header, Footer, Modal },
    data() {
        return {
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
            CONFIG : {
                headers: {
                'Content-Type': 'multipart/form-data',
                'API-TOKEN': '',
                'USER-TOKEN': ''
                },
            }
        }
    },
    props: ['mode'],

    methods: {
        loadData(){
            axios
            .get('/api/meal/' + this.$route.params.slug, this.CONFIG)
            .then(
                ({ data }) => {
                    (this.charged = true),
                    (this.meal = data[0]),
                    (this.ingredients = data[1]),
                    (this.like = data[2].like)
                }
            )
            .catch((error) => console.log("error", error));
        },
        ChangeMode() {
            this.dark = (window.sessionStorage.getItem("dark") == "true") ? true : false;
        },
        notification(message, title, type) {
            this.message = message;
            this.title = title;
            this.type = type;
            this.open == true ? this.open = false : this.open = true;
        },
        updateMeal(meal) {
            this.notification("le message est", "le titre est ", "le type est");
        },
        likeMeal(meal) {
            this.showModalDelete = false;
            this.showModalLike = true;
            if (this.like == false) {
                this.notification("Ajouter un plat à vos favoris vous permet de le retrouver plus facilement par la suite.", "Ajouter " + meal.name + " à vos plats favoris ?", "like");
            } else {
                this.notification("Retirer définitivement le plat de vos favoris.", "Retirer " + meal.name + " de vos plats favoris ?", "like");
            }
        },
        Like() {
            this.like = !this.like;
            this.open = false;
            axios
            .get('/api/favorite/' + this.meal.id, this.CONFIG)
            .then(
                ({ data }) => {
                    if (this.like == false) {
                        this.$router.push('/meal/'+ this.meal.slug +'?msg=favoriteSuccess')
                    } else {
                        this.$router.push('/meal/'+ this.meal.slug +'?msg=favoriteRemoveSuccess')
                    }
                }
            )
            .catch((error) => {
                this.$router.push('/meal/'+ this.meal.slug +'?msg=favoriteError')
            })
        },
        deleteMeal(meal) {
            this.showModalLike = false;
            this.showModalDelete = true;
            this.notification("Cette action est irréversible, soyez certain de vouloir effacer le plat suivant : " + meal.name + ".", "Etes vous sur de supprimer : " + meal.name + " ?", "delete");
        },
        Delete() {
            if (true) {
                this.open = false;

                axios
                .delete('/api/meal/' + this.meal.slug, this.CONFIG)
                .then(
                    this.$router.push('/meals?msg=deleteSuccess')
                )
                .catch((error) => {
                    console.log("error", error)
                    this.$router.push('/meals?msg=deleteError')
                });
            }
        },
        Cancel() {
            this.open = false;
        }
    },
    created() {
        this.CONFIG.headers['API-TOKEN'] = localStorage.getItem('api_token');
        this.CONFIG.headers['USER-TOKEN'] = localStorage.getItem('user_token');
        this.loadData();
    },
    mounted() {
        this.ChangeMode();
    }
}
</script>