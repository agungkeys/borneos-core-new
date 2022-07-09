<div class="scrollbar-sidebar" style="overflow: scroll;">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Menu</li>
            <li>
              <a href="/merchant" class="admin {{ count(request()->segments()) == 1 && request()->segments()[0] == 'admin' ? 'mm-active' : '' }}"><i class="metismenu-icon pe-7s-rocket"></i>Dashboards</a>
            </li>
            <li>
              <a class="all" href="#"><i class="metismenu-icon pe-7s-news-paper"></i>Pesanan</a>
            </li>
            <li>
              <a class="all" href="#"><i class="metismenu-icon pe-7s-user"></i>Profil Saya</a>
            </li>
            <li>
              <a class="all" href="#"><i class="metismenu-icon pe-7s-help1"></i>Seputar Pertanyaan</a>
            </li>
            <li class="app-sidebar__heading pt-2"></li>
            <li>
              <a class="all" href="#"><i class="metismenu-icon pe-7s-power"></i>Keluar</a>
            </li>
        </ul>
    </div>
</div>
