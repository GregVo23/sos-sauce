<template>
<Header @ChangeMode="ChangeMode($event)"></Header>
  <div :class="[dark ? 'bg-gray-600' : 'bg-white']">

  <main class="min-h-full h-screen bg-cover bg-top sm:bg-top" style="background-image: url('http://www.localhost:8000/storage/meals/intro.jpeg'); background-position: center; background-size: cover; background-repeat: no-repeat;">
    <div class="max-w-7xl mx-auto px-4 py-16 text-center sm:px-6 sm:py-24 lg:px-8 lg:py-48">
      <p class="text-sm font-semibold text-gray-100 text-opacity-80 uppercase tracking-wide">404 erreur</p>
      <h1 class="mt-2 text-4xl font-extrabold text-white tracking-tight sm:text-5xl">Vous êtes perdu ?</h1>
      <p class="mt-2 text-lg font-medium text-gray-100 text-opacity-80">La page que vous cherchez n'existe pas !</p>
      <div class="mt-6">
        <router-link to="/" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-black text-opacity-75 bg-white bg-opacity-70 sm:bg-opacity-70 sm:hover:bg-opacity-90">
          Retour à l'accueil
        </router-link>
      </div>
    </div>
  </main>


  </div>
  <Footer :mode="this.dark"></Footer>
</template>

<script>
import axios from "axios";
import Header from './Header.vue';
import Footer from './Footer.vue';

export default {
  components: { Header, Footer },
    data() {
        return {
            meals: {},
            dark: false,
        }
    },
    props:['mode'],
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
            .get('/api/meals')
            .then(
                ({ data }) => (
                    (this.meals = data.data)
                )
            )
            .catch((error) => console.log("error", error));
        },
        ChangeMode() {
          this.dark = (window.sessionStorage.getItem("dark") == "true") ? true : false;
          console.log(this.dark);
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