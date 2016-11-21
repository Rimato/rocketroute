<?php

use app\assets\index\IndexAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
$this->title = 'My Yii Application';

IndexAsset::register($this);

?>

<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => true,
]); ?>

<?php $form = ActiveForm::begin(['id' => 'icaoForm',  'enableClientValidation' => true,]); ?>
<?= $form->field($model, 'ICAO') ?>

<div class="form-group">
    <?= Html::button('Submit', ['class' => 'btn btn-primary', 'id' => 'submit']) ?>
</div>

<?php ActiveForm::end(); ?>

<div style='overflow:hidden;height:440px;width:700px;'><div id='gmap_canvas' style='height:440px;width:700px;'>

</div>
<div>
    <small><a href="http://embedgooglemaps.com">embedgooglemaps.com</a></small>
</div>
<div>
    <small><a href="https://onlinepartnersuchekostenlos.de/edarling/">edarling</a></small>
</div>
    <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
</div>
<script type="text/javascript" src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAgrTcHVRx9DOSh9oDiAgd-o37iN38Wk_0'>

</script>