<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Breadcrumbs;
?>

<main role="main">

        <div id="breadcrumbs-container" class="container-fluid hidden-xs">
                <div class="container">
                        <div class="row">
                                <div class="col-xs-12">
                                    <?php
                                        echo Breadcrumbs::widget([
                                            'homeLink' => [
                                                'label' => 'Кабинет',
                                                'url' => Yii::$app->urlManager->createUrl('/admin'),
                                            ],
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
                                <div class="content-block">
                                        <header>
                                                <h1>
                                                        <?= Html::a('<i class="fa fa-arrow-left"></i>', '@web/admin', ['class' => 'go-back-link', 'title' => 'Кабинет']) ?>
                                                        <?= Html::encode($this->title) ?>
                                                </h1>
                                                <p class="bg-warning">Добавление, редактирование, удаление товаров</p>
                                        </header>

                                        <div class="goods-container">	
                                            <div class="dashboard row">
                                                
                                                <div class="col-xs-12 col-md-5 col-lg-4 text-left">
                                                    <div class="dashboard-block"  style="min-height: 70px;">
                                                        <?= Html::a('<i class="fa fa-plus"></i> Добавить товар', Yii::$app->urlManager->createUrl(['/admin/goods-add']), ['class' => 'btn btn-success']) ?>
                                                    </div>
                                                </div> <!-- end-col -->
                                                <div class="col-xs-12 col-md-7 col-lg-8 text-left">
                                                    <div class="dashboard-block" style="min-height: 70px;">
                                                        <form id="search" class="form-inline">
                                                            <div class="input-group col-sm-12">
                                                                <input class="form-control" type="text" placeholder="Найти товар..." aria-label="Поиск...">
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                                </span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div> <!-- end-col -->

                                                <div class="col-xs-12">
                                                    <div class="dashboard-block">
                                                    <p>Категории: </p>
                                                        <div class="btn-group" data-toggle="buttons">
                                                            <?php $catCounter = 1; ?>
                                                            <?= Html::a('Все', ['/admin/goods'], ['class' => 'btn btn-default active']) ?>
                                                            <?php foreach ($categories as $key => $cat): ?>
                                                                <?= Html::a($cat->getCategoryName($cat->category_id), ['/admin/goods?cat='.$cat->category_id], ['class' => 'btn btn-default', 'cat' => $cat->category_id]) ?>
                                                                <?php $catCounter++; ?>
                                                            <?php endforeach ?>
                                                        </div>
                                                        <?= Html::a('<i class="fa fa-plus"></i>Добавить категорию', Yii::$app->urlManager->createUrl(['/admin/add-category']), ['class' => 'btn btn-success']) ?>
                                                    </div>
                                                </div> <!-- end-col -->

                                                <div class="col-xs-12">
                                                    <div class="dashboard-block">
                                                        <div class="tovar-block row">
                                                            <div class="col-xs-1 text-center">
                                                                <h5>№</h5>
                                                            </div>
                                                            <div class="col-xs-8 text-center">
                                                                <h5>Наименование</h5>
                                                            </div>
                                                            <div class="col-xs-1 text-center">
                                                                <h5>Руб.</h5>
                                                            </div>
                                                            <div class="col-xs-1 text-center">
                                                                <h5>USD</h5>
                                                            </div>
                                                            <div class="col-xs-1 text-center">
                                                                <h5>EUR</h5>
                                                            </div>
                                                        </div> <!-- end-tovar-block -->

                                                        <?php $tovarCounter = 1; ?>

                                                        <?php foreach ($tovar as $key => $good): ?>
                                                            <div class="tovar-block row">
                                                                <div class="tovar-counter col-xs-1 text-center">
                                                                    <?= $tovarCounter ?>
                                                                </div>
                                                                <div class="tovar-name-block col-xs-8 text-left">
                                                                    <?= Html::img(
                                                                        '@web/images/goods/'.$good->photo1, 
                                                                        [
                                                                            'alt' => $good->name,
                                                                            'class' => 'img-responsive',
                                                                        ]
                                                                    ) ?>
                                                                    <?= Html::a(
                                                                        $good->name, 
                                                                        ['../goods-view', 'id' => $good->id,]
                                                                    ) ?>
                                                                </div>
                                                                <div class="tovar-price-rub col-xs-1 text-center">
                                                                    <?= $good->price_rub ?>
                                                                </div>
                                                                <div class="tovar-price-usd col-xs-1 text-center">
                                                                    <?= $good->price_usd ?>
                                                                </div>
                                                                <div class="tovar-price-eur col-xs-1 text-center">
                                                                    <?= $good->price_eur ?>
                                                                </div>
                                                                <?php $tovarCounter++; ?>
                                                            </div> <!-- end-tovar-block -->
                                                        <?php endforeach ?>
                                                    </div> <!-- end-dashboard-block -->
                                                </div> <!-- end-col -->
                                            </div>	<!-- end dashboard row -->                                                        
                                        </div>	<!-- end goods-container -->

                                        <div>
                                            <?php       
                                                echo LinkPager::widget([
                                                    'pagination' => $pages,
                                                    'registerLinkTags' => true
                                                ]);
                                            ?>
                                        </div>
                                </div>	<!-- end content-block -->
                            </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>