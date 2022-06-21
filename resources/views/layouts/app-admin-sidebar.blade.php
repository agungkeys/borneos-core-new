<div class="scrollbar-sidebar" style="overflow: scroll;">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Menu</li>
            <li>
              <a href="/admin" class="admin {{ count(request()->segments()) == 1 && request()->segments()[0] == 'admin' ? 'mm-active' : '' }}"><i class="metismenu-icon pe-7s-rocket"></i>Dashboards</a>
            </li>
            <li class="app-sidebar__heading">Orders</li>
            <li>
              <a class="new" href="#"><i class="metismenu-icon pe-7s-download"></i>New</a>
            </li>
            <li>
              <a class="processing" href="#"><i class="metismenu-icon pe-7s-hourglass"></i>Processing</a>
            </li>
            <li>
              <a class="otw" href="#"><i class="metismenu-icon pe-7s-bicycle"></i>Product OTW</a>
            </li>
            <li>
              <a class="delivered" href="#"><i class="metismenu-icon pe-7s-cup"></i>Delivered</a>
            </li>
            <li>
              <a class="canceled" href="#"><i class="metismenu-icon pe-7s-close"></i>Canceled</a>
            </li>
            <li>
              <a class="all" href="#"><i class="metismenu-icon pe-7s-news-paper"></i>All</a>
            </li>
            <li class="app-sidebar__heading">Master Data</li>
            <li class="{{ count(request()->segments()) > 1 && request()->segments()[1] === 'master-category' || count(request()->segments()) > 1 && request()->segments()[1] === 'master-sub-category' || count(request()->segments()) > 1 && request()->segments()[1] === 'master-sub-sub-category' ? 'mm-active' : '' }}">
              <a href="#"><i class="metismenu-icon pe-7s-server"></i>Master Category<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
              <ul>
                  <li>
                    <a class="master-category {{ count(request()->segments()) > 1 && request()->segments()[1] == 'master-category' ? 'mm-active' : '' }}" href="{{ route('admin.master-category') }}"><i class="metismenu-icon pe-7s-server"></i>Category</a>
                  </li>
                  <li>
                    <a class="master-sub-category {{ count(request()->segments()) > 1 && request()->segments()[1] == 'master-sub-category' ? 'mm-active' : '' }}" href="{{ route('admin.master-sub-category') }}"><i class="metismenu-icon pe-7s-server"></i>Sub Category</a>
                  </li>
                  <li>
                    <a class="master-sub-sub-category {{ count(request()->segments()) > 1 && request()->segments()[1] == 'master-sub-sub-category' ? 'mm-active' : '' }}" href="{{ route('admin.master-sub-sub-category') }}"><i class="metismenu-icon pe-7s-server"></i>Sub Sub Category</a>
                  </li>
              </ul>
            </li>
            <li>
              <a class="merchant" href="#"><i class="metismenu-icon pe-7s-home"></i>Merchant</a>
            </li>
            <li>
              <a class="master-product {{ count(request()->segments()) > 1 && request()->segments()[1] == 'master-product' ? 'mm-active' : '' }}" href="{{ route('admin.master-product') }}"><i class="metismenu-icon pe-7s-box2"></i>Product</a>
            </li>
            <li>
              <a class="master-courier {{ count(request()->segments()) > 1 && request()->segments()[1] == 'courier' ? 'mm-active' : '' }}" href="{{ route('admin.courier.index') }}" ><i class="metismenu-icon pe-7s-users"></i>User Courier</a>
            </li>
            <li>
              <a class="master-admin {{ count(request()->segments()) > 1 && request()->segments()[1] == 'master-admin' ? 'mm-active' : '' }}" href="{{ route('admin.master-user') }}" ><i class="metismenu-icon pe-7s-users"></i>User Admin</a>
            </li>
            <li class="app-sidebar__heading">Marketing</li>

            <li>
              <a class="bannners {{ count(request()->segments()) > 1 && request()->segments()[1] == 'banner' ? 'mm-active' : '' }}" href="{{ route('admin.banner.index') }}"><i class="metismenu-icon pe-7s-photo-gallery"></i>Banners</a>
            </li>
            <li>
              <a class="coupons {{ count(request()->segments()) > 1 && request()->segments()[1] == 'coupon' ? 'mm-active' : '' }}" href="{{ route('admin.coupon.index') }}"><i class="metismenu-icon pe-7s-ticket"></i>Coupons</a>
            </li>
            <li class="app-sidebar__heading">Business</li>
            <li>
              <a class="tacs {{ count(request()->segments()) > 1 && request()->segments()[1] == 'master-tac' ? 'mm-active' : '' }}" href="{{ route('admin.master-tac') }}"><i class="metismenu-icon pe-7s-ticket"></i>Terms and Conditions</a>
            </li>
            <li>
              <a class="privacy-policy" href="#"><i class="metismenu-icon pe-7s-attention"></i>Privacy Policy</a>
            </li>
            <li>
              <a class="faq" href="#"><i class="metismenu-icon pe-7s-help1"></i>FAQ</a>
            </li>
            <li>
              <a class="about-us" href="#"><i class="metismenu-icon pe-7s-info"></i>About Us</a>
            </li>
        </ul>
    </div>
</div>
