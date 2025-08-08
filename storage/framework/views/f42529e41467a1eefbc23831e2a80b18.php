<?php $__env->startSection('styles'); ?>
<!-- Custom CSS for landing page already included in app.blade.php -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- loader -->
<div class="loader_bg">
   <div class="loader"><img src="<?php echo e(asset('css/images/loading.gif')); ?>" alt="Loading" /></div>
</div>
<!-- end loader -->

<!-- banner -->
<section class="banner_main">
   <div id="banner1" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
         <li data-target="#banner1" data-slide-to="0" class="active"></li>
         <li data-target="#banner1" data-slide-to="1"></li>
         <li data-target="#banner1" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
         <div class="carousel-item active">
            <div class="container-fluid">
               <div class="carousel-caption">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="text-bg">
                           <h1>Premium Car Workshop</h1>
                           <p>Your vehicle deserves the best care. Our certified technicians provide comprehensive repair and maintenance services using state-of-the-art equipment and genuine parts to keep your car running at peak performance.</p>
                           <a href="<?php echo e(url('/book-appointment')); ?>" class="btn btn-primary"> Book Now</a>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="text_img">
                           <figure><img src="<?php echo e(asset('css/images/car.png')); ?>" alt="Car" /></figure>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="carousel-item">
            <div class="container-fluid">
               <div class="carousel-caption">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="text-bg">
                           <h1>Trusted Auto Service</h1>
                           <p>From routine maintenance to complex repairs, our skilled team handles everything with precision and care. We pride ourselves on transparent pricing, quick turnaround times, and exceptional customer service.</p>
                           <a href="<?php echo e(url('/contact-admin')); ?>" class="btn btn-secondary">Contact Us</a>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="text_img">
                           <figure><img src="<?php echo e(asset('css/images/car.png')); ?>" alt="Car" /></figure>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <a class="carousel-control-prev" href="#banner1" role="button" data-slide="prev">
      <i class="fa fa-chevron-left" aria-hidden="true"></i>
      </a>
      <a class="carousel-control-next" href="#banner1" role="button" data-slide="next">
      <i class="fa fa-chevron-right" aria-hidden="true"></i>
      </a>
   </div>
</section>
<!-- end banner -->

<!-- three_box -->
<div class="three_box">
   <div class="container">
      <div class="row">
         <div class="col-md-4">
            <div class="box_text">
               <h3>DIAGNOSTICS</h3>
               <i><img src="<?php echo e(asset('css/images/thr.png')); ?>" alt="Auto Diagnose" /></i>
               <p>State-of-the-art computer diagnostics to identify issues with precision. Our advanced equipment detects problems quickly for accurate repairs.</p>
            </div>
         </div>
         <div class="col-md-4">
            <div class="box_text">
               <h3>REPAIR SERVICE</h3>
               <i><img src="<?php echo e(asset('css/images/thr1.png')); ?>" alt="Auto Repair" /></i>
               <p>Expert technicians perform quality repairs for all vehicle makes and models. From engine work to electrical systems, we fix it right.</p>
            </div>
         </div>
         <div class="col-md-4">
            <div class="box_text">
               <h3>MAINTENANCE</h3>
               <i><img src="<?php echo e(asset('css/images/thr2.png')); ?>" alt="Auto Maintenance" /></i>
               <p>Regular maintenance packages to keep your vehicle running smoothly. Scheduled services prevent costly repairs and extend your car's life.</p>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- three_box -->

<!-- about -->
<div class="about">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage">
               <h2>About Our Car Service</h2>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="row">
            <div class="col-md-10 offset-md-1">
               <div class="about_img">
                  <div class="about_box">
                     <h3>Professional Auto Service Since 2005</h3>
                     <p>With over 20 years of experience in the automotive industry, our workshop has built a reputation for excellence and reliability. Our certified technicians are trained to handle all makes and models, using only genuine parts and the latest diagnostic equipment. We believe in transparent pricing, quality workmanship, and building long-term relationships with our customers. Whether you need routine maintenance, complex repairs, or performance upgrades, our team is dedicated to keeping your vehicle running at its best while providing exceptional customer service.</p>
                     <a href="<?php echo e(url('/contact-admin')); ?>" class="btn btn-primary">Contact Us</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end about -->

