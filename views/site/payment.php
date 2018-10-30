<?php

/*
 * service page
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
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

                        <aside class="col-sm-5 col-md-4">
                                <div class="aside-block default">
                                    <nav id="catalog-menu" class="navbar navbar-default">
                                        <div class="navbar-header">
                                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                                        <span class="sr-only">Toggle navigation</span>
                                                        <span class="icon-bar"></span>
                                                        <span class="icon-bar"></span>
                                                        <span class="icon-bar"></span>
                                                </button>
                                                <a class="navbar-brand visible-xs" href="#"><?= Yii::$app->name ?></a>
                                        </div>
                                        <div id="navbar" class="navbar-collapse collapse">
                                            <ul class="nav navbar-nav">
                                                <h3><i class="fa fa-bars" aria-hidden="true"></i>Каталог товаров</h3>
                                                <li>
                                                    <form id="search" class="form-inline">
                                                        <div class="input-group col-xs-12">
                                                            <input class="form-control" type="text" placeholder="Поиск по каталогу..." aria-label="Поиск...">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                            </span>
                                                        </div>
                                                    </form>
                                                    <hr>
                                                </li>
                                                <?php
                                                    // вывод меню из БД
                                                    $category = \app\models\Category::find()->where(['parent' => '0'])->all();

                                                    foreach ($category as $cat):
                                                        $sub_category = \app\models\Category::find()->where(['parent' => $cat->id])->all();
                                                        if ($sub_category == NULL) {
                                                            echo '<li><a href="'.Yii::$app->urlManager->createUrl(['category/'.$cat->id]).'"><i class="fa fa-arrow-right"></i>'.$cat->name.'</a></li>';
                                                        } else {
                                                            echo '<li role="presentation" class="dropdown">'
                                                            . '<a href="'.Yii::$app->urlManager->createUrl(['category/'.$cat->id]).'" data-target="'.Yii::$app->urlManager->createUrl(['category/'.$cat->id]).'" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-arrow-right"></i>'.$cat->name.'  <i class="fa fa-caret-right" aria-hidden="true"></i></a>';
                                                                echo '<ul class="dropdown-menu">';
                                                                    foreach ($sub_category as $sub_cat):
                                                                        echo '<li><a href="'.Yii::$app->urlManager->createUrl(['category/'.$sub_cat->id]).'">'.$sub_cat->name.'</a></li>';
                                                                    endforeach;
                                                                echo '</ul>';
                                                            echo '</li>';
                                                        }

                                                    endforeach;
                                                ?>
                                                <div class="visible-xs">
                                                    <hr>
                                                    <ul class="nav navbar-nav">
                                                    <li><a href="#"><i class="fa fa-arrow-right"></i>Главная</a></li>
                                                    <li><a href="#"><i class="fa fa-arrow-right"></i>Услуги</a></li>
                                                    <li><a href="#"><i class="fa fa-arrow-right"></i>Доставка</a></li>
                                                    <li><a href="#"><i class="fa fa-arrow-right"></i>Оплата</a></li>
                                                    <li><a href="#"><i class="fa fa-arrow-right"></i>О компании</a></li>
                                                    <li><a href="#"><i class="fa fa-arrow-right"></i>Контакты</a></li>
                                                    </ul>
                                                </div>
                                            </ul>   <!-- nav navbar-nav -->
                                        </div>  <!-- end #navbar -->
                                    </nav>  <!-- end catalog-menu -->
                                </div>  <!-- end aside-block -->

                                <div class="aside-block">
                                        <div class="banner-block">
                                                <header>
                                                        <h3>Скидки недели</h3>
                                                        <br>
                                                </header>
                                                <div class="goods-container">

                                                        <div class="goods-block">
                                                                <a href="#"><img src="images/tovar2.jpg" alt="" class="img-responsive"></a>
                                                                <h4>Двухкарманный счетчик банкнот банковского класса DORS 800</h4>
                                                                <p class="goods-price"><span>15236</span> &#8381;</p>
                                                                <button class="goods-buy"><i class="fa fa-shopping-cart" aria-hidden="true"></i> В корзину</button>
                                                                <a href="#" class="label">
                                                                        <span>15%</span>
                                                                </a>
                                                        </div>
                                                        <div class="goods-block">
                                                                <a href="#"><img src="images/tovar1.jpg" alt="" class="img-responsive"></a>
                                                                <h4>Двухкарманная счетно-сортировальная машина с функцией ветхования GLORY USF-51</h4>
                                                                <p class="goods-price"><span>28963.56</span> &#8381;</p>
                                                                <button class="goods-buy"><i class="fa fa-shopping-cart" aria-hidden="true"></i> В корзину</button>
                                                                <a href="#" class="label">
                                                                        <span>9%</span>
                                                                </a>
                                                        </div>

                                                </div>	<!-- end col -->
                                        </div>
                                </div><!-- end aside-block -->

                                <div class="aside-block">
                                        <div class="banner-block">
                                                <a href="#"><img src="images/image.png" alt="" class="img-responsive"></a>
                                        </div>
                                </div><!-- end aside-block -->

                                <div class="aside-block">
                                        <div class="banner-block">
                                                <a href="#"><img src="images/image.png" alt="" class="img-responsive"></a>
                                        </div>
                                </div><!-- end aside-block -->

                        </aside><!-- end aside -->

                        <div class="col-sm-7 col-md-8">
                                <div id="content-container">

                                        <div class="content-block">
                                                <header>
                                                    <h1><?= Html::encode($this->title) ?></h1>
                                                </header>
                                            
                                            
                                                
                                        </div>	<!-- end content-block -->

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>