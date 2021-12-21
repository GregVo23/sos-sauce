<template>
<Header @ChangeMode="ChangeMode($event)"></Header>
  <div :class="[dark ? 'bg-gray-600' : 'bg-white' ,'py-16 px-4 overflow-hidden sm:px-6 lg:px-8 lg:py-24']">
    <div class="relative max-w-xl mx-auto">
      <div class="text-center">
        <h2 :class="[dark ? 'text-white' : 'text-gray-900', 'text-3xl font-extrabold tracking-tight  sm:text-4xl']">
          Ajouter un plat
        </h2>
      </div>
      <div class="mt-12">
        <form action="#" method="POST" class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
          <div class="sm:col-span-2">
            <label for="name" :class="[dark ? 'text-white' : 'text-gray-700','block text-sm font-medium']">Nom du plat</label>
            <div class="mt-1">
              <input type="text" name="name" id="name" autocomplete="organization" class="py-3 px-4 block w-full shadow-sm focus:ring-red-600 focus:border-red-600 border border-gray-300 rounded-md" />
            </div>
          </div>

              <div class="sm:col-span-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                  <svg :class="[dark ? 'text-gray-200' : 'text-gray-400','mx-auto h-12 w-12']" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <div :class="[dark ? 'text-white' : 'text-gray-600','flex text-sm']">
                    <label for="file-upload" :class="[dark ? 'bg-gray-600' : 'bg-white', 'relative cursor-pointer  rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-red-500']">
                      <span>Charger une photo</span>
                      <input id="file-upload" name="file-upload" type="file" class="sr-only" />
                    </label>
                    <p :class="[dark ? 'text-white' : 'text-gray-500','pl-1']">ou glisser / déposer</p>
                  </div>
                  <p :class="[dark ? 'text-white' : 'text-gray-500','text-xs']">
                    PNG, JPG, GIF jusqu'à 20MB
                  </p>
                </div>
              </div>

          <div class="sm:col-span-2">
            <label for="description" :class="[dark ? 'text-white' : 'text-gray-700' ,'block text-sm font-medium']">Description</label>
            <div class="mt-1">
              <textarea id="description" name="description" rows="4" class="py-3 px-4 block w-full shadow-sm focus:ring-red-600 focus:border-red-600 border border-gray-300 rounded-md" />
            </div>
          </div>
          <div class="sm:col-span-2">
            <div class="flex items-start">
              <div class="flex-shrink-0">
                <Switch v-model="agreed" :class="[agreed ? 'bg-red-700' : 'bg-gray-200', 'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-700']">
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
  <Footer></Footer>
</template>

<script>
import { ref } from 'vue'
import { Switch } from '@headlessui/vue'
import Header from '../Header.vue';
import Footer from '../Footer.vue';

export default {
  components: {
    Switch, Header, Footer
  },
  data() {
      let dark = "false";
      return {
          dark
      }
  },
  setup() {
    const agreed = ref(false)

    return {
      agreed,
    }
  },
  methods: {
      ChangeMode() {
          this.dark = (window.sessionStorage.getItem("dark") == "true") ? true : false;
      }
  },
  mounted() {
      this.ChangeMode();
  }
}
</script>