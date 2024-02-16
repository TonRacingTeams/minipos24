<template>
    <div class="card">
  <h5 class="card-header">ລາຍການສະຕ໋ອກສີນຄ້າ</h5>
  <div class="card-body">


    <div v-if="ShowForm">
      <div class="text-end">
        <button class="btn btn-primary rounded-pill me-2 mb-4" :disabled="CheckFrom" @click="SaveStore()">ບັນທຶກ</button>
        <button class="btn btn-secondary rounded-pill me-2 mb-4" @click="CancleStore">ຍົກເລີກ</button>
      </div>

      <!-- {{ FormStore }} -->

      <div class="row">
        <div class="col-md-3 text-center" style="position: relative;">


          <button type="button" v-if="FormStore.image" @click="RemoveImg()" class="btn rounded-pill btn-icon btn-primary" style="position: absolute; top: 10px; right: 5px;">

            <i class='bx bx-trash fs-3' ></i>
              
              </button>
              

          <img :src="image_previwe" alt="" @click="$refs.img_store.click()" class="cursor-pointer rounded" style="width: 95%;">
          <input type="file" ref="img_store" style="display: none;" @change="onSelect">
        </div>
        <div class="col-md-9">
          <div class="mb-2">
              <label for="product_name" class="form-label fs-6">ຊື່ສີນຄ້າ:</label>
              <input type="text" class="form-control rounded-pill" v-model="FormStore.name" id="product_name" placeholder="...">
          </div>
          <br>
          <div>
              <label for="product_amount" class="form-label fs-6">ຈຳນວນ:</label>
              <cleave :options="options" class="form-control rounded-pill" v-model="FormStore.amount"  id="product_amount" placeholder="..." />
          </div>
          <br>
          <div class="row">
            <div class="col-md-6">
              <div class="mb-2 ">
              <label for="product_price_buy" class="form-label fs-6">ລາຄາຊື້:</label>
              <cleave :options="options" class="form-control rounded-pill" v-model="FormStore.price_buy" id="product_price_buy" placeholder="..." />
          </div>
            </div>
            
            <div class="col-md-6">
              <div class="mb-2 ">
              <label for="product_pice_sell" class="form-label fs-6">ລາຄາຂາຍ:</label>
              <cleave :options="options" class="form-control rounded-pill" v-model="FormStore.price_sell"  id="product_pice_sell" placeholder="..." />
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
                

                <select class="form-select" v-model="PerPage" @change="GetStore()">
            
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
          </select>

            </div>
            <div>
                <input type="text" class="from-control me-4 p-2 rounded-pill" v-model="Search" @keyup.enter="GetStore()" placeholder="ຄົ້ນຫາ...">
                <button class="btn btn-primary rounded-pill" @click="AddStore()"><i class='bx bx-user-plus me-2 fs-4'></i> ເພີ່ມຂໍ້ມູນ</button>
            </div>
        </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th width="32px">ID</th>
            <th width="236px" class="text-center">ຮູບສີນຄ້າ</th>
            <th width="336px" class="text-center">ຊື່ສີນຄ້າ</th>
            <th width="95px" class="text-center">ຈຳນວນ</th>
            <th width="159px" class="text-center">ລາຄາຊື້ (ກີບ)</th>
            <th width="159px" class="text-center">ລາຄາຂາຍ (ກີບ)</th>
            <th width="32px" class="text-center">ຈັດການ</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="list in StoreData.data" :key="list.id">
            <td>{{list.id}}</td>
            <td class="text-center">
              <!-- {{ list.image }} -->
                <img :src="url + '/assets/img/' + list.image" v-if="list.image" class="rounded" style="width: 100%;">
                <img :src="url + '/assets/img/no_photoJP.jpg'" v-else class="rounded" style="width: 100%;">
            </td>
            <td>{{list.name}}</td>
            <td class="text-center">{{list.amount}}</td>
            <td class="text-end">{{ formatPrice (list.price_buy) }}</td>
            <td class="text-end">{{ formatPrice (list.price_sell) }}</td>
            <td class="text-center">
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
      <button @click="showAlert">Hello world</button>
    </div>
  </div>
</div>
</template>

<script>
import axios from 'axios';

import { useStore } from '../Store/auth'
import { watch } from 'vue';

