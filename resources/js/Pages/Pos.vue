<template>
    <div>
        <h1>POS Up page</h1>

        <hr>

        Token:{{store.get_token}}

<hr>

        <input type="text" v-model="text">
        <button @click="add()">ເພີ່ມ</button>

    </div>
</template>

<script>

import { useStore } from '../Store/auth'

export default {
    name: 'WebAppLrvPos',

    setup(){
        const store = useStore();
        return {store}
    },

    data() {
        return {
            
        };
    },

    mounted() {
        
    },

    methods: {
        
    },
};
</script>

<style lang="scss" scoped>

</style>