<template>
<Header @ChangeMode="ChangeMode($event)"></Header>
  <div :class="[dark ? 'bg-gray-600' : 'bg-white']">

  <main class="min-h-full bg-cover bg-top sm:bg-top" style="background-image: url('https://images.unsplash.com/photo-1545972154-9bb223aac798?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=3050&q=80&exp=8&con=-15&sat=-75');">
    <div class="max-w-7xl mx-auto px-4 py-16 text-center sm:px-6 sm:py-24 lg:px-8 lg:py-48">
      <p class="text-sm font-semibold text-black text-opacity-50 uppercase tracking-wide">404 error</p>
      <h1 class="mt-2 text-4xl font-extrabold text-white tracking-tight sm:text-5xl">Uh oh! I think you’re lost.</h1>
      <p class="mt-2 text-lg font-medium text-black text-opacity-50">It looks like the page you’re looking for doesn't exist.</p>
      <div class="mt-6">
        <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-black text-opacity-75 bg-white bg-opacity-75 sm:bg-opacity-25 sm:hover:bg-opacity-50">
          Go back home
        </a>
      </div>
    </div>
  </main>


  </div>
  <Footer></Footer>
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