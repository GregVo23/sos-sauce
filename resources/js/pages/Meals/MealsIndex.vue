<template>
<div :class="[dark? 'bg-gray-600' : 'bg-white']">
<Header @ChangeMode="ChangeMode($event)" @Filter="Search($event)"></Header>
  <main :class="[dark ? 'bg-gray-600' : 'bg-white']">
    <Notification @Cancel="Cancel($event)" :message="this.message" :title="this.title" :type="this.type" :show="this.show" :mode="this.dark"></Notification>
    
    <div v-if="meals.length == 0" class="min-h-full h-screen bg-cover bg-top sm:bg-top" style="background-image: url('http://www.localhost:8000/storage/meals/intro.jpg'); background-position: center; background-size: cover; background-repeat: no-repeat;">
      <div class="max-w-7xl mx-auto px-4 py-16 text-center sm:px-6 sm:py-24 lg:px-8 lg:py-48">
        <p class="text-sm font-semibold text-gray-100 text-opacity-80 uppercase tracking-wide">...</p>
        <h1 class="mt-2 text-4xl font-extrabold text-white tracking-tight sm:text-5xl">Aucun plat trouvé !</h1>
        <p class="mt-2 text-lg font-medium text-gray-100 text-opacity-80">Le plat que vous cherchez ne semble pas présent !</p>
        <div class="mt-6">
          <router-link to="/" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-black text-opacity-75 bg-white bg-opacity-70 sm:bg-opacity-70 sm:hover:bg-opacity-90">
            Retour à l'accueil
          </router-link>
        </div>
      </div>
    </div>
    
    <div v-else class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
      <h2 class="sr-only text-red">Meals</h2>

      <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
        <router-link v-for="meal in meals" :key="meal.id" :to="'/meal/' + meal.slug" class="group">
          <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
            <svg v-if="meal.like" xmlns="http://www.w3.org/2000/svg" class="mt-2 ml-2 absolute h-10 w-10 text-white group-hover:text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
            <img :src="URL + 'storage/meals/' + meal.picture" :alt="meal.name" :class="[dark ? 'opacity-90 group-hover:opacity-75' : 'opacity-100 group-hover:opacity-75', 'w-full h-64 object-center object-cover']" />
          </div>
          <h3 :class="[dark ? 'text-white group-hover:text-red-400' : 'text-gray-700 group-hover:text-red-600','mt-4 text-sm']">
            {{ meal.name }}
          </h3>
          <p :class="[dark ? 'text-white group-hover:text-red-200' : 'text-gray-900 group-hover:text-red-600','mt-1 text-lg font-medium']">
            {{ meal.description }}
          </p>
        </router-link>
      </div>
    </div>
  
  </main>
  <Footer :mode="this.dark"></Footer>
</div>
</template>

<script>
import axios from "axios";
import Header from '../../components/Header.vue';
import Footer from '../../components/Footer.vue';
import { URL } from '../../env.js';
import Notification from '../../components/Notification.vue';

export default {
  components: { Header, Footer, Notification },
    data() {
        return {
            URL: URL,
            user: {},
            list: {},
            meals: {},
            allMeals: {},
            favorite: [],
            mine: [],
            dark: false,
            filter: "",
            searching: false,
            message: "",
            title: "",
            type: "",
            show: false,
            currentPage: "",
            CONFIG : {
                headers: {
                'Content-Type': 'multipart/form-data',
                'API-TOKEN': '',
                'USER-TOKEN': ''
                },
            }
        }
    },
    props : ['mode', 'letters'],

    methods: {
        loadData(){
            axios
            .get('/api/meals', this.CONFIG)
            .then(
                  ({ data }) => {
                      (this.list = data.data),
                      (this.meals = data.data),
                      (this.allMeals = data.data),
                      // Favorite
                      Object.keys(this.list).forEach(key => {
                          if (this.list[key].like == true) {
                            this.favorite.push(this.list[key]);
                          }
                      }),
                      this.connectedUser(this.allMeals);
                  }
            )
            .catch((error) => console.log("error", error));
        },
        ChangeMode() {
          this.dark = (window.sessionStorage.getItem("dark") == "true") ? true : false;
        },
        Search($event = null) {
          this.filter = (typeof($event) == "string") ? $event : window.sessionStorage.getItem("search");
          if (this.filter != null) {
            if (this.filter.length > 2){
              this.searching = true;
              this.meals = [];
              for(let i = 0; i<this.list.length; i++){

                if (this.list[i].name.toLowerCase().indexOf(this.filter.toLowerCase()) != -1){

                  this.meals.push(this.list[i]);
                }
              }
            } else {
              this.searching = false;
              this.meals = this.list;
              window.sessionStorage.removeItem("search");
            }
          }
        },
        notification(message, title, type) {
            this.message = message;
            this.title = title;
            this.type = type;
            this.show == true ? this.show = false : this.show = true;
        },
        notify() {
            //TODO mounted where query string ...
            const urlSearchParams = new URLSearchParams(window.location.search);
            const params = Object.fromEntries(urlSearchParams.entries());

            switch (params.msg) {
              case "deleteSuccess":
                this.notification("Votre plat a été supprimé avec succès, toutes les données associées également.", "Suppression effectuée !", "success");
                break;
              case "deleteError":
                this.notification("Une erreur est survenue lors de la suppression de votre plat, veuillez réessayer plus tard.", "Suppression échouée !", "error");
                break;
              case "mealsuccess":
                this.notification("Votre nouveau plat a été ajouté : " + params.name, "Nouveau plat ajouté !", "success");
                break;
              case "favoritesuccess":
                this.notification("Le plat a été ajouté aux favoris : " + params.name, "Nouveau plat ajouté !", "success");
                break;
              case "favoriteError":
                this.notification("Le plat n'a pas pu être ajouté aux Favoris : " + params.name, "Ajout aux favoris échoué !", "error");
                break;
            }
        },
        Cancel() {
            this.show = false;
        },
        connectedUser(mealList) {
            axios
            .get('/api/user', this.CONFIG)
            .then(
                ({ data }) => {
                    (this.user = data.user),
                    Object.keys(mealList).forEach(key => {
                        if (mealList[key].user_id == this.user.id) {
                          this.mine.push(mealList[key]);
                        }
                    }),
                    this.choicePage();
                    this.Search();
                }
            )
            .catch((error) => console.log("error", error));
        },
        choicePage() {
            if (this.$router.currentRoute.value.name == "favorite" && this.currentPage != "favorite" && this.searching == false) {
              this.currentPage = "favorite";
              this.list = this.favorite;
              this.meals = this.favorite;
            } else if (this.$router.currentRoute.value.name == "meals" && this.currentPage != "meals" && this.searching == false){
              this.currentPage = "meals";
              this.list = this.allMeals;
              this.meals = this.allMeals;
            } else if (this.$router.currentRoute.value.name == "mine" && this.currentPage != "mine" && this.searching == false){
              this.currentPage = "mine";
              this.list = this.mine;
              this.meals = this.mine;
            } else {
              this.currentPage = "";
            }
        }
    },
    created() {
        this.CONFIG.headers['API-TOKEN'] = localStorage.getItem('api_token');
        this.CONFIG.headers['USER-TOKEN'] = localStorage.getItem('user_token');
        this.loadData();
    },
    mounted() {
        this.ChangeMode();
        this.notify();
    },
    beforeUpdate() {
        this.choicePage();
    }
}
</script>