<template>
    <div>
        <h1>Transection Up Page</h1>

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
    name: 'WebAppLrvTransection',

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
        add(){
            this.store.set_token(this.text)
        }
    },
};
</script>

<style lang="scss" scoped>

</style>