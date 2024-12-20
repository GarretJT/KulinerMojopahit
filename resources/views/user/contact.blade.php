@extends('layouts.user')

@section('header')
    <style>
        #hero{
             background: url('{{asset('user/images/cover.png')}}') top center;
            background-attachment: fixed; /* Keeps the image still while scrolling */
            background-repeat: no-repeat;
            width: 100%;
            background-size: cover;
            margin: 0px;
            height: 250px; /* Adjust the height as necessary */
        }
    </style>    
@endsection

@section('hero')
    <h1>Kontak Kami</h1>
    <h2>Bergabung dan liburan bersama Kami</h2>
@endsection

@section('content')

    <!-- WhatsApp Floating Icon -->
    <a href="https://api.whatsapp.com/send?phone=6282139003999" target="_blank" class="whatsapp-icon">
      <i class="fa fa-whatsapp"></i>
    </a>


 <!--========================== Google Maps Section ============================-->
<section id="google-maps">
  <div class="container wow fadeIn">
    <div class="section-header">
      <h3 class="section-title mt-4">Lokasi Kami</h3>
      <p class="section-description">Temukan kami di alamat berikut:</p>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="0.2s">
        <div class="map-container">
          <!-- Google Maps Embed -->
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.1757687726936!2d112.36837327500268!3d-7.55580509245799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e786d07706e5635%3A0x13e557c51ff9348!2sKuliner%20Maha%20Vihara%20Mojopahit!5e0!3m2!1sen!2sid!4v1734451840517!5m2!1sen!2sid"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>
    <section id="contact">
    <div class="container wow fadeInUp">
      <div class="section-header">
        <h3 class="section-title">Kontak</h3>
        <div class="mb-4 text-center"><b>Kontak kami melalui detil kontak berikut:</b></div>
      </div>
    </div>

    <!-- Additional Information Section -->
    <div class="row mt-4 justify-content-center">
  <div class="col-md-6">
    <div class="location-info text-center">
      <!-- Address -->
      <div class="location-item mb-3">
        <i class="fa fa-map-marker" style="font-size: 30px; color: #3498db;"></i>
        <span class="ml-3" style="font-size: 16px; color: #555;">Maha Vihara Majapahit, Bejijong, Trowulan, Mojokerto Regency, East Java 61362</span>
      </div>
      
      <!-- Phone -->
      <div class="location-item mb-3">
        <i class="fa fa-phone" style="font-size: 30px; color: #3498db;"></i>
        <span class="ml-3" style="font-size: 16px; color: #555;">+62 123-456-789</span>
      </div>
      
      <!-- Email -->
      <div class="location-item mb-3">
        <i class="fa fa-envelope" style="font-size: 30px; color: #3498db;"></i>
        <span class="ml-3" style="font-size: 16px; color: #555;">kulinermojopahit@gmail.com</span>
      </div>
    </div>
  </div>
</div>

</section><!-- #google-maps -->

    <!-- <div class="container wow fadeInUp">
      <div class="row justify-content-center">

        <div class="col-lg-3 col-md-4">

          <div class="info">
            <div>
              <i class="fa fa-map-marker"></i>
              <p>Gedong Tengen,
                <br>Daerah Istimewa Yogyakarta</p>
            </div>

            <div>
              <i class="fa fa-envelope"></i>
              <p>danyadhi4149@gmail.com</p>
            </div>

            <div>
              <i class="fa fa-phone"></i>
              <p>0831-6179-3990</p>
            </div>
          </div> -->
<!-- 
          <div class="social-links">
            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
            <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
            <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
            <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
          </div> -->

        </div>

        <!-- <div class="col-lg-5 col-md-8">
          <div class="form">
            <div id="sendmessage">Your message has been sent. Thank you!</div>
            <div id="errormessage"></div>
            <form action="" method="post" role="form" class="contactForm">
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validation"></div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>
        </div> -->

      </div>

    </div>
  </section><!-- #contact -->
@endsection