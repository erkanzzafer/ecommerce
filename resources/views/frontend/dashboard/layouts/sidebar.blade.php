<div class="dashboard_sidebar">
    <span class="close_icon">
      <i class="far fa-bars dash_bar"></i>
      <i class="far fa-times dash_close"></i>
    </span>
    <a href="dsahboard.html" class="dash_logo"><img src="images/logo.png" alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">
      <li><a class="active" href="{{ route('user.dashboarduser') }}"><i class="fas fa-tachometer"></i>Dashboard</a></li>
      <li><a href="{{ route('user.orders') }}"><i class="fas fa-list-ul"></i> Siparişler</a></li>
      <li><a href="dsahboard_download.html"><i class="far fa-cloud-download-alt"></i> Downloads</a></li>
      <li><a href="{{ route('user.review.index') }}"><i class="far fa-star"></i> Reviews</a></li>
      <li><a href="dsahboard_wishlist.html"><i class="far fa-heart"></i> Wishlist</a></li>
      <li><a href="{{ route('user.profile') }}"><i class="far fa-user"></i> My Profile</a></li>
      <li><a href="{{ route('user.address.index') }}"><i class="fal fa-gift-card"></i> Addresses</a></li>


      <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout').submit();"><i class="far fa-sign-out-alt"></i> Log out</a></li>
      <form action="{{ route('logout') }}" method="post" id="logout">@csrf</form>
    </ul>
  </div>
