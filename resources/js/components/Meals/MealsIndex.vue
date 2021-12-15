<template>
    <Header></Header>
    <h1>Meals</h1>
    <div v-for="meal in meals" :key="meal.id">
        <ul>
            <a :href="'meal/' + meal.slug"><li>{{ meal.name }}</li></a>
        </ul>
    </div>
    <router-link
        to="/login"
    >Test</router-link>
    <Footer></Footer>
</template>

<script>
import axios from "axios";
import Header from '../Header.vue';
import Footer from '../Footer.vue';

export default {
  components: { Header, Footer },
    data() {
        return {
            meals: {}
        }
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
        loadData(){
            axios
            .get('/api/meals')
            .then(
                ({ data }) => (
                    (this.meals = data.data)
                )
            )
            .catch((error) => console.log("error", error));
        },
    },
    created() {
        this.loadData();
  },
}
</script>