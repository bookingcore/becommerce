@php $shipping = (!empty(session('shipping'))) ? session('shipping') : null @endphp
<div class="ps-section--shopping ps-shopping-cart">
    <div class="container">
        <form action="{{route('booking.cart')}}" method="post" class="form-cart">
            @csrf
            <div class="ps-section__content">
                <div class="table-responsive">
                    <table class="table ps-table--shopping-cart">
                        <thead>
                        <tr>
                            <th>{{__('PRODUCT NAME')}}</th>
                            <th>{{__('PRICE')}}</th>
                            <th>{{__('QUANTITY')}}</th>
                            <th>{{__('TOTAL')}}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @include('Booking::frontend.cart.list-cart')
                        </tbody>
                    </table>
                </div>
                <div class="ps-section__cart-actions">
                    <a class="ps-btn" href="/">
                        <i class="icon-arrow-left"></i> Back to Shop
                    </a>
                    <button type="submit" class="ps-btn ps-btn--outline">
                        <i class="icon-sync"></i> {{__('Update cart')}}
                    </button>
                </div>
            </div>
        </form>
        <div class="ps-section__footer">
           <div class="row">
              <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                  <form action="{{ route('booking.cart') }}" method="post" class="coupon-form">
                      @csrf
                      <figure>
                          <figcaption>{{__('Coupon Discount')}}</figcaption>
                          <div class="form-group">
                              <input class="form-control" type="text" name="coupon" placeholder="" required>
                          </div>
                          <div class="form-group">
                              <button type="submit" class="ps-btn ps-btn--outline">{{__('Apply')}}</button>
                          </div>
                      </figure>
                  </form>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                  <form action="{{route('booking.cart')}}" method="post" class="coupon-form">
                      @csrf
                      <figure>
                          <figcaption>{{ __('Calculate shipping') }}</figcaption>
                          <div class="form-group">
                              <select class="ps-select select2-hidden-accessible country_select" name="country">
                                  @foreach(get_country_lists() as $key => $country)
                                      <option value="{{$key}}" {{$shipping['country']['key'] == $key ? 'selected' : ''}}>{{$country}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="form-group">
                              <input class="form-control" type="text" name="address" placeholder="{{ __('Town/City') }}" value="{{$shipping['address']}}">
                          </div>
                          <div class="form-group">
                              <input class="form-control" type="text" name="postcode" placeholder="{{ __('Postcode/Zip') }}" value="{{$shipping['postcode']}}">
                          </div>
                          <div class="form-group">
                              <button type="submit" class="ps-btn ps-btn--outline">{{ __('Update') }}</button>
                          </div>
                      </figure>
                  </form>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                 <div class="ps-block--shopping-total">
                        <div class="ps-block__header">
                           <p>{{__('Subtotal')}}<span> {{format_money(Cart::subtotal())}}</span></p>
                        </div>
                        <div class="ps-block__content">
                            <ul class="ps-block__product">
                                @if(Cart::count())
                                    @foreach(Cart::content() as $item)
                                        <li>
                                            <span class="ps-block__shop">{{__(':author Shipping',['author'=>mb_strtoupper($item->model->author->getDisplayName())])}}</span>
                                            <span class="ps-block__estimate">
                                                {{ __('Estimate for') }}
                                                <strong style="color:#000">{{ (!empty($shipping['address'])) ? $shipping['address'].',' : ''}} {{ $shipping['country']['value'] ?? '' }}</strong>
                                               <a href="{{$item->model->getDetailUrl()}}">{{$item->model->title}} ×{{$item->qty}}</a>
                                            </span>
                                        </li>
                                    @endforeach
                                @endif
                                @if(!empty($coupons))
                                    @foreach($coupons as $coupon)
                                        <li class="coupon">
                                            <div class="coupon_text">
                                                <span class="c_text">{{__('Coupon: :code',['code'=>$coupon['name']])}}</span>
                                                <a href="{{route('booking.cart')}}?remove_coupon={{$coupon['name']}}" class="c_close icon-cross2"></a>
                                            </div>
                                            <div class="coupon_discount">
                                                @php $discount = ($coupon['type'] == 'percent') ? Cart::subtotal() * $coupon['discount']/100 : $coupon['discount'] @endphp
                                                <span class="c_discount">-{{format_money($discount)}}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                           <h3>{{__('Total')}} <span>{{format_money(Cart::final_total())}}</span></h3>
                        </div>
                 </div>
                 <a class="ps-btn ps-btn--fullwidth" href="{{route('booking.checkout')}}">{{ __('Proceed to checkout') }}</a>
              </div>
           </div>
        </div>
     </div>
</div>
