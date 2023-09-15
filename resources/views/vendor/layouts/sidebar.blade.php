<div class="dashboard_sidebar">
    <span class="close_icon">
      <i class="far fa-bars dash_bar"></i>
      <i class="far fa-times dash_close"></i>
    </span>
    <a href="dsahboard.html" class="dash_logo"><img src="images/logo.png" alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">
      <li><a class="active" href="{{ route('vendor.dashboard') }}"><i class="fas fa-tachometer"></i>Dashboard</a></li>
      <li><a href="{{ route('vendor.orders') }}"><i class="far fa-user"></i>Siparişler</a></li>
      <li><a href="{{ route('vendor.products.index') }}"><i class="far fa-user"></i> Ürünler</a></li>
      <li><a href="{{ route('vendor.shop-profile.index') }}"><i class="far fa-user"></i> Shop Profile</a></li>
      <li><a href="{{ route('vendor.profile') }}"><i class="far fa-user"></i> My Profile</a></li>
      <li><a href="dsahboard_address.html"><i class="fal fa-gift-card"></i> Addresses</a></li>
      <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout').submit();"><i class="far fa-sign-out-alt"></i> Log out</a></li>
      <form action="{{ route('logout') }}" method="post" id="logout">@csrf</form>
    </ul>
  </div>
