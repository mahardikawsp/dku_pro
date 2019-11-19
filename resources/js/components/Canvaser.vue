<template>
    <div class="container">
      <!-- start content header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2" style="">
          <div class="col-sm-6">
            <h1>Data Canvaser</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Canvaser</li>
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
                      <th>ID Canvaser</th>
                      <th>Aktif</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="canvaser in canvasers" :key="canvaser.id">
                      <td> {{ canvaser.id_canvasser }}</td>
                      <td>{{ canvaser.aktif }}</td>
                      <td>
                          <a href="#" @click="editModal(canvaser)">
                              <span class="badge bg-primary">
                                Edit
                                 <i class="fas fa-edit"> </i>
                              </span>
                          </a>
                          <a href="#" @click="deleteCanvaser(canvaser.id_canvas)">
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
            <form @submit.prevent="editmode ? updateCanvaser() : createCanvaser()">
            <div class="modal-body">
                    <div class="form-group">
                    <label>ID Canvaser</label>
                    <input v-model="form.id_canvasser" type="text" name="id_canvasser" placeholder="Contoh : BWG-"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('id_canvasser') }">
                    <has-error :form="form" field="id_canvasser"></has-error>
                    </div>
            <div class="form-group ">
                    <label>Aktif</label>
                        <select name="aktif" id="aktif" v-model="form.aktif" class="form-control" :class="{'is-invalid': form.errors.has('aktif')}" required>
                            <option value="">Aktif ?</option>
                            <option value="ya">Ya</option>
                            <option value="tidak">Tidak</option>
                        </select>
                        <has-error :form="form" field="aktif"></has-error>
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
                canvasers : {},
                form: new Form({
                        id_canvas      : '',
                        id_canvasser   : '',
                        aktif          : '',
                })
            }
        },
        methods : {
            updateCanvaser(){
              this.$Progress.start();
              this.form.put('api/canvaser/'+this.form.id_canvas)
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
            editModal(canvaser){
              this.editmode = true;
              this.form.reset();
              $('#addModal').modal('show');
              this.form.fill(canvaser);
            },
            loadCanvasers(){
                this.$Progress.start();
                axios.get('api/canvaser').then(response => this.canvasers = response.data)
                this.$Progress.finish();
            },
            deleteCanvaser(id){
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
                  this.form.delete('api/canvaser/'+id)
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
            createCanvaser(){ //IF USER KLIK BUTTON
                this.$Progress.start()
                this.form.post('api/canvaser')
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
            this.loadCanvasers();
            Fire.$on('afterCreate',() => {
              this.loadCanvasers();
            });
            // setInterval(() => this.loadleaders(),3000);
        }
    }
</script>