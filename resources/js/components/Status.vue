<template>
    <div class="container">
        <!-- start content header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2" style="">
          <div class="col-sm-6">
            <h1>Data Lokasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Lokasi</li>
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
                      <th>Lokasi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="location in locations" :key="location.id">
                      <td>{{ location.location }}</td>
                      <td>
                          <a href="#" @click="editModal(location)">
                              <span class="badge bg-primary">
                                Edit
                                 <i class="fas fa-edit"> </i>
                              </span>
                          </a>
                          <a href="#" @click="deleteLocation(location.id_location)">
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
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" v-show = "!editmode" id="exampleModalLabel">Tambah Data</h5>
                <h5 class="modal-title" v-show = "editmode" id="exampleModalLabel">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="editmode ? updateLocation() : createLocation()">
            <div class="modal-body">
                    <div class="form-group">
                    <label>Lokasi</label>
                    <input v-model="form.location" type="text" name="location" placeholder="Lokasi"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('location') }">
                    <has-error :form="form" field="location"></has-error>
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
                locations : {},
                form: new Form({
                        id_location     : '',
                        location        : '',
                })
            }
        },
        methods : {
           updateLocation(){
              this.$Progress.start();
              this.form.put('api/location/'+this.form.id_location)
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
            editModal(location){
              this.editmode = true;
              this.form.reset();
              $('#addModal').modal('show');
              this.form.fill(location);
            },
            loadLocations(){
                this.$Progress.start()
                axios.get('api/location').then(response => this.locations = response.data)
                this.$Progress.finish()
            },
            deleteLocation(id){
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
                  this.form.delete('api/location/'+id)
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
            createLocation(){ //IF USER KLIK BUTTON
                this.$Progress.start()
                this.form.post('api/location');
                Fire.$emit('afterCreate'); //refresh if any change from server
                $('#addModal').modal('hide');
                toast.fire({
                     type: 'success',
                     title: 'Data Berhasil Ditambahkan'
                })
                this.$Progress.finish()
            }
        },
        created() {
            this.loadLocations();
            Fire.$on('afterCreate',() => {
              this.loadLocations();
            });
        }
    }
</script>
