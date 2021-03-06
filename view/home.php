<div class="container content">
	<div class="row" style="overflow: hidden;">
		<div class="span3"><?php $this->view('sidebar.php'); ?></div>
		
		<div class="span9" style="padding-bottom: 2em;">
			<div class="hero">
                &nbsp;
			</div>
			<div class="content-header">
				<div class="header-link"><a href="">Browse Our Products by Brands &raquo;</a></div>
				Popular Brands
			</div>
			<div class="content-box">
                <div class="slide-nav slide-nav-prev prev-page"
                     style="background:#DDD url('<?php echo $this->asset('images/nav.png'); ?>') 4px 3px no-repeat;">
                </div>
                <div class="slide-nav slide-nav-next next-page"
                     style="background:#DDD url('<?php echo $this->asset('images/nav.png'); ?>') 4px -17px no-repeat;">
                </div>
                <div id="brand-slider" class="slider">
                    <ul>
                        <?php //var_dump($brands);
                        foreach($brands as $b) :
                            $temp = explode("/",$b->logo);
                            $key = $temp[count($temp)-1];
                        ?>
                        <li><a href="<?php echo $this->location('product/list/brand/'.$key); ?>">
                                <img class="brand-icon" src="<?php echo $this->location("coms/".$b->logo_thumb); ?>">
                            </a></li>
                        <?php endforeach; ?>
                        <!--
                        <li><a href="<?php echo $this->location('product/list/brand/cocalo'); ?>">
                                <img class="brand-icon" src="<?php echo $this->asset('images/brands/cocalo.png'); ?>">
                            </a></li>
                        <li><a href="<?php echo $this->location('product/list/brand/boogaboo'); ?>">
                                <img class="brand-icon" src="<?php echo $this->asset('images/brands/boogaboo.png'); ?>">
                            </a></li>
                        <li><a href="<?php echo $this->location('product/list/brand/fisherprice'); ?>">
                                <img class="brand-icon" src="<?php echo $this->asset('images/brands/fisherprice.png'); ?>">
                            </a></li>
                        <li><a href="<?php echo $this->location('product/list/brand/dr-browns'); ?>">
                                <img class="brand-icon" src="<?php echo $this->asset('images/brands/dr-browns.png'); ?>">
                            </a></li>
                        -->
                    </ul>
                </div>
                <!--
                <div class="controls">
                    <a href="#" class="prev-page">Prev Page</a> |
                    <a href="#" class="prev-slide">Prev Slide</a> |
                    <a href="#" class="next-slide">Next Slide</a> |
                    <a href="#" class="next-page">Next Page</a>
                </div>
                -->
			</div>

			<div class="content-header">
				<div class="header-link"><a href="">Our Best Offers &raquo;</a></div>
				New Products
			</div>
			<div class="container-fluid" style="padding-left: 0;">
				<div class="row-fluid">
					<?php $this->view('product-box.php'); ?>
					<?php $this->view('product-box.php'); ?>
					<?php $this->view('product-box.php'); ?>
				</div>
				<div class="row-fluid">
					<?php $this->view('product-box.php'); ?>
					<?php $this->view('product-box.php'); ?>
					<?php $this->view('product-box.php'); ?>
				</div>
				<div class="row-fluid">
					<?php $this->view('product-box.php'); ?>
					<?php $this->view('product-box.php'); ?>
					<?php $this->view('product-box.php'); ?>
				</div>
				<div class="row-fluid">
					<?php $this->view('product-box.php'); ?>
					<?php $this->view('product-box.php'); ?>
					<?php $this->view('product-box.php'); ?>
				</div>
			</div>
			
			<div class="about">
			<h2>What or Who is BabyAffata.com?</h2>
			<p>BabyAffata is an award winning baby website, a supplier of baby products and accessories including prams and pushchairs, nursery furnitures, car seats baby cots, baby furnitures, and equipments. We supply all the top brands including Fisher-Price, Peg-Perego, Coco-Latte, Avent by Philips, MacLaren, Graco, and more. We now stock a huge ranga of baby daily equipments, everyday baby equipments, like nappies and foods.</p>
			</div>
			
		</div><!--/span9-->
	</div>
	<div class="row" style="background-color: #ff8f50; margin: 0;">
		<div class="span5" style="background-color: #ffcb13; height: 0.4em; margin: 0;"></div>
		<div class="span3" style="background-color: #a9cacf; height: 0.4em; margin: 0;"></div>
		<div class="span2" style="background-color: #f8eeb1; height: 0.4em; margin: 0;"></div>
		<div class="span2"></div>
	</div>
</div> <!--/container-->