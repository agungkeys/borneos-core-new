<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Borneos Admin Management - Dari Borneos Untuk UKM Indonesia</title>

  <!-- Scripts -->

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
  <div id="app">
    <body>
      <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <div class="app-header header-shadow">
          <div class="app-header__logo">
            <div class="logo-src"></div>
            <div class="header__pane ml-auto">
              <div><button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button></div>
            </div>
          </div>
          <div class="app-header__mobile-menu">
            <div><button type="button" class="hamburger hamburger--elastic mobile-toggle-nav"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button></div>
          </div>
          <div class="app-header__menu"><span><button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav"><span class="btn-icon-wrapper"><i class="fa fa-ellipsis-v fa-w-6"></i></span></button></span></div>
          <div class="app-header__content">
            <div class="app-header-left"></div>

            <div class="app-header-right">
              <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                  <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                      <div class="btn-group"><a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn"><img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg" alt=""><i class="fa fa-angle-down ml-2 opacity-8"></i></a>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                          <div class="dropdown-menu-header">
                            <div class="dropdown-menu-header-inner bg-info">
                              <div class="menu-header-image opacity-2" style="background-image: url('assets/images/dropdown-header/city3.jpg');"></div>
                              <div class="menu-header-content text-left">
                                <div class="widget-content p-0">
                                  <div class="widget-content-wrapper">
                                    <div class="widget-content-left mr-3"><img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg" alt=""></div>
                                    <div class="widget-content-left">
                                      <div class="widget-heading">Agung Kurniawan</div>
                                      <div class="widget-subheading opacity-8">A short profile description</div>
                                    </div>
                                    <div class="widget-content-right mr-2"><a href="{{ route('admin.auth.logout') }}" class="btn-pill btn-shadow btn-shine btn btn-focus">Logout</a></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="widget-content-left  ml-3 header-user-info">
                      <div class="widget-heading"> Alina Mclourd </div>
                      <div class="widget-subheading"> VP People Manager </div>
                    </div>
                    <!-- <div class="widget-content-right header-user-info ml-3"><button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example"><i class="fa text-white fa-calendar pr-1 pl-1"></i></button></div> -->
                  </div>
                </div>
              </div>
              <!-- <div class="header-btn-lg"><button type="button" class="hamburger hamburger--elastic open-right-drawer"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button></div> -->
            </div>
          </div>
        </div>

        <div class="app-main">
          <div class="app-sidebar sidebar-shadow">
            <div class="app-header__logo">
              <div class="logo-src"></div>
              <div class="header__pane ml-auto">
                <div><button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button></div>
              </div>
            </div>
            <div class="app-header__mobile-menu">
              <div><button type="button" class="hamburger hamburger--elastic mobile-toggle-nav"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button></div>
            </div>
            <div class="app-header__menu"><span><button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav"><span class="btn-icon-wrapper"><i class="fa fa-ellipsis-v fa-w-6"></i></span></button></span></div>
            <!-- SIDEBAR MENU START -->
            <div class="scrollbar-sidebar">
              <div class="app-sidebar__inner">
                <ul class="vertical-nav-menu">
                  <li class="app-sidebar__heading">Menu Sidebar</li>
                  <li><a href="#"><i class="metismenu-icon pe-7s-rocket"></i>Dashboards <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                    <ul>
                      <li><a href="index.html"><i class="metismenu-icon"></i>Analytics </a></li>
                      <li><a href="dashboards-commerce.html"><i class="metismenu-icon"></i>Commerce </a></li>
                      <li><a href="dashboards-sales.html"><i class="metismenu-icon"></i>Sales </a></li>
                      <li><a href="#"><i class="metismenu-icon"></i> Minimal <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                        <ul>
                          <li><a href="dashboards-minimal-1.html"><i class="metismenu-icon"></i>Variation 1 </a></li>
                          <li><a href="dashboards-minimal-2.html"><i class="metismenu-icon"></i>Variation 2 </a></li>
                        </ul>
                      </li>
                      <li><a href="dashboards-crm.html"><i class="metismenu-icon"></i> CRM </a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="metismenu-icon pe-7s-browser"></i>Pages <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                    <ul>
                      <li><a href="pages-login.html"><i class="metismenu-icon"></i> Login </a></li>
                      <li><a href="pages-login-boxed.html"><i class="metismenu-icon"></i>Login Boxed </a></li>
                      <li><a href="pages-register.html"><i class="metismenu-icon"></i>Register </a></li>
                      <li><a href="pages-register-boxed.html"><i class="metismenu-icon"></i>Register Boxed </a></li>
                      <li><a href="pages-forgot-password.html"><i class="metismenu-icon"></i>Forgot Password </a></li>
                      <li><a href="pages-forgot-password-boxed.html"><i class="metismenu-icon"></i>Forgot Password Boxed </a></li>
                    </ul>
                  </li>
                  <li class="mm-active"><a href="#"><i class="metismenu-icon pe-7s-plugin"></i>Applications <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                    <ul class="mm-show">
                      <li><a href="apps-mailbox.html"><i class="metismenu-icon"></i>Mailbox </a></li>
                      <li><a href="apps-chat.html" class="mm-active"><i class="metismenu-icon"></i>Chat </a></li>
                      <li><a href="apps-faq-section.html"><i class="metismenu-icon"></i>FAQ Section </a></li>
                      <li><a href="#"><i class="metismenu-icon"></i>Forums <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                        <ul>
                          <li><a href="apps-forum-list.html"><i class="metismenu-icon"></i>Forum Listing </a></li>
                          <li><a href="apps-forum-threads.html"><i class="metismenu-icon"></i>Forum Threads </a></li>
                          <li><a href="apps-forum-discussion.html"><i class="metismenu-icon"></i>Forum Discussion </a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="app-sidebar__heading">UI Components</li>
                  <li><a href="#"><i class="metismenu-icon pe-7s-diamond"></i> Elements <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                    <ul>
                      <li><a href="#"><i class="metismenu-icon"></i> Buttons <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                        <ul>
                          <li><a href="elements-buttons-standard.html"><i class="metismenu-icon"></i>Standard </a></li>
                          <li><a href="elements-buttons-pills.html"><i class="metismenu-icon"></i>Pills </a></li>
                          <li><a href="elements-buttons-square.html"><i class="metismenu-icon"></i>Square </a></li>
                          <li><a href="elements-buttons-shadow.html"><i class="metismenu-icon"></i>Shadow </a></li>
                          <li><a href="elements-buttons-icons.html"><i class="metismenu-icon"></i>With Icons </a></li>
                        </ul>
                      </li>
                      <li><a href="elements-dropdowns.html"><i class="metismenu-icon"></i>Dropdowns </a></li>
                      <li><a href="elements-icons.html"><i class="metismenu-icon"></i>Icons </a></li>
                      <li><a href="elements-badges-labels.html"><i class="metismenu-icon"></i>Badges </a></li>
                      <li><a href="elements-cards.html"><i class="metismenu-icon"></i>Cards </a></li>
                      <li><a href="elements-loaders.html"><i class="metismenu-icon"></i>Loading Indicators </a></li>
                      <li><a href="elements-list-group.html"><i class="metismenu-icon"></i>List Groups </a></li>
                      <li><a href="elements-navigation.html"><i class="metismenu-icon"></i>Navigation Menus </a></li>
                      <li><a href="elements-timelines.html"><i class="metismenu-icon"></i>Timeline </a></li>
                      <li><a href="elements-utilities.html"><i class="metismenu-icon"></i>Utilities </a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="metismenu-icon pe-7s-car"></i> Components <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                    <ul>
                      <li><a href="components-tabs.html"><i class="metismenu-icon"></i>Tabs </a></li>
                      <li><a href="components-accordions.html"><i class="metismenu-icon"></i>Accordions </a></li>
                      <li><a href="components-notifications.html"><i class="metismenu-icon"></i>Notifications </a></li>
                      <li><a href="components-modals.html"><i class="metismenu-icon"></i>Modals </a></li>
                      <li><a href="components-loading-blocks.html"><i class="metismenu-icon"></i>Loading Blockers </a></li>
                      <li><a href="components-progress-bar.html"><i class="metismenu-icon"></i>Progress Bar </a></li>
                      <li><a href="components-tooltips-popovers.html"><i class="metismenu-icon"></i>Tooltips &amp; Popovers </a></li>
                      <li><a href="components-carousel.html"><i class="metismenu-icon"></i>Carousel </a></li>
                      <li><a href="components-calendar.html"><i class="metismenu-icon"></i>Calendar </a></li>
                      <li><a href="components-pagination.html"><i class="metismenu-icon"></i>Pagination </a></li>
                      <li><a href="components-count-up.html"><i class="metismenu-icon"></i>Count Up </a></li>
                      <li><a href="components-scrollable-elements.html"><i class="metismenu-icon"></i>Scrollable </a></li>
                      <li><a href="components-tree-view.html"><i class="metismenu-icon"></i>Tree View </a></li>
                      <li><a href="components-maps.html"><i class="metismenu-icon"></i>Maps </a></li>
                      <li><a href="components-ratings.html"><i class="metismenu-icon"></i>Ratings </a></li>
                      <li><a href="components-image-crop.html"><i class="metismenu-icon"></i>Image Crop </a></li>
                      <li><a href="components-guided-tours.html"><i class="metismenu-icon"></i>Guided Tours </a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="metismenu-icon pe-7s-display2"></i> Tables <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                    <ul>
                      <li><a href="tables-data-tables.html"><i class="metismenu-icon"></i>Data Tables </a></li>
                      <li><a href="tables-regular.html"><i class="metismenu-icon"></i>Regular Tables </a></li>
                      <li><a href="tables-grid.html"><i class="metismenu-icon"></i>Grid Tables </a></li>
                    </ul>
                  </li>
                  <li class="app-sidebar__heading">Dashboard Widgets</li>
                  <li><a href="widgets-chart-boxes.html"><i class="metismenu-icon pe-7s-graph"></i>Chart Boxes 1 </a></li>
                  <li><a href="widgets-chart-boxes-2.html"><i class="metismenu-icon pe-7s-way"></i>Chart Boxes 2 </a></li>
                  <li><a href="widgets-chart-boxes-3.html"><i class="metismenu-icon pe-7s-ball"></i>Chart Boxes 3 </a></li>
                  <li><a href="widgets-profile-boxes.html"><i class="metismenu-icon pe-7s-id"></i>Profile Boxes </a></li>
                  <li class="app-sidebar__heading">Forms</li>
                  <li><a href="#"><i class="metismenu-icon pe-7s-light"></i> Elements <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                    <ul>
                      <li><a href="forms-controls.html"><i class="metismenu-icon"></i>Controls </a></li>
                      <li><a href="forms-layouts.html"><i class="metismenu-icon"></i>Layouts </a></li>
                      <li><a href="forms-validation.html"><i class="metismenu-icon"></i>Validation </a></li>
                      <li><a href="forms-wizard.html"><i class="metismenu-icon"></i>Wizard </a></li>
                    </ul>
                  </li>
                  <li><a href="#"><i class="metismenu-icon pe-7s-joy"></i> Widgets <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                    <ul>
                      <li><a href="forms-datepicker.html"><i class="metismenu-icon"></i>Datepicker </a></li>
                      <li><a href="forms-range-slider.html"><i class="metismenu-icon"></i>Range Slider </a></li>
                      <li><a href="forms-input-selects.html"><i class="metismenu-icon"></i>Input Selects </a></li>
                      <li><a href="forms-toggle-switch.html"><i class="metismenu-icon"></i>Toggle Switch </a></li>
                      <li><a href="forms-wysiwyg-editor.html"><i class="metismenu-icon"></i>WYSIWYG Editor </a></li>
                      <li><a href="forms-input-mask.html"><i class="metismenu-icon"></i>Input Mask </a></li>
                      <li><a href="forms-clipboard.html"><i class="metismenu-icon"></i>Clipboard </a></li>
                      <li><a href="forms-textarea-autosize.html"><i class="metismenu-icon"></i>Textarea Autosize </a></li>
                    </ul>
                  </li>
                  <li class="app-sidebar__heading">Charts</li>
                  <li><a href="charts-chartjs.html"><i class="metismenu-icon pe-7s-graph2"></i>ChartJS </a></li>
                  <li><a href="charts-apexcharts.html"><i class="metismenu-icon pe-7s-graph"></i>Apex Charts </a></li>
                  <li><a href="charts-sparklines.html"><i class="metismenu-icon pe-7s-graph1"></i>Chart Sparklines </a></li>
                </ul>
              </div>
            </div>
            <!-- SIDEBAR MENU END -->
          </div>

          <div class="app-main__outer">
            @yield('content')
          </div>
        </div>
      </div>

      <div class="app-drawer-wrapper">
        <div class="drawer-nav-btn"><button type="button" class="hamburger hamburger--elastic is-active"><span class="hamburger-box"><span class="hamburger-inner"></span></span></button></div>
        <div class="drawer-content-wrapper">
          <div class="scrollbar-container">
            <h3 class="drawer-heading">Servers Status</h3>
            <div class="drawer-section">
              <div class="row">
                <div class="col">
                  <div class="progress-box">
                    <h4>Server Load 1</h4>
                    <div class="circle-progress circle-progress-gradient-xl mx-auto"><small></small></div>
                  </div>
                </div>
                <div class="col">
                  <div class="progress-box">
                    <h4>Server Load 2</h4>
                    <div class="circle-progress circle-progress-success-xl mx-auto"><small></small></div>
                  </div>
                </div>
                <div class="col">
                  <div class="progress-box">
                    <h4>Server Load 3</h4>
                    <div class="circle-progress circle-progress-danger-xl mx-auto"><small></small></div>
                  </div>
                </div>
              </div>
              <div class="divider"></div>
              <div class="mt-3">
                <h5 class="text-center card-title">Live Statistics</h5>
                <div id="sparkline-carousel-3"></div>
                <div class="row">
                  <div class="col">
                    <div class="widget-chart p-0">
                      <div class="widget-chart-content">
                        <div class="widget-numbers text-warning fsize-3">43</div>
                        <div class="widget-subheading pt-1">Packages</div>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="widget-chart p-0">
                      <div class="widget-chart-content">
                        <div class="widget-numbers text-danger fsize-3">65</div>
                        <div class="widget-subheading pt-1">Dropped</div>
                      </div>
                    </div>
                  </div>
                  <div class="col">
                    <div class="widget-chart p-0">
                      <div class="widget-chart-content">
                        <div class="widget-numbers text-success fsize-3">18</div>
                        <div class="widget-subheading pt-1">Invalid</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="divider"></div>
                <div class="text-center mt-2 d-block"><button class="mr-2 border-0 btn-transition btn btn-outline-danger">Escalate Issue</button><button class="border-0 btn-transition btn btn-outline-success">Support Center</button></div>
              </div>
            </div>
            <h3 class="drawer-heading">File Transfers</h3>
            <div class="drawer-section p-0">
              <div class="files-box">
                <ul class="list-group list-group-flush">
                  <li class="pt-2 pb-2 pr-2 list-group-item">
                    <div class="widget-content p-0">
                      <div class="widget-content-wrapper">
                        <div class="widget-content-left opacity-6 fsize-2 mr-3 text-primary center-elem"><i class="fa fa-file-alt"></i></div>
                        <div class="widget-content-left">
                          <div class="widget-heading font-weight-normal">TPSReport.docx</div>
                        </div>
                        <div class="widget-content-right widget-content-actions"><button class="btn-icon btn-icon-only btn btn-link btn-sm"><i class="fa fa-cloud-download-alt"></i></button></div>
                      </div>
                    </div>
                  </li>
                  <li class="pt-2 pb-2 pr-2 list-group-item">
                    <div class="widget-content p-0">
                      <div class="widget-content-wrapper">
                        <div class="widget-content-left opacity-6 fsize-2 mr-3 text-warning center-elem"><i class="fa fa-file-archive"></i></div>
                        <div class="widget-content-left">
                          <div class="widget-heading font-weight-normal">Latest_photos.zip</div>
                        </div>
                        <div class="widget-content-right widget-content-actions"><button class="btn-icon btn-icon-only btn btn-link btn-sm"><i class="fa fa-cloud-download-alt"></i></button></div>
                      </div>
                    </div>
                  </li>
                  <li class="pt-2 pb-2 pr-2 list-group-item">
                    <div class="widget-content p-0">
                      <div class="widget-content-wrapper">
                        <div class="widget-content-left opacity-6 fsize-2 mr-3 text-danger center-elem"><i class="fa fa-file-pdf"></i></div>
                        <div class="widget-content-left">
                          <div class="widget-heading font-weight-normal">Annual Revenue.pdf</div>
                        </div>
                        <div class="widget-content-right widget-content-actions"><button class="btn-icon btn-icon-only btn btn-link btn-sm"><i class="fa fa-cloud-download-alt"></i></button></div>
                      </div>
                    </div>
                  </li>
                  <li class="pt-2 pb-2 pr-2 list-group-item">
                    <div class="widget-content p-0">
                      <div class="widget-content-wrapper">
                        <div class="widget-content-left opacity-6 fsize-2 mr-3 text-success center-elem"><i class="fa fa-file-excel"></i></div>
                        <div class="widget-content-left">
                          <div class="widget-heading font-weight-normal">Analytics_GrowthReport.xls</div>
                        </div>
                        <div class="widget-content-right widget-content-actions"><button class="btn-icon btn-icon-only btn btn-link btn-sm"><i class="fa fa-cloud-download-alt"></i></button></div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <h3 class="drawer-heading">Tasks in Progress</h3>
            <div class="drawer-section p-0">
              <div class="todo-box">
                <ul class="todo-list-wrapper list-group list-group-flush">
                  <li class="list-group-item">
                    <div class="todo-indicator bg-warning"></div>
                    <div class="widget-content p-0">
                      <div class="widget-content-wrapper">
                        <div class="widget-content-left mr-2">
                          <div class="custom-checkbox custom-control"><input type="checkbox" id="exampleCustomCheckbox1266" class="custom-control-input"><label class="custom-control-label" for="exampleCustomCheckbox1266">&nbsp;</label></div>
                        </div>
                        <div class="widget-content-left">
                          <div class="widget-heading">Wash the car <div class="badge badge-danger ml-2">Rejected</div>
                          </div>
                          <div class="widget-subheading"><i>Written by Bob</i></div>
                        </div>
                        <div class="widget-content-right widget-content-actions"><button class="border-0 btn-transition btn btn-outline-success"><i class="fa fa-check"></i></button><button class="border-0 btn-transition btn btn-outline-danger"><i class="fa fa-trash-alt"></i></button></div>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="todo-indicator bg-focus"></div>
                    <div class="widget-content p-0">
                      <div class="widget-content-wrapper">
                        <div class="widget-content-left mr-2">
                          <div class="custom-checkbox custom-control"><input type="checkbox" id="exampleCustomCheckbox1666" class="custom-control-input"><label class="custom-control-label" for="exampleCustomCheckbox1666">&nbsp;</label></div>
                        </div>
                        <div class="widget-content-left">
                          <div class="widget-heading">Task with hover dropdown menu</div>
                          <div class="widget-subheading">
                            <div>By Johnny <div class="badge badge-pill badge-info ml-2">NEW</div>
                            </div>
                          </div>
                        </div>
                        <div class="widget-content-right widget-content-actions">
                          <div class="d-inline-block dropdown"><button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="border-0 btn-transition btn btn-link"><i class="fa fa-ellipsis-h"></i></button>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                              <h6 tabindex="-1" class="dropdown-header">Header</h6><button type="button" disabled="" tabindex="-1" class="disabled dropdown-item">Action</button><button type="button" tabindex="0" class="dropdown-item">Another Action</button>
                              <div tabindex="-1" class="dropdown-divider"></div><button type="button" tabindex="0" class="dropdown-item">Another Action</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="todo-indicator bg-primary"></div>
                    <div class="widget-content p-0">
                      <div class="widget-content-wrapper">
                        <div class="widget-content-left mr-2">
                          <div class="custom-checkbox custom-control"><input type="checkbox" id="exampleCustomCheckbox4777" class="custom-control-input"><label class="custom-control-label" for="exampleCustomCheckbox4777">&nbsp;</label></div>
                        </div>
                        <div class="widget-content-left flex2">
                          <div class="widget-heading">Badge on the right task</div>
                          <div class="widget-subheading">This task has show on hover actions!</div>
                        </div>
                        <div class="widget-content-right widget-content-actions"><button class="border-0 btn-transition btn btn-outline-success"><i class="fa fa-check"></i></button></div>
                        <div class="widget-content-right ml-3">
                          <div class="badge badge-pill badge-success">Latest Task</div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="todo-indicator bg-info"></div>
                    <div class="widget-content p-0">
                      <div class="widget-content-wrapper">
                        <div class="widget-content-left mr-2">
                          <div class="custom-checkbox custom-control"><input type="checkbox" id="exampleCustomCheckbox2444" class="custom-control-input"><label class="custom-control-label" for="exampleCustomCheckbox2444">&nbsp;</label></div>
                        </div>
                        <div class="widget-content-left mr-3">
                          <div class="widget-content-left"><img width="42" class="rounded" src="assets/images/avatars/1.jpg" alt="" /></div>
                        </div>
                        <div class="widget-content-left">
                          <div class="widget-heading">Go grocery shopping</div>
                          <div class="widget-subheading">A short description ...</div>
                        </div>
                        <div class="widget-content-right widget-content-actions"><button class="border-0 btn-transition btn btn-sm btn-outline-success"><i class="fa fa-check"></i></button><button class="border-0 btn-transition btn btn-sm btn-outline-danger"><i class="fa fa-trash-alt"></i></button></div>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item">
                    <div class="todo-indicator bg-success"></div>
                    <div class="widget-content p-0">
                      <div class="widget-content-wrapper">
                        <div class="widget-content-left mr-2">
                          <div class="custom-checkbox custom-control"><input type="checkbox" id="exampleCustomCheckbox3222" class="custom-control-input"><label class="custom-control-label" for="exampleCustomCheckbox3222">&nbsp;</label></div>
                        </div>
                        <div class="widget-content-left flex2">
                          <div class="widget-heading">Development Task</div>
                          <div class="widget-subheading">Finish React ToDo List App</div>
                        </div>
                        <div class="widget-content-right">
                          <div class="badge badge-warning mr-2">69</div>
                        </div>
                        <div class="widget-content-right"><button class="border-0 btn-transition btn btn-outline-success"><i class="fa fa-check"></i></button><button class="border-0 btn-transition btn btn-outline-danger"><i class="fa fa-trash-alt"></i></button></div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <h3 class="drawer-heading">Urgent Notifications</h3>
            <div class="drawer-section">
              <div class="notifications-box">
                <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                  <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                    <div><span class="vertical-timeline-element-icon bounce-in"></span>
                      <div class="vertical-timeline-element-content bounce-in">
                        <h4 class="timeline-title">All Hands Meeting</h4><span class="vertical-timeline-element-date"></span>
                      </div>
                    </div>
                  </div>
                  <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                    <div><span class="vertical-timeline-element-icon bounce-in"></span>
                      <div class="vertical-timeline-element-content bounce-in">
                        <p>Yet another one, at <span class="text-success">15:00 PM</span></p><span class="vertical-timeline-element-date"></span>
                      </div>
                    </div>
                  </div>
                  <div class="vertical-timeline-item dot-success vertical-timeline-element">
                    <div><span class="vertical-timeline-element-icon bounce-in"></span>
                      <div class="vertical-timeline-element-content bounce-in">
                        <h4 class="timeline-title">Build the production release <div class="badge badge-danger ml-2">NEW</div>
                        </h4><span class="vertical-timeline-element-date"></span>
                      </div>
                    </div>
                  </div>
                  <div class="vertical-timeline-item dot-primary vertical-timeline-element">
                    <div><span class="vertical-timeline-element-icon bounce-in"></span>
                      <div class="vertical-timeline-element-content bounce-in">
                        <h4 class="timeline-title">Something not important <div class="avatar-wrapper mt-2 avatar-wrapper-overlap">
                            <div class="avatar-icon-wrapper avatar-icon-sm">
                              <div class="avatar-icon"><img src="assets/images/avatars/1.jpg" alt=""></div>
                            </div>
                            <div class="avatar-icon-wrapper avatar-icon-sm">
                              <div class="avatar-icon"><img src="assets/images/avatars/2.jpg" alt=""></div>
                            </div>
                            <div class="avatar-icon-wrapper avatar-icon-sm">
                              <div class="avatar-icon"><img src="assets/images/avatars/3.jpg" alt=""></div>
                            </div>
                            <div class="avatar-icon-wrapper avatar-icon-sm">
                              <div class="avatar-icon"><img src="assets/images/avatars/4.jpg" alt=""></div>
                            </div>
                            <div class="avatar-icon-wrapper avatar-icon-sm">
                              <div class="avatar-icon"><img src="assets/images/avatars/5.jpg" alt=""></div>
                            </div>
                            <div class="avatar-icon-wrapper avatar-icon-sm">
                              <div class="avatar-icon"><img src="assets/images/avatars/6.jpg" alt=""></div>
                            </div>
                            <div class="avatar-icon-wrapper avatar-icon-sm">
                              <div class="avatar-icon"><img src="assets/images/avatars/7.jpg" alt=""></div>
                            </div>
                            <div class="avatar-icon-wrapper avatar-icon-sm">
                              <div class="avatar-icon"><img src="assets/images/avatars/8.jpg" alt=""></div>
                            </div>
                            <div class="avatar-icon-wrapper avatar-icon-sm avatar-icon-add">
                              <div class="avatar-icon"><i>+</i></div>
                            </div>
                          </div>
                        </h4><span class="vertical-timeline-element-date"></span>
                      </div>
                    </div>
                  </div>
                  <div class="vertical-timeline-item dot-info vertical-timeline-element">
                    <div><span class="vertical-timeline-element-icon bounce-in"></span>
                      <div class="vertical-timeline-element-content bounce-in">
                        <h4 class="timeline-title">This dot has an info state</h4><span class="vertical-timeline-element-date"></span>
                      </div>
                    </div>
                  </div>
                  <div class="vertical-timeline-item dot-dark vertical-timeline-element">
                    <div><span class="vertical-timeline-element-icon is-hidden"></span>
                      <div class="vertical-timeline-element-content is-hidden">
                        <h4 class="timeline-title">This dot has a dark state</h4><span class="vertical-timeline-element-date"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="app-drawer-overlay d-none animated fadeIn"></div>
    </body>
    <script src="{{ asset('js/main.js') }}" defer></script>
  </div>
</body>
</html>