export default {
    name: 'WebAppLrvStore',

    setup(){
        const store = useStore();
        return { store }
    },

    data() {
        return {
            url: window.location.origin,
            image_previwe: window.location.origin + '/assets/img/upload_img.png',
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
            PerPage:'5',
            Search:'',
            options: {
              // prefix: '₭',
              numeral: true,
              numeralPositiveOnly: true,
              noImmediatePrefix: true,
              rawValueTrimPerfix: true,
              numeralIntegerScale: 10,
              numeralDecimalScale: 2,
              numeralDecimalMark: ',',
              delimiter: '.'
                }
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


      showAlert() {
          // Use sweetalert2
          
          this.$swal({ 
            title: 'res.data.message',
                      icon: "error", 
                      showConfirmButton: false,
                      timer: 3600
        });
          
      },

      RemoveImg(){
        this.FormStore.image = '';
        this.image_previwe = window.location.origin + '/assets/img/upload_img.png';

      },

      formatPrice(value) {
        let val = (value / 1).toFixed(2).replace(",",".");
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      },


      ChangSort(){
          if (this.Sort == 'asc') {
              this.Sort = 'desc'
          } else{
            this.Sort = 'asc'
          }

          this.GetStore()
      },


      onSelect(event){
          // console.log(event.target.files[0])

          this.FormStore.image = event.target.files[0]
          let reader = new FileReader()
          reader.readAsDataURL(this.FormStore.image)
          reader.addEventListener("load",function(){
            this.image_previwe =reader.result
          }.bind(this),false)
      },


        AddStore(){

          this.FormStore.name = '';
          this.FormStore.amount = '';
          this.FormStore.price_buy = '';
          this.FormStore.price_sell = '';
          this.FormStore.image = '';
          this.image_previwe = window.location.origin + '/assets/img/upload_img.png';


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

                if (res.data.image) {
                  this.image_previwe = this.url + '/assets/img/' + res.data.image;
                } else{
                  this.image_previwe = this.url + '/assets/img/upload_img.png';
                }

                this.ShowForm = true;
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

                      // `api/store/edit/${id}`          ຫຼັກການຂຽນ api ແບບທີ່ 01
                      // 'api/store/edit/' + id          ຫຼັກການຂຽນ api ແບບທີ່ 02

            },


        DeleteStore(id){

          
          this.$swal({
              title: " ທ່ານແນ່ໃຈ ຫຼື ບໍ່ ? ",
              text: " ທີ່ຈະລົບລາຍການຂໍ້ມູນນີ້ ! ",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#696cff",
              cancelButtonColor: "#8592A3",
              confirmButtonText: " ຕົກລົງ ",
              cancelButtonText: " ຍົກເລີກ "
            }).then((result) => {
              if (result.isConfirmed) {


                axios.delete(`api/store/delete/${id}`, { headers:{ Authorization:"Bearer" + this.store.get_token}}).then((res)=>{
                if(res.data.success){
                  this.GetStore()


                  this.$swal({
                      title: " ລົບຂໍ້ມູນ ! ",
                      text: res.data.message,
                      icon: "success",
                      showConfirmButton: false,
                      timer: 1500
                });


                } else {
                  this.$swal({ 
                      title: res.data.message,
                      icon: "error", 
                      showConfirmButton: false,
                      timer: 3600
        });
                }
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
            });
  


          
        },






          SaveStore(){
            //ການກວດສອບຟອມ FormType = true ເປັນການເພີ່ມຂໍ້ມູນ, FormType = false ເປັນການອັບເດດຂໍ້ມູນ.

            if (this.FormType) {
              //ການເພີ່ມຂໍ້ມຸນ

              axios.post('api/store/add', this.FormStore, { headers:{ "Content-Type":"multipart/form-data", Authorization:"Bearer" + this.store.get_token}}).then((res)=> {
                  
                if (res.data.success) {
                  this.ShowForm = false
                  this.GetStore()

                  this.$swal({ 
                      position: 'top-center',
                      toast: true,
                      title: res.data.message,
                      icon: "success", 
                      showConfirmButton: false,
                      timer: 500
                  });


                } else{
                  this.$swal({ 

                      title: res.data.message,
                      icon: "error", 
                      showConfirmButton: false,
                      timer: 3600

                  });
                }
                
                
                // console.log(res)


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

          GetStore(page){
            axios.get(`api/store?page=${page}&sort=${this.Sort}&perpage=${this.PerPage}&search=${this.Search}`, { headers:{ Authorization:"Bearer" + this.store.get_token} }).then((res)=> {
                  
              this.StoreData = res.data;
  
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
      this.GetStore();      
    },
    watch:{
      Search(){
        if (this.Search == '') {
            this.GetStore()
        }
      }
    }
};
</script>

<style lang="scss" scoped>

</style>