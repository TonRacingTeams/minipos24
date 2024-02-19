<template>
<di class="row">
    <div class="col-md-8">
        <div class="card mb-4">
                <div class="card-body">
                    <input type="text" class="form-control rounded-pill" placeholder="ຄົ້ນຫາ...">
                </div>   
        </div>

    <perfect-scrollbar>
        <div class="row" style="overflow: auto; height: 59vh;">
            <div class="col-md-4" v-for="item in StoreData.data" :key="item">
                <div class="card mb-3 cursor-pointer">
                    <span class="number-list">{{ item.id }}</span>
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
    </perfect-scrollbar>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body p-0">
                <div class="p-3">
                    
                    <label for="customer_name">ຊື່ລູກຄ້າ: </label>
                    <input type="text" class="form-control rounded-pill" placeholder="........">
                    <label for="customer_tel">ເບີໂທ: </label>
                    <input type="text" class="form-control rounded-pill" placeholder="........">
                </div>
                    <hr>
                    
                    <div class="p-3">
                        <div class="d-flex justify-content-between fs-4 fw-bold text-primary">
                            <span>ລວມຍອດເງີນ:</span>
                            <span>630,000 ກີບ</span>
                        </div>
                        <button class="btn btn-outline-primary fw-blod w-100 fs-5">ຊຳລະເງີນ</button>
                    </div>

                    <div class="table-responsive text-nowrap">
    <table class="table border">
      <thead>
        <tr>
          <th>Project</th>
          <th>Client</th>
          <th>Users</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><i class="bx bxl-angular bx-sm text-danger me-3"></i> <span class="fw-medium">Angular Project</span></td>
          <td>Albert Cook</td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template-free/demo/assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Sophia Wilkerson" data-bs-original-title="Sophia Wilkerson">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template-free/demo/assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Christina Parker" data-bs-original-title="Christina Parker">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template-free/demo/assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
              </li>
            </ul>
          </td>
          <td><span class="badge bg-label-primary me-1">Active</span></td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td><i class="bx bxl-react bx-sm text-info me-3"></i> <span class="fw-medium">React Project</span></td>
          <td>Barry Hunter</td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template-free/demo/assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Sophia Wilkerson" data-bs-original-title="Sophia Wilkerson">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template-free/demo/assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Christina Parker" data-bs-original-title="Christina Parker">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template-free/demo/assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
              </li>
            </ul>
          </td>
          <td><span class="badge bg-label-success me-1">Completed</span></td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td><i class="bx bxl-vuejs bx-sm text-success me-3"></i> <span class="fw-medium">VueJs Project</span></td>
          <td>Trevor Baker</td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template-free/demo/assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Sophia Wilkerson" data-bs-original-title="Sophia Wilkerson">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template-free/demo/assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Christina Parker" data-bs-original-title="Christina Parker">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template-free/demo/assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
              </li>
            </ul>
          </td>
          <td><span class="badge bg-label-info me-1">Scheduled</span></td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td><i class="bx bxl-bootstrap bx-sm text-primary me-3"></i> <span class="fw-medium">Bootstrap Project</span></td>
          <td>Jerry Milton</td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Lilian Fuller" data-bs-original-title="Lilian Fuller">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template-free/demo/assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Sophia Wilkerson" data-bs-original-title="Sophia Wilkerson">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template-free/demo/assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
              </li>
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" aria-label="Christina Parker" data-bs-original-title="Christina Parker">
                <img src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template-free/demo/assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
              </li>
            </ul>
          </td>
          <td><span class="badge bg-label-warning me-1">Pending</span></td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
      <tfoot class="table-border-bottom-0">
        <tr>
          <th class="rounded-start-bottom">Project</th>
          <th>Client</th>
          <th>Users</th>
          <th>Status</th>
          <th class="rounded-end-bottom">Actions</th>
        </tr>
      </tfoot>
    </table>
  </div>

            </div>
        </div>
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
            url: window.location.origin,
            Sort: 'desc',
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