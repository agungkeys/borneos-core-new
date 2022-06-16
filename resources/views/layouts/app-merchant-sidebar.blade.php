<div class="scrollbar-sidebar" style="overflow: scroll;">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Menu</li>
            <li>
              <a href="/admin" class="admin {{ count(request()->segments()) == 1 && request()->segments()[0] == 'admin' ? 'mm-active' : '' }}"><i class="metismenu-icon pe-7s-rocket"></i>Dashboards</a>
            </li>
            <li class="app-sidebar__heading">Orders</li>
            <li>
              <a class="all" href="#"><i class="metismenu-icon pe-7s-news-paper"></i>All</a>
            </li>
            <li class="app-sidebar__heading">Master Data</li>
            <li>
              <a class="merchant" href="#"><i class="metismenu-icon pe-7s-home"></i>Merchant</a>
            </li>
            <li>
              <a class="master-product {{ count(request()->segments()) > 1 && request()->segments()[1] == 'master-product' ? 'mm-active' : '' }}" href="{{ route('admin.master-product') }}"><i class="metismenu-icon pe-7s-box2"></i>Product</a>
            </li>
            <li class="app-sidebar__heading">Marketing</li>

            <li>
              <a class="bannners {{ count(request()->segments()) > 1 && request()->segments()[1] == 'banner' ? 'mm-active' : '' }}" href="{{ route('admin.banner.index') }}"><i class="metismenu-icon pe-7s-photo-gallery"></i>Banners</a>
            </li>
            <li>
              <a class="coupons {{ count(request()->segments()) > 1 && request()->segments()[1] == 'coupon' ? 'mm-active' : '' }}" href="{{ route('admin.coupon.index') }}"><i class="metismenu-icon pe-7s-ticket"></i>Coupons</a>
            </li>
        </ul>
    </div>
</div>
