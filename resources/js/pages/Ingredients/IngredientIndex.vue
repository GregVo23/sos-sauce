<template>
    <Header></Header>
    <h1>Ingredients</h1>
    <div v-for="ingredient in ingredients" :key="ingredient.name">
        <p>{{ ingredient.name }}</p>
    </div>
    <router-link to="/login">Test</router-link>
    <Footer></Footer>
</template>

<script>
import axios from "axios";
import Header from "../../components/Header.vue";
import Footer from "../../components/Footer.vue";

export default {
    components: { Header, Footer },
    data() {
        return {
            ingredients: {},
        };
    },
    /*
    setup() {
        const getIngredients = async () => {
            let data = await axios.get('/api/ingredients');
            //this.ingredients = data.data;
            console.log(data);
            //this.ingredients = data;
        }

        getIngredients();
    },
    */
    methods: {
        loadData() {
            axios
                .get("/api/ingredients")
                .then(({ data }) => (this.ingredients = data.data))
                .catch((error) => console.log("error", error));
        },
    },
    created() {
        this.loadData();
    },
};
</script>
