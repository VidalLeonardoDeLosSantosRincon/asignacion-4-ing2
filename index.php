<?php 
    require_once __DIR__ . '/config/connection.php';
    require_once __DIR__ . '/data/repositories/provinces.repository.php';

    $repo = new PronvinceRepository($pdo);

    $search = $_GET['search'] ?? '';
    $validSearch = !empty($search);
    $data = $validSearch ? $repo->getAll($search) : $repo->getAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Pronvincias</title>
    <link rel="stylesheet" href="./index.css"/>
</head>
<body>
    <header>
        Listado de Provincias RD
    </header>
    <div class="provinces-container">
        <div class="search-container">
            <div class="search-box">
                <form method="GET">
                    <input name="search" id="search" 
                        placeholder="Nombre de pronvicia o ciudad" 
                        value="<?= $search ?>"
                        onkeyup="validSearchTerm()"
                    />

                    <button id="btn-search" type="submit">Buscar</button>

                    <?php if($validSearch): ?>
                        <button id="btn-cancel" type="button" onclick="clearForm()">Cancelar</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
        <h2>Provincias y sus cuidades</h2>
        <table border="1" cellpadding="8" cellspacing="0" style="width:100%;">
            <tbody>
                <?php foreach ($data as $key => $d): ?>
                    <tr class="province-row">
                        <td colspan="1" rowspan="<?= (count($d->cities) + 1) ?>">
                            <b><?= $d->name ?></b>
                        </td>
                    </tr>

                    <?php foreach ($d->cities as $c): ?>
                        <tr style="font-size:18px; border-bottom:2px solid;">
                            <?php if($c->is_main): ?>
                                <td class="is-main">
                                    <b><?= $c->name." (Principal)" ?></b>
                                </td>
                            <?php else: ?>
                                <td><?= $c->name ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>

                    <tr>
                        <td colspan="2" style="border:none; background-color:lightblue;"></td>
                    </tr>
                <?php endforeach; ?>

                <?php if(!count($data)): ?>
                    <tr>
                        <td colspan="2" style="
                            border:none; 
                            border-radius:10px;
                            background-color: rgba(0, 0, 0, 0.05);
                            text-align:center;
                            font-weight:300;
                            font-size:24px;
                            padding:25px;
                        ">
                            <b>Sin resultados para la busqueda: "<?=  $search ?>"</b>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script>
        function validSearchTerm() {
            const inputSearchValue = document.getElementById('search')?.value;
            if(!inputSearchValue) clearForm(false);
        }

        function clearForm(useConfirm = true) {
            const reloadPage = () => window.location='index.php';

            if(!useConfirm) reloadPage();

            if(useConfirm && confirm("Estas seguro que quieres cancelar la busqueda")) {
               reloadPage();
            } 
        }
    </script>
</body>
</html>