@extends('layouts.user')
@section('user')
    <!-- Content wrapper -->


    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row gy-4">
                <!-- Congratulations card -->
                <div class="col-md-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            @php
                                // Menggunakan helper session() untuk mengambil data dari sesi
                                $userId = session('user_id');

                                // Mendapatkan username berdasarkan user_id
                                $user = \App\Models\users::find($userId);
                                $userName = $user ? $user->username : null;
                            @endphp
                            {{-- pake ucapan waktu --}}
                            <?php
                            $currentTime = date('H');
                            
                            if ($userName) {
                                echo '<h4 class="card-title">';
                                if ($currentTime >= 0 && $currentTime < 12) {
                                    echo 'Selamat Pagi, ' . $userName . ' 🌅';
                                } elseif ($currentTime >= 12 && $currentTime < 18) {
                                    echo 'Selamat Siang, ' . $userName . ' ☀️';
                                } else {
                                    echo 'Selamat Malam, ' . $userName . ' 🌙';
                                }
                                echo '</h4>';
                            } else {
                                echo '<h4 class="card-title">';
                                if ($currentTime >= 0 && $currentTime < 12) {
                                    echo 'Selamat Pagi';
                                } elseif ($currentTime >= 12 && $currentTime < 18) {
                                    echo 'Selamat Siang';
                                } else {
                                    echo 'Selamat Malam';
                                }
                                echo '</h4>';
                            }
                            ?>

                            {{-- pake biasa --}}
                            {{-- <h4 class="card-title">
                                @if ($userName)
                                    Selamat Datang, {{ $userName }} 🎉
                                @else
                                    Selamat Datang
                                @endif
                            </h4> --}}

                        </div>

                        {{-- <img src="../assets/img/icons/misc/triangle-light.png"
                            class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background"
                            data-app-light-img="icons/misc/triangle-light.png"
                            data-app-dark-img="icons/misc/triangle-dark.png" />
                        <img src="../assets/img/illustrations/trophy.png"
                            class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83"
                            alt="view sales" /> --}}
                    </div>
                </div>
                <!--/ Congratulations card -->

                <!-- Transactions -->
                <div class="col-lg-15">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title m-0 me-2">Pengaduan Masyarakat</h5>
                                {{-- <div class="dropdown">
                                    <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                    </div>
                                </div> --}}
                            </div>
                            <p class="mt-3"><span class="fw-medium">Statistik Pengaduan Masyarakat :</p>
                            <p id="realTime" style="margin-top: -10px;"></p>

                            <script>
                                function updateRealTime() {
                                    const now = new Date();
                                    const options = {
                                        timeZone: 'Asia/Jakarta',
                                        weekday: 'long',
                                        day: 'numeric',
                                        month: 'long',
                                        year: 'numeric',
                                        hour: 'numeric',
                                        minute: 'numeric',
                                        second: 'numeric'
                                    };
                                    const formattedTime = now.toLocaleString('id-ID', options);

                                    document.getElementById('realTime').textContent = formattedTime;
                                }

                                // Update real-time every second
                                setInterval(updateRealTime, 1000);

                                // Initial call to display the time immediately
                                updateRealTime();
                            </script>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-danger rounded shadow">
                                                <i class="mdi mdi-alert-decagram mdi-24px"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            @php
                                                $user_id = session('user_id');

                                                $countTerkirim = DB::table('pengaduan')
                                                    ->where('IsDelete', 0)
                                                    ->where('IsApproved', '=', '0')
                                                    ->count();
                                            @endphp
                                            <div class="small mb-1">Pengaduan Belum Ditanggapi</div>
                                            <h5 class="mb-0">{{ $countTerkirim }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-info rounded shadow">
                                                <i class="mdi mdi-clock mdi-24px"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            @php
                                                $user_id = session('user_id');

                                                $countTerproses = DB::table('pengaduan')
                                                    ->where('IsDelete', 0)
                                                    ->where('IsApproved', '=', '1')
                                                    ->count();
                                            @endphp
                                            <div class="small mb-1">Pengaduan Yang Telah Diproses</div>
                                            <h5 class="mb-0">{{ $countTerproses }}</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-success rounded shadow">
                                                <i class="fa-reguler fas fa-check"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            @php
                                                $user_id = session('user_id');

                                                $countTanggap = DB::table('pengaduan')
                                                    ->where('IsDelete', 0)
                                                    ->where('IsApproved', '=', '2')
                                                    ->count();
                                            @endphp
                                            <div class="small mb-1">Pengaduan Yang Telah Ditanggapi</div>
                                            <h5 class="mb-0">{{ $countTanggap }}</h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-warning rounded shadow">
                                                <i class="mdi mdi-cellphone-link mdi-24px"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            @php
                                                $user_id = session('user_id');

                                                $count = DB::table('pengaduan')
                                                    ->where('IsDelete', 0)
                                                    ->count();
                                            @endphp
                                            <div class="small mb-1">Total Pengaduan</div>
                                            <h5 class="mb-0">{{ $count }}</h5>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-3 col-6">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar">
                                            <div class="avatar-initial bg-info rounded shadow">
                                                <i class="mdi mdi-currency-usd mdi-24px"></i>
                                            </div>
                                        </div>
                                        <div class="ms-3">
                                            <div class="small mb-1">Revenue</div>
                                            <h5 class="mb-0">$88k</h5>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Transactions -->

                {{-- <!-- Weekly Overview Chart -->
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-1">Weekly Overview</h5>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="weeklyOverviewDropdown"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="weeklyOverviewDropdown">
                                        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="weeklyOverviewChart"></div>
                            <div class="mt-1 mt-md-3">
                                <div class="d-flex align-items-center gap-3">
                                    <h3 class="mb-0">45%</h3>
                                    <p class="mb-0">Your sales performance is 45% 😎 better compared to last month</p>
                                </div>
                                <div class="d-grid mt-3 mt-md-4">
                                    <button class="btn btn-primary" type="button">Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Weekly Overview Chart -->

                <!-- Total Earnings -->
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Total Earning</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="totalEarnings" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalEarnings">
                                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 mt-md-3 mb-md-5">
                                <div class="d-flex align-items-center">
                                    <h2 class="mb-0">$24,895</h2>
                                    <span class="text-success ms-2 fw-medium">
                                        <i class="mdi mdi-menu-up mdi-24px"></i>
                                        <small>10%</small>
                                    </span>
                                </div>
                                <small class="mt-1">Compared to $84,325 last year</small>
                            </div>
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-4 pb-md-2">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="../assets/img/icons/misc/zipcar.png" alt="zipcar" class="rounded" />
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Zipcar</h6>
                                            <small>Vuejs, React & HTML</small>
                                        </div>
                                        <div>
                                            <h6 class="mb-2">$24,895.65</h6>
                                            <div class="progress bg-label-primary" style="height: 4px">
                                                <div class="progress-bar bg-primary" style="width: 75%"
                                                    role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-md-2">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="../assets/img/icons/misc/bitbank.png" alt="bitbank" class="rounded" />
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Bitbank</h6>
                                            <small>Sketch, Figma & XD</small>
                                        </div>
                                        <div>
                                            <h6 class="mb-2">$8,6500.20</h6>
                                            <div class="progress bg-label-info" style="height: 4px">
                                                <div class="progress-bar bg-info" style="width: 75%" role="progressbar"
                                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-md-3">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="../assets/img/icons/misc/aviato.png" alt="aviato" class="rounded" />
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Aviato</h6>
                                            <small>HTML & Angular</small>
                                        </div>
                                        <div>
                                            <h6 class="mb-2">$1,2450.80</h6>
                                            <div class="progress bg-label-secondary" style="height: 4px">
                                                <div class="progress-bar bg-secondary" style="width: 75%"
                                                    role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--/ Total Earnings -->

                <!-- Four Cards -->
                <div class="col-xl-4 col-md-6">
                    <div class="row gy-4">
                        <!-- Total Profit line chart -->
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header pb-0">
                                    <h4 class="mb-0">$86.4k</h4>
                                </div>
                                <div class="card-body">
                                    <div id="totalProfitLineChart" class="mb-3"></div>
                                    <h6 class="text-center mb-0">Total Profit</h6>
                                </div>
                            </div>
                        </div>
                        <!--/ Total Profit line chart -->
                        <!-- Total Profit Weekly Project -->
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-secondary rounded-circle shadow">
                                            <i class="mdi mdi-poll mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="totalProfitID"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalProfitID">
                                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body mt-mg-1">
                                    <h6 class="mb-2">Total Profit</h6>
                                    <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                                        <h4 class="mb-0 me-2">$25.6k</h4>
                                        <small class="text-success mt-1">+42%</small>
                                    </div>
                                    <small>Weekly Project</small>
                                </div>
                            </div>
                        </div>
                        <!--/ Total Profit Weekly Project -->
                        <!-- New Yearly Project -->
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header d-flex align-items-center justify-content-between">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-primary rounded-circle shadow-sm">
                                            <i class="mdi mdi-wallet-travel mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn p-0" type="button" id="newProjectID"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="newProjectID">
                                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body mt-mg-1">
                                    <h6 class="mb-2">New Project</h6>
                                    <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                                        <h4 class="mb-0 me-2">862</h4>
                                        <small class="text-danger mt-1">-18%</small>
                                    </div>
                                    <small>Yearly Project</small>
                                </div>
                            </div>
                        </div>
                        <!--/ New Yearly Project -->
                        <!-- Sessions chart -->
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-header pb-0">
                                    <h4 class="mb-0">2,856</h4>
                                </div>
                                <div class="card-body">
                                    <div id="sessionsColumnChart" class="mb-3"></div>
                                    <h6 class="text-center mb-0">Sessions</h6>
                                </div>
                            </div>
                        </div>
                        <!--/ Sessions chart -->
                    </div>
                </div>
                <!--/ Total Earning -->

                <!-- Sales by Countries -->
                <div class="col-xl-4 col-md-6">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Sales by Countries</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="saleStatus" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="saleStatus">
                                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <div class="avatar-initial bg-label-success rounded-circle">US</div>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center gap-1">
                                            <h6 class="mb-0">$8,656k</h6>
                                            <i class="mdi mdi-chevron-up mdi-24px text-success"></i>
                                            <small class="text-success">25.8%</small>
                                        </div>
                                        <small>United states of america</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="mb-0">894k</h6>
                                    <small>Sales</small>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <span class="avatar-initial bg-label-danger rounded-circle">UK</span>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center gap-1">
                                            <h6 class="mb-0">$2,415k</h6>
                                            <i class="mdi mdi-chevron-down mdi-24px text-danger"></i>
                                            <small class="text-danger">6.2%</small>
                                        </div>
                                        <small>United Kingdom</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="mb-0">645k</h6>
                                    <small>Sales</small>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <span class="avatar-initial bg-label-warning rounded-circle">IN</span>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center gap-1">
                                            <h6 class="mb-0">865k</h6>
                                            <i class="mdi mdi-chevron-up mdi-24px text-success"></i>
                                            <small class="text-success"> 12.4%</small>
                                        </div>
                                        <small>India</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="mb-0">148k</h6>
                                    <small>Sales</small>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <span class="avatar-initial bg-label-secondary rounded-circle">JA</span>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center gap-1">
                                            <h6 class="mb-0">$745k</h6>
                                            <i class="mdi mdi-chevron-down mdi-24px text-danger"></i>
                                            <small class="text-danger">11.9%</small>
                                        </div>
                                        <small>Japan</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="mb-0">86k</h6>
                                    <small>Sales</small>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <span class="avatar-initial bg-label-danger rounded-circle">KO</span>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center gap-1">
                                            <h6 class="mb-0">$45k</h6>
                                            <i class="mdi mdi-chevron-up mdi-24px text-success"></i>
                                            <small class="text-success">16.2%</small>
                                        </div>
                                        <small>Korea</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="mb-0">42k</h6>
                                    <small>Sales</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Sales by Countries -->

                <!-- Deposit / Withdraw -->
                <div class="col-xl-8">
                    <div class="card h-100">
                        <div class="card-body row g-2">
                            <div class="col-12 col-md-6 card-separator pe-0 pe-md-3">
                                <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                                    <h5 class="m-0 me-2">Deposit</h5>
                                    <a class="fw-medium" href="javascript:void(0);">View all</a>
                                </div>
                                <div class="pt-2">
                                    <ul class="p-0 m-0">
                                        <li class="d-flex mb-4 align-items-center pb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="../assets/img/icons/payments/gumroad.png" class="img-fluid"
                                                    alt="gumroad" height="30" width="30" />
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Gumroad Account</h6>
                                                    <small>Sell UI Kit</small>
                                                </div>
                                                <h6 class="text-success mb-0">+$4,650</h6>
                                            </div>
                                        </li>
                                        <li class="d-flex mb-4 align-items-center pb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="../assets/img/icons/payments/mastercard-2.png" class="img-fluid"
                                                    alt="mastercard" height="30" width="30" />
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Mastercard</h6>
                                                    <small>Wallet deposit</small>
                                                </div>
                                                <h6 class="text-success mb-0">+$92,705</h6>
                                            </div>
                                        </li>
                                        <li class="d-flex mb-4 align-items-center pb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="../assets/img/icons/payments/stripes.png" class="img-fluid"
                                                    alt="stripes" height="30" width="30" />
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Stripe Account</h6>
                                                    <small>iOS Application</small>
                                                </div>
                                                <h6 class="text-success mb-0">+$957</h6>
                                            </div>
                                        </li>
                                        <li class="d-flex mb-4 align-items-center pb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="../assets/img/icons/payments/american-bank.png"
                                                    class="img-fluid" alt="american" height="30" width="30" />
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">American Bank</h6>
                                                    <small>Bank Transfer</small>
                                                </div>
                                                <h6 class="text-success mb-0">+$6,837</h6>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="../assets/img/icons/payments/citi.png" class="img-fluid"
                                                    alt="citi" height="30" width="30" />
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Bank Account</h6>
                                                    <small>Wallet deposit</small>
                                                </div>
                                                <h6 class="text-success mb-0">+$446</h6>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 ps-0 ps-md-3 mt-3 mt-md-2">
                                <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                                    <h5 class="m-0 me-2">Withdraw</h5>
                                    <a class="fw-medium" href="javascript:void(0);">View all</a>
                                </div>
                                <div class="pt-2">
                                    <ul class="p-0 m-0">
                                        <li class="d-flex mb-4 align-items-center pb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="../assets/img/icons/brands/google.png" class="img-fluid"
                                                    alt="google" height="30" width="30" />
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Google Adsense</h6>
                                                    <small>Paypal deposit</small>
                                                </div>
                                                <h6 class="text-danger mb-0">-$145</h6>
                                            </div>
                                        </li>
                                        <li class="d-flex mb-4 align-items-center pb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="../assets/img/icons/brands/github.png" class="img-fluid"
                                                    alt="github" height="30" width="30" />
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Github Enterprise</h6>
                                                    <small>Security &amp; compliance</small>
                                                </div>
                                                <h6 class="text-danger mb-0">-$1870</h6>
                                            </div>
                                        </li>
                                        <li class="d-flex mb-4 align-items-center pb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="../assets/img/icons/brands/slack.png" class="img-fluid"
                                                    alt="slack" height="30" width="30" />
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Upgrade Slack Plan</h6>
                                                    <small>Debit card deposit</small>
                                                </div>
                                                <h6 class="text-danger mb-0">$450</h6>
                                            </div>
                                        </li>
                                        <li class="d-flex mb-4 align-items-center pb-2">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="../assets/img/icons/payments/digital-ocean.png"
                                                    class="img-fluid" alt="digital" height="30" width="30" />
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Digital Ocean</h6>
                                                    <small>Cloud Hosting</small>
                                                </div>
                                                <h6 class="text-danger mb-0">-$540</h6>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="../assets/img/icons/brands/aws.png" class="img-fluid"
                                                    alt="aws" height="30" width="30" />
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">AWS Account</h6>
                                                    <small>Choosing a Cloud Platform</small>
                                                </div>
                                                <h6 class="text-danger mb-0">-$21</h6>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- Deposit / Withdraw -->
                @if (Session::has('pesan'))
                    <div class="alert alert-success" id="alert">{{ Session::get('pesan') }}</div>
                    <script>
                        // Automatically hide the alert after 3 seconds
                        setTimeout(function() {
                            document.getElementById('alert').style.display = 'none';
                        }, 3000);
                    </script>
                @endif

                @if (Session::has('hapus'))
                    <div class="alert alert-danger" id="alert">{{ Session::get('hapus') }}</div>
                    <script>
                        // Automatically hide the alert after 3 seconds
                        setTimeout(function() {
                            document.getElementById('alert').style.display = 'none';
                        }, 3000);
                    </script>
                @endif
                <!-- Add a modal at the end of your HTML body -->
                <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title text-white mb-2" id="detailModalLabel">
                                    <svg width="40" height="35" viewBox="0 0 8 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M4.83333 2.95833H6.08333C6.3125 2.95833 6.5 2.77083 6.5 2.54167C6.5 2.3125 6.3125 2.125 6.08333 2.125H4.83333C4.60417 2.125 4.41667 2.3125 4.41667 2.54167C4.41667 2.77083 4.60417 2.95833 4.83333 2.95833ZM4.83333 5.875H6.08333C6.3125 5.875 6.5 5.6875 6.5 5.45833C6.5 5.22917 6.3125 5.04167 6.08333 5.04167H4.83333C4.60417 5.04167 4.41667 5.22917 4.41667 5.45833C4.41667 5.6875 4.60417 5.875 4.83333 5.875ZM6.91667 7.75H1.08333C0.625 7.75 0.25 7.375 0.25 6.91667V1.08333C0.25 0.625 0.625 0.25 1.08333 0.25H6.91667C7.375 0.25 7.75 0.625 7.75 1.08333V6.91667C7.75 7.375 7.375 7.75 6.91667 7.75ZM1.91667 3.58333H3.16667C3.39583 3.58333 3.58333 3.39583 3.58333 3.16667V1.91667C3.58333 1.6875 3.39583 1.5 3.16667 1.5H1.91667C1.6875 1.5 1.5 1.6875 1.5 1.91667V3.16667C1.5 3.39583 1.6875 3.58333 1.91667 3.58333ZM1.91667 1.91667H3.16667V3.16667H1.91667V1.91667ZM1.91667 6.5H3.16667C3.39583 6.5 3.58333 6.3125 3.58333 6.08333V4.83333C3.58333 4.60417 3.39583 4.41667 3.16667 4.41667H1.91667C1.6875 4.41667 1.5 4.60417 1.5 4.83333V6.08333C1.5 6.3125 1.6875 6.5 1.91667 6.5ZM1.91667 4.83333H3.16667V6.08333H1.91667V4.83333Z"
                                            fill="white" />
                                    </svg>

                                    Detail Pengaduan Anda
                                </h5>
                                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button> --}}
                            </div>
                            <div class="modal-body">
                                <!-- Display details here -->
                                {{-- <h4>Judul Pengaduan: <span id="detailJudul"></span></h4> --}}
                                <label for="" class="form-label text-dark">Judul Pengaduan :</label>
                                <p id="detailJudul" class="border-bottom"></p>
                                <label for="" class="form-label text-dark">Lokasi Pengaduan :</label>
                                <p id="detailLokasi" class="border-bottom"></p>
                                <label for="" class="form-label text-dark">Tanggal Pengaduan :</label>
                                <p id="detailWaktu" class="border-bottom"></p>
                                <label for="" class="form-label text-dark">Pengaduan :</label>
                                <p id="detailDeskripsi" class="border-bottom"></p>
                                <label for="" class="form-label text-dark">Lampiran :</label>
                                <div id="lampiranDetail" class="border-bottom"></div>
                                <label for="" class="form-label text-dark">Status Pengaduan :</label>
                                <div id="detailStatus" class="border-bottom"></div>


                                {{-- <p>Lokasi Pengaduan: <span id="detailLokasi"></span></p>
                                <p>Status Pengaduan: <span id="detailStatus"></span></p>
                                <p>Deskripsi Pengaduan: <span id="detailDeskripsi"></span></p>
                                <p>Username: <span id="detailUsername"></span></p> --}}
                                <!-- Add other details as needed -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Aproval --}}
                <div class="modal fade" id="approvalModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body d-flex flex-column align-items-center">
                                <!-- Your form goes here -->
                                <img src="{{ asset('assets/img/logo/logo.jpg') }}" alt="" width="150">
                                <form action="{{ route('approveAction') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <h4 class="" id="judulPengaduan"></h4>
                                        <label for="approvalStatus" class="form-label">Ubah Status aduan Menjadi :</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="approvalStatus"
                                                id="Proses" value="1" required>
                                            <label class="form-check-label" for="Proses">
                                                Proses Aduan
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="approvalStatus"
                                                id="AduanSelesai" value="2" required>
                                            <label class="form-check-label" for="AduanSelesai">
                                                Aduan Selesai
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Use the hidden field to store the id_pengajuan -->
                                    <input type="hidden" name="id_pengaduan" id="approvalId">

                                    <div class="mb-3">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                            

                            {{-- <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    // Mendapatkan elemen radio button untuk proses aduan
                                    var prosesRadioButton = document.getElementById('Proses');
                            
                                    // Mendapatkan elemen radio button untuk aduan selesai
                                    var selesaiRadioButton = document.getElementById('AduanSelesai');
                            
                                    // Mendapatkan elemen id_pengaduan
                                    var idPengaduan = document.getElementById('approvalId').value;
                            
                                    // Mendapatkan elemen judul pengaduan
                                    var judulPengaduan = document.getElementById('judulPengaduan');
                            
                                    // Memanggil fungsi untuk memeriksa status laporan
                                    checkApprovalStatus();
                            
                                    // Event listener untuk radio button
                                    prosesRadioButton.addEventListener('change', checkApprovalStatus);
                                    selesaiRadioButton.addEventListener('change', checkApprovalStatus);
                            
                                    // Panggil fungsi untuk mengambil status isApproved dari server
                                    fetchApprovalStatus();
                            
                                    function fetchApprovalStatus() {
                                        fetch(`/get-approval-status/${idPengaduan}`)
                                        .then(response => {
                                            if (!response.ok) {
                                                throw new Error('Terjadi kesalahan saat mengambil data status isApproved.');
                                            }
                                            return response.json();
                                        })
                                        .then(data => {
                                            // Set nilai radio button sesuai dengan status isApproved yang diambil
                                            if (data.isApproved == 1) {
                                                prosesRadioButton.checked = true;
                                            } else if (data.isApproved == 2) {
                                                selesaiRadioButton.checked = true;
                                            }
                            
                                            // Periksa dan atur kembali status laporan
                                            checkApprovalStatus();
                                        })
                                        .catch(error => {
                                            console.error(error);
                                            alert('Terjadi kesalahan saat mengambil data status isApproved.');
                                        });
                                    }
                            
                                    function checkApprovalStatus() {
                                        // Mendapatkan nilai dari radio button yang terpilih
                                        var approvalStatus = document.querySelector('input[name="approvalStatus"]:checked').value;
                            
                                        // Memeriksa apakah status laporan sudah selesai
                                        if (approvalStatus == 2) {
                                            // Menonaktifkan radio button jika status selesai dipilih
                                            prosesRadioButton.disabled = true;
                                            selesaiRadioButton.disabled = true;
                                        } else {
                                            // Mengaktifkan radio button jika status proses dipilih
                                            prosesRadioButton.disabled = false;
                                            selesaiRadioButton.disabled = false;
                                        }
                                    }
                                });
                            </script> --}}

                            <div class="modal-footer">
                                <!-- Footer content goes here -->
                            </div>
                        </div>
                    </div>
                </div>

                @if (Session::has('message'))
                    <div id="pesan-sukses" class="alert alert-success mt-4">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <!-- Data Tables -->
                <div class="col-12">
                    <div class="card text-dark">
                        <div class="card-header bg-primary">
                            <h4 class="mb-0 text-white ms-0">
                                <svg width="40" height="35" viewBox="0 0 8 8" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.83333 2.95833H6.08333C6.3125 2.95833 6.5 2.77083 6.5 2.54167C6.5 2.3125 6.3125 2.125 6.08333 2.125H4.83333C4.60417 2.125 4.41667 2.3125 4.41667 2.54167C4.41667 2.77083 4.60417 2.95833 4.83333 2.95833ZM4.83333 5.875H6.08333C6.3125 5.875 6.5 5.6875 6.5 5.45833C6.5 5.22917 6.3125 5.04167 6.08333 5.04167H4.83333C4.60417 5.04167 4.41667 5.22917 4.41667 5.45833C4.41667 5.6875 4.60417 5.875 4.83333 5.875ZM6.91667 7.75H1.08333C0.625 7.75 0.25 7.375 0.25 6.91667V1.08333C0.25 0.625 0.625 0.25 1.08333 0.25H6.91667C7.375 0.25 7.75 0.625 7.75 1.08333V6.91667C7.75 7.375 7.375 7.75 6.91667 7.75ZM1.91667 3.58333H3.16667C3.39583 3.58333 3.58333 3.39583 3.58333 3.16667V1.91667C3.58333 1.6875 3.39583 1.5 3.16667 1.5H1.91667C1.6875 1.5 1.5 1.6875 1.5 1.91667V3.16667C1.5 3.39583 1.6875 3.58333 1.91667 3.58333ZM1.91667 1.91667H3.16667V3.16667H1.91667V1.91667ZM1.91667 6.5H3.16667C3.39583 6.5 3.58333 6.3125 3.58333 6.08333V4.83333C3.58333 4.60417 3.39583 4.41667 3.16667 4.41667H1.91667C1.6875 4.41667 1.5 4.60417 1.5 4.83333V6.08333C1.5 6.3125 1.6875 6.5 1.91667 6.5ZM1.91667 4.83333H3.16667V6.08333H1.91667V4.83333Z"
                                        fill="white" />
                                </svg>
                                Semua Aduan
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="data" class="table table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Nama Pengadu</th>
                                            <th>Judul Pengaduan</th>
                                            <th>Lokasi Pengaduan</th>
                                            <th>Status Pengaduan</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $da)
                                            @if ($da->IsDelete == 0)
                                                <tr>
                                                    <td>{{ $da->username }}</td>
                                                    <td>{{ $da->judul_pengaduan }}</td>
                                                    <td>{{ $da->lokasi_pengaduan }}</td>
                                                    <td>
                                                        @if ($da->IsApproved == 0)
                                                            <div class="carddd p-2 d-flex align-items-center bg-danger d-sm-flex justify-content-sm-center"
                                                                style="min-width: 200px;">
                                                                <i
                                                                    class="fa-regular fa-hourglass-half text-white text-center"></i>
                                                                <span class="ml-2 text-white ms-3">Belum Ditanggapi</span>
                                                            </div>
                                                        @elseif($da->IsApproved == 1)
                                                            <div class="carddd p-2 d-flex align-items-center bg-info d-sm-flex justify-content-sm-center"
                                                                style="min-width: 200px;">
                                                                <i class="fa-regular fa-clock text-white"></i>
                                                                <span class="ml-2 text-white ms-3">Sedang Diproses</span>
                                                            </div>
                                                        @elseif($da->IsApproved == 2)
                                                            <div class="carddd p-2 d-flex align-items-center bg-success d-sm-flex justify-content-sm-center"
                                                                style="min-width: 200px;">
                                                                <i class="fa-regular fas fa-check text-white"></i>
                                                                <span class="ml-2 text-white ms-3">Sudah Ditanggapi</span>
                                                            </div>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <button class="btn btn-info view-details"
                                                            data-id="{{ $da->id_pengaduan }}">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>

                                                        <button class="btn btn-success btn-approval"
                                                        data-id="{{ $da->id_pengaduan }}"
                                                        {{ $da->IsApproved == 2 ? 'disabled' : '' }}
                                                        {{ $da->IsApproved == 2 ? 'aria-disabled=true' : '' }}
                                                        {{ $da->IsApproved == 2 ? 'tabindex=-1' : '' }}
                                                        title="{{ $da->IsApproved == 2 ? 'Pengaduan sudah selesai. Tidak bisa diedit.' : '' }}">
                                                    <i class="fas fa-file-signature"></i>
                                                </button>
                                                

                                                        <a href="javascript:void(0);"
                                                            onclick="confirmDelete({{ $da->id_pengaduan }}, {{ $da->IsApproved }})"
                                                            class="btn btn-danger delete-btn"
                                                            {{ $da->IsApproved == 1 || $da->IsApproved == 2 ? 'disabled' : '' }}
                                                            {{ $da->IsApproved == 1 || $da->IsApproved == 2 ? 'aria-disabled=true' : '' }}
                                                            {{ $da->IsApproved == 1 || $da->IsApproved == 2 ? 'tabindex=-1' : '' }}
                                                            title="{{ $da->IsApproved == 1 || $da->IsApproved == 2 ? 'Pengaduan sudah ditanggapi. Tidak bisa dihapus.' : '' }}">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </a>

                                                        <script>
                                                            function confirmDelete(id_pengaduan, isApproved) {
                                                                // Cek nilai isApproved
                                                                if ( isApproved == 2) {
                                                                    // Jika isApproved == 1 atau 2, tidak tampilkan Sweet Alert
                                                                    // atau lakukan tindakan lain sesuai kebutuhan
                                                                    Swal.fire({
                                                                        title: 'Gagal Menghapus',
                                                                        text: 'Pengaduan yang telah Selesai tidak dapat dihapus. Silahkan hubungi Tim Developer',
                                                                        icon: 'warning'

                                                                    });
                                                                } else {
                                                                    // Tampilkan Sweet Alert jika isApproved bukan 1 atau 2
                                                                    Swal.fire({
                                                                        title: 'Apakah kamu yakin?',
                                                                        text: "Pengaduan yang dihapus tidak dapat dikembalikan!",
                                                                        icon: 'warning',
                                                                        showCancelButton: true,
                                                                        confirmButtonColor: '#3085d6',
                                                                        cancelButtonColor: '#d33',
                                                                        confirmButtonText: 'Ya, hapus!',
                                                                        cancelButtonText: 'Batal'
                                                                    }).then((result) => {
                                                                        if (result.isConfirmed) {
                                                                            // Lakukan permintaan DELETE menggunakan Fetch API
                                                                            fetch(`{{ route('user.destroy', ['id' => $da->id_pengaduan]) }}`, {
                                                                                    method: 'DELETE',
                                                                                    headers: {
                                                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                                                        'Content-Type': 'application/json'
                                                                                    },
                                                                                    body: JSON.stringify({
                                                                                        id_pengaduan: id_pengaduan
                                                                                    })
                                                                                })
                                                                                .then(response => response.json())
                                                                                .then(data => {
                                                                                    // Handle respon setelah penghapusan berhasil
                                                                                    // Misalnya, tampilkan pesan atau atur tindakan yang diperlukan
                                                                                    console.log(data);
                                                                                    Swal.fire('Berhasil!', 'Pengaduan berhasil dihapus.', 'success')
                                                                                        .then(() => {
                                                                                            // Refresh halaman setelah menutup SweetAlert
                                                                                            window.location.reload();
                                                                                        });
                                                                                })
                                                                                .catch(error => {
                                                                                    // Handle kesalahan jika terjadi
                                                                                    console.error(error);
                                                                                    Swal.fire('Oops!', 'Terjadi kesalahan saat menghapus pengaduan.', 'error');
                                                                                });
                                                                        }
                                                                    });
                                                                }
                                                            }
                                                        </script>





                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



                <!--/ Data Tables -->
            </div>
        </div>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <!-- Include moment.js in the head section -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
        <link rel="stylesheet" type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>


        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
        <!-- Add the script at the end of your HTML body -->
        <!-- Add the script at the end of your HTML body -->
        <!-- Add the script at the end of your HTML body -->
        <script>
            // Triggered when the view-details button is clicked
            // Triggered when the view-details button is clicked
            $('.view-details').on('click', function() {
                var pengaduanId = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: '/pengaduan/' + pengaduanId + '/detail',
                    success: function(data) {
                        // Update modal content with the retrieved details
                        $('#detailJudul').text(data.pengaduan.judul_pengaduan);
                        $('#detailLokasi').text(data.pengaduan.lokasi_pengaduan);
                        // $('#detailStatus').text(data.pengaduan.IsApproved);
                        $('#detailDeskripsi').text(data.pengaduan.deskripsi_pengaduan);
                        $('#detailUsername').text(data.user.username);
                        var statusText = getStatusText(data.pengaduan.IsApproved);
                        $('#detailStatus').text(statusText);

                        // Format created_at using moment library with Indonesian locale
                        var formattedDate = moment(data.pengaduan.created_at).locale('id').format(
                            'dddd, DD MMMM YYYY HH:mm:ss');
                        $('#detailWaktu').text(formattedDate);

                        // Display file attachments as images
                        var attachmentsHtml = '';

                        if (data.files.length > 0) {
                            attachmentsHtml += '<div class="image-container">';
                            data.files.forEach(function(file, index) {
                                attachmentsHtml +=
                                    '<a data-fancybox="gallery" href="/storage/Foto/' + file
                                    .nama_file + '" data-caption="' + file.nama_file + '">';
                                attachmentsHtml += '<img src="/storage/Foto/' + file.nama_file +
                                    '" alt="' + file.nama_file +
                                    '" class="img-thumbnail" style="width: 450px; max-height: 300px; margin-right: 5px;">';
                                attachmentsHtml += '</a>';
                            });
                            attachmentsHtml += '</div>';
                        } else {
                            attachmentsHtml = 'Tidak ada lampiran';
                        }

                        $('#lampiranDetail').html(attachmentsHtml);

                        // Initialize Fancybox
                        // $('[data-fancybox="gallery"]').fancybox({
                        //     thumbs: {
                        //         autoStart: true, // Enable thumbnail preview
                        //     },
                        //     loop: true, // Enable infinite loop
                        //     buttons: [
                        //         'slideShow',
                        //         'fullScreen',
                        //         'thumbs',
                        //         'close'
                        //     ],
                        //     animationEffect: "zoom",
                        //     transitionEffect: "slide",
                        // });



                        // Show the modal
                        $('#detailModal').modal('show');
                    },
                    error: function() {
                        alert('Failed to load details.');
                    }
                });
            });
            setTimeout(function() {
                document.getElementById('pesan-sukses').style.display = 'none';
            }, 3000);

            function getStatusText(statusValue) {
                switch (parseInt(statusValue)) { // Pastikan statusValue di-parse ke integer
                    case 0:
                        return 'Belum Ditanggapi';
                    case 1:
                        return 'Sedang Diproses';
                    case 2:
                        return 'Sudah Ditanggapi';
                    default:
                        return 'Status Tidak Dikenali';
                }
            }


            $(document).ready(function() {
                // Function to handle the approval modal
                $('.btn-approval').click(function(e) {
                    var pengaduanId = $(this).data('id');

                    // Use Ajax to fetch judul_pengaduan based on pengaduanId
                    $.ajax({
                        type: 'GET',
                        url: '/fetch-judul/' + pengaduanId, // Replace with your actual route
                        success: function(data) {
                            // Update the h4 element in the modal with the fetched judul_pengaduan
                            $('#judulPengaduan').text(data.judul_pengaduan);

                            // Set the pengaduanId value in the hidden field
                            $('#approvalId').val(pengaduanId);

                            // Show the modal
                            $('#approvalModal').modal('show');
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });

                    e.preventDefault();
                });
            });
        </script>


{{-- <script>
    $(document).ready(function() {
        // Mendapatkan elemen radio button untuk proses aduan
        var prosesRadioButton = $('#Proses');

        // Mendapatkan elemen radio button untuk aduan selesai
        var selesaiRadioButton = $('#AduanSelesai');

        // Mendapatkan elemen id_pengaduan
        var id_pengaduan = $('#approvalId').val();

        // Memanggil fungsi untuk memeriksa status laporan
        fetchApprovalStatus();

        // Event listener untuk radio button
        prosesRadioButton.on('change', checkApprovalStatus);
        selesaiRadioButton.on('change', checkApprovalStatus);

        function fetchApprovalStatus() {
            $.ajax({
                url: `/get-approval-status/${id_pengaduan}`,
                type: 'GET',
                success: function(data) {
                    // Set nilai radio button sesuai dengan status isApproved yang diambil
                    if (data.IsApproved == 1) {
                        prosesRadioButton.prop('checked', true);
                        selesaiRadioButton.prop('checked', false);
                    } else if (data.IsApproved == 2) {
                        prosesRadioButton.prop('checked', false);
                        selesaiRadioButton.prop('checked', true);
                    }

                    // Periksa dan atur kembali status laporan
                    checkApprovalStatus();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Terjadi kesalahan saat mengambil data status isApproved.');
                }
            });
        }

        // Fungsi untuk memeriksa dan mengatur kembali status laporan
        function checkApprovalStatus() {
            var approvalStatus = $('input[name="approvalStatus"]:checked').val();

            // Jika isApproved = 1 (Proses Aduan), checkbox pertama dipilih
            if (approvalStatus == 1) {
                prosesRadioButton.prop('checked', true);
                selesaiRadioButton.prop('checked', false);
            }
            // Jika isApproved = 2 (Aduan Selesai), checkbox kedua dipilih
            else if (approvalStatus == 2) {
                prosesRadioButton.prop('checked', false);
                selesaiRadioButton.prop('checked', true);
            }
        }
    });
</script>  --}}

        <!-- Your script to initialize DataTables -->
        <script>
            $('#data').DataTable({
                lengthMenu: [
                    [5, 10, 25, -1],
                    [5, 10, 25, "All"]
                ],

                pageLength: 5 // Menampilkan 5 data per halaman
            });
        </script>
        <style>
            @media (min-width: 768px) {
                .carddd {
                    width: 60%;
                    margin-left: 20%;
                    /* Atur lebar sesuai keinginan Anda */
                    border-radius: 10px;
                    /* Atur radius sesuai keinginan Anda */
                }
            }
        </style>
    @endsection
