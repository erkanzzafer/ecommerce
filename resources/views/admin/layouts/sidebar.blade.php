<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Stisla</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="dropdown active">
          <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>
        <li class="menu-header">Starter</li>

        <li class="dropdown {{ setActive([
            'admin.category.*',
            'admin.subcategory.*',
            'admin.childcategory.*'
        ]) }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Kategori Yönetimi</span></a>
            <ul class="dropdown-menu">
              <li class="{{ setActive(['admin.categtory.*']) }}"><a class="nav-link" href="{{ route('admin.category.index') }}"><i class="far fa-square"></i> <span>Kategori</span></a></li>
              <li class="{{ setActive(['admin.subcategory.*']) }}"><a class="nav-link" href="{{ route('admin.subcategory.index') }}"><i class="far fa-square"></i> <span>Alt Kategori</span></a></li>
              <li class="{{ setActive(['admin.childcategory.*']) }}"><a class="nav-link" href="{{ route('admin.childcategory.index') }}"><i class="far fa-square"></i> <span>Dış Kategori</span></a></li>
            </ul>
          </li>


          <li class="dropdown  {{ setActive([
            'admin.brand.*',
            'admin.product.*',
            'admin.products-image-gallery.*',
            'admin.products-variant.*',
            'admin.products-variant-item.*',
            'admin.seller-products.*',
            'admin.seller-pending-products.*'
        ]) }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Marka Yönetimi</span></a>
            <ul class="dropdown-menu">
              <li class="{{ setActive(['admin.brand.*']) }}"><a class="nav-link" href="{{ route('admin.brand.index') }}"><i class="far fa-square"></i> <span>Marka</span></a></li>
              <li class="{{ setActive(['admin.product.*',
              'admin.products-image-gallery.*',
              'admin.products-variant.*',
              'admin.products-variant-item.*']) }}"><a class="nav-link" href="{{ route('admin.product.index') }}"><i class="far fa-square"></i> <span>Ürün</span></a></li>
              <li class="{{ setActive(['admin.seller-products.*']) }}"><a class="nav-link" href="{{ route('admin.seller-products.index') }}"><i class="far fa-square"></i> <span>Satıcı Ürünleri</span></a></li>
              <li class="{{ setActive(['admin.seller-pending-products.*']) }}"><a class="nav-link" href="{{ route('admin.seller-pending-products.index') }}"><i class="far fa-square"></i> <span>Satıcı Bekleyen Ürünleri</span></a></li>

            </ul>
          </li>

          <li class="dropdown  {{ setActive([
            'admin.vendor-profile.*',
        ]) }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>E-Ticaret</span></a>
            <ul class="dropdown-menu">
              <li class="{{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link" href="{{ route('admin.flash-sale.index') }}"><i class="far fa-square"></i> <span>Flash Sale</span></a></li>
              <li class="{{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link" href="{{ route('admin.vendor-profile.index') }}"><i class="far fa-square"></i> <span>Vendor Profil</span></a></li>
            </ul>
          </li>


          <li class="dropdown  {{ setActive([
            'admin.slider.*',
        ]) }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Site Yönetimi</span></a>
            <ul class="dropdown-menu">
              <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link" href="{{ route('admin.slider.index') }}"><i class="far fa-square"></i> <span>Slider</span></a></li>
            </ul>
          </li>

          <li><a class="nav-link" href="{{ route('admin.setting.index') }}"><i class="far fa-square"></i>Ayarlar</a></li>

        {{--  <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
              <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
              <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
            </ul>
        </li>--}}
      </ul>


   </aside>
  </div>
