<template>
    <div class="card">
  <h5 class="card-header">ລາຍການສະຕ໋ອກສີນຄ້າ</h5>
  <div class="card-body">


    <div v-if="ShowForm">
      <div class="text-end">
        <button class="btn btn-info rounded-pill me-2 mb-4" :disabled="CheckFrom" @click="SaveStore()">ບັນທຶກ</button>
        <button class="btn btn-danger rounded-pill me-2 mb-4" @click="CancleStore">ຍົກເລີກ</button>
      </div>

      {{ FormStore }}

      <div class="row">
        <div class="col-md-3">Image</div>
        <div class="col-md-9">
          <div class="mb-2">
              <label for="product_name" class="form-label fs-6">ຊື່ສີນຄ້າ:</label>
              <input type="text" class="form-control rounded-pill" v-model="FormStore.name" id="product_name" placeholder="...">
          </div>

          <div>
              <label for="product_amount" class="form-label fs-6">ຈຳນວນ:</label>
              <input type="text" class="form-control rounded-pill" v-model="FormStore.amount"  id="product_amount" placeholder="...">
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="mb-2">
              <label for="product_price_buy" class="form-label fs-6">ລາຄາຊື້:</label>
              <input type="text" class="form-control rounded-pill" v-model="FormStore.price_buy" id="product_price_buy" placeholder="...">
          </div>
            </div>
            <div class="col-md-6"><div class="mb-2">
              <label for="product_pice_sell" class="form-label fs-6">ລາຄາຂາຍ:</label>
              <input type="text" class="form-control rounded-pill" v-model="FormStore.price_sell"  id="product_pice_sell" placeholder="...">
            </div>
          </div>
          </div>
      </div>
      </div>

    </div>




    <div class="table-responsive text-nowrap" v-if="!ShowForm">

        <div class="d-flex justify-content-between mb-2">
            <div class="d-flex justify-items-center"> 

                <div class="d-flex justify-items-center me-2 cursor-pointer" @click="ChangSort()">
                    <i class='bx bx-sort-up fs-3' v-if="Sort=='asc'"></i>
                    <i class='bx bx-sort-down fs-3' v-if="Sort=='desc'"></i>
                </div>
                

                <select class="form-select">
            
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
          </select>

            </div>
            <div>
                <input type="text" class="from-control rounded me-2" placeholder="ຄົ້ນຫາ...">
                <button class="btn btn-primary rounded-pill" @click="AddStore()"><i class='bx bx-user-plus me-2 fs-4'></i> ເພີ່ມຂໍ້ມູນ</button>
            </div>
        </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>ຮູບສີນຄ້າ</th>
            <th>ຊື່ສີນຄ້າ</th>
            <th>ລາຄາຊື້ (ກີບ)</th>
            <th>ລາຄາຂາຍ (ກີບ)</th>
            <th>ຈັດການ</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="list in StoreData.data" :key="list.id">
            <td>{{list.id}}</td>
            <td>-</td>
            <td>{{list.name}}</td>
            <td>{{list.price_buy}}</td>
            <td>{{list.price_sell}}</td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);" @click="CopyStore(list.id)"><i class='bx bx-copy-alt'></i> ກ໋ອບປີ້ </a>
                  <a class="dropdown-item" href="javascript:void(0);" @click="EditStore(list.id)"><i class="bx bx-edit-alt me-1"></i> ແກ້ໄຂ </a>
                  <a class="dropdown-item" href="javascript:void(0);" @click="DeleteStore(list.id)"><i class="bx bx-trash me-1"></i> ລົບລາຍການ </a>
                </div>
              </div>
            </td>
          </tr>
          
        </tbody>
      </table>

      <Pagination :pagination="StoreData" :offset="5" @paginate="GetStore($event)" />
    </div>
  </div>
</div>
</template>

<script>
import axios from 'axios';

import { useStore } from '../Store/auth'

