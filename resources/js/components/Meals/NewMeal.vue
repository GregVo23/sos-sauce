<template>
<Header @ChangeMode="changeMode($event)"></Header>

    <section class="h-screen flex justify-center items-center" style="background-image: url('http://www.localhost:8000/storage/meals/intro.jpeg'); background-position: center; background-size: cover; background-repeat: no-repeat;">
        <div class="lg:w-2/5 md:w-1/2 sm:w-2/3 w-full">


  <div :class="[dark ? 'bg-gray-600' : 'bg-white' ,'rounded-lg shadow-lg p-10 overflow-hidden']">
    <div class="relative max-w-xl mx-auto">
      <div class="text-center">
        <h2 :class="[dark ? 'text-white' : 'text-gray-900', 'text-3xl font-extrabold tracking-tight  sm:text-4xl']">
          Ajouter un plat
        </h2>
      </div>
      <div class="mt-6">
        <form @submit="formSubmit" enctype="multipart/form-data" action="./meal" method="POST" class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
          <div class="sm:col-span-2">
            <label for="name" :class="[dark ? 'text-white' : 'text-gray-700','block text-sm font-medium']">Nom du plat</label>
            <div class="mt-1">
              <input v-model="name" @keydown="checkName()" type="text" name="name" id="name" :class="[messageName != null ? 'ring-red-600 border-red-600 border' : '' ,'py-3 px-4 block w-full shadow-sm focus:ring-red-600 focus:border-red-600 border border-gray-300 rounded-md']" />
            <p v-if="messageName != null" class="text-red-600">{{ messageName }}</p>
            </div>
          </div>

          

              <div class="sm:col-span-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div v-if="!pictureName" class="space-y-1 text-center">
                  <svg :class="[dark ? 'text-gray-200' : 'text-gray-400','mx-auto h-12 w-12']" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <div :class="[dark ? 'text-white' : 'text-gray-600','flex text-sm']">
                    <label for="picture" :class="[dark ? 'bg-gray-600' : 'bg-white', 'relative cursor-pointer  rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-red-500']">
                      <span>Charger une photo</span>
                      <input @change="updatePhoto" id="picture" name="picture" type="file" accept="image/*" class="sr-only" />
                    </label>
                    <p :class="[dark ? 'text-white' : 'text-gray-500','pl-1']">ou glisser / déposer</p>
                  </div>
                  <p :class="[dark ? 'text-white' : 'text-gray-500','text-xs']">
                    PNG, JPG, GIF jusqu'à 20MB
                  </p>
                </div>
                <div v-else class="space-y-1 text-center">
                  <svg :class="[dark ? 'text-gray-200' : 'text-gray-400','mx-auto h-12 w-12']" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <div :class="[dark ? 'text-white' : 'text-gray-600','flex text-sm']">
                    <label for="picture" :class="[dark ? 'bg-gray-600' : 'bg-white', 'relative cursor-pointer  rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-red-500']">
                      <span>{{ pictureName }}</span>
                      <input @change="updatePhoto" id="picture" name="picture" type="file" accept="image/*" class="sr-only" />
                    </label>
                    <p :class="[dark ? 'text-white' : 'text-gray-500','pl-1']">ou glisser / déposer</p>
                  </div>
                  <p @click="removeImage" :class="[dark ? 'text-white' : 'text-red-600','text-xs hover:text-red-800']">
                    Supprimer l'image
                  </p>
                </div>
              </div>

          <div class="sm:col-span-2">
            <label for="description" :class="[dark ? 'text-white' : 'text-gray-700' ,'block text-sm font-medium']">Description</label>
            <div class="mt-1">
              <textarea v-model="description" @keydown="checkDescription()" id="description" name="description" rows="4" :class="[messageDescription != null ? 'ring-red-600 border-red-600 border' : '' ,'py-3 px-4 block w-full shadow-sm focus:ring-red-600 focus:border-red-600 border border-gray-300 rounded-md']" />
              <p v-if="messageDescription != null" class="text-red-600">{{ messageDescription }}</p>
            </div>
          </div>
          <div class="sm:col-span-2">
            <div class="flex items-start">
              <div class="flex-shrink-0">
                <Switch @click="checkRules()" v-model="agreed" :class="[agreed ? 'bg-red-700' : 'bg-gray-200', messageRule != null ? 'ring-2 ring-offset-2 ring-red-700' : '' , 'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-700']">
                  <span class="sr-only">Agree to policies</span>
                  <span aria-hidden="true" :class="[agreed ? 'translate-x-5' : 'translate-x-0', 'inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']" />
                </Switch>
              </div>
              <div class="ml-3">
                <p :class="[dark ? 'text-white' : 'text-gray-500', 'text-base']">
                  En cliquant ce bouton, j'adhère au
                  {{ ' ' }}
                  <a href="#" :class="[dark ? 'text-gray-100' : 'text-gray-700','font-medium underline']">Réglement d'usage</a>
                  {{ ' ' }}
                  et la
                  {{ ' ' }}
                  <a href="#" :class="[dark ? 'text-gray-100' : 'text-gray-700','font-medium underline']">Politique de Cookies</a>.
                </p>
                <p v-if="messageRule != null" class="text-red-600">{{ messageRule }}</p>
              </div>
            </div>
          </div>
          <div class="sm:col-span-2">
            <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
              Ajouter
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
  </section>
  <Footer :mode="this.dark"></Footer>
