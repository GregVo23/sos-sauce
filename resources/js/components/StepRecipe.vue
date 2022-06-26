<template>
    <div
        :class="[
            dark ? 'bg-gray-600' : 'bg-white',
            'xl:flex justify-around p-8 lg:px-24 xl:px-48',
        ]"
    >
        <div class="mt-16 space-y-16">
            <h2
                :class="[
                    dark ? 'text-white' : 'text-gray-800',
                    'text-center mt-10 mb-4 text-3xl font-bold underline',
                ]"
            >
                Préparation:
            </h2>
            <div
                v-for="(step, featureIdx) in meal.recipes"
                :key="step.id"
                class="flex flex-col-reverse lg:grid lg:grid-cols-12 lg:gap-x-8 lg:items-center"
            >
                <div
                    :class="[
                        featureIdx % 2 === 0
                            ? 'lg:col-start-1'
                            : 'lg:col-start-8 xl:col-start-9',
                        'mt-6 lg:mt-0 lg:row-start-1 lg:col-span-5 xl:col-span-4',
                    ]"
                >
                    <h3
                        :class="[
                            dark ? 'text-white' : 'text-gray-900',
                            'text-2xl font-medium',
                        ]"
                    >
                        Etape {{ step.step }}.
                    </h3>
                    <div class="flex my-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            :class="[
                                dark ? 'text-white' : 'text-gray-900',
                                'h-6 w-6',
                            ]"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                            /></svg
                        ><span
                            :class="[
                                dark ? 'text-white' : 'text-gray-900',
                                'pl-1',
                            ]"
                        >
                            {{ new Date(meal.time).getMinutes() }}
                            minutes</span
                        >
                    </div>
                    <p
                        :class="[
                            dark ? 'text-gray-300' : 'text-gray-900',
                            'mt-2 text-lg',
                        ]"
                    >
                        {{ step.description }}
                    </p>
                </div>
                <div
                    :class="[
                        featureIdx % 2 === 0
                            ? 'lg:col-start-6 xl:col-start-5'
                            : 'lg:col-start-1',
                        'flex-auto lg:row-start-1 lg:col-span-7 xl:col-span-8',
                    ]"
                >
                    <div
                        class="aspect-w-5 aspect-h-2 rounded-3xl bg-gray-500 overflow-hidden"
                    >
                        <img
                            :src="URL + 'storage/meals/' + meal.picture"
                            :alt="meal.name"
                            :class="[
                                dark ? 'opacity-80' : 'opacity-100',
                                'object-center object-cover',
                            ]"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["dark", "URL", "meal"],
};
</script>
