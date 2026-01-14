@extends('front.layout.master')

@section('title', 'Product')

@section('body')
    <!-- Product Shop Section Begin-->
    <section class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                    @include('front.shop.components.products-sidebar-filter')
                </div>

                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-pic-zoom">
                                <img class="product-big-img" src="{{ asset('storage/' . $product->productImages[0]->path) }}"
                                    alt="" style="width: 409px; height: 459px">
                                <div class="zoom-icon">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>

                            <div class="product-thumbs">
                                <div class="product-thumbs-track ps-slider owl-carousel">
                                    @foreach ($product->productImages as $productImage)
                                        <div class="pt active"
                                            data-imgbigurl="{{ asset('storage/' . $productImage->path) }}">

                                            <img src="{{ asset('storage/' . $productImage->path) }}"
                                                style="width: 130px; height: 145px" alt="">

                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    <span>{{ $product->tag }}</span>
                                    <h3>{{ $product->name }}</h3>
                                </div>

                                <div class="pd-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $product->avgRating)
                                            <i class="fa fa-star"></i>
                                        @elseif ($i - 0.5 <= $product->avgRating)
                                            <i class="fa fa-star-half-o"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    @endfor

                                    <span>({{ count($product->productComments) }})</span>
                                </div>

                                <div class="pd-desc">
                                    <p>{{ $product->content }}</p>
                                    @if ($product->discount != null)
                                        <h4>${{ $product->discount }}<span>${{ $product->price }}</span></h4>
                                    @else
                                        <h4>${{ $product->price }}</h4>
                                    @endif
                                </div>

                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1" id="qty">
                                    </div>

                                    <a href="javascript:void(0);" onclick="addToCart({{ $product->id }}, $('#qty').val())"
                                        class="primary-btn pd-cart">
                                        Add To Cart
                                    </a>


                                </div>
                                <ul class="pd-tags">
                                    <li><span>CATEGORIES</span>: {{ $product->productCategory?->name }}</li>
                                    <li><span>TAGS</span>: {{ $product->tag }}</li>
                                </ul>
                                <div class="pd-share">
                                    <div class="pd-social">
                                        <a href="#"><i class="ti-facebook"></i></a>
                                        <a href="#"><i class="ti-twitter-alt"></i></a>
                                        <a href="#"><i class="ti-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="product-tab">
                        <div class="tab-item">
                            <ul class="nav" role="tablist">
                                <li><a class="active" href="#tab-1" data-toggle="tab" role="tab">DESCRIPTION</a></li>
                                <li><a href="#tab-2" data-toggle="tab" role="tab">SPECIFICATIONS</a></li>
                                <li><a href="#tab-3" data-toggle="tab" role="tab">Customer Reviews
                                        ({{ count($product->productComments) }})</a></li>
                            </ul>
                        </div>

                        <div class="tab-item-content">
                            <div class="tab-content">
                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    <div class="product-content">

                                        {!! $product->description !!}

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                    <div class="specification-table">
                                        <table>

                                            <tr>
                                                <td class="p-catagory">Customer Rating</td>
                                                <td>
                                                    <div class="pd-rating">

                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $product->avgRating)
                                                                <i class="fa fa-star"></i>
                                                            @else
                                                                <i class="fa fa-star-o"></i>
                                                            @endif
                                                        @endfor

                                                        <span>({{ count($product->productComments) }})</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Price</td>
                                                <td>
                                                    <div class="p-price">${{ $product->price }}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Add to cart</td>
                                                <td>
                                                    <div class="cart-add">+ add to cart</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Availability</td>
                                                <td>
                                                    <div class="p-stock">{{ $product->qty }}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Weight</td>
                                                <td>
                                                    <div class="p-weight">{{ $product->weight }}kg</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                    <div class="customer-review-option">
                                        <h4>{{ count($product->productComments) }} Comments</h4>
                                        <div class="comment-option">

                                            @foreach ($product->productComments as $productComment)
                                                <div class="co-item">
                                                    <div class="avatar-pic">
                                                        <img src="{{ $productComment->user->avatar ?? 'front/img/user/default-avatar.png' }}"
                                                            alt="">
                                                    </div>
                                                    <div class="avatar-text">
                                                        <div class="at-rating">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $productComment->rating)
                                                                    <i class="fa fa-star"></i>
                                                                @else
                                                                    <i class="fa fa-star-o"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <h5>{{ $productComment->name }}<span>{{ date('M, d, Y', strtotime($productComment->created_at)) }}</span>
                                                        </h5>
                                                        <div class="at-reply">{{ $productComment->messages }}</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="leave-comment">
                                            <h4>Leave A Comment</h4>

                                            <form action="{{ route('shop.postComment', $product->id) }}" method="POST"
                                                class="comment-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <input type="text" name="name" placeholder="Name" required
                                                            value="{{ Auth::user()->name ?? '' }}">
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <input type="email" name="email" placeholder="Email"
                                                            value="{{ Auth::user()->email ?? '' }}" required>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <textarea name="messages" placeholder="Messages" required></textarea>

                                                        <div class="personal-rating">
                                                            <h6>Your Rating</h6>
                                                            <div class="rate">
                                                                <input type="radio" id="star5" name="rating"
                                                                    value="5"><label for="star5"></label>
                                                                <input type="radio" id="star4" name="rating"
                                                                    value="4"><label for="star4"></label>
                                                                <input type="radio" id="star3" name="rating"
                                                                    value="3"><label for="star3"></label>
                                                                <input type="radio" id="star2" name="rating"
                                                                    value="2"><label for="star2"></label>
                                                                <input type="radio" id="star1" name="rating"
                                                                    value="1"><label for="star1"></label>
                                                            </div>
                                                        </div>

                                                        <button type="submit" class="site-btn">Send message</button>
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
    <!-- Product Shop Section End-->

    <!-- Related Products section Begin-->
    <div class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach ($relatedProducts as $product)
                    <div class="col-lg-3 col-sm-6">
                        @include('front.components.product-item')
                    </div>
                @endforeach


            </div>
        </div>
    </div>

    </div>
    <!-- Related Products section End-->

@endsection
