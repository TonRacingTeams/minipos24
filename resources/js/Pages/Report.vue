<template>
    <div class="row">

        <div class="col-md-8">
            <div class="card">
  <h5 class="card-header">ກາຟລາຍງານ</h5>
  <div class="card-body">
    <div class="table-responsive text-nowrap">

        <div class="d-flex justify-content-end mb-2">
            
            <div class="d-flex mb-2">

                <!-- {{ month_type }} -->
                <div class="btn-group me-3 " role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary rounded-pill rounded-end" @click="month_type='m'"> <i class='bx bx-calendar me-2' style='color:white' v-if="month_type == 'm'" ></i> ເດືອນ</button>
                    
                    <button type="button" class="btn btn-primary rounded-pill rounded-start" @click="month_type='y'"> <i class='bx bx-calendar me-2' style='color:white' v-if="month_type == 'y'"  ></i> ປີ</button>
              </div>
              <input type="date" class="form-control rounded-pill" v-model="dmy">
            </div>
            
        </div>
            <LineChart :chartData="testdata" />
            <DoughnutChart :chartData="testdata" />
    </div>
  </div>
</div>
</div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                ແຈ້ງຈຳນວນ
            </div>
            </div>
        </div>

    </div>
</template>

<script>
import { useStore } from '../Store/auth'
import { LineChart, DoughnutChart }from 'vue-chart-3'

import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);


export default {
    name: 'WebAppLrvReport',

    setup(){
        const store = useStore();
        return {store}
    },

    data() {
        return {
            
            month_type:'m',
            dmy:new Date().toISOString().slice(0,10),
            testdata:{
                    labels: ['Paris', 'Nîmes', 'Toulon', 'Perpignan', 'Autre'],
                    datasets: [
                        {
                        data: [30, 40, 60, 70, 5],
                        backgroundColor: ['#77CEFF', '#0079AF', '#123E6B', '#97B0C4', '#A5C8ED'],
                        },
                    ],
                    }
        };
    },
    components:{
        LineChart, DoughnutChart
    },

    mounted() {
        
    },

    methods: {
        
    },
};
</script>

<style lang="scss" scoped>

</style>