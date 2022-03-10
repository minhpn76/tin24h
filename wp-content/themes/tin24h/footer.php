
<section class="footer">
    <div class="header-container">
        <div class="col-12">
            <div class="row">
                <?php
                    $left_footer = get_field('left_footer','option');
                    if( $left_footer ):
                ?>  
                <div class="col-12 col-lg-6">
                    <div class="col-12 col-md-10 col-md-offset-1 footer-content">
                        <?php
                            $logo_footer = $left_footer['logo_footer'];
                            if( $logo_footer ):
                        ?>  
                        <div class="col-12 logo-footer">
                            <a href="<?= $logo_footer['link']?>">
                                <img src="<?= $logo_footer['image']?>" alt="">
                                <!-- <img src="<?php echo get_stylesheet_directory_uri(). '/tin24h/images/logo-footer.svg'?>" alt=""> -->
                            </a>
                        </div>
                        <?php endif?>
                        <?php
                            $address_footer = $left_footer['address_footer'];
                            if( $address_footer ):
                        ?> 
                        <div class="col-12">
                            <p class="s2-subtitle text-uppercase"><img src="<?php echo get_stylesheet_directory_uri(). '/tin24h/images/marker.svg'?>" class="mr-3" alt="">Địa chỉ
                            </p>
                            <p class="p2-paragraph p2-address"><?= $address_footer?></p>
                        </div>
                        <?php endif;?>
                        
                        <div class="col-12 contact ">
                            <div class="row">
                                <?php
                                    $phone_footer = $left_footer['phone_footer'];
                                    if( $phone_footer ):
                                ?> 
                                <div class="col-md-6 col-12">
                                    <p class="s2-subtitle text-uppercase"><img src="<?php echo get_stylesheet_directory_uri(). '/tin24h/images/phone.svg'?>" class="mr-2" alt="">Điện
                                        thoại </p>
                                    <p class="p2-paragraph"><?= $phone_footer?> </p>
                                </div>
                                <?php endif;?>
                                <?php
                                    $contact_footer = $left_footer['contact_footer'];
                                    if( $contact_footer ):
                                ?> 
                                <div class="col-md-6 col-12">
                                    <p class="s2-subtitle text-uppercase"><img src="<?php echo get_stylesheet_directory_uri(). '/tin24h/images/email.svg'?>" class="mr-2" alt="">Liên
                                        hệ </p>
                                    <p class="p2-paragraph"><?= $contact_footer?></p>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif;?>
                <div class="col-12 col-lg-6 mt-4 mt-lg-0">
                    <div class="col-12 col-md-10 col-md-offset-1 footer-content">
                        <!-- <div class="col-12 logo-footer">
                            <a href="#"><img src="<?php echo get_stylesheet_directory_uri(). 'tin24h/images/tin24s.png'?>" alt=""></a>
                        </div> -->
                        <?php
                            $right_footer = get_field('right_footer','option');
                            if( $right_footer ):
                        ?> 
                        <div class="col-12">
                            <?= $right_footer?>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo get_stylesheet_directory_uri(). '/tin24h/js/jquery-3.2.1.min.js'?>"></script>
<script src="<?php echo get_stylesheet_directory_uri(). '/tin24h/js/slick.min.js'?>"></script>
<script src="<?php echo get_stylesheet_directory_uri(). '/tin24h/js/bootstrap.min.js'?>"></script>
<script src="<?php echo get_stylesheet_directory_uri(). '/tin24h/js/custom.js?v=1'?>"></script>
<script src="<?php echo get_stylesheet_directory_uri(). '/tin24h/js/covid.js?v=1'?>"></script>

<?php wp_footer(); ?>


</body>
</html>