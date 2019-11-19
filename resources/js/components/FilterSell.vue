<style>
 tbody td {
     border : 1px solid #ddd;
 }
 tbody th {
     border : 1px solid #ddd;
 }
</style>
<template>
    <div class="container">
      <!-- start content header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2" style="">
          <div class="col-sm-6">
            <h1>Data Resume </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Resume</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- end content -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a href="#timeline" data-toggle="tab" class="nav-link">Resume SF</a></li>
                            <li class="nav-item"><a href="#settings" data-toggle="tab" class="nav-link">Resume TDC</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div id="timeline" class="tab-pane">
                                <div class="col-lg-6 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info" style="background-color: #343a40 !important;">
                                    <div class="inner">
                                        <h3><sup style="font-size: 20px"></sup></h3>
                                        <select v-model="form['location']" class="form-control" name="location" id="filter">
                                            <option value="" selected>Pilih TDC</option>
                                            <option v-for="location in locations" :value="location.id_location" :key="location.value"> 
                                                        {{ location.location }}
                                                        </option>
                                        </select>
                                        <p></p>
                                        <select v-model="selectedValue1" class="form-control" name="filter" id="filter">
                                            <option value="">Filter Report</option>
                                            <option value="daily">Report Daily</option>
                                            <option value="weekly">Report Weekly</option>
                                            <option value="monthly">Report Monthly</option>
                                            <option value="yearly">Report Yearly</option>
                                        </select>
                                        <p></p>
                                        <input v-model="tanggal" v-show="shouldDisplay('daily')" type="date" name="date" class="form-control">
                                        <p></p>
                                        <select v-model="form['week']" v-show="shouldDisplay('weekly')" class="form-control" name="week" id="filter">
                                            <option value="" selected>Pilih Minggu Ke</option>
                                            <option value="m1">Minggu 1</option>
                                            <option value="m2">Minggu 2</option>
                                            <option value="m3">Minggu 2</option>
                                            <option value="m4">Minggu 2</option>
                                        </select>
                                        <p></p>
                                        <select v-model="form['month']" v-show="shouldDisplay('monthly')" class="form-control" id="month" name="month">
                                            <option value="" selected>Filter Berdasar Bulan</option>
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                                        </select>
                                        <p></p>
                                        <select v-model="form['year']" class="form-control" name="year" id="filter">
                                            <option value="" selected>Filter Berdasar Tahun</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                        </select>
                                        <p></p>
                                        <select v-model="form['tipe']" class="form-control" name="tipe" id="filter">
                                            <option value="" selected>Pilih Tipe</option>
                                            <option value="mkios">SELLTHROUGH MKIOS</option>
                                            <option value="bulk">SELLTHROUGH BULK</option>
                                        </select>
                                    </div>
                                    <a v-on:click = "fcomplete" href="#" class="small-box-footer">Tampilkan Data <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>

                                <div class="card" style="border: 1px solid #d6d6d6;">
                                    <div class="card-header">
                                        <!-- <h3 class="card-title">Data Absensi</h3> -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body p-0">
                                        <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                            <th>Nama SF</th>
                                            <th>Target</th>
                                            <th>WEEK 1</th>
                                            <th>WEEK 2</th>
                                            <th>WEEK 3</th>
                                            <th>WEEK 4</th>
                                            <th>WEEK 5</th>	
                                            <th>Actual Mkios</th>	
                                            <th>% Ach Mkios </th>	
                                            <th>Outlet Aktif</th>
                                            <th>% Outlet Aktif</th>	
                                            <th>GAP</th>

                                            <!-- <th>Keterangan</th>
                                            <th>Perfomance</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="absent in absents.data" :key="absent.id">
                                            <td> Mahardika </td>
                                            <td> 100.000 </td>
                                            <td> 100.000</td>
                                            <td> 100.000 </td>
                                            <td> 100.000</td>
                                            <td> 100.000</td>
                                            <td> 100.000 </td>
                                            <td> 100.000 </td>
                                            <td> 100.000 </td>
                                            <td> 100.000 </td>
                                            <td> 100.000 </td>
                                            <td> 100.000 </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="settings" class="tab-pane active">
                                
                            </div>
                        </div> <!-- end tab content-->

                     </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                absents : {},
                users : {},
                locations : {},
                sell    : {},
                selectedValue1: '',
                selectedValue11: '',
                form : {},
                date : '',
                year : '',
                month : '',
                userpoast : '',
                location : '',
                tanggal1 : '',
                bulan1 : '',
                tahun1 : '',
                location1 : '',
            }
        },
        methods : {
          getResults(page = 1){
              axios.get('api/absent?page=' +page)
              .then(response => {
                this.absents = response.data;
              });
          },
            shouldDisplay: function (value) {
                return this.selectedValue1 === value;
            },
            shouldDisplayy: function (value) {
                return this.selectedValue11 === value;
            },
            loadLocation(){
                axios.get('api/location').then(response => this.locations = response.data)
            },
            loadAbsents(){
                this.$Progress.start();
                axios.get('api/absent').then(response => this.absents = response.data)
                this.$Progress.finish();
            },
            loadUsers(){
                this.$Progress.start();
                axios.get('api/useronly').then(response => this.users = response.data)
                this.$Progress.finish();
            },
            fuser(){
              let query = event.target.value; //take root from app.js search
              axios.get('api/uabsent?q=' + query)
                .then((data) => {
              this.absents = data.data;
              Fire.$emit('afterCreate');
            })
              .catch(() => {
              })
            },
            flocation(){
             let query = event.target.value; //take root from app.js search
              axios.get('api/uabsent?q=' + query)
                .then((data) => {
              this.absents = data.data;
              Fire.$emit('afterCreate');
            })
              .catch(() => {
              })
            },
            fcomplete(){
              axios.get('api/findOrder?lokasi=' +this.form.location+'&daily='+this.form.daily+'&weekly='+this.form.weekly+'&monthly='+this.form.month+'&year='+this.form.year+'&tipe='+this.form.tipe)
                .then((data) => {
                  this.$Progress.start();
                  this.absents = data.data;
                  Fire.$emit('afterCreate');
                  this.$Progress.finish();
                  this.$data.reset();
                  })
              .catch(() => {
                this.$Progress.fail();
              })
            },
            resetDate(){
             this.$data.reset();
            },
            fekspor(){
              window.open('/api/export?tanggal='+this.tanggal1+'&month='+this.bulan1+'&year='+this.tahun1+'&lokasi='+this.location1);
           }
        },
        created() {
            this.loadUsers();
            this.loadAbsents();
            this.loadLocation();
            // Fire.$on('afterCreate',() => {
            //   this.loadAbsents();
            // });
        }
    }
</script>