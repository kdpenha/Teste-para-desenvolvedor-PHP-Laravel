<?php ob_start(); ?>
    <div class="text-center">
        <h1 class="mb-4">Painel Principal</h1>
        <div class="d-grid gap-3">
            <a href="<?= route('/properties') ?>" class="btn btn-primary btn-lg">
                <i class="bi bi-house-door me-2"></i> Gerenciar Imóveis
            </a>
            <a href="<?= route('/customer-interests') ?>" class="btn btn-success btn-lg">
                <i class="bi bi-people me-2"></i> Gerenciar Interesses
            </a>
        </div>
    </div>
<?php $content = ob_get_clean(); include 'views/layouts/main.php'; ?>