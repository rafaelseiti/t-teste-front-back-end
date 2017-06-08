<?php
class Arquivo {
    private $conteudo;

    function Arquivo() { }

    function carregar($theFile) {
        $arquivo = fopen($theFile, 'r');
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                <?php
                if (isset($_FILES['arquivo'])) 
                {
                    $theFile = $_FILES['arquivo']['tmp_name'];
                    
                    $arquivo = new Arquivo();
                    $arquivo->carregar($theFile);

                    echo "<div class='well well-sm'>" . $arquivo->visualizar() . "</div>";
                }
                else 
                {
                ?>
                    <div class="jumbotron">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-2 label-control">Arquivo</label>
                                <div class="col-sm-10">
                                    <input type="file" name="arquivo">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block"><i class="glyphicon glyphicon-save"></i> Enviar </button>
                            </div>
                        </form>  
                    </div>      
                <?php
                }
                ?>
                </div>
            </div>
        </div>
    </body>
</html>