<?php
include("cabecalho.php");
$url = 'https://www.canalti.com.br/api/pokemons.json';

//INICIALIZAR A URL
$jsonContents = file_get_contents($url);

//AVALIAR SE EXISTE ERRO
if($jsonContents === false) {
    echo "<p> Erro na requisição cURL: </p>";
} else {
    //DECODIFICAR
    $result = json_decode($response);

    if($result === null) {
        echo "<p>Falha ao decodificar o conteudo da API.</p>";
    } else if(empty($result->pokemon)) {
        echo "<p>Api não retornou valores.</p>";
    } else {
?>
<table class = "table table-striped table-bordered">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Imagem</th>
    </tr>
    <?php
        foreach($result->pokemon as $value) {
    ?>  
        <tr>
            <td><?=$value -> id ?></td>
            <td><?=$value -> name ?></td>
            <td><img src = "<?=$value->img ?>"</td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php
    }
}

include("rodape.php");
?>