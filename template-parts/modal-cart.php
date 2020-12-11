 <!-- Start Cart Modal -->
 <div class="modal fade modal-sidebar view-right modal-cart" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Cart</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="ti-close"></span>
                    </button>
                </div>
                <span class="minicart-container-main">
                <?php woocommerce_mini_cart();?>

                </span>
            </div>
        </div>
    </div>
    <!-- End Cart Modal -->

