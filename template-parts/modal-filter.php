  <!-- Start Filter Modal -->
  <div class="modal fade modal-sidebar view-left modal-filter" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Filters</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="ti-arrow-left"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body-block">
                        <div class="collapse-group">
                            <div class="collapse-item">
                                <a class="link-collapse" data-toggle="collapse" href="#s_collapse_1" role="button" aria-expanded="true" aria-controls="s_collapse_1">
                                    Categories
                                </a>
                                <div class="collapse show" id="s_collapse_1">
                                    <div class="collapse-body">
                                        <ul class="list-checkbox checkbox-sm -column">

                                        <?php
                                        
                                        $category = get_queried_object();
                                        $page_term = $category->term_id;
                                        $current_term = get_term($category->term_id);
                
                                      
                                        $productCats = get_terms('product_cat', array(
                                            'hide_empty' => true,
                                        ));
                                        if (count($productCats) > 0) {
                                            foreach ($productCats as $cat) {
                                        ?>
                                                <li class="list-item">
                                                    <a class="list-checkbox <?php if ($current_term->term_id == $cat->term_id) {
                                                                                echo "active";
                                                                            } ?>" href="<?php echo get_term_link($cat); ?>"><?php echo $cat->name; ?></a>

                                                </li>
                                        <?php }
                                        }
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="collapse-item d-none">
                                <a class="link-collapse collapsed" data-toggle="collapse" href="#s_collapse_3" role="button" aria-expanded="false" aria-controls="s_collapse_3">
                                    Size
                                </a>
                                <div class="collapse" id="s_collapse_3">
                                    <div class="collapse-body">
                                        <ul class="sizes sizes-sm">
                                            <li>
                                                <button type="button" class="btn size">xs</button>
                                            </li>
                                            <li>
                                                <button type="button" class="btn size">s</button>
                                            </li>
                                            <li>
                                                <button type="button" class="btn size active">m</button>
                                            </li>
                                            <li>
                                                <button type="button" class="btn size">l</button>
                                            </li>
                                            <li>
                                                <button type="button" class="btn size">xl</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>  
                            <div class="collapse-item d-none">
                                <a class="link-collapse collapsed" data-toggle="collapse" href="#s_collapse_4" role="button" aria-expanded="true" aria-controls="s_collapse_4">
                                    Color
                                </a>
                                <div class="collapse" id="s_collapse_4">
                                    <div class="collapse-body">
                                        <ul class="list-swatches swatches-sm  -column">
                                            <li class="list-item">
                                                <button type="button" class="btn swatch">
                                                    <span class="colors">
                                                        <span class="color" style="background:black">Black</span>
                                                    </span>
                                                    <span class="color-name">Black</span>
                                                </button>
                                            </li>
                                            <li class="list-item">
                                                <button type="button" class="btn swatch active">
                                                    <span class="colors">
                                                        <span class="color" style="background:white">White</span>
                                                    </span>
                                                    <span class="color-name">White</span>
                                                </button>
                                            </li>
                                            <li class="list-item">
                                                <button type="button" class="btn swatch">
                                                    <span class="colors">
                                                        <span class="color" style="background:gray">Gray</span>
                                                    </span>
                                                    <span class="color-name">Gray</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>  
                            <!-- <div class="collapse-item">
                                <a class="link-collapse collapsed" data-toggle="collapse" href="#s_collapse_5" role="button" aria-expanded="false" aria-controls="s_collapse_5">
                                    Collection
                                </a>
                                <div class="collapse" id="s_collapse_5">
                                    <div class="collapse-body">
                                        <ul class="list-checkbox checkbox-sm -column">
                                            <li class="list-item">
                                                <a class="list-checkbox" href="#">Activewear</a>
                                            </li>
                                            <li class="list-item">
                                                <a class="list-checkbox" href="#">Loungewear</a>
                                            </li>
                                            <li class="list-item">
                                                <a class="list-checkbox active" href="#">Cashmere</a>
                                            </li>
                                            <li class="list-item">
                                                <a class="list-checkbox" href="#">Work from Home</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>   -->
                            <div class="collapse-item d-none">
                                <a class="link-collapse collapsed" data-toggle="collapse" href="#s_collapse_6" role="button" aria-expanded="false" aria-controls="s_collapse_6">
                                    Price
                                </a>
                                <div class="collapse" id="s_collapse_6">
                                    <div class="collapse-body">
                                        <div>
                                            <form action="">
                                                <!-- <div class="formgroup-price formgroup-sm">
                                                   <input type="number" step="1" placeholder="Min price" class="form-control ">
                                                   <span class="price-to">to</span>
                                                   <input type="number" step="1" placeholder="Max price" class="form-control">
                                                   <button class="btn btn-primary btn-price">Go</button>
                                                </div> -->
                                                <div class="rangeslider">
                                                    <input id="priceRange" type="text" value="" data-slider-min="20" data-slider-max="500" data-slider-step="1" data-slider-value="[20,500]" />
                                                </div>
                                            </form>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="modal-footer-block">
                        <button type="button" class="btn btn-block border-0 rounded-0 btn-clear" data-dismiss="modal">Clear All</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Filter Modal -->
