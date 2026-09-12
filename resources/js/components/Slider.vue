<template>
    <div class="flex justify-between w-full">
        <div>
            <button
                @click="previous()"
                aria-label="Précédent"
                class="h-16 w-16 absolute left-10 top-1/2 z-50 bg-gray-100 hover:bg-red-600 hover:text-white text-gray-800 rounded-full flex items-center justify-center"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-7 w-7 rotate-90"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="4"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19 9l-7 7-7-7"
                    />
                </svg>
            </button>
        </div>
        <div>
            <button
                @click="next()"
                aria-label="Suivant"
                class="h-16 w-16 absolute right-10 top-1/2 z-50 bg-gray-100 hover:bg-red-600 hover:text-white text-gray-800 rounded-full flex items-center justify-center"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-7 w-7 -rotate-90"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="4"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19 9l-7 7-7-7"
                    />
                </svg>
            </button>
        </div>
    </div>
    <div class="slider">
        <div
            :class="[mode ? 'bg-gray-600' : 'bg-white', 'container-slide']"
            :style="{
                transform: `translateX(${index}px)`,
                transition: `${transition}`,
            }"
        >
            <div
                v-if="meals.length !== 0"
                v-for="meal in meals"
                :key="meal.id"
                :class="[
                    mode ? 'opacity-80' : '',
                    meal.isWelcome ? 'hero-slide' : '',
                    'div-slider',
                ]"
                :style="
                    meal.isWelcome
                        ? ''
                        : `width:100vw; height:100vh; background-image:url(http://localhost:8000/storage/meals/detail/${meal.picture}); background-size: cover;`
                "
            >
                <template v-if="meal.isWelcome">
                    <p class="hero-mark absolute top-10 w-full text-center">
                        SOS<span>·</span>Sauce
                    </p>
                    <h1
                        class="hero-title mt-52 px-10 text-6xl md:text-8xl font-extrabold tracking-tight text-white text-center"
                    >
                        {{ heroTitle }}
                    </h1>
                    <p
                        class="hero-tagline mt-6 mx-auto px-12 max-w-2xl text-xl md:text-2xl text-center"
                    >
                        {{ heroTagline }}
                    </p>
                    <div class="flex justify-center mt-8">
                        <router-link to="/meals" class="hero-cta">
                            Découvrir les recettes
                        </router-link>
                    </div>
                </template>
                <template v-else>
                    <h1
                        class="titre mt-52 text-8xl px-10 font-extrabold tracking-tight text-white text-center"
                    >
                        <router-link :to="`/meal/${meal.slug}`"
                            >{{ meal.name }}
                        </router-link>
                    </h1>

                    <p
                        class="mt-6 mx-auto px-12 text-2xl text-white text-center truncate"
                    >
                        {{ meal.description }}
                    </p>
                </template>
                <svg
                    @click="scrollToDiscover"
                    xmlns="http://www.w3.org/2000/svg"
                    class="absolute bottom-28 left-1/2 -translate-x-1/2 h-16 w-16 animate-bounce text-white cursor-pointer"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="4"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19 9l-7 7-7-7"
                    />
                </svg>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { URL } from "../env.js";
export default {
    name: "Slider",
    props: ["mode"],
    data() {
        return {
            URL: URL,
            name: "Maitre saucier",
            image: URL + "storage/meals/detail/intro.jpg",
            description: "Accompagner vos plats de sauces aux milles saveurs !",
            index: 0,
            slug: "/",
            dark: false,
            meals: [{ id: "welcome", isWelcome: true }],
            transition: "transform 0.4s ease",
        };
    },
    computed: {
        heroTitle() {
            return this.$route.query.msg
                ? "Bienvenue sur SOS Sauce"
                : "Qu'est-ce qu'on mange ?";
        },
        heroTagline() {
            return this.$route.query.msg
                ? "Ta cuisine vient de gagner un renfort. Recettes, sauces et astuces des autres membres, prêtes à piocher."
                : "Des idées de plats et de sauces maison, à parcourir en un coup d'œil avant de passer aux fourneaux.";
        },
    },
    methods: {
        scrollToDiscover() {
            document
                .getElementById("decouvrir")
                ?.scrollIntoView({ behavior: "smooth" });
        },
        loadData() {
            axios
                .get("/api/meals")
                .then(
                    ({ data }) =>
                        (this.meals = [
                            { id: "welcome", isWelcome: true },
                            ...data.data,
                        ])
                )
                .catch((error) => console.log("error", error));
        },
        slider() {
            setInterval(() => {
                this.next();
            }, 6000);
        },
        ChangeMode() {
            this.dark =
                window.sessionStorage.getItem("dark") == "true" ? true : false;
        },
        next() {
            if (
                Math.abs(this.index / window.screen.availWidth) + 1 ===
                this.meals.length
            ) {
                this.transition = "";
                this.index = 0;
            } else {
                this.transition = "transform 0.4s ease";
                this.index -= window.screen.availWidth;
                let x = Math.abs(this.index / window.screen.availWidth) + 1;
                let image = document.querySelector(
                    "#app > section > div > div > img:nth-child(" + x + ")"
                );
                //console.log("h " + x);
                //console.log("i " + this.meals.length);
            }
            //console.log(this.index);
        },
        previous() {
            if (Math.abs(this.index / window.screen.availWidth) + 1 === 1) {
                this.transition = "";
                this.index = 0;
            } else {
                this.transition = "transform 0.4s ease";
                this.index += window.screen.availWidth;
            }
            //console.log(Math.abs(this.index / window.screen.availWidth) + 1);
            //console.log("i " + this.meals.length);
        },
    },
    created() {
        this.loadData();
    },
    mounted() {
        this.slider();
        this.ChangeMode();
        document.body.style.overflowX = "hidden";
    },
};
</script>

<style scoped>
.slider {
    width: 100vw;
    height: 100vh;
    background: #888;
    /*position: relative;*/
}

.container-slide {
    display: inline-flex;
    flex-wrap: nowrap;
}

.img-slider {
    width: 100vw;
    height: 100vh;
    /*margin-left: 1000px;*/
    /*object-fit: cover;*/
}
.div-slider {
    position: relative;
    width: 100vw;
    height: 100vh;
}
.titre {
    text-shadow: 0 8px 12px rgba(0, 0, 0, 0.3);
}

.hero-slide {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    background: radial-gradient(
            120% 90% at 15% 8%,
            rgba(232, 163, 61, 0.35),
            transparent 55%
        ),
        linear-gradient(135deg, #1c1a17 0%, #c6491f 62%, #e8a33d 130%);
}

.hero-mark {
    font-weight: 700;
    font-size: 1rem;
    letter-spacing: 0.38em;
    text-transform: uppercase;
    color: #fbf3e7;
    opacity: 0.85;
}

.hero-mark span {
    color: #e8a33d;
}

.hero-title {
    text-shadow: 0 10px 40px rgba(0, 0, 0, 0.35);
}

.hero-tagline {
    color: #cdbfa9;
    line-height: 1.55;
}

.hero-cta {
    display: inline-flex;
    align-items: center;
    padding: 0.9rem 1.9rem;
    border-radius: 999px;
    background: #fbf3e7;
    color: #1c1a17;
    font-weight: 700;
    font-size: 1rem;
    letter-spacing: 0.02em;
    text-decoration: none;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.28);
    transition: transform 0.2s ease, background 0.2s ease;
}

.hero-cta:hover {
    transform: translateY(-2px);
    background: #e8a33d;
}
</style>
