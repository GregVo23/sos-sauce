import { defineStore } from "pinia";
import axios from "axios";

export const useCategoryStore = defineStore({
    id: "category",
    state: () => ({
        categories: [],
        loaded: false,
        loading: false,
    }),
    actions: {
        async fetchCategories() {
            if (this.loaded || this.loading) {
                return;
            }
            this.loading = true;
            try {
                const { data } = await axios.get("/api/categories");
                this.categories = data;
                this.loaded = true;
            } catch (error) {
                console.log("error", error);
            } finally {
                this.loading = false;
            }
        },
    },
});
