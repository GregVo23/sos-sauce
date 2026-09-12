import { defineStore } from "pinia";
import axios from "axios";
import { URL } from "../env.js";

const DEFAULT_AVATAR = URL + "images/profil.png";

export const useUserStore = defineStore({
    id: "user",
    state: () => ({
        user: null,
    }),
    getters: {
        avatarUrl(state) {
            if (state.user && state.user.avatar && state.user.avatar.startsWith("/storage/avatar/")) {
                return URL.replace(/\/$/, "") + state.user.avatar;
            }
            return DEFAULT_AVATAR;
        },
    },
    actions: {
        authHeaders() {
            return {
                headers: {
                    "API-TOKEN": localStorage.getItem("api_token"),
                    "USER-TOKEN": localStorage.getItem("user_token"),
                },
            };
        },
        async fetchUser() {
            if (!localStorage.getItem("api_token") || !localStorage.getItem("user_token")) {
                this.user = null;
                return;
            }
            try {
                const { data } = await axios.get("/api/user", this.authHeaders());
                this.user = data.user;
            } catch (error) {
                this.user = null;
            }
        },
        setUser(user) {
            this.user = user;
        },
        clearUser() {
            this.user = null;
        },
    },
});
