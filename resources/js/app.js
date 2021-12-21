require('./bootstrap');

import { createApp } from "vue";
import router from "./router";
import IngredientIndex from "./components/IngredientIndex.vue";
import Login from "./components/Login.vue";
import Home from "./components/Home.vue";
import Recipe from "./components/Recipe.vue";

createApp({
    components: {
        IngredientIndex,
        Login,
        Home,
        Recipe,
    }
})
.use(router)
.mount('#app');