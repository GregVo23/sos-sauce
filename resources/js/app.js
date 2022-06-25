require("./bootstrap");

import { createApp } from "vue";
import router from "./router";
//import IngredientIndex from "./pages/Ingredients/IngredientIndex.vue";

createApp({
    /*components: {
        IngredientIndex,
    }*/
})
    .use(router)
    .mount("#app");
