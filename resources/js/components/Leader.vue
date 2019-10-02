<template>
    <div class="container">
      <!-- start content header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2" style="">
          <div class="col-sm-6">
            <h1>Data Leader</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Leader</li>
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
                      <th>ID</th>
                      <th>Tipe</th>
                      <th>Leader</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="leader in leaders" :key="leader.id">
                      <td> {{ leader.id_leader }}</td>
                      <td>{{ leader.type }}</td>
                      <td>{{ leader.name }}</td>
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
            <form @submit.prevent="editmode ? updateLeader() : createLeader()">
            <div class="modal-body">
                    <div class="form-group">
                    <label>Tipe</label>
                    <input v-model="form.type" type="text" name="type" placeholder="Contoh : SPV Sales, BM"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                    <has-error :form="form" field="type"></has-error>
                    </div>
            <div class="form-group">
                    <label>Nama</label>
                        <select name="id_employee" id="id_employee" v-model="form.id_employee" class="form-control" :class="{'is-invalid': form.errors.has('id_employee')}">
                            <option value="">Pilih Karyawan</option>
                           <option v-for="user in users" :value="user.id" :key="user.value"> 
                               {{ user.name }}
                               </option>
                        </select>
                        <has-error :form="form" field="id_employee"></has-error>
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
                leaders : {},
                users   : {},
                form: new Form({
                        id_leader   : '',
                        type        : '',
                        id_employee : '',
                })
            }
        },
        methods : {
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
            loadUsers(){
                this.$Progress.start();
                axios.get('api/user').then(response => this.users = response.data)
                this.$Progress.finish();
            },
            editModal(leader){
              this.editmode = true;
              this.form.reset();
              $('#addModal').modal('show');
              this.form.fill(leader);
            },
            loadleaders(){
                this.$Progress.start();
                axios.get('api/leader').then(response => this.leaders = response.data)
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
                this.form.post('api/leader')
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
            this.loadUsers();
            this.loadleaders();
            Fire.$on('afterCreate',() => {
              this.loadleaders();
            });
            // setInterval(() => this.loadleaders(),3000);
        }
    }
</script>
