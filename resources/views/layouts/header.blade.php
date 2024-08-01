  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav ">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     @php
       $count =   App\Models\ChatModel::getAllChatCount();
     @endphp

      <!-- Messages Dropdown Menu -->
      <li class="nav-item ">
        <a class="nav-link"  href="{{ url('chat') }}">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">{{ !empty($count)? $count : '' }}</span>
        </a>
      </li>
      <!-- Notifications Dropdown Menu -->
      {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
   
      --}}
    </ul>
  </nav>
  <!-- /.navbar -->

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:;" class="brand-link" style="text-align: center;">
      {{-- <span class="brand-text font-weight-bold">SIPADU</span> --}}
      <span class="brand-text font-weight-bold">AKADEMIK</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 ml-3 d-flex">
        <div class="image">
          <img src="{{ Auth::user()->getProfileDirect()}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

    

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if (Auth::user()->user_type == 1)
          <li class="nav-item">
            <a href="{{ url('admin/dashboard') }}"  class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                dashboard 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/admin/list') }}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
              <i class="nav-icon fa-solid fa-user-secret"></i>
              <p>
                Admin
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/student/list') }}" class="nav-link @if(Request::segment(2) == 'student') active @endif">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Student
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/parent/list') }}" class="nav-link @if(Request::segment(2) == 'parent') active @endif">
              <i class=" nav-icon fa-solid fa-user-astronaut"></i>
                            <p>
                Parent
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/dosen/list') }}" class="nav-link @if(Request::segment(2) == 'dosen') active @endif">
              <i class=" nav-icon fa-solid fa-user-tie"></i>
                            <p>
                Dosen
              </p>
            </a>
          </li>
          <li class="nav-item @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_class_dosen' || Request::segment(2) == 'class_timetable') menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link @if(Request::segment(2) == 'class' ||Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_class_dosen'|| Request::segment(2) == 'class_timetable') active @endif">
              <i class=" nav-icon fa-solid fa-book-open-reader"></i>
                            <p>
                Layanan Akademik
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                <a href="{{ url('admin/class/list') }}" class="nav-link @if(Request::segment(2) == 'class') active @endif" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/subject/list') }}" class="nav-link @if(Request::segment(2) == 'subject') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mata Kuliah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/assign_subject/list') }}" class="nav-link @if(Request::segment(2) == 'assign_subject') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kelas & Mata Kuliah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/class_timetable/list') }}" class="nav-link @if(Request::segment(2) == 'class_timetable') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal Kelas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/assign_class_dosen/list') }}" class="nav-link @if(Request::segment(2) == 'assign_class_dosen') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Kelas & Dosen</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item @if(Request::segment(2) == 'examinations' ||Request::segment(2) == 'exam_schedule') menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link @if(Request::segment(2) == 'examinations'||Request::segment(2) == 'exam_schedule' ||Request::segment(2) == 'exam_schedule') active @endif">
              <i class=" nav-icon fa-solid fa-pen-ruler"></i>
                                          <p>
                Ujian
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                <a href="{{ url('admin/examinations/exam/list') }}" class="nav-link @if(Request::segment(3) == 'exam') active @endif" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Ujian</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="{{ url('admin/examinations/exam_schedule') }}" class="nav-link @if(Request::segment(3) == 'exam_schedule') active @endif" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal Ujian</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item @if(Request::segment(2) == 'penilaian' ) menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link @if(Request::segment(2) == 'penilaian') active @endif">
              <i class="nav-icon fa-regular fa-square-check"></i>                                          <p>
                Penilaian
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                <a href="{{ url('admin/penilaian/list') }}" class="nav-link @if(Request::segment(3) == 'list') active @endif" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nilai</p>
                </a>
              </li>
           
              <li class="nav-item ">
                <a href="{{ url('admin/penilaian/mark_register') }}" class="nav-link @if(Request::segment(3) == 'mark_register') active @endif" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengelolaan Nilai</p>
                </a>
              </li>
           <li class="nav-item ">
                <a href="{{ url('admin/penilaian/mark_grade') }}" class="nav-link @if(Request::segment(3) == 'mark_grade') active @endif" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Grade Nilai</p>
                </a>
              </li>
            </ul>
          </li>
            
          {{-- <li class="nav-item @if(Request::segment(2) == 'tugas') menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link @if(Request::segment(2) == 'tugas') active @endif">
              <i class=" nav-icon fa fa-book"></i>
                            <p>
                Penugasan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                <a href="{{ url('admin/tugas/penugasan') }}" class="nav-link @if(Request::segment(3) == 'penugasan') active @endif" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tugas</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="{{ url('admin/tugas/penugasan_report') }}" class="nav-link @if(Request::segment(3) == 'penugasan_report') active @endif" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Tugas</p>
                </a>
              </li>
            </ul>
          </li> --}}
          <li class="nav-item @if(Request::segment(2) == 'presensi') menu-is-opening menu-open @endif ">
            <a href="#" class="nav-link @if(Request::segment(2) == 'presensi') active @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Presensi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                <a href="{{ url('admin/presensi/student') }}" class="nav-link @if(Request::segment(3) == 'student') active @endif" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Presensi Mahasiswa</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="{{ url('admin/presensi/dosen') }}" class="nav-link @if(Request::segment(3) == 'dosen') active @endif" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Presensi Dosen</p>
                </a>
              </li>
              <li class="nav-item ">
                <a href="{{ url('admin/presensi/report') }}" class="nav-link @if(Request::segment(3) == 'report') active @endif" >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Presensi</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item ">
            <a href="{{ url('admin/komunikasi/pengumuman') }}" class="nav-link @if(Request::segment(3) == 'pengumuman') active @endif" >
              <i class="nav-icon fa-regular fa-comment"></i>
              <p>Papan Pengumuman</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
              <i class="nav-icon fa-solid fa-gear"></i>
                            <p>
                Info Akun
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Ubah Password
              </p>
            </a>
          </li>
          @elseif (Auth::user()->user_type == 2)
          <li class="nav-item">
            <a href="{{ url('dosen/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('dosen/my_matkul') }}" class="nav-link @if(Request::segment(2) == 'my_matkul') active @endif">
              <i class=" nav-icon fa-solid fa-chalkboard-user"></i> 
                           <p>
                Kelas & Mata Kuliah
              </p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="{{ url('dosen/my_exam_timetable') }}" class="nav-link @if(Request::segment(2) == 'my_exam_timetable') active @endif">
              <i class="nav-icon fas fa-user"></i>
              <p>
                My Jadwal Ujian
              </p>
            </a>
          </li> --}}
          <li class="nav-item">
            <a href="{{ url('dosen/my_calendar') }}" class="nav-link @if(Request::segment(2) == 'my_calendar') active @endif">
              <i class="nav-icon fa-regular fa-calendar-days"></i>
                            <p>
                Jadwal Saya
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('dosen/mark_register') }}" class="nav-link @if(Request::segment(2) == 'mark_register') active @endif">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Pengelolaan Nilai
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('dosen/pengumuman') }}" class="nav-link @if(Request::segment(2) == 'pengumuman') active @endif">
              <i class="nav-icon fa-solid fa-clipboard"></i>
              <p>
               Pengumuman
              </p>
            </a>
          </li>

       
          <li class="nav-item ">
            <a href="{{ url('dosen/presensi/my_presensi') }}" class="nav-link @if(Request::segment(3) == 'report') active @endif" >
              <i class="nav-icon fas fa-table"></i>
              <p>Presensi</p>
            </a>
          </li>

          {{-- <li class="nav-item">
            <a href="{{ url('student/my_class_timetable') }}" class="nav-link @if(Request::segment(2) == 'my_class_timetable') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                My Class TimeTable
              </p>
            </a>
          </li> --}}
          {{-- <li class="nav-item">
            <a href="{{ url('dosen/my_student_list') }}" class="nav-link @if(Request::segment(2) == 'my_student_list') active @endif">
              <i class="nav-icon fas fa-user"></i>
              <p>
                My Student List
              </p>
            </a>
          </li> --}}
          <li class="nav-item ">
            <a href="{{ url('dosen/tugas/penugasan') }}" class="nav-link @if(Request::segment(3) == 'penugasan') active @endif" >
              <i class=" nav-icon fa fa-book"></i>
              <p>Penugasan Mahasiswa</p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{ url('dosen/tugas/materi') }}" class="nav-link @if(Request::segment(3) == 'materi') active @endif" >
              <i class="nav-icon fa-solid fa-receipt"></i>
              <p>Materi Perkuliahan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('dosen/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
              <i class="nav-icon fa-solid fa-gear"></i>
              <p>
                Info Akun
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('dosen/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Ubah Password
              </p>
            </a>
          </li>
          
          @elseif (Auth::user()->user_type == 3)
          <li class="nav-item">
            <a href="{{ url('student/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/my_class') }}" class="nav-link @if(Request::segment(2) == 'my_class') active @endif">
              <i class="nav-icon fa-solid fa-chalkboard-user"></i>
                            <p>
                Kelas Saya
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/my_calendar') }}" class="nav-link @if(Request::segment(2) == 'my_calendar') active @endif">
              <i class="nav-icon fa-regular fa-calendar-days"></i>
                            <p>
                Jadwal Saya
              </p>
            </a>
          </li>
          <li class="nav-item">
          <li class="nav-item">
            <a href="{{ url('student/my_exam_result') }}" class="nav-link @if(Request::segment(2) == 'my_exam_result') active @endif">
              <i class="nav-icon fa-solid fa-bars-progress"></i>
                            <p>
               Nilai
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/my_subject') }}" class="nav-link @if(Request::segment(2) == 'my_subject') active @endif">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Mata Kuliah
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/my_tugas') }}" class="nav-link @if(Request::segment(2) == 'my_tugas') active @endif">
              <i class=" nav-icon fa-solid fa-book-open"></i>
                            <p>
                Penugasan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/my_materi') }}" class="nav-link @if(Request::segment(2) == 'my_materi') active @endif">
              <i class="nav-icon fa-solid fa-receipt"></i>
                Materi Perkuliahan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/my_submited_tugas') }}" class="nav-link @if(Request::segment(2) == 'my_submited_tugas') active @endif">
              <i class="nav-icon fa-solid fa-book-atlas"></i>
                                          <p>
                My Submited Tugas
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/my_exam') }}" class="nav-link @if(Request::segment(2) == 'my_exam') active @endif">
              <i class="nav-icon fa-regular fa-calendar-check"></i>
                            <p>
                Jadwal Ujian
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/my_presensi') }}" class="nav-link @if(Request::segment(2) == 'my_presensi') active @endif">
              <i class="nav-icon fa-solid fa-user-pen"></i>
                            <p>
                Kehadiran 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/pengumuman') }}" class="nav-link @if(Request::segment(2) == 'pengumuman') active @endif">
              <i class="nav-icon fa-solid fa-clipboard"></i>
              <p>
               Pengumuman
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
              <i class="nav-icon fa-solid fa-gear"></i>
              <p>
                My Account
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Ubah Password
              </p>
            </a>
          </li>
          @elseif (Auth::user()->user_type == 4)
          {{-- <li class="nav-item">
            <a href="{{ url('ortu/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                dashboard
              </p>
            </a>
          </li> --}}
         
          <li class="nav-item">
            <a href="{{ url('ortu/my_student') }}" class="nav-link @if(Request::segment(2) == 'my_student') active @endif">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Data Anak
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('ortu/pengumuman') }}" class="nav-link @if(Request::segment(2) == 'pengumuman') active @endif">
              <i class="nav-icon fa-solid fa-clipboard"></i>
                            <p>
               Pengumuman
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('ortu/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
              <i class="nav-icon fa-solid fa-gear"></i>
              <p>
                Info Akun
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('ortu/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Ubah Password
              </p>
            </a>
          </li>
          @endif
          
          <li class="nav-item">
            <a href="{{ url('logout') }}" class="nav-link">
              <i class=" nav-icon fa-solid fa-right-from-bracket"></i>
                <p>
                logout
              </p>
            </a>
          </li>
         
       
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>