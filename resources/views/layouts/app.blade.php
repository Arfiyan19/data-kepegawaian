
<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>@yield('title')</title>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
    @stack('before-style')
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    @stack('after-style')  
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
      <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
         
        <ul class="nav navbar-nav d-xl-none">
                        <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                    </ul>     
          <ul class="nav navbar-nav">
            <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon text-warning" data-feather="star"></i></a>
              <div class="bookmark-input search-input">
                <div class="bookmark-input-icon"><i data-feather="search"></i></div>
                <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
                <ul class="search-list search-list-bookmark"></ul>
              </div>
            </li>
          </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
          <li class="nav-item dropdown dropdown-language"><a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="javascript:void(0);" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item" href="javascript:void(0);" data-language="fr"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="javascript:void(0);" data-language="de"><i class="flag-icon flag-icon-de"></i> German</a><a class="dropdown-item" href="javascript:void(0);" data-language="pt"><i class="flag-icon flag-icon-pt"></i> Portuguese</a></div>
          </li>
          <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
   
         
          <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge badge-pill badge-danger badge-up">{{ DB::table('table_notifikasi')->where(['recipient_at'=>Auth::user()->id,'read_at'=>0])->count() }}</span></a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
              <li class="dropdown-menu-header">
                <div class="dropdown-header d-flex">
                  <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                  <div class="badge badge-pill badge-light-primary">{{ DB::table('table_notifikasi')->where(['recipient_at'=>Auth::user()->id,'read_at'=>0])->count() }} New</div>
                </div>
              </li>
              <li class="scrollable-container media-list"> 
                @foreach(DB::table('table_notifikasi')->where(['recipient_at'=>Auth::user()->id,'read_at'=>0])->get() as $row)
                <a class="d-flex" href="{{ url('notifikasi/home/'.$row->id) }}">
                  <div class="media d-flex align-items-start">
                    <div class="media-left"> 
                    </div>
                    <div class="media-body">
                      <p class="media-heading"><span class="font-weight-bolder">{{ $row->title }}</span>&nbsp;diterima</p><small class="notification-text"> {{ $row->message }}</small>
                    </div>
                  </div></a> 
                @endforeach
              </li>
              <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="{{ url('notifikasi/home') }}">Basa Semua Pesan</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{ Auth::user()->name }}</span><span class="user-status">{{ Auth::user()->role }}</span></div><span class="avatar"><img class="round" src="{{ asset('images/profile/' . Auth::user()->photo) }}" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user"><a class="dropdown-item" href="{{ Auth::user()->role === 'admin' ? route('admin-profile.index') : route('user-profile.index') }}"><i class="mr-50" data-feather="user"></i> Profile</a>
            <a class="dropdown-item" href="app-email.html"><i class="mr-50" data-feather="mail"></i> Inbox</a> 
            <a class="dropdown-item" href="app-chat.html"><i class="mr-50" data-feather="message-square"></i> Chats</a>
              <div class="dropdown-divider"></div><a class="dropdown-item" href="page-account-settings.html"><i class="mr-50" data-feather="settings"></i> Settings</a> 
              <a class="dropdown-item" href="page-auth-login-v2.html"><i class="mr-50" data-feather="power"></i> Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    
 
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mr-auto"><a class="navbar-brand" href="html/ltr/vertical-collapsed-menu-template/index.html"><span class="brand-logo">
                <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                  <defs>
                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                      <stop stop-color="#000000" offset="0%"></stop>
                      <stop stop-color="#FFFFFF" offset="100%"></stop>
                    </lineargradient>
                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                      <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                      <stop stop-color="#FFFFFF" offset="100%"></stop>
                    </lineargradient>
                  </defs>
                  <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                      <g id="Group" transform="translate(400.000000, 178.000000)">
                        <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                        <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                        <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                        <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                        <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                      </g>
                    </g>
                  </g>
                </svg></span>
              <h2 class="brand-text">APK</h2></a></li>
          <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
      </div>
      <div class="shadow-bottom"></div>
      <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

          @if (Auth::user()->role == 'admin')
            <li class="nav-item {{ (request()->is('admin/user*')) ? 'active' : '' }}">
              <a href="{{ route('user.index') }}" class="d-flex align-items-center">
                <i data-feather="user"></i>
                <span class="menu-title text-truncate">user</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('admin/informasi-pegawai*')) ? 'active' : '' }}">
              <a href="{{ url('admin/informasi-pegawai') }}" class="d-flex align-items-center">
                <i data-feather="info"></i>         
                <span class="menu-title text-truncate">informasi pegawai</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('admin/admin-profile*')) ? 'active' : '' }}">
              <a href="{{ route('admin-profile.index') }}" class="d-flex align-items-center">
                <i data-feather="user"></i> 
                <span class="menu-title text-truncate">Profil</span>
              </a>
            </li>
            <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Validasi Data">Validasi Data</span></a>
                <ul class="menu-content">

                    <li class="{{ (request()->is('admin/data-asuransi*')) ? 'active' : '' }}">
                      <a class="d-flex align-items-center" href="{{ route('data-asuransi.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                       data-i18n="Data Asuransi">Data Asuransi</span></a>
                    </li> 
                    <li class="{{ (request()->is('admin/data-asesmen-kompetensi*')) ? 'active' : '' }}">
                      <a class="d-flex align-items-center" href="{{ route('data-asesmen-kompetensi.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                       data-i18n="Data Kompetensi">Data Kompetensi</span></a>
                    </li> 
                    <li class="{{ (request()->is('admin/data-cuti*')) ? 'active' : '' }}">
                      <a class="d-flex align-items-center" href="{{ route('data-cuti.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                       data-i18n="Data Cuti">Data Cuti</span></a>
                    </li> 
                    <li class="{{ (request()->is('admin/data-pendidikan-dinas*')) ? 'active' : '' }}">
                      <a class="d-flex align-items-center" href="{{ route('data-pendidikan-dinas.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                       data-i18n="Data Pendidikan Dinas">Data Pendidikan Dinas</span></a>
                    </li> 
                    <li class="{{ (request()->is('admin/data-pendidikan-formal*')) ? 'active' : '' }}">
                      <a class="d-flex align-items-center" href="{{ route('data-pendidikan-formal.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                       data-i18n="Data Pendidikan Formal">Data Pendidikan Formal</span></a>
                    </li> 
                    <li class="{{ (request()->is('admin/data-kepangkatan*')) ? 'active' : '' }}">
                      <a class="d-flex align-items-center" href="{{ route('data-kepangkatan.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                       data-i18n="Data Kepangkatan">Data Kepangkatan</span></a>
                    </li> 
                    <li class="{{ (request()->is('admin/data-penghargaan*')) ? 'active' : '' }}">
                      <a class="d-flex align-items-center" href="{{ route('data-penghargaan.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                       data-i18n="Data Penghargaan">Data Penghargaan</span></a>
                    </li>  
                    <li class="{{ (request()->is('admin/data-organisasi*')) ? 'active' : '' }}">
                      <a class="d-flex align-items-center" href="{{ route('data-organisasi.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                       data-i18n="Data Organisasi">Data Organisasi</span></a>
                    </li> 
                    <li class="{{ (request()->is('admin/data-gaji-berkala*')) ? 'active' : '' }}">
                      <a class="d-flex align-items-center" href="{{ route('data-gaji-berkala.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                       data-i18n="Data Gaji Berjkala">Data Gaji Berjkala</span></a>
                    </li> 
                    <li class="{{ (request()->is('admin/data-keluarga*')) ? 'active' : '' }}">
                      <a class="d-flex align-items-center" href="{{ route('data-keluarga.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                       data-i18n="Data Kelurga">Data Kelurga</span></a>
                    </li> 
                    <li class="{{ (request()->is('admin/data-tempat-tinggal*')) ? 'active' : '' }}">
                      <a class="d-flex align-items-center" href="{{ route('data-tempat-tinggal.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                       data-i18n="Data Tempat Tinggal">Data Tempat Tinggal</span></a>
                    </li> 
                    <li class="{{ (request()->is('admin/data-jabatan*')) ? 'active' : '' }}">
                      <a class="d-flex align-items-center" href="{{ route('data-jabatan.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                       data-i18n="Data jabatan">Data jabatan</span></a>
                    </li> 
                    <li class="{{ (request()->is('admin/data-skp*')) ? 'active' : '' }}">
                      <a class="d-flex align-items-center" href="{{ route('data-skp.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                       data-i18n="Data SKP">Data SKP</span></a>
                    </li> 
                </ul>
            </li>
          @elseif (Auth::user()->role == 'user')
            <li class="nav-item {{ (request()->is('user/riwayat-organisasi*')) ? 'active' : '' }}">
              <a href="{{ route('riwayat-organisasi.index') }}" class="d-flex align-items-center">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">organisasi</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('user/informasi-pegawai*')) ? 'active' : '' }}">
              <a href="{{ route('informasi-pegawai.index') }}" class="d-flex align-items-center">
                <i data-feather="info"></i>
                <span class="menu-title text-truncate">informasi pegawai</span>
              </a>
            </li>
            <li class="nav-item  {{ (request()->is('user/riwayat-gaji-berkala*')) ? 'active' : '' }}">
              <a href="{{ route('riwayat-gaji-berkala.index') }}" class="d-flex align-items-center">
                <i data-feather="dollar-sign"></i>
                <span class="menu-title text-truncate">gaji berkala</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('user/riwayat-asesmen-kompetensi*')) ? 'active' : '' }}">
              <a href="{{ route('riwayat-asesmen-kompetensi.index') }}" class="d-flex align-items-center">
                <i data-feather="file-text"></i>
                <span class="menu-title text-truncate">asesmen kompetensi</span>
              </a>
            </li>
            <li class="nav-item  {{ (request()->is('user/riwayat-cuti*')) ? 'active' : '' }}">
              <a href="{{ route('riwayat-cuti.index') }}" class="d-flex align-items-center">
                <i data-feather="briefcase"></i>
                <span class="menu-title text-truncate">cuti</span>
              </a>
            </li>
            <li class="nav-item  {{ (request()->is('user/riwayat-pendidikan-dinas*')) ? 'active' : '' }}">
              <a href="{{ route('riwayat-pendidikan-dinas.index') }}" class="d-flex align-items-center">
                <i data-feather="award"></i>
                <span class="menu-title text-truncate">pendidikan dinas</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('user/riwayat-keluarga*')) ? 'active' : '' }}">
              <a href="{{ route('riwayat-keluarga.index') }}" class="d-flex align-items-center">
                <i data-feather="users"></i>
                <span class="menu-title text-truncate">keluarga</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('user/riwayat-pendidikan-formal*')) ? 'active' : '' }}">
              <a href="{{ route('riwayat-pendidikan-formal.index') }}" class="d-flex align-items-center">
                <i data-feather="award"></i>
                <span class="menu-title text-truncate">pendidikan formal</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('user/riwayat-pendidikan-non-formal*')) ? 'active' : '' }}">
              <a href="{{ route('riwayat-pendidikan-non-formal.index') }}" class="d-flex align-items-center">
                <i data-feather="award"></i>
                <span class="menu-title text-truncate">pendidikan non formal</span>
              </a>
            </li>
            <li class="nav-item {{ (request()->is('user/riwayat-penghargaan*')) ? 'active' : '' }}">
              <a href="{{ route('riwayat-penghargaan.index') }}" class="d-flex align-items-center">
                <i data-feather="award"></i>
                <span class="menu-title text-truncate">penghargaan</span>
              </a>
            </li>
            <li class="nav-item  {{ (request()->is('user/riwayat-tempat-tinggal*')) ? 'active' : '' }}">
              <a href="{{ route('riwayat-tempat-tinggal.index') }}" class="d-flex align-items-center">
                <i data-feather="home"></i>
                <span class="menu-title text-truncate">tempat tinggal</span>
              </a>
            </li>
            <li class="nav-item  {{ (request()->is('user/riwayat-asuransi*')) ? 'active' : '' }}">
              <a href="{{ route('riwayat-asuransi.index') }}" class="d-flex align-items-center">
                <i data-feather="file-text"></i>
                <span class="menu-title text-truncate">asuransi</span>
              </a>
            </li>
            <li class="nav-item  {{ (request()->is('user/riwayat-jabatan*')) ? 'active' : '' }}">
              <a href="{{ route('riwayat-jabatan.index') }}" class="d-flex align-items-center">
                <i data-feather="user"></i>
                <span class="menu-title text-truncate">jabatan</span>
              </a>
            </li>
            <li class="nav-item  {{ (request()->is('user/riwayat-kepangkatan*')) ? 'active' : '' }}">
              <a href="{{ route('riwayat-kepangkatan.index') }}" class="d-flex align-items-center">
                <i data-feather="user"></i>
                <span class="menu-title text-truncate">kepangkatan</span>
              </a>
            </li>
            <li class="nav-item  {{ (request()->is('user/riwayat-skp*')) ? 'active' : '' }}">
              <a href="{{ route('riwayat-skp.index') }}" class="d-flex align-items-center">
                <i data-feather="book"></i>
                <span class="menu-title text-truncate">skp</span>
              </a>
            </li>
            <li class="{{ (request()->is('user/user-profile*')) ? 'active' : '' }}">
              <a href="{{ route('user-profile.index') }}" class="d-flex align-items-center">
                <i data-feather="user"></i>
                <span class="menu-title text-truncate">Profil</span>
              </a>
            </li>
          @endif

          <li class=" nav-item">
            <a class="d-flex align-items-center"  href="javascript:void" onclick="$('#logout-form').submit();">
            <i data-feather="log-out"></i>
            <span class="menu-title text-truncate" data-i18n="Kanban">Logout</span>
          </a>
         
          </li>
        </ul>
      </div>
    </div>
    <!-- END: Main Menu-->
      <!-- BEGIN: Content-->
      <div class="app-content content ">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Ecommerce Starts -->
        <section id="app-content content">
          @yield('content')
        </section>
            <!-- Dashboard Ecommerce ends -->

        </div>
      </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2020<a class="ml-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    
    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->
    @stack('before-script')
    
    
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->
    
  
    @stack('after-script')
    </body>
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>
