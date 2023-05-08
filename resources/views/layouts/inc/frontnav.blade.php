<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand text-light fw-bold" href="{{route('welcome')}}">E shop</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <form action="{{Route('searchProduct')}}" method="post">
      <div class="row no-gutters mt-3">
        
          @csrf
        <div class="col">
             <input required id="search_product" name="product_name" class="form-control border-secondary border rounded-0 text-light" type="search" placeholder="search" id="example-search-input4">
        </div>
        <div class="col-auto">
             <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right" type="submit">
                <i class="fa fa-search"></i>
             </button>
        </div>
   </div>
  </form>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('welcome')}}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page">Disabled</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{Route('category')}}">Category</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{Route('cart')}}">Cart
            <span class="badge badge-pill bg-primary cart-count">0</span>
            </a>
          </li>
          <li class="nav-item me-5">
            <a class="nav-link active" aria-current="page" href="{{Route('wishlist')}}">Wishlist
              <span class="badge badge-pill bg-success wishlist-count">0</span>
            </a>
          </li>
            @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link active"  href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#">My Profile</a></li>
                              <li><a class="dropdown-item" href="{{Route('my-orders')}}">My Orders</a></li>

                              <li><a class="dropdown-item"  href="{{ route('logout') }}"   onclick="event.preventDefault();   document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>

                            </ul>
                          </li>

                           
                        @endguest
        </ul>
      </div>
    </div>
  </nav>
  <script>
    $(document).ready(function(){
    loadCart()
    loadWishList()
    $.ajaxSetup({
                 headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                });

    function loadCart(){
      $.ajax({
        method:"GET",
        url:"/load-cart-data",
        success:function(response){
          $('.cart-count').html('');
          $('.cart-count').html(response.count);
        }
        
      })
    }
    function loadWishList(){
      $.ajax({
        method:"GET",
        url:"/load-wish-data",
        success:function(response){
          $('.wishlist-count').html('');
          $('.wishlist-count').html(response.count);
        }
        
      })
    }
  });
  </script>
