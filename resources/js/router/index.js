import { createRouter, createWebHistory } from "vue-router";
import IngredientIndex from "../components/IngredientIndex.vue";
import Login from "../components/Login.vue";
import Home from "../components/Home.vue";
import Recipe from "../components/Recipe.vue";
import MealsIndex from "../components/Meals/MealsIndex.vue";
import Meal from "../components/Meals/Meal.vue";

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
        path: '/meals',
        name: 'meals',
        component: MealsIndex
    },
    {
        path: '/meal/:slug',
        name: 'meal',
        component: Meal
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
