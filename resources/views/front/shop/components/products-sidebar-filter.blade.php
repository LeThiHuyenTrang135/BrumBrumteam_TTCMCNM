<form action="{{ request(2) == 'product' ? 'side' : '' }}">

    <div class="filter-widget">
        <h4 class="fw-title">Categories</h4>
        <ul class="filter-catagories">

            @foreach ($categories as $category)
                <li><a href="shop/category/{{ $category->name }}">{{ $category->name }}</a></li>
            @endforeach

        </ul>
    </div>

    <div class="filter-widget">
        <h4 class="fw-title">Brand</h4>
        <div class="fw-brand-check">
            @foreach ($brands as $brand)
                <div class="bc-item">
                    <label for="bc-{{ $brand->id }}">
                        {{ $brand->name }}
                        <input type="checkbox" {{ (request('brand')[$brand->id] ?? '') == 'on' ? 'checked' : '' }}
                            id="bc-{{ $brand->id }}" name="brand[{{ $brand->id }}]"
                            onchange="this.form.submit();">
                        <span class="checkmark"></span>
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="filter-widget">
        <h4 class="fw-title">Price</h4>
        <div class="filter-range-wrap">
            <div class="range-slider">
                <div class="price-input">
                    <input type="text" id="minamount" name="price_min" value="{{ request('price_min') ?? 10 }}">
                    <input type="text" id="maxamount" name="price_max" value="{{ request('price_max') ?? 999 }}">
                </div>
            </div>

            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                data-min="10" data-max="999" data-min-value="{{ (int) str_replace('$', '', request('price_min')) }}"
                data-max-value="{{ (int) str_replace('$', '', request('price_max')) }}">
                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
            </div>
        </div>

        <button type="submit" class="filter-btn">Filter</button>
    </div>

    <div class="filter-widget">
        <h4 class="fw-title">Color</h4>
        <div class="fw-color-choose">
            <div class="cs-item">
                <input type="radio" id="cs-black" name="color" value="black" onchange="this.form.submit();"
                    {{ request('color') == 'black' ? 'checked' : '' }}>
                <label class="cs-black {{ request('color') == 'black' ? 'font-weight-bold' : '' }}"
                    for="cs-black">Black</label>
            </div>

            <div class="cs-item">
                <input type="radio" id="cs-violet" name="color" value="violet" onchange="this.form.submit();"
                    {{ request('color') == 'violet' ? 'checked' : '' }}>
                <label class="cs-violet {{ request('color') == 'violet' ? 'font-weight-bold' : '' }}"
                    for="cs-violet">Violet</label>
            </div>

            <div class="cs-item">
                <input type="radio" id="cs-blue" name="color" value="blue" onchange="this.form.submit();"
                    {{ request('color') == 'blue' ? 'checked' : '' }}>
                <label class="cs-blue {{ request('color') == 'blue' ? 'font-weight-bold' : '' }}"
                    for="cs-blue">Blue</label>
            </div>

            <div class="cs-item">
                <input type="radio" id="cs-yellow" name="color" value="yellow" onchange="this.form.submit();"
                    {{ request('color') == 'yellow' ? 'checked' : '' }}>
                <label class="cs-yellow {{ request('color') == 'yellow' ? 'font-weight-bold' : '' }}"
                    for="cs-yellow">Yellow</label>
            </div>

            <div class="cs-item">
                <input type="radio" id="cs-red" name="color" value="red" onchange="this.form.submit();"
                    {{ request('color') == 'red' ? 'checked' : '' }}>
                <label class="cs-red {{ request('color') == 'red' ? 'font-weight-bold' : '' }}"
                    for="cs-red">Red</label>
            </div>

            <div class="cs-item">
                <input type="radio" id="cs-green" name="color" value="green" onchange="this.form.submit();"
                    {{ request('color') == 'green' ? 'checked' : '' }}>
                <label class="cs-green {{ request('color') == 'green' ? 'font-weight-bold' : '' }}"
                    for="cs-green">Green</label>
            </div>
        </div>
    </div>

    <div class="filter-widget">
        <h4 class="fw-title">Size</h4>
        <div class="fw-size-choose">
            <div class="sc-item">
                <input type="radio" id="s-size" name="size" value="s" onchange="this.form.submit();"
                    {{ request('size') == 's' ? 'checked' : '' }}>
                <label class="{{ request('size') == 's' ? 'active' : '' }}" for="s-size">s</label>
            </div>

            <div class="sc-item">
                <input type="radio" id="m-size" name="size" value="m" onchange="this.form.submit();"
                    {{ request('size') == 'm' ? 'checked' : '' }}>
                <label class="{{ request('size') == 'm' ? 'active' : '' }}" for="m-size">m</label>
            </div>

            <div class="sc-item">
                <input type="radio" id="l-size" name="size" value="l" onchange="this.form.submit();"
                    {{ request('size') == 'l' ? 'checked' : '' }}>
                <label class="{{ request('size') == 'l' ? 'active' : '' }}" for="l-size">l</label>
            </div>

            <div class="sc-item">
                <input type="radio" id="xl-size" name="size" value="xs" onchange="this.form.submit();"
                    {{ request('size') == 'xs' ? 'checked' : '' }}>
                <label class="{{ request('size') == 'xs' ? 'active' : '' }}" for="xl-size">xs</label>
            </div>
        </div>
    </div>

    <div class="filter-widget">
        <h4 class="fw-title">Tags</h4>
        <div class="fw-tags">
            <a href="#">Towel</a>
            <a href="#">Shoes</a>
            <a href="#">Jumpsuit</a>
            <a href="#">Dresses</a>
            <a href="#">Coats</a>
            <a href="#">Blazers</a>
            <a href="#">Sunglasses</a>
            <a href="#">Pants</a>
            <a href="#">Frocks</a>
        </div>
    </div>
</form>
