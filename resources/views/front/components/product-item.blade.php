<div class="product-item item {{ $product->tag }}">
    <div class="pi-pic">
        <img class="product-img" src="{{ asset('storage/' . $product->productImages[0]->path) }}" alt=""
            style="width: 282px; height: 317px">

        @if ($product->discount != null)
            <div class="sale">Sale</div>
        @endif

        <ul>
            <li class="w-icon active">
                <a href="javascript:void(0);" onclick="addToCart('{{ $product->id }}')">
                    <i class="icon_bag_alt"></i>
                </a>
            </li>
            <li class="quick_view"><a href="shop/product/{{ $product->id }}">+ Quick View</a></li>
            <li class="w-icon"><a href=""><i class="fa fa-random"></i></a></li>
        </ul>
    </div>
    <div class="pi-text">
        <div class="catagory-name">{{ $product->tag }}</div>
        <a href="shop/product/{{ $product->id }}">
            <h5>{{ $product->name }}</h5>
        </a>
        <div class="product-price">

            @if ($product->discount != null)
                $ {{ $product->discount }}
                <span>${{ $product->price }}</span>
            @else
                ${{ $product->price }}
            @endif

        </div>

    </div>
</div>
