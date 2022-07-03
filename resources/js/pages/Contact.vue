<template>
    <Header></Header>
    <div class="hello">
        <h1>{{ msg }}</h1>
        <h1>Made By Getters</h1>
        <div v-for="gettersMeal in getMeals" :key="gettersMeal.id">
            {{ gettersMeal.id }} {{ gettersMeal.name }}
            {{ gettersMeal.description }}
        </div>
    </div>
    <Footer></Footer>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
//import meals store
import { useMealStore } from "../stores/meals";
import Header from "../components/Header.vue";
import Footer from "../components/Footer.vue";

// declare store variable
const store = useMealStore();

const msg = ref("Welcome to my Pinia Store");

const getMeals = computed(() => {
    console.log(store.getmeals.data);
    return store.getmeals.data;
});

onMounted(() => {
    store.fetchmeals();
});
</script>
