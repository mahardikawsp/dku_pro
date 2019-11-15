<template>
    <div class="container">
    <!-- start content header -->
    <section class="content-header" v-if="$gate.isAdmin()">
      <div class="container-fluid">
        <div class="row mb-2" style="">
          <div class="col-sm-6">
            <h1>Data Ijin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Ijin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- end content -->
        <div class="row" >
            <div class="col-md-12" v-if="$gate.isAdmin()">
                <div class="card">
              <div class="card-header">
                <button class="btn btn-success" @click="newModal" >Tambah Baru  <i class="fas fa-user-plus fa-fw"></i></button>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Karyawan</th>
                      <th>Nama Leader</th>
                      <th>Keterangan</th>
                      <th>Status</th>
                      <th>Tanggal</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="reason in reasons.data" :key="reason.id">
                      <td>{{ reason.nama_orang }}</td>
                      <td>{{ reason.nama_leader }}</td>
                      <td>{{ reason.keterangan }}</td>
                      <td>{{ reason.acc | acc }} </td>
                      <td>{{ reason.date_created | tanggal }}</td>
                      <td>
                          <a href="#" @click="editModal(reason)">
                              <span class="badge bg-primary">
                          Edit  <i class="fa fa-edit"> </i>
                              </span>
                          </a>
                          <a href="#" @click="deleteReason(reason.id_user)">
                              <span class="badge bg-danger">
                             Hapus  <i class="fa fa-trash"> </i>
                              </span>
                          </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="card-footer">
                <pagination :data="reasons" @pagination-change-page="getResults"> 
                    <span slot="prev-nav"> Previous</span>
	                  <span slot="next-nav">Next</span> </pagination>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
        <!--start not found-->
          <div v-if="!$gate.isAdmin()">
            <not-found></not-found>
          </div>
          <!--end not found -->
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
            <form @submit.prevent="editmode ? updateReason() : createReason()">
            <div class="modal-body">
                    <div class="form-group">
                    <label>Karyawan</label>
                    <select name="id_user" required="" id="id_User" v-model="form.id_user" class="form-control" :class="{'is-invalid': form.errors.has('id_user')}">
                            <option value="">Pilih User</option>
                           <option v-for="user in users" :value="user.id" :key="user.value"> 
                               {{ user.name }}
                               </option>
                        </select>
                    <has-error :form="form" field="id_user"></has-error>
                    </div>

                    <div class="form-group">
                    <label>Keterangan</label>
                    <input v-model="form.keterangan" required="" type="text" name="keterangan" placeholder="Keterangan"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('keterangan') }">
                    <has-error :form="form" field="keterangan"></has-error>
                    </div>

                    <div class="form-group">
                    <label>Tanggal</label>
                    <input v-model="form.date_created" required="" type="text" name="date_created" placeholder="Keterangan"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('date_created') }">
                    <has-error :form="form" field="date_created"></has-error>
                    </div>

                    <div class="form-group">
                    <label>Status</label>
                        <select name="acc" id="acc" v-model="form.acc" class="form-control" :class="{'is-invalid': form.errors.has('acc')}">
                            <option value="">Status</option>
                            <option value="0">Menunggu Persetujuan</option>
                            <option value="1">Terima</option>
                            <option value="2">Tolak</option>
                        </select>
                        <has-error :form="form" field="acc"></has-error>
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
                editmode  : false,
                reasons   : {},
                users     : {},
                form: new Form({
                        id_reason      : '',
                        id_user        : '',
                        keterangan     : '',
                        acc            : '',
                        date_created   : '',
                })
            }
        },
        methods : {
          getResults(page = 1){
              axios.get('api/user?page=' +page)
              .then(response => {
                this.users = response.data;
              });
          },
            updateReason(){
              this.$Progress.start();
              this.form.put('api/ijin/'+this.form.id_reason)
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
            editModal(reason){
              this.editmode = true;
              this.form.reset();
              $('#addModal').modal('show');
              this.form.fill(reason);
            },
            loadReason(){
              if(this.$gate.isAdmin()){
                this.$Progress.start();
                axios.get("api/ijin").then(({data}) => (this.reasons = data));
                this.$Progress.finish();
              }
            },
            loadUsers(){
                this.$Progress.start();
                axios.get('api/useronly').then(response => this.users = response.data)
                this.$Progress.finish();
            },
            deleteReason(id){
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
                  this.form.delete('api/ijin/'+id)
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
            createReason(){ //IF USER KLIK BUTTON
                this.$Progress.start();
                this.form.post('api/ijin');
                Fire.$emit('afterCreate'); //refresh if any change from server
                $('#addModal').modal('hide');
                toast.fire({
                     type: 'success',
                     title: 'Data Berhasil Ditambahkan'
                })
                this.$Progress.finish();
            }
        },
        created() {
          Fire.$on('searching',() => {
            let query = this.$parent.search; //take root from app.js search
            axios.get('api/findUserIjin?q=' + query)
            .then((data) => {
              this.reasons = data.data;
            })
            .catch(() => {

            })
          })
            this.loadReason();
            this.loadUsers();
            Fire.$on('afterCreate',() => {
              this.loadReason();
            });
            // setInterval(() => this.loadPosition(),3000);
            // setInterval(() => this.loadLocation(),3000);
        }
    }
</script>
