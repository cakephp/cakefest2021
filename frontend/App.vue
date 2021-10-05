<template>
    <div class="sm:mx-auto sm:w-full sm:max-w-lg">
        <h2 class="mb-2 text-md font-semibold text-gray-500">
            Find the current METAR at an airport
        </h2>
        <div class="flex items-center">
            <input
                v-model="searchString"
                ref="search-input"
                type="text"
                class="form-input w-full px-4 py-3 leading-4 border-gray-300 rounded-md placeholder-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                placeholder="Enter airport ICAO code"
                autofocus
            >
            <button
                type="button"
                class="btn w-32 ml-2"
                @click="clear"
            >
                Clear
            </button>
        </div>
        <div class="font-mono text-center text-lg text-gray-500 mt-4 h-32">
            {{ result }}
        </div>
    </div>
</template>

<script>
import _ from 'lodash'
import api from './api'

export default {
    data() {
        return {
            result: null,
            searchString: null,
            working: false,
        }
    },
    watch: {
        searchString: _.debounce(function(newVal) {
            if (newVal && newVal.length >= 4) {
                this.search(newVal)
            }
        }, 300)
    },
    methods: {
        async search(searchString) {
            this.result = null
            this.working = true

            try {
                let response = await api.get('metar/get', searchString)
                this.result = response.data.metar
            } catch (err) {
                switch (err.response.status) {
                case 403:
                    this.result = 'You are not allowed to view this METAR'
                    break
                    case 404:
                        this.result = 'No airport found'
                        break
                    default:
                        this.result = 'Something went wrong'
                }
            } finally {
                this.working = false
            }
        },
        clear() {
            this.result = null
            this.searchString = null
        }
    }
}
</script>