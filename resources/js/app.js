require("./bootstrap");
import { createApp } from "vue";
import { createPinia } from "pinia";
import router from "./router";
const pinia = createPinia();

createApp({}).use(router).use(pinia).mount("#app");