</template>

<script>
import { ref } from 'vue'
import { Switch } from '@headlessui/vue'
import Header from '../Header.vue';
import Footer from '../Footer.vue';
import { URL } from '../../env.js';

export default {
  components: {
    Switch, Header, Footer
  },
  data() {
      const URL = URL;
      let messageName = null;
      let messageDescription = null;
      let messageRule = null;
      let dark = "false";
      let name = null;
      let description = null;
      let pictureName = null;
      let picture = {};
      const injuries = ["con", "salope", "merde", "pute", "shit", "fuck", "suck", "vomir"];
      return {
          URL,
          dark, 
          name, 
          description, 
          picture, 
          pictureName, 
          messageName, 
          messageDescription, 
          messageRule,
          injuries
      }
  },
  setup() {
    const agreed = ref(false)

    return {
      agreed,
    }
  },
  props:['mode'],
  methods: {
      changeMode() {
          this.dark = (window.sessionStorage.getItem("dark") == "true") ? true : false;
      },
      validText(text, words) {
        for (const element of words) {
          if (text.includes(" " + element + " ")) {
            this.messageDescription = "Le texte contient un vocabulaire interdit comme : " + element + " !"; 
          }
        }
        return true;
      },
      checkForm() {
        if (this.checkName() && this.checkDescription() && this.checkPicture() && this.checkRules()) {
          return true;
        } else {
          return false;
        }
      },
      checkName() {
        if (this.name == "" || this.name == null) {
          this.messageName = "Il vous faut donner un nom à ce plat !";
        } else if (this.name.length < 5){
          this.messageName = "Ce nom est trop court ...";
        } else {
          this.messageName = null;
        }
        return (this.messageName == null ? true : false);
      },
      checkDescription() {
        if (this.description == null) {
          this.messageDescription = "Expliquer en quelques mots à quoi correspond ce plat !";
        } else if(this.description.length < 10){
          this.messageDescription = "Faites un effort, cette description est trop courte ...";
        } else if(this.description.length < 20){
          this.messageDescription = "Vous y êtes presque, encore " + (20-this.description.length) + " caractères !";
        } else {
          this.messageDescription = null;
          this.validText(this.description, this.injuries);
        }
        return (this.messageDescription == null ? true : false);
      },
      checkPicture() {
        //picture
        return true;
      },
      checkRules() {
        if (this.agreed == false) {
          this.messageRule = "Pour utiliser ce site, il faut accepter le réglement d'usage";
        } else {
          this.messageRule = null;
        }
        return (this.messageRule == null ? true : false);
      },
      removeImage() {
        this.picture = "";
        this.pictureName = "";
      },
      updatePhoto(e) {
        this.picture = e.target.files[0];
        this.pictureName = e.target.files[0].name;
      },
      formSubmit(e) {
          e.preventDefault();

          if(this.checkForm()){
            let formData = new FormData();
            formData.append('name', this.name ? this.name.trim() : null);
            formData.append('description', this.description ? this.description.trim() : null);
            formData.append('agreed', this.agreed ? this.agreed : null);
            formData.append("picture", this.picture ? this.picture : null);
            formData.append('pictureName', this.pictureName ? this.pictureName : null);

            const config = {
              headers: {
                'Content-Type': 'multipart/form-data',
                'API-TOKEN': localStorage.getItem('api_token'),
                'USER-TOKEN': localStorage.getItem('user_token')
              },
            };

            axios
              .post('/api/meal', formData, config)
              .then((res) => 
                  //window.location.assign(this.URL + "meals?message=success")
                  this.$router.push('/meals?msg=mealsuccess&name=' + this.name)
              )
              .catch((error) => console.log("error", error));
          } else {
            console.log("Probleme avec le formulaire");
          }
      }
  },
  mounted() {
      this.changeMode();
  }
}
</script>