import { defineStore } from "pinia";

export const useMealStore = defineStore({
    id: "meal",
    state: () => ({
        meals: [],
        meal: null,
        loading: false,
        error: null,
    }),
    CONFIG: {
        headers: {
            "Content-Type": "multipart/form-data",
            "API-TOKEN": "",
            "USER-TOKEN": "",
        },
    },
    getters: {
        getmeals(state) {
            return state.meals;
        },
    },
    actions: {
        async fetchmeals() {
            this.meals = [];
            this.loading = true;
            try {
                this.meals = await fetch("/api/meals", this.CONFIG).then(
                    (response) => response.json()
                );
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
        async fetchmeal(id) {
            this.meal = null;
            this.loading = true;
            try {
                this.meal = await fetch(`/api/meals/${id}`).then((response) =>
                    response.json()
                );
            } catch (error) {
                this.error = error;
            } finally {
                this.loading = false;
            }
        },
    },
    created() {
        this.CONFIG.headers["API-TOKEN"] = localStorage.getItem("api_token");
        this.CONFIG.headers["USER-TOKEN"] = localStorage.getItem("user_token");
    },
});
