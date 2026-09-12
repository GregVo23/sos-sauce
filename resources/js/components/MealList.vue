<template>
    <router-link :to="'/meal/' + meal.slug" class="group">
        <div
            class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8"
        >
            <button
                type="button"
                @click.stop.prevent="toggleLike"
                class="mt-2 ml-2 absolute z-10 focus:outline-none"
                aria-label="Ajouter ou retirer des favoris"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    :fill="meal.like ? 'currentColor' : 'none'"
                    :class="[
                        meal.like
                            ? 'text-red-600'
                            : 'text-white hover:text-red-600',
                        'h-10 w-10 drop-shadow',
                    ]"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                    />
                </svg>
            </button>
            <img
                :src="URL + 'storage/meals/card/' + meal.picture"
                :alt="meal.name"
                loading="lazy"
                :class="[
                    dark
                        ? 'opacity-90 group-hover:opacity-75'
                        : 'opacity-100 group-hover:opacity-75',
                    'w-full h-64 object-center object-cover',
                ]"
            />
        </div>
        <h3
            :class="[
                dark
                    ? 'text-white group-hover:text-red-400'
                    : 'text-gray-700 group-hover:text-red-600',
                'mt-4 text-sm',
            ]"
        >
            {{ meal.name }}
        </h3>
        <p
            :class="[
                dark
                    ? 'text-white group-hover:text-red-200'
                    : 'text-gray-900 group-hover:text-red-600',
                'mt-1 text-lg font-medium',
            ]"
        >
            {{ meal.description }}
        </p>
    </router-link>
</template>

<script>
import axios from "axios";

export default {
    name: "MealList",
    props: {
        meal: Object,
        URL: String,
        charged: Boolean,
        dark: Boolean,
    },
    methods: {
        toggleLike() {
            this.meal.like = !this.meal.like;
            axios
                .get("/api/favorite/" + this.meal.id, {
                    headers: {
                        "API-TOKEN": localStorage.getItem("api_token"),
                        "USER-TOKEN": localStorage.getItem("user_token"),
                    },
                })
                .catch((error) => {
                    this.meal.like = !this.meal.like;
                    console.log("error", error);
                });
        },
    },
};
</script>
