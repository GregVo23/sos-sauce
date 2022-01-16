import { createRouter, createWebHistory } from "vue-router";
import IngredientIndex from "../pages/Ingredients/IngredientIndex.vue";
import Login from "../pages/Login.vue";
import Register from "../pages/Register.vue";
import Home from "../pages/Home.vue";
import Recipe from "../components/Recipe.vue";
import MealsIndex from "../pages/Meals/MealsIndex.vue";
import Meal from "../pages/Meals/Meal.vue";
import NewMeal from "../pages/Meals/NewMeal.vue";
import Lost from "../pages/Lost.vue";
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
