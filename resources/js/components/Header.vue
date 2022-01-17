<template>
  <Popover as="template" v-slot="{ open }">
    <header :class="[open ? 'fixed inset-0 z-40 overflow-y-auto' : '', dark ? 'bg-gray-600 shadow-sm lg:static lg:overflow-y-visible' : 'bg-white shadow-sm lg:static lg:overflow-y-visible', 'py-2']">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative flex justify-between xl:grid xl:grid-cols-12 lg:gap-8">
          <div class="flex md:absolute md:left-0 md:inset-y-0 lg:static xl:col-span-2">
            <div class="flex-shrink-0 flex items-center">
              <router-link to="/">
                <img class="block h-24 w-auto" :src="URL + 'images/logo/sos-sauce.png'" alt="SOS sauce logo" />
              </router-link>
            </div>
          </div>
          <div class="min-w-0 flex-1 md:px-8 lg:px-0 xl:col-span-6">
            <div class="flex items-center px-6 py-8 md:max-w-3xl md:mx-auto lg:max-w-none lg:mx-0 xl:px-0">
              <div class="w-full">
                <label for="search" class="sr-only">Rechercher</label>
                <div class="relative">
                  <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                    <SearchIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                  </div>
                  <input @keyup="filteredList()" @click="showFilterSearch()" v-model="letters" id="search" name="search" class="block w-full bg-white border border-gray-300 rounded-md py-2 pl-10 pr-3 text-sm placeholder-gray-500 focus:outline-none focus:text-gray-900 focus:placeholder-gray-400 focus:ring-1 focus:ring-red-500 focus:border-red-500 sm:text-sm" placeholder="Rechercher" type="search" />
                </div>

<transition name="filterSearch" enter-active-class="transition ease-out duration-200" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-200" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
  <div v-if="showFilter" class="mt-2">
    <label :class="[dark ? 'text-white' : 'text-gray-900' ,'text-base font-medium']">Recherche sur base</label>
    <fieldset class="mt-2">
      <legend class="sr-only">filter method</legend>
      <div class="space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
        <div v-for="filterSearch in filterSearchs" :key="filterSearch.id" class="flex items-center">
          <input v-model="filterChoice" :id="filterSearch.id" name="filter-method" type="radio" :value="filterSearch.id" class="accent-red-500 focus:ring-red-500 h-4 w-4 text-red-600 border-gray-300" :checked="filterSearch.id === 'name'"/>
          <label :for="filterSearch.id" :class="[dark ? 'text-gray-300' : 'text-gray-700' ,'ml-3 block text-sm font-medium']">
            {{ filterSearch.title }}
          </label>
        </div>
      </div>
    </fieldset>
  </div>
</transition>

              </div>
            </div>
          </div>
          <div class="flex items-center md:absolute md:right-0 md:inset-y-0 lg:hidden">
            <!-- Mobile menu button -->
            <PopoverButton class="-mx-2 rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-red-500">
              <span class="sr-only">Open menu</span>
              <MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
              <XIcon v-else class="block h-6 w-6" aria-hidden="true" />
            </PopoverButton>
          </div>
          <div class="hidden lg:flex lg:items-center lg:justify-end xl:col-span-4">
            
            
              <div class="flex-shrink-0">
                <Switch @click="darkmode()" v-model="dark" :class="[dark ? 'bg-gray-500' : 'bg-gray-200', 'relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300']">
                  <span class="sr-only">Agree to policies</span>
                  <span aria-hidden="true" :class="[dark ? 'translate-x-5' : 'translate-x-0', 'inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200']" />
                </Switch>
              </div>

            <!-- Profile dropdown -->
            <Menu v-if="connected == true" as="div" class="flex-shrink-0 relative ml-5">
              <div>
                <MenuButton :class="[dark ? 'bg-white' : 'bg-gray-600', 'rounded-full flex focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500']">
                  <span class="sr-only">Open user menu</span>

                  <img v-if="user.imageUrl" class="h-8 w-8 rounded-full" :src="user.imageUrl" alt="" />

                  <span v-else class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                  </span>
                </MenuButton>
              </div>
              <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                <MenuItems class="origin-top-right absolute z-10 right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1 focus:outline-none">
                  <MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
                    <a :href="item.href" :class="[active ? 'bg-gray-100' : '', 'block py-2 px-4 text-sm text-gray-700']">{{ item.name }}</a>
                  </MenuItem>
                  <router-link to="/profil" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">Profil</router-link>
                  <a @click="logout()" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 cursor-pointer">Déconnexion</a>
                </MenuItems>
              </transition>
            </Menu>

            <router-link v-if="connected == true" to="/ajout" class="ml-6 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
              Nouvelle recette
            </router-link>
            
            <router-link v-else to="/login" class="ml-6 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600">
              Connexion
            </router-link>

          </div>
        </div>
      </div>

      <PopoverPanel as="nav" class="lg:hidden" aria-label="Global">
        <div class="max-w-3xl mx-auto px-2 pt-2 pb-3 space-y-1 sm:px-4">
          <a v-for="item in navigation" :key="item.name" :href="item.href" :aria-current="item.current ? 'page' : undefined" :class="[item.current ? 'bg-gray-100 text-gray-900' : 'hover:bg-gray-50', 'block rounded-md py-2 px-3 text-base font-medium']">{{ item.name }}</a>
        </div>
        <div class="border-t border-gray-200 pt-4 pb-3">
          <div class="max-w-3xl mx-auto px-4 flex items-center sm:px-6">
            <div class="flex-shrink-0">
              <img class="h-10 w-10 rounded-full" :src="user.imageUrl" alt="" />
            </div>
            <div class="ml-3">
              <div class="text-base font-medium text-gray-800">{{ user.name }}</div>
              <div class="text-sm font-medium text-gray-500">{{ user.email }}</div>
            </div>
            <button type="button" class="ml-auto flex-shrink-0 bg-white rounded-full p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
              <span class="sr-only">View notifications</span>
              <BellIcon class="h-6 w-6" aria-hidden="true" />
            </button>
          </div>
          <div class="mt-3 max-w-3xl mx-auto px-2 space-y-1 sm:px-4">
            <a v-for="item in userNavigation" :key="item.name" :href="item.href" class="block rounded-md py-2 px-3 text-base font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-900">{{ item.name }}</a>
          </div>
        </div>
      </PopoverPanel>
    </header>
  </Popover>
