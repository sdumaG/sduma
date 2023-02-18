<?php
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Html;


NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar navbar-expand-md navbar-light bg-light fixed-top',
    ],
]);
$menuItems = [
    
 /*    ['label' => 'About', 'url' => ['/site/about']],
    ['label' => 'Contact', 'url' => ['/site/contact']], */
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Registrarse', 'url' => ['/site/signup']];
}
else{
    $menuItems[] = ['label' => 'Solicitudes', 'url' => ['/solicitud-generica/index']];
    $menuItems[] = ['label' => 'Expedientes', 'url' => ['/expedientes/index']];
}

echo Nav::widget([
    'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
    'items' => $menuItems,
]);
if (Yii::$app->user->isGuest) {
    echo Html::tag('div',Html::a('Iniciar Sesión',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
} else {
    echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
        . Html::submitButton(
            'Cerrar Sesión (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout text-decoration-none text-primary']
        )
        . Html::endForm();
}
NavBar::end();