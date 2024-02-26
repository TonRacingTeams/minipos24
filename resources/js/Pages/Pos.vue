<template>
<div class="row">
    <div class="col-md-7">
        <div class="card mb-4">
                <div class="card-body">
                    <input type="text" class="form-control rounded-pill" placeholder="ຄົ້ນຫາ..." v-model="Search" @keyup.enter="GetStore()">
                </div>   
        </div>

    <perfect-scrollbar>
        <div style=" height: 51vh;">
            <div class="row m-1">
            <div class="col-md-4" v-for="item in StoreData.data" :key="item">
                <div class="card mb-3 cursor-pointer" @click="AddProduct(item.id)">
                    <span v-for=" i in ListOrder" :key="i.id">
                    <span class="number-list" v-if="item.id == i.id">{{ i.order_amount }}</span>
                    </span>
                    <img class="card-img-top img-pos" v-if="item.image" :src="url + '/assets/img/'+item.image">
                    <img class="card-img-top img-pos" v-else :src="url + '/assets/img/no_photoJP.jpg'">
                    <div class="card-body p-2 text-center">
                        <h6 class="card-title m-0">{{ item.name }}</h6>
                        <p class="card-text">
                        {{ item.price_sell}}
                        </p>
                        <!-- <a href="javascript:void(0)" class="btn btn-outline-primary">ລາຍລະອຽດ</a> -->
                    </div>
                    </div>
            </div>
        </div>
        </div>
    </perfect-scrollbar>
    </div>
    <div class="col-5">
        <div class="card">
            <div class="card-body p-0">
                <div class="p-3">
                    
                    <label for="customer_name">ຊື່ລູກຄ້າ: </label>
                    <input type="text" class="form-control rounded-pill" v-model="customer_name" id="customer_name" placeholder="........">
                    <label for="customer_tel">ເບີໂທ: </label>
                    <input type="text" class="form-control rounded-pill" v-model="customer_tel" id="customer_tel" placeholder="........">
                </div>
                    <hr>
                    
                    <div class="p-3">
                        <div class="d-flex justify-content-between fs-4 fw-bold text-danger">
                            <span>ລວມຍອດເງີນ:</span>
                            <span>{{ formatPrice(TotalAmount) }} ກີບ</span>
                        </div>
                        <button class="btn btn-primary rounded-pill fw-blod w-100 fs-5" :disabled="!TotalAmount" @click="ShowModal()">ຊຳລະເງີນ</button>
                    </div>


                    <div>
                        <perfect-scrollbar class="mb-4">
                            <div style="height: 32vh;">
                                
                            <div class="table-responsive text-nowrap mb-4" >

                            <table class="table border">
                            <thead>
                                <tr>
                                
                                <th class="fs-6 fw-blod w-100">ລາຍການ</th>
                                <th class="fs-6 fw-blod w-100">ລາຄາ</th>
                                <th class="fs-6 fw-blod w-100">ຍອດລວມ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="list in ListOrder " :key="list.id">
                                <td>{{ list.name }}</td>
                                <td class="text-end">{{ formatPrice (list.price_sell) }} <br>
                                    <i class='bx bx-minus-circle text-danger cursor-pointer opacity-87' @click="RemoveProduct(list.id)"></i> {{ list.order_amount }} <i class='bx bx-plus-circle text-success cursor-pointer' @click="AddProduct(list.id)"></i> | <i class='bx bxs-trash text-danger cursor-pointer' @click="DeleteProduct(list.id)" ></i>
                                </td>
                                <td class="text-end">{{formatPrice (list.order_amount*list.price_sell) }}</td>

                                
                                </tr>
                            </tbody>
                            
                            </table>
                        
                        </div>
                    </div>
                    </perfect-scrollbar>
                </div>




            </div>
        </div>
    </div>

    <!-- {{ StoreData }} -->


    <div class="modal fade" id="confrim_pay_modal" tabindex="-1" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel1">ການຊຳລະເງີນ</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                                <div class=" d-flex justify-content-between">
                                <span>ລວມຍອດເງິນ:</span>
                                <span>{{ formatPrice(TotalAmount) }} ກີບ</span>
                            </div>
                            <div class=" d-flex justify-content-between">
                                <span>ຮັບເງິນນຳລູກຄ້າ:</span>
                                <span>{{ formatPrice(CashAmount) }} ກີບ</span>
                            </div>
                            <div class=" d-flex justify-content-between text-danger" v-if="(CashAmount-TotalAmount)>0">
                                <span>ເງິນທອນ:</span>
                                <span>{{ formatPrice(CashAmount - TotalAmount) }} ກີບ</span>
                            </div>

                            <div class=" d-flex justify-content-center">
                                <div class="row" style=" width: 236px; ">
                            <div class=" col-md-4 mt-2">
                                <button class="btn btn-outline-primary rounded-pill" style=" width: 59px; height: 59px;" @click="AddNum(1)" >1</button>
                            </div>
                            <div class=" col-md-4 mt-2">
                                <button class="btn btn-outline-primary rounded-pill" style=" width: 59px; height: 59px;;" @click="AddNum(2)" >2</button>
                            </div>
                            <div class=" col-md-4 mt-2"> 
                                <button class="btn btn-outline-primary rounded-pill" style=" width: 59px; height: 59px;" @click="AddNum(3)" >3</button>
                            </div>
                            <div class=" col-md-4 mt-2">
                                <button class="btn btn-outline-primary rounded-pill" style=" width: 59px; height: 59px;" @click="AddNum(4)" >4</button>
                            </div>
                            <div class=" col-md-4 mt-2">
                                <button class="btn btn-outline-primary rounded-pill" style=" width: 59px; height: 59px;" @click="AddNum(5)" >5</button>
                            </div>
                            <div class=" col-md-4 mt-2">
                                <button class="btn btn-outline-primary rounded-pill" style=" width: 59px; height: 59px;" @click="AddNum(6)" >6</button>
                            </div>
                            <div class=" col-md-4 mt-2">
                                <button class="btn btn-outline-primary rounded-pill" style=" width: 59px; height: 59px;" @click="AddNum(7)" >7</button>
                            </div>
                            <div class=" col-md-4 mt-2">
                                <button class="btn btn-outline-primary rounded-pill" style=" width: 59px; height: 59px;" @click="AddNum(8)" >8</button>
                            </div>
                            <div class=" col-md-4 mt-2">
                                <button class="btn btn-outline-primary rounded-pill" style=" width: 59px; height: 59px;" @click="AddNum(9)" >9</button>
                            </div>
                            <div class=" col-md-4 mt-2">
                                <button class="btn btn-outline-primary rounded-pill" style=" width: 59px; height: 59px;" @click="AddNum('00')" >00</button>
                            </div>
                            <div class=" col-md-4 mt-2">
                                <button class="btn btn-outline-primary rounded-pill" style=" width: 59px; height: 59px;" @click="AddNum(0)" >0</button>
                            </div>
                            <div class=" col-md-4 mt-2">
                                <button class="btn btn-outline-danger rounded-pill" style=" width: 59px; height: 59px;" @click="AddNum('-')" ><i class='bx bx-arrow-back'></i></button>
                            </div>


                        </div>
                  </div>
                  
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">ປິດ</button>
                  <button type="button" class="btn btn-primary rounded-pill" :disabled="!(CashAmount>=TotalAmount)" @click="ConfirmPay()">ຢືນຢັນຊຳລະເງີນ</button>
                </div>
              </div>
            </div>
          </div>

