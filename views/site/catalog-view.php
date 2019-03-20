<?php

/*
 * catalog-view page
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;

// get tovar count
$tovar_count = $model->getTovarCount($model->id);
$sub_tovar_count = $model->getSubTovarCount($model->id);
if($tovar_count == 0) {
    $tovar_count = $sub_tovar_count;
}
?>

<main role="main">

        <div id="breadcrumbs-container" class="container-fluid">
                <div class="container">
                        <div class="row">
                                <div class="col-xs-12">
                                        <?php
                                            echo Breadcrumbs::widget([
                                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                            ]);
                                        ?>
                                </div>

                        </div>	 <!-- end row -->
                </div> <!-- end container -->
        </div> <!-- end container-fluid -->

        <div id="page-container" class="container">

                <div class="row">

                        <?php
                            // aside
                            echo $this->render('_aside');
                        ?>

                        <div class="col-sm-7 col-md-8">
                                <div id="content-container">

                                    <?php foreach ($bannersPos3 as $key => $banner): ?>
                                        <div class="banner-block">
                                            <a href="<?= Yii::$app->urlManager->createUrl($banner->link) ?>"><img src="images/banners/<?= $banner->image ?>" alt="<?= $banner->name ?>" class="img-responsive"></a>
                                        </div><!-- end banner-block -->
                                    <?php endforeach ?>
                                        
                                    <!--<div class="banner-block">
                                        <a href="#"><img src="images/category-banner-889x200.jpg" alt="" class="img-responsive"></a>
                                    </div>-->  <!-- end banner-block -->
                                    
                                    <!--<div class="filter-block btn-toolbar" role="group" aria-label="...">
                                        <button type="button" class="btn btn-default"><i class="fa fa-eye" aria-hidden="true"></i> Новинки</button>
                                        <button type="button" class="btn btn-default"><i class="fa fa-star-o" aria-hidden="true"></i> Популярные</button>
                                        <button type="button" class="btn btn-default"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Скидки</button>
                                        
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-fa" aria-hidden="true"></i> Бренды
                                            <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">DoCash </a></li>
                                                <li><a href="#">Doors</a></li>
                                                <li><a href="#">GLORY</a></li>
                                                <li><a href="#">SBM</a></li>
                                            </ul>
                                        </div>
                                    </div> --> <!-- end filter-block -->
                                    
                                    <div class="content-block">
                                        <header>
                                            <h1><?= Html::encode($model->title.' ('.$tovar_count.')') ?></h1>
                                        </header>

                                        <div class="filter-block row">
                                            <div class="toggle-panel col-xs-12 text-right">
                                                <div class="row">
                                                    <div class="col-xs-9 col-md-10 text-left">
                                                        <h3>Расширенный поиск</h3>
                                                    </div>
                                                    <div class="col-xs-3 col-md-2">
                                                        <button id="filter-block-toggle" class="btn btn-link" title="Скрыть расширенный поиск">
                                                            <i class="fa fa-close"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="filter-block-container col-xs-12">
                                                <div class="col-xs-6 col-md-4"> 
                                                    <h4>Бренд</h4>
                                                    <ul class="filter-by-brand">
                                                        <?php foreach ($brands as $brand):?>
                                                            <li>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox"> <span><?= $brand->brand ?></span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        <?php endforeach;?>
                                                    </ul>
                                                </div>
                                                <div class="col-xs-6 col-md-4">
                                                    <h4>Тип</h4>
                                                    <ul class="filter-by-type">
                                                        <?php foreach ($types as $type):?>
                                                            <li>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox"> <span><?= $type->type ?></span>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        <?php endforeach;?>
                                                    </ul>
                                                </div>
                                                <div class="col-xs-12 col-md-4">
                                                    <h4>Цена</h4>
                                                    <div class="filter-block-price">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">от</div>
                                                                <input class="form-control" type="text" id="price-from" placeholder="цена от..." value=""  disabled>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">до</div>
                                                                <input class="form-control" type="text" id="price-to" placeholder="цена до..." value=""  disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="filter-block-buttons col-xs-12 text-center">
                                                    <button id="btn-filter-apply" class="btn btn-default"><i class="fa fa-check"></i> Найти</button>
                                                    <button id="btn-filter-cancel" class="btn btn-default"><i class="fa fa-close"></i> Сбросить</button>
                                                </div>
                                            </div>  <!-- end filter-block-container -->
                                        </div>  <!-- end filter-block -->

                                        <div class="filter-block btn-toolbar hidden" role="group" aria-label="...">
                                            <button type="button" class="btn btn-default"><i class="fa fa-eye"></i> Новинки</button>
                                            <button type="button" class="btn btn-default"><i class="fa fa-star-o"></i> Популярные</button>
                                            <button type="button" class="btn btn-default"><i class="fa fa-thumbs-o-up"></i> Скидки</button>

                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-fa" aria-hidden="true"></i> Бренды
                                                <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <?php
                                                        // выводим бренды
                                                        foreach ($brands as $brand):
                                                            echo '<li><a href="#">'.$brand->brand.'</a></li>';
                                                        endforeach;
                                                    ?>
                                                </ul>
                                            </div>

                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-fa" aria-hidden="true"></i> Модели
                                                <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <?php
                                                        // выводим модели
                                                        /*foreach ($models as $model):
                                                            echo '<li><a href="#">'.$model->model.'</a></li>';
                                                        endforeach;*/
                                                    ?>
                                                    <?php foreach ($models as $model):?>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox"> <?= $model->model ?>
                                                            </label>
                                                        </div>
                                                    <?php endforeach;?>
                                                </ul>
                                            </div>
                                        </div>  <!-- end filter-block hidden -->

                                        
                                        <div class="catalog-view-pagination-block">
                                            <div class="row">
                                                <div class="col-xs-9 col-md-8">
                                                    <div class="catalog-view-pagination">
                                                        <div class="btn-group" role="group">
                                                        
                                                        </div>
                                                    </div>
                                                </div>  <!-- end col -->
                                                <div class="col-xs-3 col-md-4 text-right">
                                                    <div class="btn-group" role="group">                                                       
                                                        <select id="select-catalog-pages-count" class="form-control">
                                                            <option value="5">5</option>
                                                            <option value="10" selected>10</option>
                                                            <option value="20">20</option>
                                                            <option value="50">50</option>
                                                        </select>
                                                    </div>
                                                </div>  <!-- end col -->
                                            </div>  <!-- end row -->
                                        </div>  <!-- end catalog-view-pagination-block -->
                                        
                                        <div class="goods-container">	
                                            <div class="row">
                                                
                                                <?php
                                                // если есть подкатегории - выводим их, иначе - выводим товары категории
                                                if ($sub_category != NULL) {
                                                    foreach ($sub_category as $cat):
                                                        $tovar_count = $cat->getTovarCount($cat->id);
                                                        if ( $tovar_count != 0) {
                                                        echo '<div class="col-sm-12 col-lg-4">'
                                                            . '<div class="goods-block">'
                                                            . '<div class="goods-block-fg">'.'<a href="'.Yii::$app->urlManager->createUrl('catalog/'.$cat->id).'"></a></div>'
                                                            . '<a href="'.Yii::$app->urlManager->createUrl('catalog/'.$cat->id).'"><img src="images/catalog/'.$cat->image.'" alt="'.$cat->name.'" class="img-responsive"></a>'
                                                            . '<hr>'
                                                            //. '<hr><p><i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i></p>'
                                                            . '<h4>'.$cat->name.' ('.$tovar_count.')</h4>'
                                                            . Html::a('Подробнее', ['catalog/'.$cat->id], ['class' => 'goods-more'])
                                                            . '</div>    <!-- end goods-block -->'
                                                            . '</div>    <!-- end col -->';
                                                        }
                                                    endforeach;
                                                } else {
                                                    $form = ActiveForm::begin([
                                                        'id'  =>  'catalog-view-form',
                                                    ]);
                                                    echo $form->field($client, 'company')->textInput(['type' => 'hidden'])->label(false);

                                                    $pageNumber = 1;
                                                    $price = 0;
                                                    foreach ($tovar as $good):
                                                        if ($good->price_rub != 0) { 
                                                            $price = round($good->price_rub);
                                                        } 
                                                        if ($good->price_usd != 0) {
                                                            $price = round($good->price_usd * $currencies['USD'],2);
                                                        } 
                                                        if ($good->price_eur != 0) {
                                                            $price = round($good->price_eur * $currencies['EUR'],2);
                                                        }
                                                        if ($good->discount != 0) {
                                                            $discount = '<a href="'.Yii::$app->urlManager->createUrl(Yii::$app->homeUrl.'../view?id='.$good->id).'" class="label discount"><span class="flash animated">'.$good->discount.'%</span></a>';
                                                            $old_price = round($price);
                                                            $price = round($price - $price/100*$good->discount);
                                                        } else {
                                                            $discount = '';
                                                            $old_price = '';
                                                        }
                                                        if ($good->hit != 0) {
                                                            $hit = '<a href="'.Yii::$app->urlManager->createUrl(Yii::$app->homeUrl.'../view?id='.$good->id).'" class="label hit"><span><i class="fa fa-star-o" aria-hidden="true"></i></span></a>';
                                                        } else {
                                                            $hit = '';
                                                        }

                                                        if(strpos($price, '.')) {
                                                            if(substr($price, -3, 1) != '.') {
                                                                $price = round($price,2).'0';
                                                            }
                                                        }
                                                        if(strpos($old_price, '.')) {
                                                            if(substr($old_price, -3, 1) != '.') {
                                                                $old_price = round($old_price,2).'0';
                                                            }
                                                        }
                                                        if(!strpos($price, '.')) {
                                                            $price = $price.'.00';
                                                        }
                                                        if(!strpos($old_price, '.') && $old_price != '') {
                                                            $old_price = $old_price.'.00';
                                                        }

                                                        

                                                        echo '<div class="goods-list-block" data-goods-id="'.$good->id.'" data-page-number="'.$pageNumber.'" data-brand="'.$good->brand.'" data-type="'.$good->type.'">'
                                                            .'<div class="row">'
                                                            .'<div class="col-md-4 col-lg-3">'
                                                            .'<a href="'.Yii::$app->urlManager->createUrl(Yii::$app->homeUrl.'../view?id='.$good->id).'"><img src="images/goods/'.$good->photo1.'" alt="" class="img-responsive"></a>'
                                                            .$hit
                                                            .$discount
                                                            .'</div>  <!-- end col -->'
                                                            .'<div class="col-md-8 col-lg-9">'
                                                            .'<h3>'.Html::a($good->name, [Yii::$app->urlManager->createUrl('../view?id='.$good->id)], ['class' => 'goods-more']).'</h3>'
                                                            .'<div class="row">'
                                                            .'<i class="goods-price col-md-6"><s>'.$old_price.'</s> <span>'.$price.'</span> &#8381;</i>'
                                                            .'<button type="submit" class="goods-buy buy-from-catalog-view col-md-5"><i class="fa fa-shopping-cart" aria-hidden="true"></i> В корзину</button>'
                                                            .'<p class="col-xs-12">'
                                                            .'<a class="preview" role="button" data-toggle="collapse" href="#collapse-more-'.$good->id.'" aria-expanded="false" aria-controls="collapse-more-'.$good->id.'">'
                                                            .$good->description
                                                            .'<i class="fa fa-chevron-down" aria-hidden="true"></i>'
                                                            .'</a>'
                                                            .'</p>'
                                                            .'</div>'
                                                            .'<div class="collapse" id="collapse-more-'.$good->id.'">'
                                                            .'<div class="well">'
                                                            .$good->text
                                                            .'</div>  <!-- end well -->'
                                                            .'</div>  <!-- end collapse -->'
                                                            .'<a class="preview"  role="button" data-toggle="collapse" href="#collapse-options-'.$good->id.'" aria-expanded="false" aria-controls="collapse-options-'.$good->id.'">Характеристики'
                                                            .'<i class="fa fa-chevron-down" aria-hidden="true"></i>'
                                                            .'</a>'
                                                            .'<div class="collapse" id="collapse-options-'.$good->id.'">'
                                                            .'<div class="well">'
                                                            .'<div class="catalog-view-props-table">'.$good->properties.'</div>'
                                                            .'</div> <!-- end well -->'
                                                            .'</div>  <!-- end collapse -->'
                                                            .Html::a('Подробнее...', ['view?id='.$good->id], ['class' => 'goods-more'])
                                                            .'</div>  <!-- end col -->'
                                                            .'</div>  <!-- end row -->'
                                                            .'</div>  <!-- end goods-list-block -->';
                                                            
                                                    endforeach;
                                                    ActiveForm::end();
                                                }

                                                ?>
                                        
                                            </div>	<!-- end row -->

                                        </div>	<!-- end goods-container -->

                                        <div class="catalog-view-pagination-block">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="catalog-view-pagination">
                                                        <div class="btn-group" role="group">
                                                        
                                                        </div>
                                                    </div>
                                                </div>  <!-- end col -->
                                            </div>  <!-- end row -->
                                        </div>  <!-- end catalog-view-pagination-block -->

                                    </div>	<!-- end content-block -->

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>