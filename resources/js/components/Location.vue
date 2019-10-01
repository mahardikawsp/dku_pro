<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Lokasi <button class="btn btn-success" data-toggle="modal" data-target="#addModal" >Tambah Baru  <i class="fas fa-user-plus fa-fw"></i></button></h3>
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
                          <a href="">
                              <span class="badge bg-info">
                          <i class="fa fa-pin">Edit </i>
                              </span>
                          </a>
                          <a href="#" @click="deleteLocation(location.id_location)">
                              <span class="badge bg-danger">
                             <i class="fa fa-pin">Hapus</i>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="createLocation">
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
                <button type="submit" class="btn btn-primary">Simpan</button>
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
                locations : {},
                form: new Form({
                        location        : '',
                })
            }
        },
        methods : {
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
