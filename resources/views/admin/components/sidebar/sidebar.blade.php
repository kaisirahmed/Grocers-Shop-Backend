<div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
        <ul id="sidebarnav">
            <li class="nav-devider"></li>
            <li class="nav-label">Home</li>
            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard <span class="label label-rouded label-primary pull-right">2</span></span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('admin.dashboard') }}">Ecommerce </a></li>
                    <li><a href="index1.html">Analytics </a></li>
                </ul>
            </li>
            @auth
            <li class="nav-label">Authority</li>
            <li> <a class="has-arrow " href="#" aria-expanded="false"><i class="fa fa-envelope"></i><span class="hide-menu">Admin</span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('admin.index') }}">All Admin</a></li>
                    <li><a href="{{ route('admin.register') }}">Add New</a></li>
                </ul>
            </li>
            
            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-bar-chart"></i><span class="hide-menu">Staff</span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('staff.index')}}">All Staff</a></li>
                    <li><a href="{{ route('staff.register') }}">Add New</a></li>
                </ul>
            </li>
            
            <li class="nav-label">Permissions</li>
            <li> 
                <a class="has-arrow  " href="#" aria-expanded="false"><i class="ti-panel text-info"></i><span class="hide-menu">Permission</a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('admin.permissions.index') }}">Admin</a></li>
                    <li><a href="{{ route('admin.staff.permissions.index') }}">Staff</a></li>
                </ul>
            </li>

            <li class="nav-label">App Settings</li>
            <li> 
                <a class="has-arrow " href="#" aria-expanded="false"><i class="ti-panel text-info"></i><span class="hide-menu">System</a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('admin.system.index') }}">App Info</a></li>
                    @appinfo
                    <li><a href="{{ route('admin.system.create') }}">Add New</a></li>
                    @endappinfo
                </ul>
            </li>
            @endauth
            <li class="nav-label">Catalog</li>
            <li> 
                <a class="has-arrow  " href="#" aria-expanded="false"><i class="ti-panel text-info"></i><span class="hide-menu">Category</a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('category.index') }}">Categories</a></li>
                    <li><a href="{{ route('category.create') }}">Add New</a></li>
                </ul>
            </li>
            <li class="nav-label">Products & Store</li>
            <li> 
                <a class="has-arrow  " href="#" aria-expanded="false"><i class="ti-panel text-info"></i><span class="hide-menu">Products</a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('unit.index') }}">Product Unit</a></li>
                    <li><a href="{{ route('product.index') }}">All Products</a></li>
                    <li><a href="{{ route('product.create') }}">Add New</a></li>
                </ul>
            </li>
            

            <li> 
                <a class="has-arrow  " href="#" aria-expanded="false"><i class="ti-panel text-info"></i><span class="hide-menu">Stock</a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('stock.index') }}">All Stock</a></li>
                    <li><a href="{{ route('stock.create') }}">Add New</a></li>
                </ul>
            </li>

            <li class="nav-label">Order Management</li>
            <li> 
                <a class="has-arrow  " href="#" aria-expanded="false"><i class="ti-panel text-info"></i><span class="hide-menu">Orders</a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('order.index') }}">All Orders</a></li>
                    <!-- <li><a href="{{ route('product.index') }}">All Products</a></li> -->
                    <li><a href="{{ route('order.create') }}">Add New</a></li>
                </ul>
            </li>

            <li class="nav-label">Help & More</li>
            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-suitcase"></i><span class="hide-menu">Help & More<span class="label label-rouded label-warning pull-right">6</span></span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="ui-button.html">Team</a></li>
                    <li><a href="ui-dropdown.html">Career</a></li>
                    <li><a href="ui-typography.html">Privacy Policy</a></li>
                    <li><a href="ui-typography.html">Terms of use</a></li>
                    <li><a href="ui-typography.html">Faq</a></li>
                </ul>
            </li>

            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-suitcase"></i><span class="hide-menu">CMS <span class="label label-rouded label-danger pull-right">6</span></span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="{{ route('admin.cms.index') }}">All Pages</a></li>
                    <li><a href="{{ route('admin.cms.create') }}">Add New</a></li>
                </ul>
            </li>
			<!-- <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-suitcase"></i><span class="hide-menu">Components <span class="label label-rouded label-danger pull-right">6</span></span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="uc-calender.html">Calender</a></li>
                    <li><a href="uc-datamap.html">Datamap</a></li>
                    <li><a href="uc-nestedable.html">Nestedable</a></li>
                    <li><a href="uc-sweetalert.html">Sweetalert</a></li>
                    <li><a href="uc-toastr.html">Toastr</a></li>
                    <li><a href="uc-weather.html">Weather</a></li>
                </ul>
            </li>
            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-wpforms"></i><span class="hide-menu">Forms</span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="form-basic.html">Basic Forms</a></li>
                    <li><a href="form-layout.html">Form Layout</a></li>
                    <li><a href="form-validation.html">Form Validation</a></li>
                    <li><a href="form-editor.html">Editor</a></li>
                    <li><a href="form-dropzone.html">Dropzone</a></li>
                </ul>
            </li>
            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-table"></i><span class="hide-menu">Tables</span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="table-bootstrap.html">Basic Tables</a></li>
                    <li><a href="table-datatable.html">Data Tables</a></li>
                </ul>
            </li>
            <li class="nav-label">Layout</li>
            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-columns"></i><span class="hide-menu">Layout</span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="layout-blank.html">Blank</a></li>
                    <li><a href="layout-boxed.html">Boxed</a></li>
                    <li><a href="layout-fix-header.html">Fix Header</a></li>
                    <li><a href="layout-fix-sidebar.html">Fix Sidebar</a></li>
                </ul>
            </li>
            <li class="nav-label">EXTRA</li>
            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-book"></i><span class="hide-menu">Pages <span class="label label-rouded label-success pull-right">8</span></span></a>
                <ul aria-expanded="false" class="collapse">

                    <li><a href="#" class="has-arrow">Authentication <span class="label label-rounded label-success">6</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="page-login.html">Login</a></li>
                            <li><a href="page-register.html">Register</a></li>
                            <li><a href="page-invoice.html">Invoice</a></li>
                        </ul>
                    </li>
                    <li><a href="#" class="has-arrow">Error Pages</a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="page-error-400.html">400</a></li>
                            <li><a href="page-error-403.html">403</a></li>
                            <li><a href="page-error-404.html">404</a></li>
                            <li><a href="page-error-500.html">500</a></li>
                            <li><a href="page-error-503.html">503</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-map-marker"></i><span class="hide-menu">Maps</span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="map-google.html">Google</a></li>
                    <li><a href="map-vector.html">Vector</a></li>
                </ul>
            </li>
            <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-level-down"></i><span class="hide-menu">Multi level dd</span></a>
                <ul aria-expanded="false" class="collapse">
                    <li><a href="#">item 1.1</a></li>
                    <li><a href="#">item 1.2</a></li>
                    <li> <a class="has-arrow" href="#" aria-expanded="false">Menu 1.3</a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="#">item 1.3.1</a></li>
                            <li><a href="#">item 1.3.2</a></li>
                            <li><a href="#">item 1.3.3</a></li>
                            <li><a href="#">item 1.3.4</a></li>
                        </ul>
                    </li>
                    <li><a href="#">item 1.4</a></li>
                </ul>
            </li> -->
        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>