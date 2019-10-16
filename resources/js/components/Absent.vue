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
          <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box bg-info" style="background-color: #343a40 !important;">
              <div class="inner">
                <h3><sup style="font-size: 20px"></sup></h3>
                <select class="form-control" name="filter" id="filter">
                <option value="">Filter Tanggal</option>
                <option value="">Filter Bulan</option>
                <option value="">Filter Tahun</option>
                </select>
                <p></p>
                <select class="form-control" name="filter" id="filter">
                <option value="">Filter Lokasi</option>
                <option value="">Filter Bulan</option>
                <option value="">Filter Tahun</option>
              </select>
               <p></p>
              <select class="form-control" name="filter" id="filter">
                <option value="">Filter User</option>
              </select>
              </div>
              
              
              <a href="#" class="small-box-footer">Tampilkan Data <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
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
                      <th>Absen Masuk</th>
                      <th>Absen Pulang</th>
                      <th>Keterangan</th>
                      <th>Perfomance</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(absent, index) in absents.data" :key="absent.id">
                      <td> {{ index+1 }} </td>
                      <td> {{ absent.time_in | tgl_indo }}</td>
                      <td> {{ absent.name }} </td>
                      <td> {{ absent.time_in | jam}}</td>
                      <td> {{ absent.time_out | jam}} </td>
                      <td><span class="badge bg-success">{{ absent.status_masuk }}</span></td>
                      <td><div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                        </div>
                     <span class="badge bg-info">100%</span>
                     </td>
                    </tr>
                  </tbody>
                </table>
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
                absents : {}
            }
        },
        methods : {
            loadAbsents(){
                this.$Progress.start();
                axios.get('api/absent').then(response => this.absents = response.data)
                this.$Progress.finish();
            }
        },
        created() {
            this.loadAbsents();
        }
    }
</script>
