<template>
    <div class="heading">
        <h1 class="text-3xl text-red-500 leading-12 py-8">
            Hicaliber Trial Task
        </h1>
    </div>
    <div class="body m-auto w-1/3 bg-gray-300 px-6 py-4 rounded-md">
        <div class="form flex flex-col">
            <p>
                <label class="self-center p-2" for="price-from">Price From</label>
                <input v-model="form.price.from" id="price-from" type="text">
                <label class="self-center p-2" for="price-to">Price To</label>
                <input v-model="form.price.to" id="price-to" type="text">
            </p>

            <p>
                <label for="name">name</label>
                <input v-model="form.name" id="name" type="text">
            </p>
            <p>
                <label for="bedrooms">bedrooms</label>
                <input v-model="form.bedrooms" id="bedrooms" type="text">
            </p>
            <p>
                <label for="bathrooms">bathrooms</label>
                <input v-model="form.bathrooms" id="bathrooms" type="text">
            </p>
            <p>
                <label for="storeys">storeys</label>
                <input v-model="form.storeys" id="storeys" type="text">
            </p>
            <p>
                <label for="garages">garages</label>
                <input v-model="form.garages" id="garages" type="text">
            </p>
            <button class="btn bg-red-400 text-white mt-8 px-4 py-2 w-1/2 rounded-md mx-auto" @click.prevent="searchHouse">Search</button>
        </div>
        <hr class="my-8">
        <div class="results">
            <div v-if="loading && true" role="status" class="flex justify-center">
                <svg aria-hidden="true" class="w-16 h-16 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
            <div v-else>
                <ul v-if="houses.length">
                    <li v-for="house in houses" :key="house.id">
                        {{house.name}} | {{house.price}}$ | {{house.bedrooms}} BR | {{house.bathrooms}} Baths | {{house.storeys}} Storeys | {{house.garages}} Garages
                    </li>
                </ul>

                <div v-else class="text-center p-4">
                    There is no results. Try again with another search query.
                </div>
            </div>


        </div>
    </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import axiosClient from "../axios.js";

export default defineComponent({
    components: {},
    data() {
        return {
            form: {
                price: {
                    from: '',
                    to: '',
                },
                name: '',
                bedrooms: '',
                bathrooms: '',
                storeys: '',
                garages: '',
            },
            loading: false,
            houses: []
        };
    },
    methods: {
        searchHouse() {
            this.loading = true
            this.houses = [];

            axiosClient.post(`/get-houses`, {params: this.form}).then(({data}) => {
                setTimeout(() =>{
                    console.log('some long request')

                    this.houses = data.body
                    this.loading = false
                },3000)
            })
        }
    },
    mounted() {
        this.searchHouse()
    }
});
</script>

<style lang="sass" scoped>
    .form
        p
            display: flex
            justify-content: space-between

            label
                align-self: center
                padding: 6px
        input
            padding: 10px 20px
            background-color: burlywood
            margin: 5px 0
            border-radius: 10px

    .heading
        margin: 0 auto
        display: flex
        justify-content: center

        h1
            text-align: right
</style>
