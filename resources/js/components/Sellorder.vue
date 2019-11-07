<template>
    <div class="container">
      <!-- start content header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2" style="">
          <div class="col-sm-6">
            <h1>Data Master Outlets</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Master Outlets</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- end content -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
              <div class="card-header">
                <button class="btn btn-success" @click="newModal" >Upload Data  <i class="fas fa-plus fa-fw"></i></button>
                <button class="btn btn-info" @click="editData" >Perbarui Data  <i class="fas fa-plus fa-fw"></i></button>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>RS</th>
                      <th>Nama Outlet</th>
                      <th>Lokasi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="outlet in outlets.data" :key="outlet.id">
                      <td> {{ outlet.rs }}</td>
                      <td>{{ outlet.namaoutlet }}</td>
                      <td>{{ outlet.kotakab }} | {{ outlet.kecamatan }}</td>
                      <td>
                          <a href="#" @click="editModal(leader)">
                              <span class="badge bg-primary">
                                Edit
                                 <i class="fas fa-edit"> </i>
                              </span>
                          </a>
                          <a href="#" @click="deleteLeader(leader.id_leader)">
                              <span class="badge bg-danger">
                                Hapus <i class="fas fa-trash"></i>
                              </span>
                          </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <pagination :data="outlets" @pagination-change-page="getResults"></pagination>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
        </div>
        <!-- start modal -->
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" v-show = "!editmode" id="exampleModalLabel">Tambah Data</h5>
                <h5 class="modal-title" v-show = "editmode" id="exampleModalLabel">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <form @submit.prevent="editmode ? updateLeader() : createLeader()"> -->
            <form action="javascript:void(0)" @submit.prevent="editmode ? uploadEdit() : uploadSubmit()"
                        enctype="multipart/form-data" method="post">
                        <div class="alert alert-success" v-if="message">{{ message[0] }}</div>
                        <div class="modal-body">
                        <div class="form-group">
                            <label for="">Upload file</label>
                            <input type="file" class="form-control" ref="file" name="file" @change="fileUpload($event.target)" required>
                        </div>
                        <div class="progress">
                        <!-- PROGRESS BAR DENGAN VALUE NYA KITA DAPATKAN DARI VARIABLE progressBar -->
                        <div class="progress-bar" role="progressbar" 
                            :style="{width: progressBar + '%'}" 
                            :aria-valuenow="progressBar" 
                            aria-valuemin="0" 
                            aria-valuemax="100"></div>
                    </div>
                    <br>
                        <div class="form-group">
                            <button class="btn btn-danger btn-sm"
                                :disabled="isLoading">{{ isLoading ? 'Loading...':'Upload' }}</button>
                        </div>
                        </div>
                    </form>
            </div>
        </div>
        </div>
        <!-- end modal -->
    </div>
</template>

<script>
    export default {
        data(){
            return {
                editmode : false, //for modal
                outlets : {},
                progressBar: 0,
                message: '',
                isLoading: false,
                file: '',
                files: [],
                form: new Form({
                        id_leader   : '',
                        type        : '',
                        id_employee : '',
                })
            }
        },
        methods : {
            getResults(page = 1){
              axios.get('api/outlet?page=' +page)
              .then(response => {
                this.outlets = response.data;
              });
          },
           fileUpload(event) {
                this.file = event.files[0]
            },
            uploadSubmit() {
                this.isLoading = true
                this.message = ''
                let formData = new FormData();
                formData.append('file', this.file);

                axios.post('/api/usellorder', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                    onUploadProgress: function( progressEvent ) {
                        this.progressBar = parseInt(Math.round((progressEvent.loaded * 100) / progressEvent.total))
                    }.bind(this)
                })
                .then((response) => {
                  $('#addModal').modal('hide');
                  swal.fire(
                      'Upload Sukses!',
                      'Data Berhasil Diupload',
                      'success'
                    )
                    this.$Progress.finish();

                    setTimeout(() => {
                        this.message = response.data
                        this.isLoading = false
                        this.reset()
                    })
                })
            },
            uploadEdit() {
                this.isLoading = true
                this.message = ''
                let formData = new FormData();
                formData.append('file', this.file);

                axios.post('/api/upoutlet', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    },
                    onUploadProgress: function( progressEvent ) {
                        this.progressBar = parseInt(Math.round((progressEvent.loaded * 100) / progressEvent.total))
                    }.bind(this)
                })
                .then((response) => {
                  $('#addModal').modal('hide');
                  swal.fire(
                      'Upload Sukses!',
                      'Data Berhasil Diupload',
                      'success'
                    )
                    this.$Progress.finish();

                    setTimeout(() => {
                        this.message = response.data
                        this.isLoading = false
                        this.reset()
                    })
                })
            },
            reset() {
                this.$refs.file.value = '';
            },
            updateLeader(){
              this.$Progress.start();
              this.form.put('api/leader/'+this.form.id_leader)
              .then(() => {
                  //success
                  $('#addModal').modal('hide');
                  swal.fire(
                      'Perbarui Data!',
                      'Berhasil Diperbarui',
                      'success'
                    )
                    this.$Progress.finish();
                    Fire.$emit('afterCreate');
              })
              .catch(() => {
              this.$Progress.fail();
              });
            },
            newModal(){
              this.editmode = false;
              this.form.reset();
              $('#addModal').modal('show');
            },
            editData(){
              this.editmode = true;
              this.form.reset();
              $('#addModal').modal('show');
            },
            editModal(leader){
              this.editmode = true;
              this.form.reset();
              $('#addModal').modal('show');
              this.form.fill(leader);
            },
            loadOutlet(){
                this.$Progress.start();
                axios.get('api/outlet').then(response => this.outlets = response.data)
                this.$Progress.finish();
            },
            deleteLeader(id){
                swal.fire({
                  title: 'Yakin data dihapus?',
                  text: "Data tidak akan hialng",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Hapus!'
                }).then((result) => {
                  //request server
                  if (result.value) {
                  this.form.delete('api/leader/'+id)
                  .then(() => {
                    swal.fire(
                      'Deleted!',
                      'Berhasil Dihapus',
                      'success'
                    )
                    Fire.$emit('afterCreate');
                  })
                  .catch(() => { 
                    swal.fire(
                      'Gagal!',
                      'Oops Error.',
                      'warning'
                    )
                  })
                  }
                })
            },
            createLeader(){ //IF USER KLIK BUTTON
                this.$Progress.start()
                this.form.post('api/sellthrough')
                .then(() => {
                  Fire.$emit('afterCreate'); //refresh if any change from server
                  $('#addModal').modal('hide');
                  toast.fire({
                     type: 'success',
                     title: 'Data Berhasil Ditambahkan'
                  })
                  this.$Progress.finish()
                })
                .catch(() => {
                })
            }
        },
        created() {
            this.loadOutlet();
            Fire.$on('afterCreate',() => {
              this.loadOutlet();
            });
            // setInterval(() => this.loadleaders(),3000);
        }
    }
</script>