<?php ob_start(); ?>
<h1 class="mb-4">Interesses de Clientes Cadastrados</h1>

<div class="d-flex justify-content-between">
    <a href="<?= route('/') ?>" class="btn btn-primary mb-3">Voltar</a>
    <a href="<?= route('customer-interests/create') ?>" class="btn btn-success mb-3">Novo Interesse de Cliente</a>
</div>

<div class="row">
    <div class="col-12">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Celular</th>
                    <th>Tipo de imóvel desejado</th>
                    <th>Preço mín. de imóvel</th>
                    <th>Preço máx. de imóvel</th>
                    <th>Num. mín. de quartos</th>
                    <th>Bairros preferidos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customerInterests as $customerInterest): ?>
                    <tr>
                        <td><?= htmlspecialchars($customerInterest['id']) ?></td>
                        <td><?= htmlspecialchars($customerInterest['name']) ?></td>
                        <td><?= htmlspecialchars($customerInterest['phone']) ?></td>
                        <td><?= htmlspecialchars($customerInterest['desired_property_type']) ?></td>
                        <td>R$ <?= !empty($customerInterest['property_price_min']) ? number_format($customerInterest['property_price_min'], 2, ',', '.') : '-' ?></td>
                        <td>R$ <?= !empty($customerInterest['property_price_max']) ? number_format($customerInterest['property_price_max'], 2, ',', '.') : '-' ?></td>
                        <td><?= !empty($customerInterest['number_min_of_rooms']) ? htmlspecialchars($customerInterest['number_min_of_rooms']) : '-' ?></td>
                        <td><?= !empty($customerInterest['desired_neighborhoods']) ? htmlspecialchars(str_replace(['[',']','"'],'', $customerInterest['desired_neighborhoods'])) : '-' ?></td>
                        <td>
                            <a href="<?= route('/customer-interests/edit', ['id' => $customerInterest['id']]) ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="/customer-interests/delete?id=<?= $customerInterest['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php if (empty($customerInterest)): ?>
    <div class="alert alert-info">Nenhum interesse de cliente cadastrado.</div>
<?php endif; ?>
</div>

<?php $content = ob_get_clean(); include 'views/layouts/main.php'; ?>