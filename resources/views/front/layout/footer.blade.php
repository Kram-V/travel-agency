<div class="footer pt_70">
  <div class="container">
      <div class="row">
          <div class="col-lg-3 col-md-6">
              <div class="item pb_50">
                  <h2 class="heading">Important Pages</h2>
                  <ul class="useful-links">
                      <li><a href="{{ route('home') }}"><i class="fas fa-angle-right"></i> Home</a></li>
                      <li><a href="{{ route('destinations') }}"><i class="fas fa-angle-right"></i> Destinations</a></li>
                      <li><a href="{{ route('packages') }}"><i class="fas fa-angle-right"></i> Packages</a></li>
                      <li><a href="{{ route('blogs') }}"><i class="fas fa-angle-right"></i> Blog</a></li>
                  </ul>
              </div>
          </div>
          <div class="col-lg-3 col-md-6">
              <div class="item pb_50">
                  <h2 class="heading">Useful Links</h2>
                  <ul class="useful-links">
                      <li><a href="{{ route('faqs') }}"><i class="fas fa-angle-right"></i> FAQ</a></li>
                      <li><a href="{{ route('contact') }}"><i class="fas fa-angle-right"></i> Contact</a></li>
                  </ul>
              </div>
          </div>

          <div class="col-lg-3 col-md-6">
              <div class="item pb_50">
                  <h2 class="heading">Contact</h2>
                  <div class="list-item">
                      <div class="left">
                          <i class="fas fa-map-marker-alt"></i>
                      </div>
                      <div class="right">
                          34 Antiger Lane, USA, 12937
                      </div>
                  </div>
                  <div class="list-item">
                      <div class="left">
                        <i class="fas fa-envelope"></i>
                      </div>
                      <div class="right">contact@example.com</div>
                  </div>
                  <div class="list-item">
                      <div class="left">
                        <i class="fas fa-phone"></i>
                      </div>
                      <div class="right">222-222-2222</div>
                  </div>
                  <ul class="social">
                      <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                      <li><a href=""><i class="fab fa-twitter"></i></a></li>
                      <li><a href=""><i class="fab fa-youtube"></i></a></li>
                      <li><a href=""><i class="fab fa-linkedin-in"></i></a></li>
                      <li><a href=""><i class="fab fa-instagram"></i></a></li>
                  </ul>
              </div>
          </div>

          <div class="col-lg-3 col-md-6">
              <div class="item pb_50">
                  <h2 class="heading">Newsletter</h2>
                  <p>
                      To get the latest news from our website, please
                      subscribe us here:
                  </p>
                  <form action="{{ route('send_subscriber') }}" method="POST">
                    @csrf
                      <div class="form-group">
                          <input type="text" name="email" class="form-control" placeholder="Email Address">
                      </div>
                      <div class="form-group">
                          <input type="submit" class="btn subscribe-now" value="Subscribe Now">
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>

<div class="footer-bottom">
  <div class="container">
      <div class="row">
          <div class="col-lg-12 col-md-12">
              <div class="copyright">
                  Copyright &copy; 2025, EscapeEase. All Rights Reserved.
              </div>
          </div>
      </div>
  </div>
</div>

<div class="scroll-top">
  <i class="fas fa-angle-up"></i>
</div>