<template>
    <div class="container">
      <!-- start content header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2" style="">
          <div class="col-sm-6">
            <h1>Data Jam kerja</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Jam kerja</li>
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
                <button class="btn btn-success" @click="newModal" >Tambah Baru  <i class="fas fa-plus fa-fw"></i></button>
                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Jam Masuk</th>
                      <th>Jam Pulang</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="jamker in jamkers" :key="jamker.id">
                      <td> {{ jamker.id_jamker }}</td>
                      <td>{{ jamker.start }}</td>
                      <td>{{ jamker.end }}</td>
                      <td>
                          <a href="#" @click="editModal(jamker)">
                              <span class="badge bg-primary">
                                Edit
                                 <i class="fas fa-edit"> </i>
                              </span>
                          </a>
                          <a href="#" @click="deleteJamker(jamker.id_jamker)">
                              <span class="badge bg-danger">
                                Hapus <i class="fas fa-trash"></i>
                              </span>
                          </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
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
            <form @submit.prevent="editmode ? updateJamker() : createJamker()">
            <div class="modal-body">
                    <div class="form-group">
                    <label>Jam Masuk</label>
                    <input v-model="form.start" type="text" name="start" placeholder="Contoh : 08:00"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('start') }">
                    <has-error :form="form" field="start"></has-error>
                    </div>
                    <div class="form-group">
                    <label>Jam Pulang</label>
                    <input v-model="form.end" type="text" name="end" placeholder="Contoh : 17:00"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('end') }">
                    <has-error :form="form" field="end"></has-error>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button v-show = "editmode" type="submit" class="btn btn-success">Update </button>
                <button v-show = "!editmode" type="submit" class="btn btn-primary">Simpan</button>
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
                jamkers : {},
                form: new Form({
                        id_jamker   : '',
                        start       : '',
                        end         : '',
                })
            }
        },
        methods : {
            updateJamker(){
              this.$Progress.start();
              this.form.put('api/jamker/'+this.form.id_jamker)
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
            editModal(jamker){
              this.editmode = true;
              this.form.reset();
              $('#addModal').modal('show');
              this.form.fill(jamker);
            },
            loadJamkers(){
                this.$Progress.start();
                axios.get('api/jamker').then(response => this.jamkers = response.data)
                this.$Progress.finish();
            },
            deleteJamker(id){
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
                  this.form.delete('api/jamker/'+id)
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
            createJamker(){ //IF USER KLIK BUTTON
                this.$Progress.start()
                this.form.post('api/jamker')
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
            this.loadJamkers();
            Fire.$on('afterCreate',() => {
              this.loadJamkers();
            });
            // setInterval(() => this.loadleaders(),3000);
        }
    }
</script>