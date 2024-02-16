<template>
<di class="row">
    <div class="col-md-8">
        <div class="card mb-4">
                <div class="card-body">
                    <input type="text" class="form-control rounded-pill" placeholder="ຄົ້ນຫາ...">
                </div>   
        </div>

        <div class="row" style="overflow: auto; height: 400px;">
            <div class="col-md-3" v-for="i in 30" :key="i">
                <div class="card ">
                    <img class="card-img-top" src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template-free/demo/assets/img/elements/2.jpg" alt="Card image cap">
                    <div class="card-body p-2">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                        XXX,XXX.00
                        </p>
                        <!-- <a href="javascript:void(0)" class="btn btn-outline-primary">ລາຍລະອຽດ</a> -->
                    </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        Bill
    </div>

    <!-- {{ StoreData }} -->

</di>
</template>

<script>


import { useStore } from '../Store/auth'

export default {

    setup(){
        const store = useStore();
        return { store }
    },
    name: 'WebAppLrvPos',

    data() {
        return {
            Sort: 'asc',
            PerPage: '30',
            Search: '',
            StoreData: [],
            ListOrder: []
        };
    },

    mounted() {
        
    },

    methods: {
        
        GetStore(page){
            axios.get(`api/store?page=${page}&sort=${this.Sort}&perpage=${this.PerPage}&search=${this.Search}`, { headers:{ Authorization:"Bearer" + this.store.get_token} }).then((res)=> {
                  
            //   this.StoreData = res.data;

            this.StoreData = res.data
  
                }).catch((error)=>{
                  console.log(error)
                  if (error) {
                    if (error.response.status == 401) {
                      this.store.remove_token()
                      this.store.remove_user()
                      localStorage.removeItem("web_token")
                      localStorage.removeItem("web_user") 
                      this.$router.push("/login")


                    }
                  }
                });
          }


    },
    created(){
        this.GetStore()
    }
};
</script>

<style lang="scss" scoped>

</style>