<?php if(Yii::$app->request->getPathInfo() === ''): ?>
<div class="home-loading" hidden aria-hidden="true">
    <div class="home-loading-indicator">
        <i class="home-loading-ring"></i>
        <i class="home-loading-ring"></i>
        <div class="home-loading-bars">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<?php endif; ?>