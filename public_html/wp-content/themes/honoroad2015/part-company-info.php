<?php
global $omw_theme_settings;
?>
<!-- bottom -->
<div id="bottom" class="margin-top-xl">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3 wow fadeInUp" data-wow-delay="0.25s">
                <article>
                    <div class="item-content text-center">
                        <i class="fa fa-map-marker fa-3x"></i>
                        <h2><span>Địa Chỉ</span></h2>
                        <div class="item-introtext">
                            <p>
                                <?php echo $omw_theme_settings->ct_company_address ?>
                            </p>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-xs-12 col-md-3 wow fadeInUp" data-wow-delay="0.5s">
                <article>
                    <div class="item-content text-center">
                        <i class="fa fa-phone fa-3x"></i>
                        <h2><span>Điện Thoại</span></h2>
                        <div class="item-introtext">
                            <p class="text-center">
                                <?php echo $omw_theme_settings->ct_company_telephone ?>
                            </p>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-xs-12 col-md-3 wow fadeInUp" data-wow-delay="0.75s">
                <article>
                    <div class="item-content text-center">
                        <i class="fa fa-envelope-o fa-3x"></i>
                        <h2><span>Email</span></h2>
                        <div class="item-introtext">
                            <p>
                                <a href="mailto:<?php echo $omw_theme_settings->ct_company_email ?>"><?php echo $omw_theme_settings->ct_company_email ?></a>
                            </p>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-xs-12 col-md-3 wow fadeInUp" data-wow-delay="1s">
                <article>
                    <div class="item-content text-center">
                        <i class="fa fa-envelope-o fa-3x"></i>
                        <h2><span>Follow Us</span></h2>
                        <div class="item-introtext">
                            <p>
                                <a class="padding-lt-rt-md vcenter" href="https://www.facebook.com/sharer/sharer.php?u=<?php bloginfo('url') ?>"><i class="fa fa-facebook fa-3x"></i></a>
                                <a class="padding-lt-rt-md vcenter" href="http://www.twitter.com/intent/tweet?url=<?php bloginfo('url') ?>"><i class="fa fa-twitter fa-3x"></i></a>
                                <a class="inline-block vcenter" href="http://alibaba.com">
                                    <img width="64" src="<?php echo get_template_directory_uri() ?>/images/i-alibaba.png"/>
                                </a>
                            </p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<!-- bottom end-->