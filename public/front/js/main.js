/*  ---------------------------------------------------
    Template Name: codelean
    Description: codelean eCommerce HTML Template
    Author: CodeLean
    Author URI: https://CodeLean.vn/
    Version: 1.0
    Created: CodeLean
---------------------------------------------------------  */

'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    /*------------------
		Navigation
	--------------------*/
    $(".mobile-menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Hero Slider
    --------------------*/
    $(".hero-items").owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        items: 1,
        dots: false,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
    });

    /*------------------
        Product Slider
    --------------------*/
   $(".product-slider").owlCarousel({
        loop: false,
        margin: 25,
        nav: true,
        items: 4,
        dots: true,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        responsive: {
            0: {
                items: 1,
            },
            576: {
                items: 2,
            },
            992: {
                items: 2,
            },
            1200: {
                items: 3,
            }
        }
    });

    /*------------------
       logo Carousel
    --------------------*/
    $(".logo-carousel").owlCarousel({
        loop: false,
        margin: 30,
        nav: false,
        items: 5,
        dots: false,
        navText: ['<i class="ti-angle-left"></i>', '<i class="ti-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        mouseDrag: false,
        autoplay: true,
        responsive: {
            0: {
                items: 3,
            },
            768: {
                items: 5,
            }
        }
    });

    /*-----------------------
       Product Single Slider
    -------------------------*/
    $(".ps-slider").owlCarousel({
        loop: false,
        margin: 10,
        nav: true,
        items: 3,
        dots: false,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
    });
    
    /*------------------
        CountDown
    --------------------*/
    // For demo preview
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    if(mm == 12) {
        mm = '01';
        yyyy = yyyy + 1;
    } else {
        mm = parseInt(mm) + 1;
        mm = String(mm).padStart(2, '0');
    }
    var timerdate = mm + '/' + dd + '/' + yyyy;
    // For demo preview end

    console.log(timerdate);
    

    // Use this for real timer date
    /* var timerdate = "2020/01/01"; */

	$("#countdown").countdown(timerdate, function(event) {
        $(this).html(event.strftime("<div class='cd-item'><span>%D</span> <p>Days</p> </div>" + "<div class='cd-item'><span>%H</span> <p>Hrs</p> </div>" + "<div class='cd-item'><span>%M</span> <p>Mins</p> </div>" + "<div class='cd-item'><span>%S</span> <p>Secs</p> </div>"));
    });

        
    /*----------------------------------------------------
     Language Flag js 
    ----------------------------------------------------*/
    $(document).ready(function(e) {
    //no use
    try {
        var pages = $("#pages").msDropdown({on:{change:function(data, ui) {
            var val = data.value;
            if(val!="")
                window.location = val;
        }}}).data("dd");

        var pagename = document.location.pathname.toString();
        pagename = pagename.split("/");
        pages.setIndexByValue(pagename[pagename.length-1]);
        $("#ver").html(msBeautify.version.msDropdown);
    } catch(e) {
        // console.log(e);
    }
    $("#ver").html(msBeautify.version.msDropdown);

    //convert
    $(".language_drop").msDropdown({roundedBorder:false});
        $("#tech").data("dd");
    });
    /*-------------------
		Range Slider
	--------------------- */
	var rangeSlider = $(".price-range"),
		minamount = $("#minamount"),
		maxamount = $("#maxamount");
		
        // Lấy dữ liệu từ data-* attribute
        let minVal = parseInt(rangeSlider.data("min-value"));
        let maxVal = parseInt(rangeSlider.data("max-value"));

        let minPrice = parseInt(rangeSlider.data("min"));
        let maxPrice = parseInt(rangeSlider.data("max"));

        // Nếu NaN → trả về mặc định
        if (isNaN(minVal)) minVal = minPrice;
        if (isNaN(maxVal)) maxVal = maxPrice;

	    rangeSlider.slider({
		range: true,
		min: minPrice,
        max: maxPrice,
		values: [minVal, maxVal],
		slide: function (event, ui) {
			minamount.val("$" + ui.values[0]);
            maxamount.val("$" + ui.values[1]);
                }
            });
        minamount.val("$" + minVal);
        maxamount.val("$" + maxVal);

    /*-------------------
		Radio Btn
	--------------------- */
    $(".fw-size-choose .sc-item label, .pd-size-choose .sc-item label").on('click', function () {
        $(".fw-size-choose .sc-item label, .pd-size-choose .sc-item label").removeClass('active');
        $(this).addClass('active');
    });
    
    /*-------------------
		Nice Select
    --------------------- */
    $('.sorting, .p-show').niceSelect();

    /*------------------
		Single Product
	--------------------*/
	$('.product-thumbs-track .pt').on('click', function(){
		$('.product-thumbs-track .pt').removeClass('active');
		$(this).addClass('active');
		var imgurl = $(this).data('imgbigurl');
		var bigImg = $('.product-big-img').attr('src');
		if(imgurl != bigImg) {
			$('.product-big-img').attr({src: imgurl});
			$('.zoomImg').attr({src: imgurl});
		}
	});

    $('.product-pic-zoom').zoom();
    
    /*-------------------
		Quantity change
	--------------------- */
    var proQty = $('.pro-qty');
	proQty.prepend('<span class="dec qtybtn">-</span>');
	proQty.append('<span class="inc qtybtn">+</span>');
	proQty.on('click', '.qtybtn', function () {
		var $button = $(this);
		var oldValue = $button.parent().find('input').val();
		if ($button.hasClass('inc')) {
			var newVal = parseFloat(oldValue) + 1;
		} else {
			// Don't allow decrementing below zero
			if (oldValue > 0) {
				var newVal = parseFloat(oldValue) - 1;
			} else {
				newVal = 0;
			}
		}
		$button.parent().find('input').val(newVal);

        //update cart
        var rowId = $button.parent().find('input').data('rowid');
        updateCart(rowId, newVal);
	});

  /*-------------------
		Bo loc san pham ơ trang chu
	--------------------- */

    const product_men = $(".product-slider.men");
    const product_women = $(".product-slider.women");

    $('.filter-control').on('click', '.item', function(){
        const $item = $(this);
        const filter = $item.data('tag');
        const category = $item.data('category');

        $item.siblings().removeClass('active');
        $item.addClass('active');

        if (category === 'men'){
            product_men.owlcarousel2_filter(filter);
        }

        if (category === 'women'){
            product_women.owlcarousel2_filter(filter);
        }
    });

   

})(jQuery);

