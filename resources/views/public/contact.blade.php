@include('public.partials.navbar')
<!-- Contact Page Wrapper -->
{{-- <header class="container-fluid contact-banner" style="padding-left: 0; padding-right: 0; " >
    <img src="{{  asset('image/contactFinal.png ')}}" class="img-banner" alt="" >
</header> --}}
<div class="contact-page py-5">
    <div class="container"style="  overflow-x: hidden; ">

        <!-- Heading -->
        <div class="text-center mb-5">
            <h2 class="fw-bold">Contact Us</h2>
            <p class="text-muted">We’d love to hear from you. Reach out anytime.</p>
        </div>

        <div class="row g-5 align-items-stretch">

            <!-- Contact Info -->
            <div class="col-lg-5">
                <div class="contact-info h-100">
                    <h4 class="mb-4">Get in Touch</h4>

                    <div class="info-item mb-3">
                        <i class="bi bi-geo-alt"></i>
                        <span>Lahore, Pakistan</span>
                    </div>

                    <div class="info-item mb-3">
                        <i class="bi bi-telephone"></i>
                        <span>0300-1234567</span>
                    </div>

                    <div class="info-item mb-3">
                        <i class="bi bi-envelope"></i>
                        <span>info@mywebsite.com</span>
                    </div>

                    <div class="social-links mt-4">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="contact-form h-100">
                    <h4 class="mb-4">Send a Message</h4>

                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" placeholder="Your Name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" class="form-control" placeholder="Your Email">
                            </div>
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Subject">
                        </div>

                        <div class="mb-4">
                            <textarea class="form-control" rows="5" placeholder="Your Message"></textarea>
                        </div>

                        <button class="btn btn-dark px-4">Send Message</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<br><br>
@include('public.partials.footer')
