import { createRouter, createWebHistory } from "vue-router";
import IngredientIndex from "../components/IngredientIndex.vue";
import Login from "../components/Login.vue";
import Home from "../components/Home.vue";
import Recipe from "../components/Recipe.vue";

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/recettes',
        name: 'recipe',
        component: Recipe
    },
    {
        path: '/ingredients',
        name: 'ingredients',
        component: IngredientIndex
    },
    { 
        path: '/*', 
        redirect: '/dashboard' 
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
