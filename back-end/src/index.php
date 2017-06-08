<?php
function NumerosMegaSena() {
    $nums = [];
    $idx = 0;

    while ($idx < 6) {
        $tmp = rand(1, 60);
        if (!in_array($tmp, $nums)) {
            $nums[$idx] = ZeroAhEsquerda($tmp);
            $idx++;
        }
    }
    sort($nums);
    return $nums;
}

function ZeroAhEsquerda($num, $qtdZeros = 2) {
    return str_pad($num, $qtdZeros, '0', STR_PAD_LEFT);
}

function JaSorteado($array, $toVerify) {
    foreach ($array as $a) {
        if ($a == $toVerify) {
            return true;
        }
    }
    return false;
}

function MontarTabela($numeros) {
    $tbl = "<tr>";

    $i = 0;

    while ($i < 60)
    {
        $tbl = $tbl . "<td class='text-center ". (in_array(ZeroAhEsquerda($i + 1), $numeros) ? "bg-blue" : "") ."'>" . ZeroAhEsquerda($i + 1) . "</td>";
        if (($i+1) %10 == 0 && $i > 0) {
            $tbl = $tbl . "</tr><tr>";
        }
        $i++;
    }

    return $tbl;
}
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Sorteio de números da Mega Sena</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
        <style>
            .bg-blue { background-color: #0000ff; color: #fff; font-weight: bold; }
        </style>
    </head>
    <body>
        <?php
        $sorteios = [];

        $i = 0;
        while ($i < 3) {
            $tmp = NumerosMegaSena();

            if (!JaSorteado($sorteios, $tmp)) {
                $sorteios[$i] = $tmp;
                $i++;    
            }
        }
        ?>
        <div class="container">
            <div class="jumbotron">
                <h2><i class="glyphicon glyphicon-th"></i> Sorteio de números para Mega Sena.</h2>
                <p class="lead">Sorteio dos números:</p>
                <hr>
                <ul>
                <?php
                    foreach ($sorteios as $sorteio) {
                        echo "<li>" . implode(' - ', $sorteio) . "</li>";
                    }
                ?>
                </ul>
            </div>

            <div id="sorteios" class="panel-group" role="tablist" aria-multiselectable="true">
            <?php
            for ($i = 0; $i < 3; $i++)
            {
                $auxID = "sorteio_" . $i;
                ?>
                <div class="panel panel-default">
                    <div id="heading<?php echo $auxID; ?>" class="panel-heading" role="tab">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#sorteios" href="#<?php echo $auxID; ?>" aria-expanded="<?php echo ($i == 0 ? "true" : "false"); ?>" aria-controls="<?php echo $auxID; ?>">
                                Sorteio nº <?php echo ($i+1); ?>
                            </a>
                        </h4>
                    </div>
                    <div id="<?php echo $auxID; ?>" class="panel-collapse collapse <?php echo ($i == 0 ? "in" : "") ?>" role="tabpanel" aria-labelledby="<?php echo $auxID; ?>">
                        <table class="table table-bordered table-hover">
                            <tbody><?php print_r(MontarTabela($sorteios[$i])); ?></tbody>
                        </table>
                    </div>
                </div>
                <?php
            }
            ?>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>