</template>

<script>
import { ref } from 'vue';
import { Menu, MenuButton, MenuItem, MenuItems, Popover, PopoverButton, PopoverPanel } from '@headlessui/vue';
import { SearchIcon } from '@heroicons/vue/solid';
import { BellIcon, MenuIcon, XIcon } from '@heroicons/vue/outline';
import { Switch } from '@headlessui/vue';
import { URL } from '../env.js';

const user = {
  name: 'Chelsea Hagon',
  email: 'chelseahagon@example.com',
  imageUrl:
    'https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
}
const navigation = [
  { name: 'Dashboard', href: '#', current: true },
  { name: 'Calendar', href: '#', current: false },
  { name: 'Teams', href: '#', current: false },
  { name: 'Directory', href: '#', current: false },
]
const userNavigation = [
  { name: 'Settings', href: '#' },
]
const filterSearchs = [
  { id: 'name', title: 'Du nom' },
  { id: 'ingredient', title: 'd\'un ingrédient' },
]
let letters = "";

export default {
  components: {
    Menu,
    MenuButton,
    MenuItem,
    MenuItems,
    Popover,
    PopoverButton,
    PopoverPanel,
    Switch,
    BellIcon,
    MenuIcon,
    SearchIcon,
    XIcon,
  },
  props:[
    "dark","letters"
  ],
  data() {
    return {
        URL: URL,
        connected: false,
        showFilter: false,
        filterChoice: "name"
    }
  },
  setup() {
    const dark = ref(false)
    return {
      user,
      navigation,
      userNavigation,
      dark,
      letters,
      filterSearchs,
    }
  },
  methods: {
    darkmode(){
      window.sessionStorage.getItem("dark") == "true" ? window.sessionStorage.setItem("dark","false") : window.sessionStorage.setItem("dark","true");
      this.$emit('ChangeMode')
    },
    changeMode() {
        this.dark = (window.sessionStorage.getItem("dark") == "true") ? true : false;
    },
    filteredList() {
      if (this.letters != "" && this.letters.length > 0){
        this.showFilter = true
        if (this.$route.path == "/meals"){
          this.$emit('filter', this.letters);
        } else {
          if (this.letters.length > 2) {
            if (this.filterChoice === "name") {
              window.sessionStorage.setItem("search", this.letters);
              this.$router.push('/meals');
            } else if (this.filterChoice === "ingredient") {
              alert(" recherche sur base d'un ingrédient !");
            }
          }
        }
      } else {
        this.showFilter = false;
      }
    },
    showFilterSearch() {
      this.showFilter = true;
    },
    isConnected() {
      if (localStorage.getItem("user_token") && localStorage.getItem("api_token")) {
        this.connected = true;
      }
    },
    addRecipe() {
      this.$router.push('/ajout');
    },
    logout() {
      localStorage.setItem("user_token", "");
      localStorage.setItem("api", "");
      localStorage.clear();
      if (this.$route.path == "/") {
        location.href="/";
      } else {
        this.$router.push('/');
      }
    }
  },
  mounted() {
    this.changeMode();
    this.isConnected();

    if (window.sessionStorage.getItem("search") != null && this.$route.path == "/meals") {
      let searching = window.sessionStorage.getItem("search");
      let inputSearch = document.querySelector("#search");
      this.letters = searching;
      inputSearch.value = searching;
      inputSearch.focus();
      this.filteredList();
    }
  
  }
}
</script>

<style scoped>
input[type='radio'] {
  -webkit-appearance:none;
  width:20px;
  height:20px;
  border:1px solid darkgray;
  border-radius:50%;
  outline:none;
}

input[type='radio']:before {
  content:'';
  display:block;
  width:60%;
  height:60%;
  margin: 20% auto;    
  border-radius:50%;    
}
input[type='radio']:checked:before {
  background:#dc2626;
}
</style>