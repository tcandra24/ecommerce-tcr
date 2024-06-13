<footer class="footer bg-dark position-relative">
    <div class="footer-middle">
        <div class="container position-static">
            <div class="row">
                <div class="col-lg-2 col-sm-6 pb-2 pb-sm-0 d-flex align-items-center">
                    <div class="widget m-b-3">
                        <img src="{{ asset('assets/admin/img/logo-dark.png') }}" alt="Ecommerce TCR" width="202"
                            height="54" class="logo-footer">
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 pb-4 pb-sm-0">
                    <div class="widget mb-2">
                        <h4 class="widget-title mb-1 pb-1">Get In Touch</h4>
                        <ul class="contact-info">
                            <li class="text-justify">
                                <span class="contact-info-label">Address:</span>
                                Ruko Rich Palace, Jl. Mayjen Sungkono No.149-151 Blok H10, Dukuh Pakis, Kec.
                                Dukuhpakis, Surabaya, Jawa Timur 60189
                            </li>
                            <li>
                                <span class="contact-info-label">Phone:</span>
                                <a href="tel:">0852-6000-0816</a>
                            </li>
                            <li>
                                <span class="contact-info-label">Email:</span>
                                <a
                                    href="https://portotheme.com/cdn-cgi/l/email-protection#91fcf0f8fdd1f4e9f0fce1fdf4bff2fefc">
                                    <span class="__cf_email__"
                                        data-cfemail="c5a8a4aca985a0bda4a8b5a9a0eba6aaa8">hello@tcrcorp.id</span>
                                </a>
                            </li>
                            <li>
                                <span class="contact-info-label">Working Days/Hours:</span>
                                Mon - Fri / 8:00 - 17:00 PM
                                <br>
                                Sat / 8:00 - 14:00 PM
                            </li>
                        </ul>
                        <div class="social-icons">
                            <a href="https://www.instagram.com/tcr_distribution?igsh=ZjlidmZ2NXpyb2xn"
                                class="social-icon social-instagram fab fa-instagram" target="_blank"
                                title="Instagram"></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 pb-2 pb-sm-0">
                    <div class="widget">
                        <h4 class="widget-title pb-1">Usefull Link</h4>

                        <ul class="links">
                            @if (Auth::guard('customer')->check())
                                <li><a href="#">Orders History</a></li>
                            @else
                                <li><a href="#">Login</a></li>
                            @endif
                            <li><a href="/about-us">About Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="footer-bottom d-sm-flex align-items-center bg-dark justify-content-center">
            <span class="footer-copyright">TCR Ecommerce. © {{ date('Y') }}. All Rights Reserved</span>
        </div>
    </div>
</footer>
