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
              <input type="text" class="form-control rounded-pill" v-model="FormStore.price_by" id="product_price_buy" placeholder="...">
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

                <div class="d-flex justify-items-center me-2">
                    <i class='bx bx-sort-up fs-3'></i>
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
            <th>ຮູບ</th>
            <th>ຊື່ສີນຄ້າ</th>
            <th>ລາຄາຊື້</th>
            <th>ຈັດການ</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>0001</td>
            <td>001.png</td>
            <td>
              ໂຕໂຍຕ້າ
            </td>
            <td><span class="badge bg-label-primary me-1">1,200,000,00 BTH</span></td>
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> ແກ້ໄຂ</a>
                  <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> ລົບ</a>
                </div>
              </div>
            </td>
          </tr>
          
        </tbody>
      </table>
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
            FormStore:{
              name:'',
              image:'',
              amount:'',
              price_by:'',
              price_sell:'',
            }
        };
    },

    computed:{
      CheckFrom(){
                  if (this.FormStore.name == '' || this.FormStore.amount == '' || this.FormStore.price_by == '' || this.FormStore.price_sell == '') {
                    return true;
                    
                  }else{
                    return false;
                  }
      }
    },

    mounted() {
        
    },

    methods: {
        AddStore(){


          this.ShowForm = true;
          this.FormType = true;

        },
        CancleStore(){
          this.ShowForm = false;
        },

          SaveStore(){
            //ການກວດສອບຟອມ FormType = true ເປັນການເພີ່ມຂໍ້ມູນ, FormType = false ເປັນການອັບເດດຂໍ້ມູນ.

            if (this.FormStore) {
              //ການເພີ່ມຂໍ້ມຸນ

              axios.post('api/stroe/add',this.FormStore, {headers:{"Content-Type":"multipart/form-data", Authorization:"Bearer" + this.store.get_token}}).then((res)=> {
                  console.log(res)
              }).catch((error)=>{
                console.log(error)
              })
              
            } else{
              //ການອັບເດດຂໍ້ມູນ

              


            }
          }
    },
};
</script>

<style lang="scss" scoped>

</style>