@extends('layouts.app')

@section('title', 'Profil')

@section('content')

<style>

.gradient-custom {
/* fallback for old browsers */
background: #f6d365;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
}

</style>

<br><br>
<div class="main-panel">
    <div class="page-inner">
        <section class="vh-100">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-6 mb-4 mb-lg-0">
                  <div class="card mb-3" style="border-radius: .5rem;">
                    <div class="row g-0">
                      <div class="col-md-4 gradient-custom text-center text-white"
                        style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                        <img class="rounded-circle mt-4" width="120px" src="https://w7.pngwing.com/pngs/896/922/png-transparent-computer-icons-user-profile-profile-miscellaneous-angle-white-thumbnail.png">
                        <br>
                        <br>
                        <h5>{{auth()->user()->name}}</h5>
                        <p>{{auth()->user()->level['nama_level']}}</p>
                        <br><br>
                        <i ><a class="far fa-edit mb-5" href="{{route('profil.edit',auth()->user()->id)}}" style="color: white;">&nbsp;Ganti Password</a></i>
                      </div>
                      <div class="col-md-8">
                        <div class="card-body p-4">
                          <h6>Information</h6>
                          <hr class="mt-0 mb-4">
                          <div class="row pt-1">
                            <div class="col-6 mb-3">
                              <h6>Username</h6>
                              <p class="text-muted">{{auth()->user()->username}}</p>
                            </div>
                            <div class="col-6 mb-3">
                              <h6>Email</h6>
                              <p class="text-muted">{{auth()->user()->email}}</p>
                            </div>
                          </div>
                          
                          <hr class="mt-0 mb-4">
                          <div class="row pt-1">
                            <div class="col-6 mb-3">
                              <h6>No Handphone</h6>
                              <p class="text-muted">{{auth()->user()->no_hp}}</p>
                            </div>
                            <div class="col-6 mb-3">
                              <h6>Role</h6>
                              <p class="text-muted">{{auth()->user()->level['nama_level']}}</p>
                            </div>
                          </div>
                       
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <div class="alert alert-info">
            <p>Data ini hanya bisa dilihat oleh anda. Apabila anda perlu mengganti data anda karena alasan tertentu silahkan hubungi <a data-tjr-open-modal="contact-info-modal" href="#open-info-dialog-modal">kontak support</a></p>
        </div>
    </div>
</div>

@endsection