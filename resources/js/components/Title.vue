<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div>
        <div
            class="max-w-7xl mx-auto text-center pt-24 pb-12 px-4 sm:px-6 lg:pt-32 lg:pb-24 lg:px-8"
        >
            <h1
                :class="[
                    mode ? 'text-gray-100' : 'text-gray-900',
                    'text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl',
                ]"
            >
                <span class="text-red-600 text-5xl">SOS-Sauce</span>, le savoir
                faire des fines bouches !
            </h1>
            <div class="flex justify-center">
                <img
                    class="h-24 w-auto mt-12"
                    :src="URL + 'images/logo/sos-sauce.png'"
                    alt="SOS sauce logo"
                />
            </div>
        </div>
    </div>
</template>
<script>
import { URL } from "../env.js";
export default {
    props: ["mode"],
    data() {
        return {
            URL: URL,
        };
    },
};
</script>
