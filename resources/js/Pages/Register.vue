<template>
        <div class="d-flex justify-content-center">
        
    
        <div class="authentication-wrapper authentication-basic container-p-y col-md-4">
            <div class="authentication-inner">
              <!-- Register -->
              <div class="card">
                <div class="card-body">
                  
                  <h4 class="mb-2-center">ລົງທະບຽນ 👋</h4>
                  <p class="mb-4">ກະລຸນາປ້ອນຂໍ້ມູນຂອງທ່ານ.</p>
        
                  
                    <div class="mb-3">
                      <label for="email" class="form-label">ຊື່ຜູ້ໃຊ້ :</label>
                      <input type="text" v-model="user_name" class="form-control" id="email" placeholder="ຊື່ຜູ້ໃຊ້ຂອງທ່ານ">
                    </div>
                    
                    <div class="mb-3">
                      <label for="email" class="form-label">ອີເມວ :</label>
                      <input type="text" v-model="email" class="form-control" id="email" placeholder="ອີເມວຂອງທ່ານ">
                    </div>
                    <div class="mb-3 form-password-toggle">
                      <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">ລະຫັດຜ່ານ :</label>
                        
                      </div>
                      <div class="input-group input-group-merge">
                        <input type="password" id="password" v-model="password" class="form-control" placeholder="········" >
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                      </div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                      <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">ຢືນຢັນລະຫັດຜ່ານ :</label>
                        
                      </div>
                      <div class="input-group input-group-merge">
                        <input type="password" id="password" v-model="password2" class="form-control" placeholder="········">
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                      </div>
                    </div>

                    <div class="alert alert-danger" role="alert" v-if="text_error">
                        {{ text_error }}
                    </div>
                    
                    <div class="mb-3">
                      <button class="btn btn-primary d-grid w-100" @click="Register()">ລົງທະບຽນ</button>
                    </div>
                  
        
                  <p class="text-center">
                    <span>ບໍ່ມີບັນຊີຜູ້ໃຊ້?</span>
                    <router-link to="/login">
                      <span> ເຂົ້າໃຊ້ລະບົບ</span>
                    </router-link>
                  </p>
                </div>
              </div>
            </div>
            <!-- /Register -->
          </div>
        </div>
</template>

<script>

import axios from 'axios'

export default {
    name: 'WebAppLrvRegister',

    data() {
        return {
            user_name : '',
            email : '',
            password : '',
            password2 : '',
            text_error : ''
        };
    },

    mounted() {
        
    },

    methods: {
        Register(){
                if (this.user_name == '' || this.email == '' || this.password == '' || this.password2 == '') {
                    this.text_error = 'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບຖ້ວນ!'
                }else{
                    if (this.password == this.password2) {
                        this.text_error = '';

                        axios.post('api/register',{
                            from_user_name: this.user_name,
                            from_email: this.email,
                            from_password: this.password,
                        }).then((res)=>{
                            console.log(res);
                        }).catch((error)=>{
                            console.log(error);
                        })


                    }else{
                        this.text_error = 'ລະຫັດຜ່ານບໍ່ກົງກັນ!!';
                    }
                }
        }
    },
};
</script>

<style lang="scss" scoped>

</style>