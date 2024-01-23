<template>
    <div>
        <h1>Store Up Page</h1>

        <hr>

        Token: {{store.get_token}}

        <hr>

        <input type="text" v-model="text">
        <button @click="add()">ເພີ່ມ</button>

    </div>
</template>

<script>

import { useStore } from '../Store/auth'

export default {
    name: 'WebAppLrvStore',

    setup(){
        const store = useStore();
        return { store }
    },

    data() {
        return {
            text:''
        };
    },

    mounted() {
        
    },

    methods: {
        add(){
            localStorage.setItem('web_token',this.text)
            // this.store.set_token(this.text)
        }
    },
};
</script>

<style lang="scss" scoped>

</style>