// function addCart(productId) {
//     $.ajax({
//         type: "GET",
//         url: "cart/add",
//         data: {productId: productId},
//         success: function(response){
            
//             $('.cart-count').text(response['count']);
//             $('.cart-price').text(response['total']);
//             $('.select-total h5').text(response['total']);

//             var cartHover_tbody = $('.select-items tbody');
//             var cartHover_existItem = cartHover_tbody.find("tr" + "[data-rowId='" + response['cart'].rowId + "']");

//             if (cartHover_existItem.length){
//                 cartHover_existItem.find('.product-selected p').text('$' + response['cart'].price.toFixed(2) + ' x ' + response['cart'].qty);
//             }else{
//                var newItem = 
//                 '<tr data-rowId="' + response['cart'].rowId + '">\n' +
//                 '    <td class="si-pic">\n' +
//                 '        <img style="height: 70px;"\n' +
//                 '        src="front/img/products/' + response['cart'].options.images + '">\n' +
//                 '    </td>\n' +
//                 '    <td class="si-text">\n' +
//                 '        <div class="product-selected">\n' +
//                 '            <p>$' + response['cart'].price.toFixed(2) + ' x ' + response['cart'].qty + '</p>\n' +
//                 '            <h6>' + response['cart'].name + '</h6>\n' +
//                 '        </div>\n' +
//                 '    </td>\n' +
//                 '    <td class="si-close">\n' +
//                 '        <i onclick="removeCart(\'' + response['cart'].rowId + '\')" class="ti-close"></i>\n' +
//                 '    </td>\n' +  
//                 '</tr>';


