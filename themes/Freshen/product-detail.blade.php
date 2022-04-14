@extends("layouts.app")
@section('content')
     @include('global.breadcrumb')
     <!-- Shop Single Content -->
     <section class="bc-page-product shop-single-content pb70 ovh">
         <div class="container">
             <div class="row">
                 <div class="col-lg-6">
                     @include('product.details.gallery')
                 </div>
                 <div class="col-lg-6">
                     <div class="shop_single_product_details">
                         <div class="shop_item_stock mb30">
                             <span class="stock">IN STOCK</span>
                             <div class="sis_pagination float-end">
                                 <nav aria-label="Page navigation example">
                                     <ul class="pagination">
                                         <li class="page-item">
                                             <a class="page-link" href="#"><span class="flaticon-left-arrow vam"></span> PREV</a>
                                         </li>
                                         <li class="page-item"><a class="page-link" href="#">NEXT
                                                 <span class="flaticon-chevron vam"></span></a></li>
                                     </ul>
                                 </nav>
                             </div>
                         </div>
                         <h3 class="title mb20">Pineapple (Tropical Gold) 1 lb</h3>
                         <div class="sspd_review">
                             <ul class="mb15">
                                 <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                 <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                 <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                 <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                 <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                             </ul>
                         </div>
                         <div class="sspd_price mb35">
                             <small>
                                 <del>$79.49</del>
                             </small>
                             $27.63
                         </div>
                         <p class="mb25">Feugiat malesuada a a elit varius diam hac ad penatibus tellus vivamus suscipit duis suspendisse diam ac adipiscing mauris a lorem parturient ac viverra odio et etiam nisi.</p>
                         <ul class="cart_btns ui_kit_button mb30">
                             <li class="list-inline-item">
                                 <div class="cart_btn">
                                     <div class="quantity-block">
                                         <button class="quantity-arrow-minus inner_page"> -</button>
                                         <input class="quantity-num inner_page" type="number" value="2"/>
                                         <button class="quantity-arrow-plus inner_page"> +</button>
                                     </div>
                                 </div>
                             </li>
                             <li class="list-inline-item">
                                 <button type="button" class="btn btn-thm">
                                     <span class="flaticon-shopping-cart mr5 fz18 vam"></span> Add to Cart
                                 </button>
                             </li>
                         </ul>
                         <ul class="wishlist_compare">
                             <li class="list-inline-item">
                                 <a href="#" class="favorite_icon"><span class="flaticon-heart"></span> Add to Wishlist</a>
                             </li>
                             <li class="list-inline-item">
                                 <a href="#" class="favorite_icon"><span class="flaticon-shuffle"></span> Compare</a>
                             </li>
                         </ul>
                         <ul class="sspd_sku mb30">
                             <li><a href="#">SKU:</a> <span>OG1203 </span></li>
                             <li><a href="#">Categories:</a> <span>Meats, Fish Food</span></li>
                             <li><a href="#">Tags:</a> <span>Fish Food, Meats</span></li>
                             <li class="df"><a href="#">Share:</a>
                                 <span class="social_icons">
              <ul class="mb0">
                <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                <li class="list-inline-item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
              </ul>
            </span>
                             </li>
                         </ul>
                     </div>
                 </div>
                 <div class="col-lg-12">
                     <div class="shop_single_tab_content mt30">
                         <ul class="nav nav-tabs justify-content-center" id="myTab2" role="tablist">
                             <li class="nav-item" role="presentation">
                                 <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                             </li>
                             <li class="nav-item" role="presentation">
                                 <button class="nav-link" id="aiinfo-tab" data-bs-toggle="tab" data-bs-target="#aiinfo" type="button" role="tab" aria-controls="aiinfo" aria-selected="false">Additional information</button>
                             </li>
                             <li class="nav-item" role="presentation">
                                 <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false"> Reviews (9)</button>
                             </li>
                         </ul>
                         <div class="tab-content" id="myTabContent2">
                             <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                 <div class="row">
                                     <div class="col-lg-12">
                                         <div class="product_single_content">
                                             <div class="mbp_pagination_comments">
                                                 <div class="mbp_first">
                                                     <p class="mb25">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus.</p>
                                                     <div class="ui_page_heading">
                                                         <ul class="order_list list-style-type-bullet list-inline-item">
                                                             <li>
                                                                 <a href="#">Nunc nec porttitor turpis. In eu risus enim. In vitae mollis elit.</a>
                                                             </li>
                                                             <li><a href="#">Vivamus finibus vel mauris ut vehicula.</a>
                                                             </li>
                                                             <li>
                                                                 <a href="#">Nullam a magna porttitor, dictum risus nec, faucibus sapien.</a>
                                                             </li>
                                                         </ul>
                                                     </div>
                                                     <p class="mt10">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. Aenean dignissim pellentesque felis. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus.</p>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="tab-pane fade" id="aiinfo" role="tabpanel" aria-labelledby="aiinfo-tab">
                                 <div class="row justify-content-center">
                                     <div class="col-lg-7">
                                         <div class="shop_item_ai_info">
                                             <ul class="mb0">
                                                 <li><a href="#">Weight <span class="float-end">1 kg</span></a></li>
                                                 <li><a href="#">Dimensions
                                                         <span class="float-end">224 × 65 × 564 cm</span></a></li>
                                                 <li><a href="#">Brand <span class="float-end">Evoylink</span></a></li>
                                             </ul>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                 <div class="row">
                                     <div class="col-lg-6">
                                         <div class="shop_single_tab_content mb30-991">
                                             <div class="product_single_content">
                                                 <div class="mbp_pagination_comments">
                                                     <h5 class="fz16 mb30">Reviews</h5>
                                                     <div class="mbp_first d-flex align-items-center">
                                                         <div class="flex-shrink-0">
                                                             <img src="images/blog/reviewer1.png" class="mr-3" alt="reviewer1.png">
                                                         </div>
                                                         <div class="flex-grow-1 ms-4">
                                                             <h4 class="sub_title mt20">Bessie Cooper</h4>
                                                             <div class="sspd_postdate mb15">April 6, 2021 at 3:21 AM
                                                                 <div class="sspd_review pull-right">
                                                                     <ul class="mb0 pl15">
                                                                         <li class="list-inline-item">
                                                                             <a href="#"><i class="fa fa-star"></i></a>
                                                                         </li>
                                                                         <li class="list-inline-item">
                                                                             <a href="#"><i class="fa fa-star"></i></a>
                                                                         </li>
                                                                         <li class="list-inline-item">
                                                                             <a href="#"><i class="fa fa-star"></i></a>
                                                                         </li>
                                                                         <li class="list-inline-item">
                                                                             <a href="#"><i class="fa fa-star"></i></a>
                                                                         </li>
                                                                         <li class="list-inline-item">
                                                                             <a href="#"><i class="fa fa-star"></i></a>
                                                                         </li>
                                                                     </ul>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <p class="mt15 mb30">Every single thing we tried with John was delicious! Found some awesome places we would definitely go back to on our trip. John was also super friendly and passionate about Beşiktaş and Istanbul.</p>
                                                     <hr>
                                                     <div class="mbp_first d-flex align-items-center">
                                                         <div class="flex-shrink-0">
                                                             <img src="images/blog/reviewer2.png" class="mr-3" alt="reviewer2.png">
                                                         </div>
                                                         <div class="flex-grow-1 ms-4">
                                                             <h4 class="sub_title mt20">Savannah Nguyen</h4>
                                                             <div class="sspd_postdate mb15">April 6, 2021 at 3:21 AM
                                                                 <div class="sspd_review pull-right">
                                                                     <ul class="mb0 pl15">
                                                                         <li class="list-inline-item">
                                                                             <a href="#"><i class="fa fa-star"></i></a>
                                                                         </li>
                                                                         <li class="list-inline-item">
                                                                             <a href="#"><i class="fa fa-star"></i></a>
                                                                         </li>
                                                                         <li class="list-inline-item">
                                                                             <a href="#"><i class="fa fa-star"></i></a>
                                                                         </li>
                                                                         <li class="list-inline-item">
                                                                             <a href="#"><i class="fa fa-star"></i></a>
                                                                         </li>
                                                                         <li class="list-inline-item">
                                                                             <a href="#"><i class="fa fa-star"></i></a>
                                                                         </li>
                                                                     </ul>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <p class="mt15 mb30">Every single thing we tried with John was delicious! Found some awesome places we would definitely go back to on our trip. John was also super friendly and passionate about Beşiktaş and Istanbul.</p>
                                                     <hr>
                                                     <div class="mbp_first d-flex align-items-center">
                                                         <div class="flex-shrink-0">
                                                             <img src="images/blog/reviewer3.png" class="mr-3" alt="reviewer3.png">
                                                         </div>
                                                         <div class="flex-grow-1 ms-4">
                                                             <h4 class="sub_title mt20">Albert Flores</h4>
                                                             <div class="sspd_postdate mb15">April 6, 2021 at 3:21 AM
                                                                 <div class="sspd_review pull-right">
                                                                     <ul class="mb0 pl15">
                                                                         <li class="list-inline-item">
                                                                             <a href="#"><i class="fa fa-star"></i></a>
                                                                         </li>
                                                                         <li class="list-inline-item">
                                                                             <a href="#"><i class="fa fa-star"></i></a>
                                                                         </li>
                                                                         <li class="list-inline-item">
                                                                             <a href="#"><i class="fa fa-star"></i></a>
                                                                         </li>
                                                                         <li class="list-inline-item">
                                                                             <a href="#"><i class="fa fa-star"></i></a>
                                                                         </li>
                                                                         <li class="list-inline-item">
                                                                             <a href="#"><i class="fa fa-star"></i></a>
                                                                         </li>
                                                                     </ul>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <p class="mt15">Every single thing we tried with John was delicious! Found some awesome places we would definitely go back to on our trip. John was also super friendly and passionate about Beşiktaş and Istanbul.</p>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-lg-6">
                                         <div class="bsp_reveiw_wrt pt30">
                                             <form class="comments_form">
                                                 <div class="row">
                                                     <div class="col-lg-12">
                                                         <h5 class="fz16 mb30">Be the first to review “Pineapple (Tropical Gold) 1 lb” </h5>
                                                         <p class="fz14 mb30">Your email address will not be published. Required fields are marked *</p>
                                                         <div class="sspd_review mb30">
                                                             <ul>
                                                                 <li class="list-inline-item">
                                                                     <span class="heading-color fz14">Your Rating</span>
                                                                 </li>
                                                                 <li class="list-inline-item">
                                                                     <a href="#"><i class="fa fa-star"></i></a></li>
                                                                 <li class="list-inline-item">
                                                                     <a href="#"><i class="fa fa-star"></i></a></li>
                                                                 <li class="list-inline-item">
                                                                     <a href="#"><i class="fa fa-star"></i></a></li>
                                                                 <li class="list-inline-item">
                                                                     <a href="#"><i class="fa fa-star"></i></a></li>
                                                                 <li class="list-inline-item">
                                                                     <a href="#"><i class="fa fa-star"></i></a></li>
                                                             </ul>
                                                         </div>
                                                     </div>
                                                     <div class="col-md-12">
                                                         <div class="form-group">
                                                             <label class="fz14 heading-color mb10">Your review *</label>
                                                             <textarea class="form-control" rows="6"></textarea>
                                                         </div>
                                                     </div>
                                                     <div class="col-md-6">
                                                         <div class="form-group">
                                                             <label class="fz14 heading-color mb10">Name</label>
                                                             <input type="text" class="form-control">
                                                         </div>
                                                     </div>
                                                     <div class="col-md-6">
                                                         <div class="form-group">
                                                             <label class="fz14 heading-color mb10">Email</label>
                                                             <input type="email" class="form-control">
                                                         </div>
                                                     </div>
                                                     <div class="col-md-12">
                                                         <div class="form-check">
                                                             <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                                             <label class="form-check-label" for="defaultCheck1">Save my name, email, and website in this browser for the next time I comment.</label>
                                                         </div>
                                                         <button type="submit" class="btn btn-thm">SUBMIT</button>
                                                     </div>
                                                 </div>
                                             </form>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
@endsection
@section('footer')
    <script>
        jQuery(function ($) {
            $(window).on("load", function () {
                var urlHash = window.location.href.split("#")[1];
                if (urlHash &&  $('.' + urlHash).length ){
                    new bootstrap.Tab(document.querySelector('#tab-review')).show();
                    var offset_other = 70;
                    $('html,body').animate({
                        scrollTop: $('.' + urlHash).offset().top - offset_other
                    }, 1000);
                }
            });
        })
    </script>
@endsection