<template>

    <div class="d-flex justify-content-center">
        
    
<div class="authentication-wrapper authentication-basic container-p-y col-md-4">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          
          <h4 class="mb-2-center">ສະບາຍດີ ຍິນດີຕອນຮັບ 👋</h4>
          <p class="mb-4">ກະລຸນາລົງຊື່ເຂົ້າໃຊ້ລະບົບບັນຊີຂອງທ່ານ.</p>

          
            <div class="mb-3">
              <label for="email" class="form-label">ອີເມວ</label>
              <input type="text" class="form-control rounded-pill" v-model="email" id="email" placeholder="ອີເມວ ...">
            </div>
            <div class="mb-3 form-password-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">ລະຫັດຜ່ານ</label>
                <!-- <a href="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template-free/demo/auth/forgot-password-basic">
                  <small>ລືມລະຫັດຜ່ານ?</small>
                </a> -->
              </div>
              <div class="input-group input-group-merge">
                <input type="password" v-model="password" id="password" class="form-control" placeholder="• • • • • • • •">
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            <!-- <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me">
                <label class="form-check-label" for="remember-me">
                  ຈົດຈຳລະຫັດຜ່ານ
                </label>
              </div>
            </div> -->

            <div class="alert alert-danger" role="alert" v-if="check_email_text || check_pass_text">
              {{check_email_text}} {{check_pass_text}}
                    </div>

            
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100 rounded-pill" :disabled="check_from_login" >ເຂົ້າໃຊ້ລະບົບ</button>
            </div>
          

          <p class="text-center">
            <span>ບໍ່ມີບັນຊີຜູ້ໃຊ້?</span>
            <router-link to="/register">
              <span> ລົງທະບຽນ</span>
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
export default {
    name: 'WebAppLrvLogin',

    data() {
        return {
            email: '',
            password: '',
            check_email_text: '',
            check_pass_text: ''
        };
    },

    computed: {
      check_from_login(){
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        //ກວດສອບອີເມວ

        if (this.email) {
          if (!emailRegex.test(this.email)) {
            this.check_email_text = 'ອີເມວຂອງທ່ານບໍ່ຖືກຕ້ອງ';
          }else{
            this.check_email_text = '';
          }
        }

        //ກວດສອບລະຫັດຜ່ານ

        if (this.password) {
          if (this.password.length <8) {
            this.check_pass_text = 'ລະຫັດຜ່າານຕ້ອງ 8 ຕົວຂື້ນໄປ';
          }else{
            this.check_pass_text = '';
          }
        }

        //ກວດສອບແລ້ວປິດປູ່ມ

        if (!emailRegex.test(this.email) || this.password.length <8) {
          return true;
        }else{
          return false;
        }

      }
    },

    mounted() {
        
    },

    methods: {
        
    },
};
</script>

<style lang="scss" scoped>

</style>