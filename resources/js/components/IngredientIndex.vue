<template>
    <h1>Ingredients</h1>
    <div v-for="ingredient in ingredients" :key="ingredient.name">
        <p>{{ ingredient.name }}</p>
    </div>
    <router-link
        to="/login"
    >Test</router-link>
    

</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            ingredients: {}
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
            .get('/api/ingredients')
            .then(
                ({ data }) => (
                    (this.ingredients = data.data)
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