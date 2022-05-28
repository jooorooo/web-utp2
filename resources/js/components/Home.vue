<template>
    <pins-list :getItemsAxios="getItems"></pins-list>
</template>

<script>
import PinsList from './include/PinsList'

export default {
    components: {
        PinsList
    },
    methods: {
        getItems(page) {
            return axios.get('/api/pins?page=' + page);
        }
    }
}
</script>
