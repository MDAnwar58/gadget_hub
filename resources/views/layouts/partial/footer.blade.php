<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="footer">
                        <h3 class="footer-title">Contact Us</h3>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
                            <li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
                        </ul>
                    </div>
                </div>

                {{-- <div class="col-xs-6">
                  <div class="footer">
                      <h3 class="footer-title">Categories</h3>
                      <ul class="footer-links">
                          @if ($categories->count() > 0)
                              @foreach ($categories as $category)
                                  <li><a href="#">Hot deals</a></li>
                              @endforeach
                          @else
                              <li>Category Not Found</li>
                          @endif
                      </ul>
                  </div>
              </div> --}}

                <div class="col-md-6 col-lg-4">
                    <div class="footer">
                        <h3 class="footer-title">Service</h3>
                        <ul class="footer-links">

                            @if (Auth::check())
                                <li><a href="{{ route('my.account', Auth::user()->id) }}">My Account</a></li>
                            @else
                                <li>Please <a href="{{ route('login') }}" style="color: #655DBB;">Login</a> Then Access
                                    Your Profile</li>
                            @endif
                            <li><a href="{{ route('contact') }}">Contact Me</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="footer">
                        <h3 class="footer-title">Follow On</h3>
                        <ul class="footer-links">
                            <li>
                                {{-- <div class="row">
                                    <div class="col-xs-4"></div>
                                </div> --}}
                                <span><a href="" style="color: #fff; font-size: 25px;"><i class="fa fa-facebook-square"
                                            aria-hidden="true"></i></a></span>
                                <span><a href="" style="color: #fff; font-size: 25px;"><i class="fa fa-whatsapp"
                                            aria-hidden="true"></i></a></span>
                                <span><a href="" style="color: #fff; font-size: 25px;"><i class="fa fa-linkedin"
                                            aria-hidden="true"></i></a></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->
</footer>
