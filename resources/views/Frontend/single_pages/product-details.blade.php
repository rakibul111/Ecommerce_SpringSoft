@extends('Frontend.layouts.master')
@section('content')
    <div class="breadcrumb-area bg-gray">
        <div class="container">
         
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{url('/')}}">Home</a>
                    </li>
                    <li class="active">product details </li>
                </ul>
            </div>
        
        </div>
    </div>
    <div class="product-details-area pt-120 pb-115">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5">
                    <div class="product-details-tab">
                        <div class="pro-dec-big-img-slider text-center">
                           {{-- <div class="easyzoom-style">
                                <div class="easyzoom easyzoom--overlay">
                                    <a href="{{""}}/assets/images/product-details/b-large-1.jpg">
                                        <img src="{{"/upload/products_images/$product->image"}}" alt="">
                                    </a>
                                </div>
                                <a class="easyzoom-pop-up img-popup" href="{{""}}/assets/images/product-details/b-large-1.jpg"><i class="icon-size-fullscreen"></i></a>
                            </div>--}}
                            <div class="easyzoom-style">
                                <div class="easyzoom easyzoom--overlay float-right">
                                    <a href="{{"/upload/products_images/$product->image"}}">
                                        <img src="{{"/upload/products_images/$product->image"}}" style="" alt="Product Image">
                                    </a>
                                </div>
                                <a class="easyzoom-pop-up img-popup" href="{{"/upload/products_images/$product->image"}}"><i class="icon-size-fullscreen"></i></a>
                            </div>
                            @if($product->sub_images)
                                @foreach($product->sub_images as $image)
                                <div class="easyzoom-style">
                                    <div class="easyzoom easyzoom--overlay float-right">
                                        <a href="{{"/upload/products_images/sub_images/$image->image"}}">
                                            <img src="{{"/upload/products_images/sub_images/$image->image"}}" style="" alt="Product Image">
                                        </a>
                                    </div>
                                    <a class="easyzoom-pop-up img-popup" href="{{"/upload/products_images/sub_images/$image->image"}}"><i class="icon-size-fullscreen"></i></a>
                                </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="product-dec-slider-small product-dec-small-style1">
                            <div class="product-dec-small active">
                                <img src="{{"/upload/products_images/$product->image"}}" alt="">
                            </div>
                            @if($product->sub_images)
                            @foreach($product->sub_images as $image)
                            <div class="product-dec-small active">
                                <img src="{{"/upload/products_images/sub_images/$image->image"}}" alt="">
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <form id="addToCartForm" action="{{ route('insert.cart') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">

                    <div class="product-details-content pro-details-content-mrg">
                        <h2>{{$product->name}}</h2>
                        <div class="product-ratting-review-wrap">
                            <div class="product-ratting-digit-wrap">
                                <div class="product-ratting">
                                    {{--<input class="input-2" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="1" data-size="md" data-step="0.1" value="{{ $rating }}">--}}
                                    @if($rating == 1)
                                    <i class="icon_star"></i>
                                    @elseif($rating == 2)
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    @elseif($rating == 3)
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    <i class="icon_star"></i>
                                    @elseif($rating == 4)
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    @elseif($rating == 5)
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                        <i class="icon_star"></i>
                                    @endif
                                </div>
                                <div class="product-digit">
                                    <span>{{$rating}}</span>
                                </div>
                            </div>
                            <div class="product-review-order">
                                <span>{{count($product->reviews)}} Reviews</span>
                                <span>{{$orders}} orders</span>
                            </div>
                        </div>
                        <p>{{$product->short_descc}}</p>
                        <div class="pro-details-price">
                            <span class="new-price">{{ ($product->promo_price) ? $product->promo_price : $product->price }} Tk.</span>
                            <span class="old-price"> {{ ($product->promo_price) ?  $product->price .'Tk.' : null}}</span>
                        </div>
                        @if(count($product->colors) > 0)
                            <input type="number" id="colorInput" name="color_id" value="" hidden>
                        <div class="pro-details-color-wrap">
                            <span>Colors:</span>
                            <div class="pro-details-color-content">
                                {{--<select class="js-select2" name="color_id">
                                    <option>Choose an option</option>
                                        @foreach ($colors as $color)
                                        <option id="selectColors" value="{{ $color->color_id }}">{{ $color['color']['name'] }}</option>

                                        @endforeach
                                </select>--}}
                                <ul>
                                    @foreach ($colors as $color)
                                        <li class="colorLi" data-id="{{ $color->color_id}}"><a class="{{strtolower($color['color']['name'])}}" href="#">{{ $color['color']['name'] }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif

                        @if(count($product->sizes) > 0)
                            <input type="number" id="sizeInput" name="size_id" value="" hidden>
                        <div class="pro-details-size">
                            <span>Sizes:</span>
                            <div class="pro-details-size-content">
                                {{--<select class="js-select2" name="size_id"  >
                                    <option>Choose an option</option>
                                    @foreach ($sizes as $size)
                                    <option value=" {{ $size->size_id }}">{{ $size['size']['name'] }}</option>

                                    @endforeach
                            </select>--}}
                                <ul>
                                    @foreach ($sizes as $size)
                                    <li class="sizeLi" data-id="{{$size->size_id}}"><a class="productSizeContent" href="">{{ $size['size']['name'] }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif
                        <div class="pro-details-quality">
                            <span>Quantity:</span>
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" type="text" name="qty" value="1">
                            </div>
                        </div>
                        <div class="product-details-meta">
                            <ul>
                                <li><span>Categories:</span>
                                    <a href="#">{{$product->category->name}},</a>
                                </li>
                                <li><span>Tag: </span>
                                    @if(!empty($product->tag->name))
                                    <a href="#">{{$product->tag->name}},</a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                        <div class="pro-details-action-wrap">
                            <div class="pro-details-add-to-cart">
                                {{-- <a href="{{ route('insert.cart') }}">Add To Cart </a> --}}
                                {{--<input id="submitBtn" type="submit" value="Add To Cart">--}}
                                <input id="submitBtn" type="submit" value="Add To Cart"></a>
                            </div>

                            <div class="pro-details-action">
                                <a title="Add to Wishlist" href="{{ route('wishlist.add',$product->id) }}"><i class="icon-heart"></i></a>
                                <a title="Add to Compare" href="#"><i class="icon-refresh"></i></a>
                                <a class="social" title="Social" href="#"><i class="icon-share"></i></a>
                                <div class="product-dec-social">
                                    <a class="facebook" title="Facebook" href="#"><i class="icon-social-facebook"></i></a>
                                    <a class="twitter" title="Twitter" href="#"><i class="icon-social-twitter"></i></a>
                                    <a class="instagram" title="Instagram" href="#"><i class="icon-social-instagram"></i></a>
                                    <a class="pinterest" title="Pinterest" href="#"><i class="icon-social-pinterest"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="description-review-wrapper pb-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="dec-review-topbar nav mb-45">
                        <a class="active" data-toggle="tab" href="#des-details1">Description</a>
                        <a data-toggle="tab" href="#des-details2">Specification</a>
                        <a data-toggle="tab" href="#des-details4">Reviews and Ratting </a>
                    </div>
                    <div class="tab-content dec-review-bottom">
                        <div id="des-details1" class="tab-pane active">
                            <div class="description-wrap">
                                <p>{{$product->short_desc}}</p>
                                <p>{{$product->long_desc}}</p>
                            </div>
                        </div>
                        <div id="des-details2" class="tab-pane">
                            <div class="specification-wrap table-responsive">
                                <table class="text-center">
                                    <tbody>
                                    <tr>
                                        <td class="title width1">Name</td>
                                        <td>{{$product->name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="title width1">Categories</td>
                                        <td>{{($product->category->name) ? $product->category->name: "----"}}</td>
                                    </tr>
                                    @if(count($product->sizes) > 0)
                                    <tr>
                                        <td class="title width1">Size</td>
                                        <td>
                                            @foreach($product->sizes as $size)
                                                {{$size->name}},
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td class="title width1">Brand </td>
                                        <td>{{($product->brand) ? $product->brand->name: "----"}}</td>
                                    </tr>
                                    @if(count($product->colors) > 0)
                                    <tr>
                                        <td class="title width1">Color</td>
                                        <td>
                                        @foreach($product->colors as $color)
                                            {{$color->name}} ,
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if($reviews)
                        <div id="des-details4" class="tab-pane">
                            <div class="review-wrapper">
                                @foreach($reviews1 as $review)
                                <div class="single-review">
                                    <div class="review-img">
                                        <img src="{{ (!empty(auth()->user()->image)) ? url('upload/users/'.auth()->user()->image):url('upload/noImage60x60.jpg') }}" alt="user image" width="60px" height="60px">
                                    </div>
                                    <div class="review-content">
                                        <div class="review-top-wrap">
                                            <div class="review-name">
                                                <h5><span>{{$review->name}}</span> - {{$review->created_at}}</h5>
                                            </div>
                                            <div class="review-rating">

                                                <input class="input-2" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-step="0.5" data-size="xs" value=" {{ $review->rating }} ">

                                            </div>
                                        </div>
                                        <p>{{$review->review}}</p>
                                    </div>
                                </div>
                                @endforeach

                                @if($reviews->count() > 3)
                                <a href="{{route('product.details.reviews',$product->id)}}"><h4 class="text-center">See All {{$reviews->count()}} Reviews</h4></a>
                                @endif
                            </div>

                            @auth
                            <div class="ratting-form-wrapper">
                                <span>Add a Review</span>

                                <div class="ratting-form">
                                    <form action=" {{ route('store-review', $product->id) }} " method="post">
                                        @csrf
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <div class="star-box-wrap">
                                                    <input id="input-1" name="rating" class="rating rating-loading" data-min="0" data-max="5" data-size="xs" required data-step="0.5">
                                                </div>

                                                @error('rating')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <div class="rating-form-style mb-20">
                                                    <label>Your review <span>*</span></label>
                                                    <textarea maxlength="255" id="review" name="review" onkeyup="checklimit()"></textarea>
                                                </div>
                                                @error('review')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-submit">
                                                    <input type="submit" value="Submit">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endauth
                        </div>
                        @else
                            <div id="des-details4" class="tab-pane">
                                <div class="review-wrapper">
                                    <h2>No reviews</h2>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // // initialize with defaults
        // $("#input-1").rating();
        $('.input-2').rating({displayOnly: true, step: 0.1});
        var checklimit = function (){
            if (document.getElementById('review').value.length >= 255) {
                alert('You have exceeded your review limit!');
            }
        };
    </script>
@endsection

@section('scripts')
    <script src="{{asset('js/product-details.js')}}"></script>

@endsection
