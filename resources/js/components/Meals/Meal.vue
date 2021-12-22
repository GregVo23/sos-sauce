<template>
    <Header @ChangeMode="ChangeMode($event)"></Header>
    <div :class="[dark ? 'bg-gray-600' : 'bg-white','flex pt-6']">
        <div class="w-1/2">
            <img :src="'http://www.localhost:8000/storage/meals/' + meal.picture" :alt="meal.name" class="w-full h-full object-center object-cover group-hover:opacity-75" />
        </div>
        <div class="w-1/2 p-8">
            <div class="flex justify-between">
            <a href="http://www.localhost:8000/meals">
                <svg xmlns="http://www.w3.org/2000/svg" :class="[dark ? 'text-white' : 'text-gray-800','h-24 w-24 hover:fill-current hover:text-red-600']" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z" />
                </svg>
            </a>
            <a>
                <svg xmlns="http://www.w3.org/2000/svg" :class="[dark ? 'text-white' : 'text-gray-800','h-24 w-24 hover:fill-current hover:text-red-600']" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
            </a>
            <a @click="deleteMeal(meal)">
                <svg xmlns="http://www.w3.org/2000/svg" :class="[dark ? 'text-white' : 'text-gray-800','h-24 w-24 hover:fill-current hover:text-red-600']" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </a>
            </div>
            <h1 :class="[dark ? 'text-white' : 'text-gray-800','text-3xl font-bold py-6']">{{ meal.name }}</h1>
            <p :class="[dark ? 'text-white' : 'text-gray-800']">{{ meal.description }}</p>

            <h2 :class="[dark ? 'text-white' : 'text-gray-800' ,'mt-6 text-xl font-bold']">Ingrédients</h2>
        </div>
    </div>
    <Footer :mode="this.dark"></Footer>
</template>

<script>
import axios from "axios";
import Header from '../Header.vue';
import Footer from '../Footer.vue';

export default {
  components: { Header, Footer },
    data() {
        return {
            meal: {},
            dark: false,
        }
    },
    props: ['mode'],
    /*
    setup() {
        const getIngredients = async () => {
            let data = await axios.get('/api/ingredients');
            //this.ingredients = data.data;
            console.log(data);
            //this.ingredients = data;
        }

        getIngredients();
    },
    */
    methods: {
        loadData(){
            axios
            .get('/api/meal/' + this.$route.params.slug)
            .then(
                ({ data }) => (
                    (this.meal = data.data)
                )
            )
            .catch((error) => console.log("error", error));
        },
        ChangeMode() {
            this.dark = (window.sessionStorage.getItem("dark") == "true") ? true : false;
        },
        deleteMeal(meal) {
            if(confirm("Etes vous sur de supprimer " + meal.name + " ?")) {
                console.log("deleted" + meal.name);
                const config = {
                headers: {
                //'Content-Type': 'multipart/form-data',
                //"X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                //.content,
                },
            };

            axios
                .delete('/api/meal/' + meal.slug, config)
                .then(
                    window.location.assign("http://www.localhost:8000/meals")
                )
                .catch((error) => console.log("error", error));
            
            }
        }
    },
    created() {
        this.loadData();
    },
    mounted() {
        this.ChangeMode();
    }
}
</script>