<!-- wedo section -->
<div class="wedo">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage">
               <h2>What We Do</h2>
               <p>Our comprehensive range of automotive services to keep your vehicle in perfect condition</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-10 offset-md-1">
            <div class="row">
               <div class="col-md-6 margin_bottom">
                  <div class="work">
                     <figure><img src="<?php echo e(asset('css/images/img1.png')); ?>" alt="Service" /></figure>
                  </div>
                  <div class="work_text">
                     <h3>Engine Repair<br><span class="blu">Complete Overhaul</span></h3>
                  </div>
               </div>
               <div class="col-md-6 margin_bottom">
                  <div class="work">
                     <figure><img src="<?php echo e(asset('css/images/img2.png')); ?>" alt="Service" /></figure>
                  </div>
                  <div class="work_text">
                     <h3>Brake Service<br><span class="blu">Safety Assured</span></h3>
                  </div>
               </div>
               <div class="col-md-6 margin_bottom">
                  <div class="work">
                     <figure><img src="<?php echo e(asset('css/images/img3.png')); ?>" alt="Service" /></figure>
                  </div>
                  <div class="work_text">
                     <h3>Electric Systems<br><span class="blu">Diagnostic & Repair</span></h3>
                  </div>
               </div>
               <div class="col-md-6 margin_bottom">
                  <div class="work">
                     <figure><img src="<?php echo e(asset('css/images/img4.png')); ?>" alt="Service" /></figure>
                  </div>
                  <div class="work_text">
                     <h3>Oil Change<br><span class="blu">Regular Maintenance</span></h3>
                  </div>
               </div>
            </div>
            <a href="<?php echo e(url('/book-appointment')); ?>" class="btn btn-primary read_more">Book Appointment</a>
         </div>
      </div>
   </div>
</div>
<!-- end wedo section -->

<!-- testimonial -->
<div class="testimonial">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="titlepage">
               <h2>Testimonials</h2>
               <p>What our satisfied customers say about our service</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div id="myCarousel" class="carousel slide testimonial_Carousel" data-ride="carousel">
               <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
               </ol>
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="container">
                        <div class="carousel-caption">
                           <div class="row">
                              <div class="col-md-6 margin_boot">
                                 <div class="test_box">
                                    <i><img src="<?php echo e(asset('css/images/tes.jpg')); ?>" alt="Testimonial" /></i>
                                    <h4>Robert</h4>
                                    <span>BMW Owner</span>
                                    <p>"I've been bringing my BMW to this workshop for over 3 years now. Their attention to detail is remarkable, and the technicians are incredibly knowledgeable. What impresses me most is how they take the time to explain what needs to be done and why. Absolutely trustworthy service!"</p>
                                 </div>
                              </div>
                              <div class="col-md-6 margin_boot">
                                 <div class="test_box">
                                    <i><img src="<?php echo e(asset('css/images/tes1.jpg')); ?>" alt="Testimonial" /></i>
                                    <h4>Sarah</h4>
                                    <span>Toyota Owner</span>
                                    <p>"After a disappointing experience at a dealership, I found this workshop and couldn't be happier. Their prices are fair, service is quick, and they stand behind their work. My Toyota is running better than ever, and they even followed up a week later to make sure everything was still perfect."</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="container">
                        <div class="carousel-caption">
                           <div class="row">
                              <div class="col-md-6 margin_boot">
                                 <div class="test_box">
                                    <i><img src="<?php echo e(asset('css/images/tes.jpg')); ?>" alt="Testimonial" /></i>
                                    <h4>David</h4>
                                    <span>Mercedes Owner</span>
                                    <p>"I was worried about finding a reliable mechanic for my Mercedes outside the dealership. This workshop exceeded my expectations. They diagnosed an electrical issue that two other places missed, and fixed it for much less than I expected. Their diagnostic equipment is truly state-of-the-art."</p>
                                 </div>
                              </div>
                              <div class="col-md-6 margin_boot">
                                 <div class="test_box">
                                    <i><img src="<?php echo e(asset('css/images/tes1.jpg')); ?>" alt="Testimonial" /></i>
                                    <h4>Amanda</h4>
                                    <span>Honda Owner</span>
                                    <p>"As a woman who knows very little about cars, I appreciate how this workshop treats me with respect and never tries to upsell unnecessary services. They provide clear explanations, photo documentation of issues, and reasonable prices. I feel comfortable recommending them to anyone."</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
               </a>
               <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
               </a>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end testimonial -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- JavaScript files already included in app.blade.php -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/badhon/Documents/CSE391/ass3/Karigor/resources/views/landing.blade.php ENDPATH**/ ?>