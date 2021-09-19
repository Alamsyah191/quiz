 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="index3.html" class="brand-link">
         <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">Ravens</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                     alt="User Image">
             </div>
             <div class="info">
                 <a href="#" class="d-block">{{ Auth::user()->name }}</a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 <li class="nav-item has-treeview menu-open">
                     <a href="#" class="nav-link active">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item">
                             <a href="{{ route('home') }}" class="nav-link active">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Home</p>
                             </a>
                         </li>



                     </ul>
                 </li>



                 <li class="nav-header">QUIZ</li>
                 <li class="nav-item">
                     <a href="{{ route('create') }}" class="nav-link">
                         <i class="nav-icon fas fa-th"></i>
                         <p>
                             Buat Quiz

                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('home') }}" class="nav-link">
                         <i class="nav-icon fas fa-th"></i>
                         <p>
                             Quiz
                             <span class="right badge badge-danger">{{ $quiz->count() }}</span>
                         </p>
                     </a>
                 </li>

                 <li class="nav-header">Pertanyaan</li>
                 <li class="nav-item">
                     <a href="{{ route('pertanyaan') }}" class="nav-link ">
                         <i class="nav-icon fas fa-th"></i>
                         <p>Soal
                             <span class="right badge badge-danger">{{ $pert->count() }}</span>
                         </p>

                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('created') }}" class="nav-link">
                         <i class="nav-icon fas fa-th"></i>
                         <p>
                             Buat Pertanyaan
                             <span class="right badge badge-danger">New</span>
                         </p>
                     </a>
                 </li>


                 <li class="nav-header">USER AREA</li>

                 <li class="nav-item">
                     <a href="{{ route('user') }}" class="nav-link">
                         <i class="nav-icon far fa-user"></i>
                         <p>
                             User
                             <span class="badge badge-info right">{{ Auth::user()->count() }}</span>
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="{{ route('exam.create') }}" class="nav-link">
                         <i class="nav-icon far fa-user"></i>
                         <p>
                             Assign

                         </p>
                     </a>
                 </li>

                 <li class="nav-item">
                     <a href="{{ route('result') }}" class="nav-link">
                         <i class="nav-icon far fa-user"></i>
                         <p>
                             Hasil

                         </p>
                     </a>
                 </li>


                 <li class="nav-item">
                     <a href="{{ route('exam') }}" class="nav-link">
                         <i class="nav-icon far fa-user"></i>
                         <p>
                             User Exam
                             <span class="badge badge-info right">{{ Auth::user()->count() }}</span>
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> <i
                             class="fas fa-power-off nav-icon"></i>
                         Keluar
                     </a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
                 </li>

                 <li class="nav-header">LABELS</li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon far fa-circle text-danger"></i>
                         <p class="text">Important</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon far fa-circle text-warning"></i>
                         <p>Warning</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon far fa-circle text-info"></i>
                         <p>Informational</p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
