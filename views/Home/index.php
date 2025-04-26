<?php ob_start(); ?>
<h1 class="text-primary">Bem-vindo!</h1>
<p>Essa página está sendo renderizada via PHP puro com layout Bootstrap.</p>
<?php $content = ob_get_clean(); include 'views/layouts/main.php'; ?>