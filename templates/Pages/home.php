<?php
/**
 * @var \App\View\AppView $this
 */
$this->disableAutoLayout();
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= __('Home') ?></title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
 

</head>
<body>
    <header>
        <div class="container text-center">
            <h1>Welcome to My Website</h1>
        </div>
    </header>

    <main class="main">
        <div class="container text-center">
            <p>This is your custom CakePHP homepage.</p>
        </div>
    </main>
</body>
</html>
