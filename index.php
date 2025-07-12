<!-- index.php -->
<?php include 'template/header.php'; ?>
  <body>
    
    <?php include 'template/nav-bar.php'; ?>
    <!-- END nav -->
    
    <section class="home-slider owl-carousel">
      <div class="slider-item" style="background-image: url('images/bg_6.jpg');">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center text-center">
            <div class="col-md-10 col-sm-12 ftco-animate">
              <h1 class="mb-3">Book a table for yourself at a time convenient for you</h1>
            </div>
          </div>
        </div>
      </div>

      <div class="slider-item" style="background-image: url('images/bg_2.jpg');">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center text-center">
            <div class="col-md-10 col-sm-12 ftco-animate">
              <h1 class="mb-3">Tasty &amp; Delicious Food</h1> 
            </div>
          </div>
        </div>
      </div>

      <div class="slider-item" style="background-image: url('images/bg_3.jpg');">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center text-center">
            <div class="col-md-10 col-sm-12 ftco-animate">
              <h1 class="mb-3">Dine when you want, enjoy what you love.</h1> 
            </div>
          </div>
        </div>
      </div>

      <div class="slider-item" style="background-image: url('images/bg_4.jpg');">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center text-center">
            <div class="col-md-10 col-sm-12 ftco-animate">
              <h1 class="mb-3">Hungry? We're ready when you are!</h1> 
            </div>
          </div>
        </div>
      </div>

      <div class="slider-item" style="background-image: url('images/bg_5.jpg');">
        <div class="overlay"></div>
        <div class="container">
          <div class="row slider-text align-items-center justify-content-center text-center">
            <div class="col-md-10 col-sm-12 ftco-animate">
              <h1 class="mb-3">Delicious moments, just a click away.</h1> 
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- END slider -->

    <div class="ftco-section-reservation">
      <div class="container">
        <div class="row">
          <div class="col-md-12 reservation pt-5 px-5">
              <p style="font-size: 20px; color: #000;font-weight: bold;margin-top: -30px">Make a Reservation</p>
            <div class="block-17" style="min-height: 100px;">
              
              <form action="restaurant-list.php" method="POST" class="d-block d-lg-flex">
                <div class="fields d-block d-lg-flex">
                  <p style="font-size: 20px;color: #000">Country</p>
                  <div class="select-wrap one-half">
                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                    <select name="city" id="" class="form-control" disabled="">
                      <option value="India">India</option>
                    </select>
                  </div>
                    <p style="font-size: 20px;color: #000">Location</p>
                  <div class="select-wrap one-half">
                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                    <select data-plugin-selectTwo class="form-control populate" name="area" required=""  style="cursor: pointer;">
                      <option value=""> -Select- </option>
                      <?php 
                        include 'dbCon.php';
                        $con = connect();
                        $sql = "SELECT * FROM `locations`;";
                        $result = $con->query($sql);
                        foreach ($result as $r) {
                      ?>
                        <option value="<?php echo $r['id']; ?>"><?php echo $r['location_name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <input type="submit" class="search-submit btn btn-primary" name="find" value="Find">  
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    <?php include 'template/font-menu.php'; ?>  
    <section class="ftco-section bg-light">
      <div class="container special-dish"> 
           
            <h3 style="text-align: center;font: size 40px;">About Us</h3> 
           <p style="font-size: 20px;">At DineNexus, we specialize in transforming the traditional restaurant reservation experience into a modern, seamless, and intelligent process. Our web-based application is designed to simplify table bookings, minimize wait times, and enhance operational efficiency for restaurants of all sizes. With features like real-time reservation tracking,  and a smooth pre-ordering system, we ensure a personalized and convenient experience for every diner. Our platform also includes a split billing option, making group dining more flexible, and a loyalty rewards program to recognize and appreciate frequent customers with exclusive offers. For restaurant administrators and staff, DineNexus provides powerful tools for managing table data, overseeing reservation flow, and generating detailed analytics reports to support data-driven decisions. Secure, scalable, and user-friendly, DineNexus bridges the gap between exceptional customer service and efficient restaurant management, making it the perfect solution for the evolving hospitality landscape.</p> 
      </div>
    </section>

    
   
  <?php include 'template/instagram.php'; ?>

  <?php include 'template/footer.php'; ?>


  <?php include 'template/script.php'; ?>
  
  <script src="dashboard/assets/vendor/jquery/jquery.js"></script>
  <script src="dashboard/assets/vendor/select2/select2.js"></script>
  <script src="dashboard/assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
    
  </body>
</html>