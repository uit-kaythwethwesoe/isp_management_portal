<?php

header("Content-Type:text/css");

if( isset( $_GET[ 'color' ] ) ) {
    $color = '#'.$_GET[ 'color' ];
}else{
  $color = "#983ce9";
}

?>

.pricingPlan-section .single-price .name,
.about-section .left-content .list li p:hover,
.pricingPlan-section .owl-controls .owl-nav div:hover,
.offer-section .offer-list li .content::after,
.address-widget .about-info li p i,
.footer-newsletter-widget .newsletter-form-area button,
.bottomtotop i,
.branch-page .single-branch .content .top-area .icon,
.team .team-member .member-data,
.team .team-member .social,
.user-dashboard-area .card .card-header,
.user-dashboard-area .user-menu ul li a::after,
.mainmenu-area .navbar #main_menu .navbar-nav .nav-item .dropdown-menu .dropdown-item:hover, 
.mainmenu-area .navbar #main_menu .navbar-nav .nav-item .dropdown-menu .dropdown-item.active,
.service-area.service-page .get-support,
.testimonial .testimonial-slider .owl-controls .owl-nav div:hover,
.product-details-section .right-area .product-info .qtySelector i:hover,
.about-section .list li p:hover
{
background: <?php echo $color; ?>;
}

.input-group-text,
.mainmenu-area .navbar #main_menu .navbar-nav .nav-link.active,
.mainmenu-area .navbar #main_menu .navbar-nav .nav-link:hover,
.mainmenu-area .top-header .right-content ul li a.mybtn1:hover,
.mybtn1:hover,
.offer-section .offer-list li .content::before,
.contact-banner .left-content .number,
.footer-newsletter-widget .social-links .fotter-social-links ul li a:hover,
.pricingPlan-section .owl-controls .owl-nav div,
.media-page .single-service.entertainment .title,
.media-page .single-service.media .title,
.contact-us .right-area .contact-info .left .icon,
.contact-us .right-area .social-links ul li a,
.success-section .success-box .icon,
.page-link,
.auth .sign-form .reg-text a:hover,
.single-blog .content .title:hover,
.service-area.service-page .category-widget .category-list li a:hover, 
.service-area.service-page .category-widget .category-list li a.active,
.categori-widget .cat-list li.active p,
.categori-widget .cat-list li a:hover p,
.latest-post-widget .post-list li .post .post-details:hover a,
.testimonial .testimonial-slider .owl-controls .owl-nav div,
.checkout-area .cart-product .add-shiping-methods table tbody tr td p span,
.shop-section .single-product .content .price,
.shop-section .single-product .content .name a:hover,
.latest-post-widget .post-list li .post .post-details .post-title:hover,
.progress-steps li.active .icon
{
color: <?php echo $color; ?>!important;
}



.mybtn1,
.footer-newsletter-widget .social-links .fotter-social-links ul li a,
.contact-us .left-area .contact-form .submit-btn,
.contact-us .right-area .social-links ul li a:hover
{
background: <?php echo $color; ?>;
border: 1px solid <?php echo $color; ?>;
}

.offer-section .offer-list li .content:hover::before,
.contact-us .right-area .social-links ul li a:hover,
.select-payment .payment_gateway_check .mybtn1.active, 
.select-payment .payment_gateway_check .mybtn1:hover
{
color: #fff!important;
}

.branch-page .single-branch,
.contact-us .left-area .contact-form ul li .input-field:focus,
.contact-us .left-area .contact-form .submit-btn:hover
{
border: 1px solid <?php echo $color; ?>;
}

.loader-1 .loader-outter {
border: 4px solid <?php echo $color; ?>;
border-left-color: transparent;
border-bottom: 0;
}

.loader-1 .loader-inner {
border: 4px solid <?php echo $color; ?>;
border-right: 0;
border-top-color: transparent;
}

.select-payment .payment_gateway_check .mybtn1{
  border: 1px solid <?php echo $color; ?>;
  color: <?php echo $color; ?>;
}
.select-payment .payment_gateway_check .mybtn1.active,
.select-payment .payment_gateway_check .mybtn1:hover
{
  background: <?php echo $color; ?>;
}

.select-payment .plan_payment_gateway_check.active .mybtn2{
  background: <?php echo $color; ?>;
  color: #fff;
}


.page-item.active .page-link {
    background-color: <?php echo $color; ?>;
    border-color: <?php echo $color; ?>;
}
.page-item.active .page-link{
  color: #fff!important;
}

.product_payment_gateway_check.active .mybtn2{
  border-color: <?php echo $color; ?>;
  background: <?php echo $color; ?>;
  color: #fff;
}

.mybtn2 {
    color: <?php echo $color; ?>;
    border: 1px solid <?php echo $color; ?>;
}
.mybtn2:hover {
    background:  <?php echo $color; ?>;
}

button.cookie-consent__agree{
  background-color: <?php echo $color; ?>;
}