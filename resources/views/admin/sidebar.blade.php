  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('site.index') }}">
          <div class="sidebar-brand-icon ">
              <i class="fas fa-shopping-cart"></i>
          </div>
          <div class="sidebar-brand-text mx-3">{{ __('site.project course') }}</div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.index') }}">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>{{ __('site.Dashboard') }}</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link {{ str_contains(request()->url(), 'categories') ? '' : 'collapsed' }}" href="#"
              data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-fw fa-tags"></i>
              <span>{{ __('site.Categories') }}</span>
          </a>
          <div id="collapseTwo" class="collapse  {{ str_contains(request()->url(), 'categories') ? 'show' : '' }}"
              aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}"
                      href="{{ route('admin.categories.index') }}">{{ __('site.All Categories') }}</a>
                  <a class="collapse-item {{ request()->routeIs('admin.categories.create') ? 'active' : '' }}"
                      href="{{ route('admin.categories.create') }}">{{ __('site.Add New') }}</a>
                  <a class="collapse-item {{ request()->routeIs('admin.categories.trash') ? 'active' : '' }}"
                      href="{{ route('admin.categories.trash') }}">Trash</a>
              </div>
          </div>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ str_contains(request()->url(), 'products') ? '' : 'collapsed' }}" href="#"
              data-toggle="collapse" data-target="#productcollapse" aria-expanded="true"
              aria-controls="productcollapse">
              <i class="fas fa-fw fa-heart"></i>
              <span>{{ __('site.Products') }}</span>
          </a>
          <div id="productcollapse" class="collapse  {{ str_contains(request()->url(), 'products') ? 'show' : '' }}"
              aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item {{ request()->routeIs('admin.products.index') ? 'active' : '' }}"
                      href="{{ route('admin.products.index') }}">{{ __('site.All Products') }}</a>
                  <a class="collapse-item {{ request()->routeIs('admin.products.create') ? 'active' : '' }}"
                      href="{{ route('admin.products.create') }}">{{ __('site.Add New') }}</a>
                  <a class="collapse-item {{ request()->routeIs('admin.products.trash') ? 'active' : '' }}"
                      href="{{ route('admin.products.trash') }}">Trash</a>
              </div>
          </div>
      </li>
      <li class="nav-item">
          <a class="nav-link {{ str_contains(request()->url(), 'coupons') ? '' : 'collapsed' }}" href="#"
              data-toggle="collapse" data-target="#couponscollapse" aria-expanded="true"
              aria-controls="couponscollapse">
              <i class="fas fa-fw fa-percent"></i>
              <span>Coupons</span>
          </a>
          <div id="couponscollapse" class="collapse  {{ str_contains(request()->url(), 'coupons') ? 'show' : '' }}"
              aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item {{ request()->routeIs('admin.coupons.index') ? 'active' : '' }}"
                      href="{{ route('admin.coupons.index') }}">All Coupons</a>
                  <a class="collapse-item {{ request()->routeIs('admin.coupons.create') ? 'active' : '' }}"
                      href="{{ route('admin.coupons.create') }}">Add Coupons</a>
                  <a class="collapse-item {{ request()->routeIs('admin.coupons.trash') ? 'active' : '' }}"
                      href="{{ route('admin.coupons.trash') }}">Trash</a>
              </div>
          </div>
      </li>


      <!-- Nav Item - Utilities Collapse Menu -->



      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

  </ul>
  <!-- End of Sidebar -->