//                 cartHover_tbody.append(newItem);
//             }

//             //hien thi tbao thanh cong
//             alert('Add successful:\nProducts: ' + response['cart'].name)
//             console.log(response);
//         },
//         error: function(response) {
//             //hien thi tbao that bai
//             alert('Add failed.')
//             console.log(response);
//         },
//     })
// }


// function removeCart(rowId){
//     $.ajax({
//         type: "GET",
//         url: "cart/delete",
//         data: {rowId: rowId},
//         success: function(response){
//             //Xu ly phan cart hover (trang master-page)
//             $('.cart-count').text(response['count']);
//             $('.cart-price').text(response['total']);
//             $('.select-total h5').text(response['total']);

//             var cartHover_tbody = $('.select-items tbody');
//             var cartHover_existItem = cartHover_tbody.find("tr" + "[data-rowId='" + rowId + "']");

//             // ================== HIỆU ỨNG MINI CART ==================
//             cartHover_existItem.addClass('row-removing');
//             setTimeout(function () {
//                 cartHover_existItem.remove();
//             }, 300); // 300ms trùng với CSS transition
            

//             // xu ly o trong trang "shop/cart"
//             var cart_tbody = $('.cart-table tbody');
//             var cart_exisItem = cart_tbody.find("tr[data-rowId='" + rowId + "']");

//             // ================== HIỆU ỨNG TRANG CART ==================
//             cart_exisItem.addClass('row-removing');
//             setTimeout(function () {
//                 cart_exisItem.remove();
//             }, 300);
            

//             //hien thi tbao thanh cong
//             alert('Delete successful:\nProducts: ' + response['cart'].name)
//             console.log(response);
//         },
//         error: function(response) {
//             //hien thi tbao that bai
//             alert('Delete failed.')
//             console.log(response);
//         },
//     })
// }
function addCart(productId) {
    $.ajax({
        type: "GET",
        url: "/cart/add",
        data: { product_id: productId },
        success: function (res) {

            if (!res.status) return;

            /* ===== HEADER ===== */
            $('.cart-count').text(res.count);
                
            $('.select-total h5').text('$' + res.total);

            /* ===== MINI CART ===== */
            let tbody = $('.select-items tbody');
            let exist = tbody.find("tr[data-rowid='" + res.cart.rowId + "']");

            if (exist.length) {
                exist.find('.product-selected p')
                    .text('$' + res.cart.price + ' x ' + res.cart.qty);
            } else {
                tbody.append(`
                    <tr data-rowid="${res.cart.rowId}">
                        <td class="si-pic">
                            <img src="front/img/products/${res.cart.image}" style="height:70px">
                        </td>
                        <td class="si-text">
                            <div class="product-selected">
                                <p>$${res.cart.price} x ${res.cart.qty}</p>
                                <h6>${res.cart.name}</h6>
                            </div>
                        </td>
                        <td class="si-close">
                            <i class="ti-close" onclick="removeCart('${res.cart.rowId}')"></i>
                        </td>
                    </tr>
                `);
            }

            alert('Đã thêm thành công!');
        },
        error: function () {
            alert('Thêm vào giỏ hàng thất bại');
        }
    });
}
function addToCart(productId, qty = 1) {
    let size = $('input[name="size"]:checked').val() || '';
    let color = $('input[name="color"]:checked').val() || '';

    $.ajax({
        type: "GET",
        url: "{{ route('cart.add') }}",
        data: {
            product_id: productId,
            qty: qty,
            size: size,
            color: color
        },
        success: function (res) {

            if (!res.status) return;

            // ✅ thông báo
            alertify.set('notifier', 'position', 'bottom-right');
            alertify.success(res.message);

            // ✅ HEADER
            $('#cart-count').text(res.count);
            $('#cart-total').text('$' + res.total);

            // ✅ MINI CART TOTAL
            $('#cart-hover-total').text('$' + res.total);

            // ⚠️ mini cart item list (reload nhẹ)
            reloadMiniCart();
        },
        error: function (xhr) {
            if (xhr.status === 401) {
                if (confirm("Bạn cần đăng nhập để mua hàng. Đăng nhập ngay?")) {
                    window.location.href = "{{ url('account/login') }}";
                }
            } else {
                alert('Có lỗi xảy ra!');
                console.log(xhr);
            }
        }
    });
}

