<template>
    <div :class="[dark ? 'bg-gray-600' : 'bg-white']">
        <Header @ChangeMode="changeMode($event)"></Header>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 min-h-[70vh]">
            <div class="flex items-center justify-between mb-4 flex-wrap gap-2">
                <router-link
                    :to="cancelLink"
                    :class="[
                        dark
                            ? 'text-gray-300 hover:text-white'
                            : 'text-gray-500 hover:text-gray-800',
                        'inline-flex items-center gap-2 font-medium text-sm',
                    ]"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2.2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                    {{ isEditMode ? "Retour à la recette" : "Retour aux recettes" }}
                </router-link>

                <p class="text-sm font-semibold text-red-600 tracking-wide uppercase">
                    {{ isEditMode ? "Modification" : "Nouvelle recette" }}
                </p>
            </div>
            <h1
                :class="[
                    dark ? 'text-white' : 'text-gray-900',
                    'text-3xl font-extrabold tracking-tight sm:text-4xl mb-8',
                ]"
            >
                {{ isEditMode ? (name || "Modifier le plat") : "Ajouter un plat" }}
            </h1>

            <form
                @submit="formSubmit"
                enctype="multipart/form-data"
                class="grid grid-cols-1 lg:grid-cols-[380px_1fr] gap-8 items-start"
            >
                <!-- Photo -->
                <div
                    :class="[
                        dark
                            ? 'bg-gray-700 border-gray-500'
                            : 'bg-white border-gray-200',
                        'rounded-lg shadow-lg border overflow-hidden lg:sticky lg:top-6',
                    ]"
                >
                    <div v-if="previewSrc" class="relative aspect-[4/3] group">
                        <img
                            :src="previewSrc"
                            alt=""
                            class="w-full h-full object-cover"
                        />
                        <label
                            for="picture"
                            class="absolute inset-0 flex items-center justify-center text-white font-semibold text-sm bg-black/0 group-hover:bg-black/45 opacity-0 group-hover:opacity-100 transition-all cursor-pointer"
                        >
                            Changer la photo
                        </label>
                        <button
                            type="button"
                            @click="removeImage"
                            title="Retirer la photo"
                            class="absolute top-2.5 right-2.5 h-8 w-8 rounded-full bg-black/55 text-white flex items-center justify-center hover:bg-black/70"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2.6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 6l12 12M18 6L6 18"
                                />
                            </svg>
                        </button>
                    </div>
                    <label
                        v-else
                        for="picture"
                        :class="[
                            dragging ? 'bg-red-50' : '',
                            'aspect-[4/3] flex flex-col items-center justify-center gap-2 text-center px-6 cursor-pointer',
                        ]"
                        @dragover.prevent="dragging = true"
                        @dragleave.prevent="dragging = false"
                        @drop.prevent="onDrop"
                    >
                        <svg
                            :class="[
                                dark ? 'text-gray-300' : 'text-gray-400',
                                'h-10 w-10',
                            ]"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5 5 5M12 5v11"
                            />
                        </svg>
                        <div :class="[dark ? 'text-white' : 'text-gray-600', 'text-sm']">
                            <span class="text-red-600 font-semibold hover:text-red-500">Choisir une photo</span>
                            ou glisser-déposer
                        </div>
                        <p :class="[dark ? 'text-gray-300' : 'text-gray-400', 'text-xs']">
                            PNG, JPG — 20 Mo max
                        </p>
                    </label>
                    <input
                        id="picture"
                        type="file"
                        accept="image/*"
                        class="sr-only"
                        @change="updatePhoto"
                    />
                    <p
                        :class="[
                            dark
                                ? 'text-gray-300 border-gray-500'
                                : 'text-gray-500 border-gray-100',
                            'flex items-center gap-2 text-xs px-4 py-3 border-t',
                        ]"
                    >
                        <svg
                            class="h-4 w-4 text-red-600 flex-shrink-0"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M13 10V3L4 14h7v7l9-11h-7z"
                            />
                        </svg>
                        Optimisée et redimensionnée automatiquement à l'enregistrement.
                    </p>
                </div>

                <!-- Fields -->
                <div>
                    <div class="mb-5">
                        <label
                            for="name"
                            :class="[
                                dark ? 'text-white' : 'text-gray-700',
                                'block text-sm font-medium mb-1.5',
                            ]"
                            >Nom du plat</label
                        >
                        <input
                            v-model="name"
                            @keydown="checkName()"
                            type="text"
                            name="name"
                            id="name"
                            :class="[
                                messageName != null
                                    ? 'border-red-600 ring-1 ring-red-600'
                                    : dark
                                    ? 'border-gray-500'
                                    : 'border-gray-300',
                                dark ? 'bg-gray-600 text-white' : 'bg-white',
                                'py-3 px-4 block w-full shadow-sm focus:ring-2 focus:ring-red-600 focus:border-red-600 border rounded-md',
                            ]"
                        />
                        <p v-if="messageName != null" class="text-red-600 text-sm mt-1">
                            {{ messageName }}
                        </p>
                    </div>

                    <div class="mb-5">
                        <div class="flex items-baseline justify-between mb-1.5">
                            <label
                                for="description"
                                :class="[
                                    dark ? 'text-white' : 'text-gray-700',
                                    'block text-sm font-medium',
                                ]"
                                >Description</label
                            >
                            <span :class="[dark ? 'text-gray-300' : 'text-gray-400', 'text-xs font-medium']">
                                {{ (description || "").length }} / 2000
                            </span>
                        </div>
                        <textarea
                            v-model="description"
                            @keydown="checkDescription()"
                            id="description"
                            name="description"
                            rows="5"
                            :class="[
                                messageDescription != null
                                    ? 'border-red-600 ring-1 ring-red-600'
                                    : dark
                                    ? 'border-gray-500'
                                    : 'border-gray-300',
                                dark ? 'bg-gray-600 text-white' : 'bg-white',
                                'py-3 px-4 block w-full shadow-sm focus:ring-2 focus:ring-red-600 focus:border-red-600 border rounded-md',
                            ]"
                        />
                        <p
                            v-if="messageDescription != null"
                            class="text-red-600 text-sm mt-1"
                        >
                            {{ messageDescription }}
                        </p>
                    </div>

                    <div class="mb-5">
                        <label
                            :class="[
                                dark ? 'text-white' : 'text-gray-700',
                                'block text-sm font-medium mb-1.5',
                            ]"
                            >Catégories</label
                        >
                        <div class="flex flex-wrap gap-2">
                            <label
                                v-for="category in categories"
                                :key="category.id"
                                :class="[
                                    selectedCategories.includes(category.id)
                                        ? 'bg-red-600 border-red-600 text-white'
                                        : dark
                                        ? 'border-gray-400 text-white'
                                        : 'border-gray-300 text-gray-700',
                                    'cursor-pointer select-none px-3.5 py-1.5 rounded-full border text-sm font-medium transition-colors',
                                ]"
                            >
                                <input
                                    type="checkbox"
                                    :value="category.id"
                                    v-model="selectedCategories"
                                    class="sr-only"
                                />
                                {{ category.name }}
                            </label>
                        </div>
                    </div>

                    <div
                        :class="[
                            dark ? 'border-gray-500' : 'border-gray-200',
                            'flex justify-end gap-3 pt-5 border-t',
                        ]"
                    >
                        <router-link
                            :to="cancelLink"
                            :class="[
                                dark
                                    ? 'border-gray-400 text-gray-200 hover:border-gray-200'
                                    : 'border-gray-300 text-gray-600 hover:border-gray-500 hover:text-gray-800',
                                'inline-flex items-center px-6 py-3 rounded-full border font-medium text-sm',
                            ]"
                        >
                            Annuler
                        </router-link>
                        <button
                            type="submit"
                            class="inline-flex items-center px-6 py-3 rounded-full font-medium text-sm text-white bg-red-600 hover:bg-red-700 shadow-sm shadow-red-600/25"
                        >
                            {{ isEditMode ? "Enregistrer les modifications" : "Publier la recette" }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <Footer :mode="this.dark"></Footer>
    </div>
</template>

<script>
import Header from "../../components/Header.vue";
import Footer from "../../components/Footer.vue";
import { URL } from "../../env.js";
import router from "../../router";
import { useCategoryStore } from "../../stores/category";

export default {
    components: {
        Header,
        Footer,
    },
    data() {
        let messageName = null;
        let messageDescription = null;
        let name = null;
        let description = null;
        let pictureName = null;
        let picture = {};
        const injuries = [
            "con",
            "salope",
            "merde",
            "pute",
            "shit",
            "fuck",
            "suck",
            "vomir",
            "homo",
            "sexe",
        ];
        return {
            URL,
            dark: false,
            name,
            description,
            picture,
            pictureName,
            previewUrl: null,
            dragging: false,
            messageName,
            messageDescription,
            injuries,
            currentPicture: null,
            selectedCategories: [],
        };
    },
    setup() {
        return {
            categoryStore: useCategoryStore(),
        };
    },
    props: ["mode"],
    computed: {
        isEditMode() {
            return !!this.$route.params.slug;
        },
        categories() {
            return this.categoryStore.categories;
        },
        previewSrc() {
            if (this.previewUrl) {
                return this.previewUrl;
            }
            if (this.currentPicture) {
                return this.URL + "storage/meals/detail/" + this.currentPicture;
            }
            return null;
        },
        cancelLink() {
            return this.isEditMode ? "/meal/" + this.$route.params.slug : "/meals";
        },
    },
    methods: {
        changeMode() {
            this.dark =
                window.sessionStorage.getItem("dark") == "true" ? true : false;
        },
        validText(text, words) {
            for (const element of words) {
                if (text.includes(" " + element + " ")) {
                    this.messageDescription =
                        "Le texte contient un vocabulaire interdit comme : " +
                        element +
                        " !";
                }
            }
            return true;
        },
        checkForm() {
            return this.checkName() && this.checkDescription();
        },
        checkName() {
            if (this.name == "" || this.name == null) {
                this.messageName = "Il vous faut donner un nom à ce plat !";
            } else if (this.name.length < 5) {
                this.messageName = "Ce nom est trop court ...";
            } else {
                this.messageName = null;
            }
            return this.messageName == null ? true : false;
        },
        checkDescription() {
            if (this.description == null) {
                this.messageDescription =
                    "Expliquer en quelques mots à quoi correspond ce plat !";
            } else if (this.description.length < 10) {
                this.messageDescription =
                    "Faites un effort, cette description est trop courte ...";
            } else if (this.description.length < 20) {
                this.messageDescription =
                    "Vous y êtes presque, encore " +
                    (20 - this.description.length) +
                    " caractères !";
            } else {
                this.messageDescription = null;
                this.validText(this.description, this.injuries);
            }
            return this.messageDescription == null ? true : false;
        },
        setPreview(file) {
            if (this.previewUrl) {
                URL.revokeObjectURL(this.previewUrl);
            }
            this.picture = file;
            this.pictureName = file.name;
            this.previewUrl = URL.createObjectURL(file);
        },
        updatePhoto(e) {
            if (e.target.files[0]) {
                this.setPreview(e.target.files[0]);
            }
        },
        onDrop(e) {
            this.dragging = false;
            const file = e.dataTransfer.files[0];
            if (file) {
                this.setPreview(file);
            }
        },
        removeImage() {
            if (this.previewUrl) {
                URL.revokeObjectURL(this.previewUrl);
            }
            this.picture = "";
            this.pictureName = "";
            this.previewUrl = null;
            this.currentPicture = null;
        },
        loadMeal() {
            axios
                .get("/api/meal/" + this.$route.params.slug)
                .then(({ data }) => {
                    const meal = data[0];
                    this.name = meal.name;
                    this.description = meal.description;
                    this.currentPicture = meal.picture;
                    this.selectedCategories = (meal.categories || []).map(
                        (category) => category.id
                    );
                })
                .catch((error) => console.log("error", error));
        },
        formSubmit(e) {
            e.preventDefault();

            if (this.checkForm()) {
                let formData = new FormData();
                formData.append("name", this.name ? this.name.trim() : null);
                formData.append(
                    "description",
                    this.description ? this.description.trim() : null
                );
                formData.append("picture", this.picture ? this.picture : null);
                formData.append(
                    "pictureName",
                    this.pictureName ? this.pictureName : null
                );
                this.selectedCategories.forEach((id) => {
                    formData.append("category_ids[]", id);
                });

                const config = {
                    headers: {
                        "API-TOKEN": localStorage.getItem("api_token"),
                        "USER-TOKEN": localStorage.getItem("user_token"),
                    },
                };

                if (this.isEditMode) {
                    formData.append("_method", "PUT");
                }

                const url = this.isEditMode
                    ? "/api/meal/" + this.$route.params.slug
                    : "/api/meal";

                axios
                    .post(url, formData, config)
                    .then((res) =>
                        this.$router.push(
                            "/meal/" +
                                res.data.meal.slug +
                                (this.isEditMode
                                    ? "?msg=mealupdated"
                                    : "?msg=mealsuccess")
                        )
                    )
                    .catch(function (error) {
                        if (error.response.status == 403) {
                            router.push("/login?msg=notconnected");
                        } else {
                            console.log(error.response.status);
                            console.log(error.response.data);
                        }
                    });
            } else {
                console.log("Probleme avec le formulaire");
            }
        },
    },
    mounted() {
        this.changeMode();
        this.categoryStore.fetchCategories();
        if (this.isEditMode) {
            this.loadMeal();
        }
    },
    beforeUnmount() {
        if (this.previewUrl) {
            URL.revokeObjectURL(this.previewUrl);
        }
    },
};
</script>
