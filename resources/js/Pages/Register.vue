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
                      <label for="name" class="form-label">ຊື່ :</label>
                      <input type="text" v-model="user_name" class="form-control rounded-pill" id="name" placeholder="ຊື່ ...">
                    </div>

                    <div class="mb-3">
                      <label for="last_name" class="form-label">ນາມສະກຸນ :</label>
                      <input type="text" v-model="last_name" class="form-control rounded-pill" id="last_name" placeholder="ນາມສະກຸນ ...">
                    </div>

                    <div class="mb-3">
                      <label for="gender" class="form-label">ເພດ :</label>
                      <input type="text" v-model="gender" class="form-control rounded-pill" id="gender" placeholder="ເພດ ...">
                    </div>
                    
                    <div class="mb-3">
                      <label for="email" class="form-label">ອີເມວ :</label>
                      <input type="text" v-model="email" class="form-control rounded-pill" id="email" placeholder="ອີເມວ ... ">
                    </div>
                    <div class="mb-3 form-password-toggle">
                      <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">ລະຫັດຜ່ານ :</label>
                        
                      </div>
                      <div class="input-group input-group-merge">
                        <input type="password" id="password" v-model="password" class="form-control" placeholder="• • • • • • • •" >
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                      </div>
                    </div>
                    <div class="mb-3 form-password-toggle">
                      <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">ຢືນຢັນລະຫັດຜ່ານ :</label>
                        
                      </div>
                      <div class="input-group input-group-merge rounded-pill">
                        <input type="password" id="password2" v-model="password2" class="form-control" placeholder="• • • • • • • •">
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                      </div>
                    </div>

                    <div class="alert alert-danger" role="alert" v-if="text_error">
                        {{ text_error }}
                    </div>
                    
                    <div class="mb-3">
                      <button class="btn btn-primary d-grid w-100 rounded-pill" @click="Register()">ລົງທະບຽນ</button>
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
            last_name : '',
            gender : '',
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
                if (this.user_name == '' || this.last_name == '' || this.gender == '' || this.email == '' || this.password == '' || this.password2 == '') {
                    this.text_error = 'ກະລຸນາປ້ອນຂໍ້ມູນໃຫ້ຄົບຖ້ວນ!';
                }else{
                    if (this.password == this.password2) {
                        this.text_error = ''

                        axios.post('api/register',{
                            from_user_name: this.user_name,
                            from_last_name: this.last_name,
                            from_gender: this.gender,
                            from_email: this.email,
                            from_password: this.password,
                        }).then((res)=>{

                          if (res.data.success) {
                            this.text_error = '';
                            this.user_name = '';
                            this.last_name = '';
                            this.email = '';
                            this.password = '';
                            this.password2 = '';
                            this.$router.push('/login');
                          }else{
                            this.text_error = res.data.message;
                          }
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