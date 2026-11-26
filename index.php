
<?php
$base_url = '/SERVICE_CAR';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Service Car | Serviços Automotivos</title>

    <!-- CSS compartilhado -->
    <link rel="stylesheet" href="<?= $base_url ?>/assets/css/global.css">
    <link rel="stylesheet" href="<?= $base_url ?>/assets/css/components.css">
    <link rel="stylesheet" href="<?= $base_url ?>/assets/css/header.css">
    <link rel="stylesheet" href="<?= $base_url ?>/assets/css/footer.css">

    <!-- JavaScript global -->
    <script src="<?= $base_url ?>/assets/js/main.js" defer></script>
</head>

<body>

    <!-- Header compartilhado -->
    <?php require __DIR__ . '/includes/header.php'; ?>

    <main>

        <!-- Seção de teste -->
        <section class="section">
            <div class="container">

                <h1 class="section-title">
                    Bem-vindo ao Service Car
                </h1>

                <p>
                    Encontre os serviços automotivos ideais
                    para o seu veículo.
                </p>

                <br>

                <div class="alert alert-success">
                    Base compartilhada carregada com sucesso!
                </div>

                <div class="card">

                    <h2 class="card-title">
                        Encontre um serviço
                    </h2>

                    <p class="card-description">
                        Pesquise pelo serviço que seu veículo precisa.
                    </p>

                    <div class="form-group">

                        <label class="form-label" for="servico">
                            Qual serviço você procura?
                        </label>

                        <input
                            type="text"
                            id="servico"
                            class="form-control"
                            placeholder="Ex.: Troca de óleo"
                        >

                    </div>

                    <button type="button" class="btn btn-primary">
                        Buscar serviço
                    </button>

                    <button type="button" class="btn btn-secondary">
                        Saiba mais
                    </button>

                </div>

            </div>
        </section>

    </main>

    <!-- Footer compartilhado -->
    <?php require __DIR__ . '/includes/footer.php'; ?>

</body>

</html>
