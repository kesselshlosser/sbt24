<?php

/* 
 * open invoice view in pdf file
 */


use yii\helpers\Html;
?>

<main role="main">

        <div id="page-container" class="container">

                <div class="row">

                        <div class="col-sm-12">
                                <div id="content-container">
                                    
                                    <br>
                                    
                                    <div class="content-block">
                                        <table class="table table-responsive table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><?= $company->bank ?></td>
                                                    <td>БИК</td>
                                                    <td><?= $company->bik ?></td>
                                                </tr>
                                                <tr>
                                                    <td><small>Банк получателя</small></td>
                                                    <td>Сч. №</td>
                                                    <td><?= $company->account ?></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <header>
                                            <h4><?= Html::encode($this->title) ?></h4>
                                        </header>
                                        
                                        <br>
                                        
                                        <table class="table table-responsive table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Поставщик <br>(Исполнитель)</td>
                                                    <td><?= $company->company_name ?>, 
                                                        ИНН <?= $company->inn ?>,
                                                        КПП <?= $company->kpp ?>,
                                                        <?= $company->address ?>,
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Покупатель <br>(Заказчик)</td>
                                                    <td>
                                                        <?= $client->company ?>
                                                        <?php 
                                                            if($client->inn == '')
                                                            {echo ' ';}
                                                            else
                                                            {echo ', ИНН '.$client->inn;}
                                                        ?>
                                                        <?php 
                                                            if($client->kpp == '')
                                                                echo ' ';
                                                            else
                                                                echo ', КПП '.$client->kpp.', ';
                                                        ?>
                                                        <?= $client->address ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br>
                                        <table id="cart-table" class="table table-responsive table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td width="7%" class="text-center">№</td>
                                                    <td class="text-center">Товары (работы, услуги)</td>
                                                    <td width="10%" class="text-center">Кол-во</td>
                                                    <td width="7%" class="text-center">Ед.</td>
                                                    <td width="15%" class="text-center">Цена</td>
                                                    <td width="15%" class="text-center">Сумма</td>
                                                </tr>
                                                <?php 
                                                    $itemCount = 0;
                                                    $totalSum = 0;
                                                    $rowCount=1;
                                                    foreach ($order['orderItems'] as $item):
                                                        //$tovar = app\models\Tovar::find()->where(['id' => $item->tovar_id])->one();
                                                        $tovar = $tovar->getTovarById($item->tovar_id);
                                                        /*if ($tovar->price_rub != 0) { 
                                                            $price = round($tovar->price_rub,2);
                                                        } 
                                                        if ($tovar->price_usd != 0) {
                                                            $price = round(($tovar->price_usd * $currencies['USD']),2);
                                                        } 
                                                        if ($tovar->price_eur != 0) {
                                                            $price = round(($tovar->price_eur * $currencies['EUR']),2);
                                                        }
                                                        if ($tovar->discount != 0) {
                                                            $price = round(($price - $price/100*$tovar->discount),2);
                                                        }
                                                        if(strpos($price, '.')) {
                                                            if(substr($price, -3, 1) != '.') {
                                                                $price = round($price,2).'0';
                                                            }
                                                        }
                                                        if(!strpos($price, '.')) {
                                                            $price = $price.'.00';
                                                        }*/
                                                        $itemSum = $item->sum;
                                                        $sum = ($item->sum * $item->count);
                                                        
                                                        if(strpos($itemSum, '.')) {
                                                            if(substr($itemSum, -3, 1) != '.') {
                                                                $itemSum = round($itemSum,2).'0';
                                                            }
                                                        }
                                                        if(!strpos($itemSum, '.')) {
                                                            $itemSum = $itemSum.'.00';
                                                        }
                                                        if(strpos($sum, '.')) {
                                                            if(substr($sum, -3, 1) != '.') {
                                                                $sum = round($sum,2).'0';
                                                            }
                                                        }
                                                        if(!strpos($sum, '.')) {
                                                            $sum = $sum.'.00';
                                                        }
                                                        echo '<tr>'
                                                        .'<td  class="text-center">'
                                                        .$rowCount        
                                                        .'</td>'
                                                        .'<td class="text-left">'
                                                        .$tovar->name
                                                        .'</td>'
                                                        .'<td class="text-right">'
                                                        .$item->count
                                                        .'</td>'
                                                        .'<td class="text-left">'
                                                        .'шт'
                                                        .'</td>'
                                                        .'<td class="text-right">'
                                                        .$itemSum
                                                        .'</td>'
                                                        .'<td class="text-right">'
                                                        .$sum
                                                        .'</td>'
                                                        . '</tr>';
                                                        $itemCount += $item->count;
                                                        $totalSum += $sum;
                                                        $rowCount++;
                                                    endforeach;
                                                    if(strpos($totalSum, '.')) {
                                                        if(substr($totalSum, -3, 1) != '.') {
                                                            $totalSum = round($totalSum,2).'0';
                                                        }
                                                    }
                                                    if(!strpos($totalSum, '.')) {
                                                        $totalSum = $totalSum.'.00';
                                                    } else
                                                    $totalSum = round($totalSum,2);

                                                    $nds = round(($totalSum / 100 * 15),2);
                                                    if(strpos($nds, '.')) {
                                                        if(substr($nds, -3, 1) != '.') {
                                                            $nds = round($nds,2).'0';
                                                        }
                                                    }
                                                    if(!strpos($nds, '.')) {
                                                        $nds = $nds.'.00';
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                        <div class="text-right">
                                            <h5>Итого: <?= $totalSum ?></h5>
                                            <h5>В том числе НДС: <?= $nds ?></h5>
                                            <h5>Всего к оплате: <?= $totalSum ?></h5>
                                        </div>
                                        
                                        <div class="text-left">
                                            <p>Всего наименований <?= $itemCount ?> на сумму <?= $totalSum ?> руб.</p>
                                            <h5><?= Yii::$app->controller->ucfirst_utf8(Yii::$app->controller->num2str($totalSum)) ?></h5>
                                        </div>
                                        
                                        <br>
                                        
                                        <div class="text-left">
                                            <p>Внимание!</p>
                                            <p>Оплата данного счета означает согласие с условиями поставки товара.</p>
                                            <p>Уведомление об оплате обязательно, в противном случае не гарантируется наличие товара на складе.</p>
                                            <p>Товар отпускается по факту прихода денег на р/с Поставщика, самовывозом, при наличии доверенности и паспорта.</p>
                                        </div>
                                        
                                        <br>
                                        
                                        <table class="table table-responsive table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td width="18%">Руководитель:</td>
                                                    <td class="text-right" style="border-bottom: 1px #000 solid;">Янов С.А.</td>
                                                    <td class="text-right" width="15%">Бухгалтер:</td>
                                                    <td class="text-right" style="border-bottom: 1px #000 solid;">Янов С.А.</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>	<!-- end content-block -->

                                </div>	<!-- end content-container -->
                        </div>	<!-- end col -->

                </div>	<!-- end row -->
        </div>	<!-- end page-container -->
</main>