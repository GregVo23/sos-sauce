<template>
    <Header></Header>
    <h1>{{ meal.name }}</h1>
    <p>{{ meal.description }}</p>

    <h2>Ingrédients</h2>


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
            meal: {},
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
            .get('/api/meal/' + this.$route.params.slug)
            .then(
                ({ data }) => (
                    (this.meal = data.data)
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