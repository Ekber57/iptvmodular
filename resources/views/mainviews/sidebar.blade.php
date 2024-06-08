
@php
$links = new Modules\ModuleConf\Services\ModuleLinkService();
$modules = $links->getLinks();
@endphp
<!-- Page Sidebar Start -->
<!--================================-->
<div class="page-sidebar">
    <div class="logo">
        <a class="logo-img" href="index.html">
            <img class="desktop-logo" src="assets/images/logo.png" alt="">
            <img class="small-logo" src="assets/images/small-logo.png" alt="">
        </a>
        <a id="sidebar-toggle-button-close"><i class="wd-20" data-feather="x"></i> </a>
    </div>
    <!--================================-->
    <!-- Sidebar Menu Start -->
    <!--================================-->
    <div class="page-sidebar-inner">
        <div class="page-sidebar-menu">
            <ul class="accordion-menu">
                <li class="mg-l-20-force mg-t-25-force menu-navigation">Navigation</li>

                @foreach ($modules as $module)
                <li>
          
          

                        <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-git-pull-request"><circle cx="18" cy="18" r="3"></circle><circle cx="6" cy="6" r="3"></circle><path d="M13 6h3a2 2 0 0 1 2 2v7"></path><line x1="6" y1="9" x2="6" y2="21"></line></svg>
                            <span>  {{$module['name']}}</span><i class="accordion-icon fa fa-angle-left"></i></span><i class="accordion-icon fa fa-angle-left"></i></a>
                    <ul class="sub-menu">

                        @foreach ($module['links'] as $i => $link)

                             @can($link->permission) 
                                 <li><a href="{{ $link->url }}">{{ $link->title }}</a></li> 
                             @endcan 
                        @endforeach 
                        <li><a href="/reseller/packages/show">Paketler</a></li>

                    </ul>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!--/ Sidebar Menu End -->
    <!--================================-->
    <!-- Sidebar Footer Start -->
    <!--================================-->
    <div class="sidebar-footer">
        <a class="pull-left" href="pages-profile.html" data-toggle="tooltip" data-placement="top"
            data-original-title="Profile">
            <i data-feather="user" class="wd-16"></i></a>
        <a class="pull-left " href="mailbox.html" data-toggle="tooltip" data-placement="top"
            data-original-title="Mailbox">
            <i data-feather="mail" class="wd-16"></i></a>
        <a class="pull-left" href="aut-unlock.html" data-toggle="tooltip" data-placement="top"
            data-original-title="Lockscreen">
            <i data-feather="lock" class="wd-16"></i></a>
        <a class="pull-left" href="/logout" data-toggle="tooltip" data-placement="top" data-original-title="Sing Out">
            <i data-feather="log-out" class="wd-16"></i></a>
    </div>
    <!--/ Sidebar Footer End -->
</div>
<!--/ Page Sidebar End -->