export default {
    name: 'WebAppLrvStore',

    setup(){
        const store = useStore();
        return { store }
    },

    data() {
        return {
            ShowForm:false,
            FormType:true,
            EditID:'',
            FormStore:{
              name:'',
              image:'',
              amount:'',
              price_buy:'',
              price_sell:'',
            },

            StoreData:[],
            Sort:'asc',
        };
    },

    computed:{
      CheckFrom(){
                  if (this.FormStore.name == '' || this.FormStore.amount == '' || this.FormStore.price_buy == '' || this.FormStore.price_sell == '') {
                    return true;
                    
                  }else{
                    return false;
                  }
      }
    },

    mounted() {
        
    },

    methods: {


      ChangSort(){
          if (this.Sort == 'asc') {
              this.Sort = 'desc'
          } else{
            this.Sort = 'asc'
          }

          this.GetStore()
      },


        AddStore(){

          this.FormStore.name = '';
          this.FormStore.amount = '';
          this.FormStore.price_buy = '';
          this.FormStore.price_sell = '';


          this.ShowForm = true;
          this.FormType = true;

        },
        CancleStore(){
          this.ShowForm = false;
        },



        EditStore(id){
            // console.log(id)

            this.FormType = false;
            this.EditID = id;

            axios.get(`api/store/edit/${id}`, { headers:{ "Content-Type":"multipart/form-data", Authorization:"Bearer" + this.store.get_token}}). then((res)=>{
                this.FormStore = res.data;
                this.ShowForm = true;
            }).catch((error)=>{
                console.log(error)
              })

                      // `api/store/edit/${id}`          ຫຼັກການຂຽນ api ແບບທີ່ 01
                      // 'api/store/edit/' + id          ຫຼັກການຂຽນ api ແບບທີ່ 02

            },


            CopyStore(id){
            // console.log(id)

            this.FormType = true;
            this.EditID = id;

            axios.get(`api/store/edit/${id}`, { headers:{ "Content-Type":"multipart/form-data", Authorization:"Bearer" + this.store.get_token}}). then((res)=>{
                this.FormStore = res.data;
                this.ShowForm = true;
            }).catch((error)=>{
                console.log(error)
              })

                      // `api/store/edit/${id}`          ຫຼັກການຂຽນ api ແບບທີ່ 01
                      // 'api/store/edit/' + id          ຫຼັກການຂຽນ api ແບບທີ່ 02

            },


        DeleteStore(id){
          axios.delete(`api/store/delete/${id}`, { headers:{ Authorization:"Bearer" + this.store.get_token}}).then((res)=>{
                if(res.data.success){
                  this.GetStore()
                }
          }).catch((error)=>{
            console.log(error)
          })
        },






          SaveStore(){
            //ການກວດສອບຟອມ FormType = true ເປັນການເພີ່ມຂໍ້ມູນ, FormType = false ເປັນການອັບເດດຂໍ້ມູນ.

            if (this.FormType) {
              //ການເພີ່ມຂໍ້ມຸນ

              axios.post('api/store/add', this.FormStore, { headers:{ "Content-Type":"multipart/form-data", Authorization:"Bearer" + this.store.get_token}}).then((res)=> {
                  
                if (res.data.success) {
                  this.ShowForm = false
                  this.GetStore()
                }
                
                
                // console.log(res)


              }).catch((error)=>{
                console.log(error)
              })
              
            } else{
              //ການອັບເດດຂໍ້ມູນ

              axios.post(`api/store/update/${this.EditID}`, this.FormStore, { headers:{ "Content-Type":"multipart/form-data", Authorization:"Bearer" + this.store.get_token}}).then((res)=> {
                  
                  if (res.data.success) {
                    this.ShowForm = false
                    this.GetStore()
                  }
                  
                  
                  // console.log(res)
  
  
                }).catch((error)=>{
                  console.log(error)
                })


            }
          },

          GetStore(page){
            axios.get(`api/store?page=${page}&sort=${this.Sort}`, { headers:{ Authorization:"Bearer" + this.store.get_token} }).then((res)=> {
                  
              this.StoreData = res.data;
  
                }).catch((error)=>{
                  console.log(error)
                });
          }
    },

    created(){
      this.GetStore();      
    }
};
</script>

<style lang="scss" scoped>

</style>