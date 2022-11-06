<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use app\models\ContactForm as ContactForm;;
use app\models\ContactRequest as ContactRequest;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\ArrayHelper;
use yii\controllers\SiteController;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;


$script = <<< JS
$("#contactform-requesttype").on('change.yii', function(v) {
        $.ajax({
        url: 'http://localhost:8080/index.php?r=site%2Fget-requests-by-type',
        type: 'GET',
        data: {},
        success: function (data) {
            if(v === 1)
            {
                for (var i = 0; i <= data.length; i++) 
                {  
                    $("#contactform-requestdetail").append("<option value='"+i+"'>"+data[i].description+"</option>")  
                }

            }
            else if(v === 2)
            {
                for (var i = 0; i <= data.length; i++) 
                {  
                    $("#contactform-requestdetail").append("<option value='"+i+"'>"+data[i].description+"</option>")  
                }
            }
        },
        error: function(jqXHR, errMsg) {
            alert(errMsg);
        }
        });
    })
JS;

?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

        <p>
            Note that if you turn on the Yii debugger, you should be able
            to view the mail message on the mail panel of the debugger.
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>

    <?php else: ?>

        <p>
            If you have business inquiries or other questions, please fill out the following form to contact us.
            Thank you.
        </p>


        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->label('Name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email')->label('Email')?>

                    <?= $form->field($model, 'requestType')->label('Request Type')->dropDownList(ArrayHelper::map(ContactForm::find()->all(), 'type', 'type'), [
                        'prompt' => 'Select the request type',
                        'onchange' => $script
                    ])?>

                    <?= $form->field($model, 'requestDetail')->label('Request Details')->dropDownList(['prompt' => 'Select the request details '])?>

                    <?= $form->field($model, 'body') ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