function reloadMiniCart() {
    $.get("/cart", function (html) {
        let dom = $(html);
        $('#cart-hover-tbody').html(dom.find('#cart-hover-tbody').html());
    });
}



function removeCart(rowId){
    $.ajax({
        type: "GET",
        url: "/cart/delete",
        data: { rowId },
        success: function(res){

            if (!res.status) return;

            // MINI CART
            $('.cart-count').text(res.count);
            $('.cart-price').text('$' + res.total);
            $('.select-total h5').text('$' + res.total);

            // CART PAGE
            $('.cart-table tbody')
                .find("tr[data-rowid='" + rowId + "']")
                .remove();

            $('.subtotal span').text('$' + res.subtotal);
            $('.cart-total span').text('$' + res.total);
        }
    });
}

function destroyCart() {
    $.ajax({
        type: "GET",
        url: "cart/destroy", 
        data:{},
        success: function (response) {

            // Cập nhật phần cart ở header
            $('.cart-count').text(response['count']);
            $('.cart-price').text(response['total']);
            $('.select-total h5').text(response['total']);


            // Hiệu ứng xóa trên trang /cart
            var cartRows = $('.cart-table tbody tr');
            cartRows.addClass('row-removing');
            setTimeout(function () {
                $('.cart-table tbody').empty();
            }, 300);

         
        },
        error: function (response) {
            alert('Delete all failed.');
            console.log(response);
        }
    });
}


function updateCart(rowId, qty) {
    $.ajax({
        url: "/cart/update",
        type: "GET",
        data: { rowId, qty },
        success: function (res) {

            if (!res.status) return;

            /* ===== CART PAGE ===== */
            let row = $('.cart-table tbody')
                .find("tr[data-rowid='" + rowId + "']");

            if (row.length) {
                row.find('.total-price')
                   .text('$' + res.cart.lineTotal);
            }

            $('.subtotal span').text('$' + res.subtotal);
            $('.cart-total span').text('$' + res.total);

            /* ===== MINI CART (HEADER) ===== */
            $('.cart-count').text(res.count);
            $('.cart-price').text('$' + res.total);
            $('.select-total h5').text('$' + res.total);
        }
    });
}



document.addEventListener("DOMContentLoaded", function () {

    const btn = document.querySelector(".place-btn");
    const form = document.querySelector("form.checkout-form");

    btn.addEventListener("click", function () {

        let payment = document.querySelector("input[name='payment_type']:checked").value;

        if (payment === 'momo_atm') {
            form.action = "/checkout/momo";
            form.method = "POST";
        } 
        else if (payment === 'stripe') {
            form.action = "/stripe/checkout";
            form.method = "POST";
        } 
        else {
            form.action = "/checkout";
            form.method = "POST";
        }
    });
});

//ADD TO CART 
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.add-to-cart-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const productId = this.dataset.productId;
            const qty = document.getElementById('qty').value;

            $.ajax({
                type: 'GET',
                url: "{{ route('cart.add') }}",
                data: {
                    product_id: productId,
                    qty: qty
                },
                success: function () {
                    location.reload();
                },
                error: function (err) {
                    alert('Thêm vào giỏ hàng thất bại');
                    console.log(err);
                }
            });
        });
    });
});