<style>
    .widget-user-header{
        background-position: center center;
        background-size: cover;
        height: 250 px;
    }
</style>
<template>
    <div class="container">
            <!-- start content header -->
            <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
            <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="../../../public/img/user.jpg" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">Nina Mcintire</h3>

                <p class="text-muted text-center">Software Engineer</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">Malibu, California</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">UI Design</span>
                  <span class="tag tag-success">Coding</span>
                  <span class="tag tag-info">Javascript</span>
                  <span class="tag tag-warning">PHP</span>
                  <span class="tag tag-primary">Node.js</span>
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                          <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-comments bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-camera bg-purple"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                          <div class="timeline-body">
                            <img src="http://placehold.it/150x100" alt="...">
                            <img src="http://placehold.it/150x100" alt="...">
                            <img src="http://placehold.it/150x100" alt="...">
                            <img src="http://placehold.it/150x100" alt="...">
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane active" id="settings">
                    <form class="form-horizontal">
                                          <div class="form-group row">
                    <label class="col-sm-2">Email</label>
                    <div class="col-sm-10">
                    <input v-model="form.email" type="email" name="email" placeholder="Email"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                    <has-error :form="form" field="email"></has-error>
                    </div>
	                </div>
                    
                    <div class="form-group row">
                     <label class="col-sm-2">Nama</label>
                     <div class="col-sm-10">
                    <input v-model="form.name" type="text" name="name" placeholder="Nama"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                    <has-error :form="form" field="name"></has-error>
                    </div>
                    </div>

                    <div class="form-group row">
                     <label class="col-sm-2">Password</label>
                     <div class="col-sm-10">
                    <input v-model="form.password" type="password" name="password" placeholder="Kosongkan jika tidak diubah"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                    <has-error :form="form" field="password"></has-error>
                    </div>
                    </div>

                    <div class="form-group row">
                     <label class="col-sm-2">Nomor HP</label>
                     <div class="col-sm-10">
                    <input v-model="form.no_hp" type="text" name="no_hp" placeholder="Nomor HP"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('no_hp') }">
                    <has-error :form="form" field="no_hp"></has-error>
                    </div>
                    </div>

                    <div class="form-group row">
                     <label class="col-sm-2">Lokasi</label>
                     <div class="col-sm-10">
                        <select name="id_location" id="id_location" v-model="form.id_location" class="form-control" :class="{'is-invalid': form.errors.has('id_location')}">
                            <option value="">Pilih Lokasi</option>
                           <option v-for="location in locations" :value="location.id_location" :key="location.value"> 
                               {{ location.location }}
                               </option>
                        </select>
                        <has-error :form="form" field="id_location"></has-error>
                    </div>
                    </div>

                    <div class="form-group row">
                     <label class="col-sm-2">Jabatan</label>
                     <div class="col-sm-10">
                    <select name="id_position" id="id_position" v-model="form.id_position" class="form-control" :class="{'is-invalid': form.errors.has('id_position')}">
                            <option value="">Pilih Jabatan</option>
                           <option v-for="position in positions" :value="position.id_position" :key="position.value"> 
                               {{ position.position }}
                               </option>
                        </select>
                    <has-error :form="form" field="id_position"></has-error>
                    </div>
                    </div>

                    <div class="form-group row">
                     <label class="col-sm-2">Leader</label>
                     <div class="col-sm-10">
                    <select name="id_leader" id="id_leader" v-model="form.id_leader" class="form-control" :class="{'is-invalid': form.errors.has('id_leader')}">
                            <option value="">Pilih Leader</option>
                           <option v-for="leader in leaders" :value="leader.id_leader" :key="leader.value"> 
                               {{ leader.name }} || {{ leader.type }}
                               </option>
                        </select>
                    <has-error :form="form" field="id_leader"></has-error>
                    </div>
                    </div>

                    <div class="form-group row">
                     <label class="col-sm-2">Status</label>
                     <div class="col-sm-10">
                        <select name="tipe" id="tipe" v-model="form.tipe" class="form-control" :class="{'is-invalid': form.errors.has('tipe')}">
                            <option value="">Status</option>
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                        <has-error :form="form" field="tipe"></has-error>
                    </div>
                    </div>

                    <div class="form-group row">
                     <label class="col-sm-2">Foto</label>
                     <div class="col-sm-10">
                        <input type="file" @change="updateProfile" name='photo' class='form-input'>
                    </div>
                    </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button @click.prevent = "updateInfo" type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
        </div>
</template>

<script>
    export default {
        data(){
            return {
                positions : {},
                locations : {},
                leaders    : {},
                form: new Form({
                        id          : '',
                        name        : '',
                        email       : '',
                        password    : '',
                        no_hp       : '',
                        id_location : '',
                        id_position : '',
                        photo       : '',
                        id_leader   : '',
                        tipe      : '',
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods : {
        updateInfo(){
            this.$Progress.start();
            this.form.put('api/profile')
            .then(() => {
              this.$Progress.finish();
            })
            .catch(() => {
              this.$Progress.fail();
            });
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
        updateProfile(e){
            // console.log('diupload');
            let file = e.target.files[0];
            let reader = new FileReader();
            if(file['size'] < 10000000){
                  reader.onloadend = (file) => {
                    // console.log('RESULT',reader.result)
                  this.form.photo = reader.result;
                  }
                  reader.readAsDataURL(file);
            } else {
               swal.fire(
                      'Gagal!',
                      'Oops Error.',
                      'warning'
                    )
            }
        }
        },
        created() {
            axios.get("api/profile").
            then(({ data}) => (this.form.fill(data)));
            this.loadPosition();
            this.loadLocation();
            this.loadLeader();
        }
    }
</script>
