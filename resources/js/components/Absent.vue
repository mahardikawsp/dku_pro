<template>
    <div class="container">
        <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard Absensi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Absensi</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          
          
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info" style="background-color: #343a40 !important;">
              <div class="inner">
                <h3><sup style="font-size: 20px"></sup></h3>
                <select v-model="selectedValue1" class="form-control" name="filter" id="filter">
                <option value="">Filter Berdasarkan</option>
                <option value="A">Filter Tanggal</option>
                <option value="B">Filter Bulan</option>
                <option value="C">Filter Tahun</option>
                <option value="D">Filter Lokasi</option>
                <option value="E">Filter Status</option>
                </select>
                <p></p>
                <input v-model="form['date']" v-show="shouldDisplay('A')" type="date" name="date" class="form-control">
                <select v-model="form['month']" v-show="shouldDisplay('B')" class="form-control" name="month" id="filter">
                <option value="">Filter Berdasar Bulan</option>
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
                <select v-model="form['year']" v-show="shouldDisplay('C')" class="form-control" name="year" id="filter">
                <option value="">Filter Berdasar Tahun</option>
                <option value="1">2019</option>
                <option value="2">2020</option>
                </select>
                <select v-model="form['location']" v-show="shouldDisplay('D')" class="form-control" name="location" id="filter">
                <option value="">Filter Berdasar Lokasi</option>
                 <option v-for="location in locations" :value="location.id_location" :key="location.value"> 
                               {{ location.location }}
                               </option>
                </select>
               <p></p>
              <select v-model="form['userpoast']" v-on:click ="fuser" class="form-control" name="id_user" id="filter">
                <option value="">Filter User</option>
                <option v-for="user in users" :value="user.id" :key="user.value"> 
                               {{ user.name }}
                               </option>
              </select>
              </div>
              
              
              <a v-on:click = "fcomplete" href="#" class="small-box-footer">Tampilkan Data <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info" style="background-color: #343a40 !important;">
              <div class="inner">
                <h3><sup style="font-size: 20px"></sup></h3>
                <select v-model="selectedValue11" class="form-control" name="filter" id="filter">
                <option value="">Filter Berdasarkan</option>
                <option value="A1">Filter Tanggal</option>
                <option value="B1">Filter Bulan</option>
                <option value="D1">Filter Lokasi</option>
                </select>
                <p></p>
                <input v-model="tanggal1" v-show="shouldDisplayy('A1')" type="date" name="date" class="form-control">
                <select v-model="bulan1" v-show="shouldDisplayy('B1')" class="form-control" name="month1" id="filter">
                <option value="">Filter Berdasar Bulan</option>
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
                <br v-show="shouldDisplayy('B1')">
                <select v-model="tahun1" v-show="shouldDisplayy('B1')" class="form-control" name="year1" id="filter">
                <option value="">Filter Berdasar Tahun</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                </select>
                <select v-model="location1" v-show="shouldDisplayy('D1')" class="form-control" name="location1" id="filter">
                <option value="">Filter Berdasar Lokasi</option>
                 <option v-for="location in locations" :value="location.id_location" :key="location.value"> 
                               {{ location.location }}
                               </option>
                </select>
              </div>
              <a v-on:click = "fekspor" href="#" class="small-box-footer">Ekspor Data <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <div class="card" style="border: 1px solid #d6d6d6;">
              <div class="card-header">
                <!-- <h3 class="card-title">Data Absensi</h3> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Tanggal</th>
                      <th>Karyawan</th>
                      <th>Lokasi</th>
                      <th>Absen Masuk</th>
                      <th>Absen Pulang</th>
                      <!-- <th>Keterangan</th>
                      <th>Perfomance</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(absent, index) in absents.data" :key="absent.id">
                      <td> {{ index+1 }} </td>
                      <td> {{ absent.time_in | tgl_indo }}</td>
                      <td> {{ absent.name }} </td>
                      <td>{{ absent.location }}</td>
                      <td> {{ absent.time_in | jam}} | {{ absent.absen_masuk }}</td>
                      <td> {{ absent.time_out | jam}} | {{ absent.absen_keluar }} </td>
                      <!-- <td><span class="badge bg-success"></span></td>
                      <td><div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                        </div>
                     <span class="badge bg-info">100%</span>
                     </td> -->
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <pagination :data="absents" @pagination-change-page="getResults"></pagination>
              </div>
              <!-- /.card-body -->
            </div>
      </div><!-- /.container-fluid -->
    </section>

    </div>
</template>

<script>
    export default {
        data(){
            return {
                absents : {},
                users : {},
                locations : {},
                selectedValue1: '',
                selectedValue11: '',
                form : {},
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
              console.info(this.form)
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
