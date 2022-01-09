import { createRouter, createWebHistory } from "vue-router";
import IngredientIndex from "../components/IngredientIndex.vue";
import Login from "../components/Login.vue";
import Register from "../components/Register.vue";
import Home from "../components/Home.vue";
import Recipe from "../components/Recipe.vue";
import MealsIndex from "../components/Meals/MealsIndex.vue";
import Meal from "../components/Meals/Meal.vue";
import NewMeal from "../components/Meals/NewMeal.vue";
import Lost from "../components/Lost.vue";
import Profil from "../pages/User/Profil.vue";

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
        path: '/register',
        name: 'register',
        component: Register
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
        path: '/ajout',
        name: 'ajout',
        component: NewMeal
    },
    {
        path: '/meal/:slug',
        name: 'meal',
        component: Meal
    },
    {
        path: '/profil',
        name: 'profil',
        component: Profil
    },
    {
        path: '/404',
        name: '404',
        component: Lost
    },
    {
        path: '/:pathMatch(.*)*', 
        redirect: '/404' 
    }
];


const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
