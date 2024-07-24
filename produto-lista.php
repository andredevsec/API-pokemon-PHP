<?php
include("cabecalho.php");
$url = 'https://www.canalti.com.br/api/pokemons.json';

//INICIALIZAR A URL
$ch = curl_init($url);

//CONFIGURAÇÃO DA REQUISIÇÃO
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//EXECUTAR A REQUISIÇÃO
$response = curl_exec($ch);

//AVALIAR SE EXISTE ERRO
if(curl_errno($ch)) {
    echo "<p> Erro na requisição cURL: " . curl_error($ch) . "</p>";
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

//FECHA CONEX~~AO
curl_close($ch);

include("rodape.php");
?>