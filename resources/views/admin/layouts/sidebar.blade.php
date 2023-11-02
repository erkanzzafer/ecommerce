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
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>

            <li class="dropdown {{ setActive(['admin.category.*', 'admin.subcategory.*', 'admin.childcategory.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Kategori Yönetimi</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.categtory.*']) }}"><a class="nav-link"
                            href="{{ route('admin.category.index') }}"><i class="far fa-square"></i>
                            <span>Kategori</span></a></li>
                    <li class="{{ setActive(['admin.subcategory.*']) }}"><a class="nav-link"
                            href="{{ route('admin.subcategory.index') }}"><i class="far fa-square"></i> <span>Alt
                                Kategori</span></a></li>
                    <li class="{{ setActive(['admin.childcategory.*']) }}"><a class="nav-link"
                            href="{{ route('admin.childcategory.index') }}"><i class="far fa-square"></i> <span>Dış
                                Kategori</span></a></li>
                </ul>
            </li>



            <li
                class="dropdown {{ setActive([
                    'admin.order.*',
                    'admin.pending.orders',
                    'admin.processed.orders',
                    'admin.droppedOff.orders',
                    'admin.shipped.orders',
                    'admin.out-for-delivery.orders',
                    'admin.delivered.orders',
                    'admin.cancelled.orders',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Sipariş Yönetimi</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.order.*']) }}"><a class="nav-link"
                            href="{{ route('admin.order.index') }}"><i class="far fa-square"></i> <span>Tüm
                                Siparişler</span></a></li>
                    <li class="{{ setActive(['admin.pending.orders']) }}"><a class="nav-link"
                            href="{{ route('admin.pending.orders') }}"><i class="far fa-square"></i> <span>Bekleyenler
                            </span></a></li>
                    <li class="{{ setActive(['admin.processed.orders']) }}"><a class="nav-link"
                            href="{{ route('admin.processed.orders') }}"><i class="far fa-square"></i>
                            <span>Processedler</span></a></li>
                    <li class="{{ setActive(['admin.droppedOff.orders']) }}"><a class="nav-link"
                            href="{{ route('admin.droppedOff.orders') }}"><i class="far fa-square"></i> <span>Dropped
                                Off</span></a></li>
                    <li class="{{ setActive(['admin.shipped.orders']) }}"><a class="nav-link"
                            href="{{ route('admin.shipped.orders') }}"><i class="far fa-square"></i>
                            <span>Shipped</span></a></li>
                    <li class="{{ setActive(['admin.out-for-delivery.orders']) }}"><a class="nav-link"
                            href="{{ route('admin.out-for-delivery.orders') }}"><i class="far fa-square"></i> <span>Out
                                For Delivery</span></a></li>
                    <li class="{{ setActive(['admin.delivered.orders']) }}"><a class="nav-link"
                            href="{{ route('admin.delivered.orders') }}"><i class="far fa-square"></i>
                            <span>Delivered</span></a></li>
                    <li class="{{ setActive(['admin.cancelled.orders']) }}"><a class="nav-link"
                            href="{{ route('admin.cancelled.orders') }}"><i class="far fa-square"></i>
                            <span>Cancelled</span></a></li>
                </ul>
            </li>


            <li class="{{ setActive(['admin.transaction']) }}"><a class="nav-link"
                    href="{{ route('admin.transaction') }}"><i class="far fa-square"></i>Transactions</a></li>


            <li
                class="dropdown  {{ setActive([
                    'admin.brand.*',
                    'admin.product.*',
                    'admin.products-image-gallery.*',
                    'admin.products-variant.*',
                    'admin.products-variant-item.*',
                    'admin.seller-products.*',
                    'admin.seller-pending-products.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Marka Yönetimi</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.brand.*']) }}"><a class="nav-link"
                            href="{{ route('admin.brand.index') }}"><i class="far fa-square"></i>
                            <span>Marka</span></a></li>
                    <li
                        class="{{ setActive([
                            'admin.product.*',
                            'admin.products-image-gallery.*',
                            'admin.products-variant.*',
                            'admin.products-variant-item.*',
                            'admin.reviews.index',
                        ]) }}">
                        <a class="nav-link" href="{{ route('admin.product.index') }}"><i class="far fa-square"></i>
                            <span>Ürün</span></a>
                    </li>
                    <li class="{{ setActive(['admin.seller-products.*']) }}"><a class="nav-link"
                            href="{{ route('admin.seller-products.index') }}"><i class="far fa-square"></i>
                            <span>Satıcı Ürünleri</span></a></li>
                    <li class="{{ setActive(['admin.seller-pending-products.*']) }}"><a class="nav-link"
                            href="{{ route('admin.seller-pending-products.index') }}"><i class="far fa-square"></i>
                            <span>Satıcı Bekleyen Ürünleri</span></a></li>

                    <li class="{{ setActive(['admin.reviews.*']) }}"><a class="nav-link"
                            href="{{ route('admin.reviews.index') }}"><i class="far fa-square"></i>
                            <span>Ürün Reviews</span></a></li>
                </ul>
            </li>

            <li
                class="dropdown  {{ setActive([
                    'admin.vendor-profile.*',
                    'admin.coupons.*',
                    'admin.shipping-rule.*',
                    'admin.paypal-setting.*',
                    'admin.payment-settings.*',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i>
                    <span>E-Ticaret</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link"
                            href="{{ route('admin.flash-sale.index') }}"><i class="far fa-square"></i> <span>Flash
                                Sale</span></a></li>
                    <li class="{{ setActive(['admin.coupons.*']) }}"><a class="nav-link"
                            href="{{ route('admin.coupons.index') }}"><i class="far fa-square"></i>
                            <span>Kuponlar</span></a></li>
                    <li class="{{ setActive(['admin.shipping-rule.*']) }}"><a class="nav-link"
                            href="{{ route('admin.shipping-rule.index') }}"><i class="far fa-square"></i>
                            <span>Shipping Rule</span></a></li>
                    <li class="{{ setActive(['admin.vendor-profile.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-profile.index') }}"><i class="far fa-square"></i>
                            <span>Vendor Profil</span></a></li>
                    <li class="{{ setActive(['admin.payment-settings.*']) }}"><a class="nav-link"
                            href="{{ route('admin.payment-settings.index') }}"><i class="far fa-square"></i>
                            <span>Ödeme Ayarlları</span></a></li>
                </ul>
            </li>


            <li
                class="dropdown  {{ setActive(['admin.slider.*', 'admin.home-page-setting', 'admin.vendor-condition.index', 'admin.about.index','admin.terms.index']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i> <span>Site Yönetimi</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.slider.*']) }}"><a class="nav-link"
                            href="{{ route('admin.slider.index') }}"><i class="far fa-square"></i>
                            <span>Slider</span></a></li>
                    <li class="{{ setActive(['admin.home-page-setting']) }}"><a class="nav-link"
                            href="{{ route('admin.home-page-setting') }}"><i class="far fa-square"></i>
                            <span>Anasayfa Ayar</span></a></li>

                    <li class="{{ setActive(['admin.vendor-condition.index']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-condition.index') }}"><i class="far fa-square"></i>
                            <span>Mağaza Şartları</span></a></li>

                    <li class="{{ setActive(['admin.about.index']) }}"><a class="nav-link"
                            href="{{ route('admin.about.index') }}"><i class="far fa-square"></i>
                            <span>Hakkında</span></a></li>

                    <li class="{{ setActive(['admin.terms.index']) }}"><a class="nav-link"
                            href="{{ route('admin.terms.index') }}"><i class="far fa-square"></i>
                            <span>Şartname</span></a></li>
                </ul>
            </li>


            <li
                class="dropdown  {{ setActive(['admin.footer-info.*', 'admin.footer-socials.index', 'admin.footer-grid-two.index', 'admin.footer-grid-three.index']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i> <span>Footer Yönetimi</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.footer-info.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-info.index') }}"><i class="far fa-square"></i>
                            <span>Footer Bilgi</span></a></li>

                    <li class="{{ setActive(['admin.footer-socials.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-socials.index') }}"><i class="far fa-square"></i>
                            <span>Footer Sosyal Medya</span></a></li>

                    <li class="{{ setActive(['admin.footer-grid-two.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-grid-two.index') }}"><i class="far fa-square"></i>
                            <span>Footer Grid Two</span></a></li>

                    <li class="{{ setActive(['admin.footer-grid-three.*']) }}"><a class="nav-link"
                            href="{{ route('admin.footer-grid-three.index') }}"><i class="far fa-square"></i>
                            <span>Footer Grid Three</span></a></li>
                </ul>
            </li>

            <li
                class="dropdown  {{ setActive(['vendor-requests.index', 'admin.customers.index', 'admin.vendors.index']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i> <span>Mağaza İstekleri</span></a>
                <ul class="dropdown-menu">

                    <li class="{{ setActive(['admin.customers.*']) }}"><a class="nav-link"
                            href="{{ route('admin.customers.index') }}"><i class="far fa-square"></i>
                            <span>Müşteri Listesi</span></a></li>
                    <li class="{{ setActive(['admin.vendors.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendors.index') }}"><i class="far fa-square"></i>
                            <span>Mağaza Listesi</span></a></li>
                    <li class="{{ setActive(['admin.footer-info.*']) }}"><a class="nav-link"
                            href="{{ route('admin.vendor-requests.index') }}"><i class="far fa-square"></i>
                            <span>Bekleyen Mağaza İstekleri</span></a></li>
                </ul>
            </li>


            <li class="{{ setActive(['admin.advertisement.*']) }}"><a class="nav-link"
                    href="{{ route('admin.advertisement.index') }}"><i class="far fa-square"></i>Advirtesement</a>
            </li>

            <li class="{{ setActive(['admin.subscribers.*']) }}"><a class="nav-link"
                    href="{{ route('admin.subscribers.index') }}"><i class="far fa-square"></i>Subscriber</a></li>

            <li class="{{ setActive(['admin.setting.*']) }}"><a class="nav-link"
                    href="{{ route('admin.setting.index') }}"><i class="far fa-square"></i>Ayarlar</a></li>

            {{--  <li class="dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
              <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
              <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
            </ul>
        </li> --}}
        </ul>


    </aside>
</div>
