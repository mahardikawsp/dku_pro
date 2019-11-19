<template>
    <div class="container">
    <!-- start content header -->
    <section class="content-header" v-if="$gate.isAdmin()">
      <div class="container-fluid">
        <div class="row mb-2" style="">
          <div class="col-sm-6">
            <h1>Data Karyawan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Karyawan</li>
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
                      <th>ID</th>
                      <th>Nama</th>
                      <th>No HP</th>
                      <th>Jabatan</th>
                      <th>Lokasi</th>
                      <th>Join Date</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(user,index) in users.data" :key="user.id">
                      <td>{{ index+1 }}</td>
                      <td>{{ user.name }}</td>
                      <td>{{ user.no_hp }}</td>
                      <td>{{ user.position }}</td>
                      <td>{{ user.location }}</td>
                      <td>{{ user.created_at | tgl_indo }}</td>
                      <td><span class="tag tag-success">{{ user.tipe | upText }}</span></td>
                      <td>
                          <a href="#" @click="editModal(user)">
                              <span class="badge bg-primary">
                          Edit  <i class="fa fa-edit"> </i>
                              </span>
                          </a>
                          <a href="#" @click="deleteUser(user.id)">
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
                <pagination :data="users" @pagination-change-page="getResults"> 
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" v-show = "!editmode" id="exampleModalLabel">Tambah Data</h5>
                <h5 class="modal-title" v-show = "editmode" id="exampleModalLabel">Update Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="editmode ? updateUser() : createUser()">
            <div class="modal-body">
                    <div class="form row">
                    <div class="form-group col-md-6">
                    <label>Email</label>
                    <input v-model="form.email" required="" type="email" name="email" placeholder="Email"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                    <has-error :form="form" field="email"></has-error>
                    </div>

                    <div class="form-group col-md-6">
                    <label>Nama</label>
                    <input v-model="form.name" required="" type="text" name="name" placeholder="Nama"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                    </div>
                    </div>

                    <div class="form row">
                    <div class="form-group col-md-6">
                    <label>Password</label>
                    <input v-model="form.password" type="password" name="password" placeholder="Password"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                    <has-error :form="form" field="password"></has-error>
                    </div>

                    <div class="form-group col-md-6">
                    <label>Nomor HP</label>
                    <input v-model="form.no_hp" required="" type="text" name="no_hp" placeholder="Nomor HP"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('no_hp') }">
                    <has-error :form="form" field="no_hp"></has-error>
                    </div>
                    </div>

                    <div class="form row">
                    <div class="form-group col-md-6">
                    <label>Lokasi</label>
                        <select name="id_location" required="" id="id_location" v-model="form.id_location" class="form-control" :class="{'is-invalid': form.errors.has('id_location')}">
                            <option value="">Pilih Lokasi</option>
                           <option v-for="location in locations" :value="location.id_location" :key="location.value"> 
                               {{ location.location }}
                               </option>
                        </select>
                        <has-error :form="form" field="id_location"></has-error>
                    </div>

                    <div class="form-group col-md-6">
                    <label>Jabatan</label>
                    <select name="id_position" required="" id="id_position" v-model="form.id_position" class="form-control" :class="{'is-invalid': form.errors.has('id_position')}">
                            <option value="">Pilih Jabatan</option>
                           <option v-for="position in positions" :value="position.id_position" :key="position.value"> 
                               {{ position.position }}
                               </option>
                        </select>
                    <has-error :form="form" field="id_position"></has-error>
                    </div>
                    </div>


                    <div class="form row">
                    <div class="form-group col-md-6">
                    <label>Leader</label>
                    <select name="id_leader" required="" id="id_leader" v-model="form.id_leader" class="form-control" :class="{'is-invalid': form.errors.has('id_leader')}">
                            <option value="">Pilih Leader</option>
                           <option v-for="leader in leaders" :value="leader.id_leader" :key="leader.value"> 
                               {{ leader.name }} || {{ leader.type }}
                               </option>
                        </select>
                    <has-error :form="form" field="id_leader"></has-error>
                    </div>

                    <div class="form-group col-md-6">
                    <label>ID Canvasser</label>
                    <select name="id_canvas" id="id_canvas" v-model="form.id_canvas" class="form-control" :class="{'is-invalid': form.errors.has('id_canvas')}">
                            <option value="">Pilih ID Canvaser</option>
                           <option v-for="canvaser in canvasers" :value="canvaser.id_canvas" :key="canvaser.value"> 
                               {{ canvaser.id_canvasser }} 
                               </option>
                        </select>
                    <has-error :form="form" field="id_canvas"></has-error>
                    </div>    
                    </div>

                    <div class="form row">
                    <div class="form-group col-md-6">
                    <label>Jam Kerja</label>
                        <select name="id_jamker" required="" id="id_jamker" v-model="form.id_jamker" class="form-control" :class="{'is-invalid': form.errors.has('id_jamker')}">
                            <option value="">Pilih Jam Kerja</option>
                           <option v-for="jamker in jamkers" :value="jamker.id_jamker" :key="jamker.value"> 
                               {{ jamker.start }} - {{ jamker.end }}
                               </option>
                        </select>
                        <has-error :form="form" field="id_jamker"></has-error>
                    </div>

                    <div class="form-group col-md-6">
                    <label>Status</label>
                        <select name="tipe" id="tipe" v-model="form.tipe" class="form-control" :class="{'is-invalid': form.errors.has('tipe')}">
                            <option value="">Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                            <option value="resign">Resign</option>
                        </select>
                        <has-error :form="form" field="tipe"></has-error>
                    </div>
                    </div>

                    <div class="form row">
                    <div class="form-group col-md-6">
                    <label>Mulai Bekerja</label>
                    <input v-model="form.created_at" required="" type="text" name="created_at"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('created_at') }">
                    <has-error :form="form" field="created_at"></has-error>
                    </div>

                    <div class="form-group col-md-6" v-if="form.tipe === 'resign'">
                    <label>Tanggal Resign</label>
                    <input v-model="form.resign_at" required="" type="text" name="resign_at"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('resign_at') }">
                    <has-error :form="form" field="resign_at"></has-error>
                    </div>
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
                users     : {},
                positions : {},
                locations : {},
                leaders   : {},
                jamkers   : {},
                canvasers : {},
                form: new Form({
                        id          : '',
                        name        : '',
                        email       : '',
                        password    : '',
                        no_hp       : '',
                        id_location : '',
                        id_position : '',
                        id_jamker   : '',
                        photo       : '',
                        id_leader   : '',
                        tipe        : '',
                        imei        : '',
                        created_at  : '',
                        id_canvas   : ''
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
            updateUser(){
              this.$Progress.start();
              this.form.put('api/user/'+this.form.id)
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
            editModal(position){
              this.editmode = true;
              this.form.reset();
              $('#addModal').modal('show');
              this.form.fill(position);
            },
            loadUsers(){
              if(this.$gate.isAdmin()){
                this.$Progress.start();
                axios.get("api/user").then(({data}) => (this.users = data));
                this.$Progress.finish();
              }
            },
            loadPosition(){
                axios.get('api/position').then(response => this.positions = response.data)
            },
            loadLeader(){
                axios.get('api/leader').then(response => this.leaders = response.data)
            },
            loadLocation(){
                axios.get('api/location').then(response => this.locations = response.data)
            },
            loadJamker(){
                axios.get('api/jamker').then(response => this.jamkers = response.data)
            },
            loadCanvaser(){
                axios.get('api/canvaser').then(response => this.canvasers = response.data)
            },
            deleteUser(id){
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
                  this.form.delete('api/user/'+id)
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
            createUser(){ //IF USER KLIK BUTTON
                this.$Progress.start();
                this.form.post('api/user');
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
              axios.get('api/findUser?q=' + query)
              .then((data) => {
                this.users = data.data;
              })
              .catch(() => {

              })
            })
            this.loadUsers();
            this.loadPosition();
            this.loadLocation();
            this.loadLeader();
            this.loadJamker();
            this.loadCanvaser();
            Fire.$on('afterCreate',() => {
              this.loadUsers();
            });
            // setInterval(() => this.loadPosition(),3000);
            // setInterval(() => this.loadLocation(),3000);
        }
    }
</script>
