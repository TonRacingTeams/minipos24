<template>
<div class="card">
  <h5 class="card-header">ຂໍ້ມູນການຂາຍ</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">

        <div class="d-flex justify-content-between mb-2">
            <div class="d-flex justify-items-center"> 

                <div class="d-flex justify-items-center me-2 cursor-pointer" @click="ChangSort()">
                    <i class='bx bx-sort-up fs-3' v-if="Sort=='asc'"></i>
                    <i class='bx bx-sort-down fs-3' v-if="Sort=='desc'"></i>
                </div>
                

                <select class="form-select" v-model="PerPage" @click="GetTransection()">
            
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
          </select>

            </div>

            <div class="d-flex mb-2">

                <!-- {{ month_type }} -->
                <div class="btn-group me-3 " role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary rounded-pill rounded-end" @click="month_type='m'"> <i class='bx bx-calendar me-2' style='color:white' v-if="month_type == 'm'" ></i> ເດືອນ</button>
                    
                    <button type="button" class="btn btn-primary rounded-pill rounded-start" @click="month_type='y'"> <i class='bx bx-calendar me-2' style='color:white' v-if="month_type == 'y'"  ></i> ປີ</button>
              </div>
              <input type="date" class="form-control rounded-pill" v-model="dmy">
            </div>
            
        </div>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center">ວັນທີ່</th>
            <th class="text-center">ເລກທີທຸລະກຳ</th>
            <th class="text-center">ປະເພດທຸລະກຳ</th>
            <th class="text-center">ລາຍລະອຽດ</th>
            <th class="text-center">ມູນຄ່າ</th>
          </tr>
        </thead>
        <tbody>

            <tr v-for="list in TransectionData.data" :key="list.id">
                <td class="text-center">{{ date (list.created_at) }}</td>
                <td class="text-center">{{ list.tran_id }}</td>
                <td class="text-center">{{ list.tran_type }}</td>
                <td class="text-center">{{ list.tran_detail }}</td>
                <td class="text-end">{{ formatPrice (list.price) }}</td>
            </tr>
          
        </tbody>
      </table>
      <Pagination :pagination="TransectionData" :offset="5" @paginate="GetTransection($event)" />
    </div>
  </div>
</div>
</template>

<script>
import moment from 'moment'
import axios from 'axios';
import { useStore } from '../Store/auth'

export default {
    name: 'WebAppLrvTransection',

    setup(){
        const store = useStore();
        return { store }
    },

    data() {
        return {
            Sort: 'asc',
            PerPage: 10,
            month_type:'m',
            TransectionData:[],
            dmy:new Date().toISOString().slice(0,10),
        };
    },

    components:{
        moment
    },

    mounted() {
        
    },

    methods: {

        formatPrice(value) {
        let val = (value / 1).toFixed(2).replace(",",".");
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      },

        date(value){
            return moment(value).format("DD/MM/YYY")
        },

        ChangSort(){
          if (this.Sort == 'asc') {
              this.Sort = 'desc'
          } else{
            this.Sort = 'asc'
          }

          this.GetTransection()

      },
      GetTransection(page){
        axios.post(`api/transection?page=${page}&sort=${this.Sort}&perpage=${this.PerPage}`,{
                month_type : this.month_type,
                dmy : this.dmy
        },{ headers:{ Authorization:"Bearer" + this.store.get_token}}).then((res)=>{
            this.TransectionData = res.data
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
        })
      }
    },
    created(){
        this.GetTransection()
    },

    watch:{
      month_type(){
        this.GetTransection()
      },

      dmy(){
        this.GetTransection()
      }
    }
};
</script>

<style lang="scss" scoped>

</style>