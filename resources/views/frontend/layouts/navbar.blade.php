 <!--==========================
        TOPBAR PART START
    ===========================-->
 <section id="wsus__topbar">
     <div class="container">
         <div class="row">
             <div class="col-xl-6 col-md-7 d-none d-md-block">
                 <ul class="wsus__topbar_left">
                     <li><a href="mailto:support@websolutionus.com"><i class="fal fa-envelope"></i>
                             @gmail.com</a></li>
                     <li><a href="callto:+6958474522655"><i class="fal fa-phone-alt"></i>+6958474522655</a></li>
                 </ul>
             </div>
             <div class="col-xl-6 col-md-5">
                 <div class="wsus__topbar_right">
                     <a href="{{ route('login') }}"><i class="fas fa-user"></i> Login</a>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!--==========================
        TOPBAR PART END
    ===========================-->


 <!--==========================
        MENU PART START
    ===========================-->
 <nav class="navbar navbar-expand-lg main_menu">
     <div class="container">
         <a class="navbar-brand" href="index.html">
             <img src="images/logo.png" alt="DB.Card">
         </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
             data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
             aria-label="Toggle navigation">
             <i class="far fa-bars"></i>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav m-auto">
                 @foreach (Menu::getByName('Main Menu') as $menu)
                     <li class="nav-item">
                         <a class="nav-link" href="{{ $menu['link'] }}">{{ $menu['label'] }}
                             @if ($menu['child'])
                                 <i class="far fa-chevron-down"></i>
                             @endif
                         </a>
                         @if ($menu['child'])
                             <ul class="menu_droapdown">
                                 @foreach ($menu['child'] as $child)
                                     <li><a href="{{ $child['link'] }}">{{ $child['label'] }}</a></li>
                                 @endforeach
                             </ul>
                         @endif
                     </li>
                 @endforeach


             </ul>
             <a class="user_btn" href="dsahboard.html"><i class="far fa-plus"></i> add listing</a>
         </div>
     </div>
 </nav>
 <!--==========================
        MENU PART END
    ===========================-->
