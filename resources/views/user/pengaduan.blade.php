@extends('layouts.user')
@section('user')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="py-3 mb-4"><span class="text-bold fw-bold">Lembar Pengaduan</h4>

      <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              {{-- <h5 class="mb-0">Basic Layout</h5> --}}
              <small class="text-bold float-end">Silahkan Tulis Pengaduanmu</small>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ Route('user.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-floating form-floating-outline mb-4">
                  <input type="text" class="form-control" id="basic-default-fullname" placeholder="Tulis Pengaduan Disini" name="judul" />
                  <label for="basic-default-fullname">Judul Pengaduan</label>
                </div>
                <div class="form-floating form-floating-outline mb-4">
                  <input type="text" class="form-control" id="basic-default-company" placeholder="Tuliskan Lokasi Kejadian" name="lokasi" />
                  <label for="basic-default-company">Lokasi Kejadian</label>
                </div>
                <div class="mb-4">
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Silahkan Upload Foto (*Optional)</label>
                        <input class="form-control" type="file" id="formFileMultiple" multiple name="file[]" accept=".jpeg,.jpg, .png, .mp4" />
                      </div>
                </div>
                {{-- <div class="form-floating form-floating-outline mb-4">
                  <input
                    type="text"
                    id="basic-default-phone"
                    class="form-control phone-mask"
                    placeholder="658 799 8941" />
                  <label for="basic-default-phone">Phone No</label>
                </div> --}}
                <div class="form-floating form-floating-outline mb-4">
                  <textarea
                    id="basic-default-message"
                    class="form-control"
                    name="deskripsi"
                    placeholder="Apa Permasalahanya?"
                    style="height: 100px"></textarea>
                  <label for="basic-default-message">Deskripsi Laporan</label>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
              </form>
            </div>
          </div>
        </div>
        <!-- Merged -->
        {{-- <div class="col-xl">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Basic with Icons</h5>
              <small class="text-muted float-end">Merged input group</small>
            </div>
            <div class="card-body">
              <form>
                <div class="input-group input-group-merge mb-4">
                  <span id="basic-icon-default-fullname2" class="input-group-text"
                    ><i class="mdi mdi-account-outline"></i
                  ></span>
                  <input
                    type="text"
                    class="form-control"
                    id="basic-icon-default-fullname"
                    placeholder="Full Name"
                    aria-label="Full Name"
                    aria-describedby="basic-icon-default-fullname2" />
                </div>
                <div class="input-group input-group-merge mb-4">
                  <span id="basic-icon-default-company2" class="input-group-text"
                    ><i class="mdi mdi-office-building-outline"></i
                  ></span>
                  <input
                    type="text"
                    id="basic-icon-default-company"
                    class="form-control"
                    placeholder="Company"
                    aria-label="Company"
                    aria-describedby="basic-icon-default-company2" />
                </div>
                <div class="mb-4">
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="mdi mdi-email-outline"></i></span>
                    <input
                      type="text"
                      id="basic-icon-default-email"
                      class="form-control"
                      placeholder="Email"
                      aria-label="Email"
                      aria-describedby="basic-icon-default-email2" />
                    <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                  </div>
                  <div class="form-text">You can use letters, numbers & periods</div>
                </div>
                <div class="input-group input-group-merge mb-4">
                  <span id="basic-icon-default-phone2" class="input-group-text"
                    ><i class="mdi mdi-phone"></i
                  ></span>
                  <input
                    type="text"
                    id="basic-icon-default-phone"
                    class="form-control phone-mask"
                    placeholder="Phone No"
                    aria-label="Phone No"
                    aria-describedby="basic-icon-default-phone2" />
                </div>
                <div class="input-group input-group-merge mb-4">
                  <span id="basic-icon-default-message2" class="input-group-text"
                    ><i class="mdi mdi-message-outline"></i
                  ></span>
                  <textarea
                    id="basic-icon-default-message"
                    class="form-control"
                    placeholder="Message"
                    aria-label="Message"
                    aria-describedby="basic-icon-default-message2"
                    style="height: 60px"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
              </form>
            </div>
          </div>
        </div> --}}
      </div>
    </div>
@endsection