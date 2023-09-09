<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //add product into cart
        $('.shopping-cart-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            // console.log(formData);
            $.ajax({
                method: 'POST',
                data: formData,
                url: '{{ route('add-to-cart') }}',
                success: function(data) {
                    if (data.status == 'success') {
                        getCartCount()
                        fetchSidebarCartProducts()
                        $('.mini_cart_actions').removeClass('d-none');
                        toastr.success(data.message)
                    } else if (data.status == 'error') {
                        toastr.error(data.message)
                    }

                },
                error: function(data) {

                }

            })
        });


        function getCartCount() {
            $.ajax({
                method: 'get',
                url: '{{ route('cart-count') }}',
                success: function(data) {
                    $('#cart-count').text(data);
                },
                error: function(data) {

                }
            })
        }



        function fetchSidebarCartProducts() {
            $.ajax({
                method: 'get',
                url: '{{ route('cart-products') }}',
                success: function(data) {

                    $('.mini_cart_wrapper').html("");
                    var html = '';
                    for (item in data) {
                        let product = data[item];
                        html += ` <li id="mini_cart_${product.rowId}">
                                        <div class="wsus__cart_img">
                                            <a href="{{ url('product-detail') }}/${product.options.slug}"><img src="{{ asset('/') }}${product.options.image}" alt="product" class="img-fluid w-100"></a>
                                            <a class="wsis__del_icon remove_sidebar_product" data-id="${product.rowId}" href=""><i class="fas fa-minus-circle"></i></a>
                                        </div>
                                        <div class="wsus__cart_text">
                                            <a class="wsus__cart_title" href="{{ url('product-detail') }}/${product.options.slug}">${product.name}</a>
                                            <p>{{ $settings->currency_icon }}${product.price}</p>
                                            <small>Varyant Toplam: {{ $settings->currency_icon }}${product.options.variants_total}</small><br>
                                            <small>Adet:  ${product.qty}</small>
                                        </div>
                                     </li> `
                    }
                    $('.mini_cart_wrapper').html(html);
                    getSidebarCartSubtotal();
                },
                errror: function(data) {}
            })
        }


        //remove from mini_cart via buton
        $('body').on('click', '.remove_sidebar_product', function(e) {
            e.preventDefault();
            let rowId = $(this).data('id');
            $.ajax({
                method: 'post',
                url: '{{ route('cart.remove-sidebar-product') }}',
                data: {
                    rowId: rowId,
                },
                success: function(data) {
                    let productId = '#mini_cart_' + rowId;
                    $(productId).remove();
                    getSidebarCartSubtotal();
                    if ($('.mini_cart_wrapper').find('li').length == 0) {
                        $('.mini_cart_wrapper').html(
                            '<li class="text-center"> Sepet Boş!</li>')
                        $('.mini_cart_actions').addClass('d-none')
                    }
                    toastr.success(data.message);

                    //fetchSidebarCartProducts();
                },
                error: function(data) {},
            })
        })


        //get sidebar cart sub total
        function getSidebarCartSubtotal() {
            $.ajax({
                method: 'get',
                url: "{{ route('cart.sidebar-product-total') }}",
                success: function(data) {

                    $('#mini_cart_subtotal').text("{{ $settings->currency_icon }}" + data);
                },
                error: function(data) {

                }
            })
        }




    });
</script>
