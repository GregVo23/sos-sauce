<template>
<Header @ChangeMode="ChangeMode($event)" @Filter="Search($event)"></Header>
  <div :class="[dark ? 'bg-gray-600' : 'bg-white']">
    <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
      <h2 class="sr-only text-red">Meals</h2>

      <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
        <a v-for="meal in meals" :key="meal.id" :href="URL + 'meal/' + meal.slug" class="group">
          <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="mt-2 ml-2 absolute h-10 w-10 text-white group-hover:text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            <img :src="URL + 'storage/meals/' + meal.picture" :alt="meal.name" class="w-full h-64 object-center object-cover group-hover:opacity-75" />
          </div>
          <h3 :class="[dark ? 'text-white group-hover:text-red-400' : 'text-gray-700 group-hover:text-red-600','mt-4 text-sm']">
            {{ meal.name }}
          </h3>
          <p :class="[dark ? 'text-white group-hover:text-red-200' : 'text-gray-900 group-hover:text-red-600','mt-1 text-lg font-medium']">
            {{ meal.description }}
          </p>
        </a>
      </div>
    </div>
  </div>
  <Footer :mode="this.dark"></Footer>
</template>

<script>
import axios from "axios";
import Header from '../Header.vue';
import Footer from '../Footer.vue';
import { URL } from '../../env.js';

export default {
  components: { Header, Footer },
    data() {
        return {
            URL: URL,
            list: {},
            meals: {},
            dark: false,
            filter: "test",
            test: false
        }
    },
    props : ['mode', 'letters'],
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
                    (this.list = data.data)
                    (this.meals = data.data)
                )
            )
            .catch((error) => console.log("error", error));
        },
        ChangeMode() {
          this.dark = (window.sessionStorage.getItem("dark") == "true") ? true : false;
        },
        Search($event = null) {
          this.filter = ($event != null) ? $event : window.sessionStorage.getItem("search");
          if (this.filter.length > 2){
            this.meals = [];
            for(let i = 0; i<this.list.length; i++){
              if (this.list[i].name.toLowerCase().indexOf(this.filter.toLowerCase()) == 0){
                this.meals.push(this.list[i]);
              }
            }
          } else {
            this.meals = this.list;
            window.sessionStorage.removeItem("search");
          }
        }
    },
    created() {
        this.loadData();
    },
    mounted() {
        this.ChangeMode();
    },
    updated() {
        if (window.sessionStorage.getItem("search") != null){
          this.filter = window.sessionStorage.getItem("search");
          if (this.filter.length > 1){
            this.meals = [];
            for(let i = 0; i<this.list.length; i++){
              if (this.list[i].name.toLowerCase().indexOf(this.filter.toLowerCase()) == 0){
                this.meals.push(this.list[i]);
              }
            }
          }
        }
    }
}
</script>