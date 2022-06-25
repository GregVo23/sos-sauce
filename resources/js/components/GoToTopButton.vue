<template>
    <router-link to @click="moveUp">
        <button
            x-data="topBtn"
            @click="scrolltoTop"
            id="topButton"
            class="fixed z-10 hidden p-3 bg-gray-100 hover:bg-red-600 hover:text-white rounded-full shadow-md bottom-10 right-10 animate-bounce"
        >
            <svg
                class="w-8 h-8"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2.5"
                    d="M5 10l7-7m0 0l7 7m-7-7v18"
                ></path>
            </svg></button
    ></router-link>
</template>

<script>
export default {
    name: "GoToTopButton",
    methods: {
        scrolltoTop() {
            const topBtn = document.getElementById("topButton");

            document.body.scrollTop > 20 ||
            document.documentElement.scrollTop > 20
                ? topBtn.classList.remove("hidden")
                : topBtn.classList.add("hidden");
        },
        handleScroll(event) {
            this.scrolltoTop();
            console.log("test");
        },
    },
    created() {
        window.addEventListener("scroll", this.handleScroll);
    },
    destroyed() {
        window.removeEventListener("scroll", this.handleScroll);
    },
};
</script>