</div>
</template>

<script>
import axios from 'axios';


import { useStore } from '../Store/auth'

export default {

    setup(){
        const store = useStore();
        return { store }
    },
    name: 'WebAppLrvPos',

    data() {
        return {
            url: window.location.origin,
            Sort: 'desc',
            PerPage: '30',
            Search: '',
            StoreData: [],
            ListOrder: [],
            CashAmount:'',
            customer_name:'',
            customer_tel:'',
        };
    },

    mounted() {
        
    },

    computed:{
        TotalAmount(){
            let caculate = this.ListOrder.reduce((num, item)=> parseInt(num) + (parseInt(item.order_amount) * parseInt(item.price_sell)),0)
            return caculate
        }
    },

    methods: {

        AddNum(num){
            if (num == '-') {
                this.CashAmount = this.CashAmount.slice(0,-1);
            } else {
                this.CashAmount = this.CashAmount + num;
            }
        },

        ShowModal(){
            $('#confrim_pay_modal').modal('show')
        },

        ConfirmPay(){
            axios.post('api/transection/add',{
                customer_name: this.customer_name,
                customer_tel: this.customer_tel,
                listorder: this.ListOrder,
                acc_type: 'income'

            }, { headers:{ Authorization:"Bearer" + this.store.get_token}}).then((res)=>{

                if (res.data.success) {
                  
                    $('#confrim_pay_modal').modal('hide')

                    this.customer_name = ''
                    this.customer_tel = ''
                    this.ListOrder = []
                    this.CashAmount = ''
                    this.GetStore()


                  this.$swal({ 
                      position: 'top-center',
                      toast: true,
                      title: res.data.message,
                      icon: "success", 
                      showConfirmButton: false,
                      timer: 3600
                  });


                } else{
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
        },

        formatPrice(value) {
        let val = (value / 1).toFixed(2).replace(",",".");
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
      },

        AddProduct(id){
            // console.log(id);
            let item = this.StoreData.data.find((i) =>i.id == id)

            let list_order_item = this.ListOrder.find((i)=>i.id == id)

            if (list_order_item) {
                list_order_item.order_amount++;
            } else {
                // console.log(item);
                    this.ListOrder.push({
                        id: item.id,
                        name: item.name,
                        order_amount: 1,
                        price_sell: item.price_sell
                    })
            }

            
        },

        RemoveProduct(id){
            let item = this.ListOrder.find((i)=> i.id == id)
            if (item) {
                item.order_amount--;

                if (item.order_amount<1) {
                    this.ListOrder.splice(this.ListOrder.map((i)=>id).indexOf(id),1)
                }
            }
        },

        DeleteProduct(id){
            this.ListOrder.splice(this.ListOrder.map((i)=>id).indexOf(id),1)
        },
        
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

<style scoped>

/* .ps {
  height: 400px;
} */


.img-pos{
    object-fit: cover;
    width: 100%;
    height: 110px;
    object-position: center;
}

.number-list{
    position: absolute;
    background: red;
    color: white;
    padding: 4px;
    right: 0px;
    border-radius: 0px 10px 0px 10px;
}

</style>