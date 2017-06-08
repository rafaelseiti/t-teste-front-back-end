<?php
class Arquivo {
    private $conteudo;

    function Arquivo() { }

    function carregar() {
        $arquivo = fopen('arquivo.txt', 'r');
        $l = "";
        while ($l = fgets($arquivo)) {
            $this->conteudo = $this->conteudo . $l . "\n";
        }
        fclose($arquivo);
    }

    function visualizar() {
        return $this->conteudo;
    }
}
?>
<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Leitura de arquivo</title>
    </head>
    <body>
    <?php
        $arq = new Arquivo();
        $arq->carregar();

        echo $arq->visualizar();
    ?>
    </body>
</html>