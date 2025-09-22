<?php
include './class/Animais.php';
$animais = new Animais(); // instanciando a classe Animais

echo '<pre>'; // Formatação da página para os var_dumps
var_dump($_POST); // var_dump -> para Validar se o Método POST está trazendo os dados de maneira correta
var_dump($_FILES); // var_dump -> Para Validar se o método $_FILES está correto

if($_SERVER['REQUEST_METHOD'] = 'POST' && isset($_POST['cadastro'])){ // Condição que verificar se as validações estão corretas para executar o próximo conteúdo
    $nomeAnimal = $_POST['nome_animal']; // Recebendo o nome do Animal pelo input do nome do animal, utilizando método POST
    $localTemp = $_FILES['foto_animal']['tmp_name']; // Pegando o local onde o arquivo está sendo alocado pelo arquivo, utilizando o método $_FILES
    $nomeArquivo = $_FILES['foto_animal']['name']; // Pegando o nome do arquivo pelo método $_FILES

    $tipoArquivo = explode('.' , $nomeArquivo); // Separando a string onde comteno o nome do arquivo utilizando o explode, sempre que tem um . ex: panda.html -> utilizando o explode seria: pandahtml
    $tipoArquivo = '.' . end($tipoArquivo); // Pegando o último valor depois do explode, no exemplo acima seria o html
    $novoNome = uniqid() . date("YmdHis") . $tipoArquivo; // gerando um novo nome para o arquivo, uniqid() Gera um ID unico aleatorio, date("YmdHis") formato da data, e a variável tipo do arquivo

    $caminhoArquivo = "animais/{$novoNome}"; // Armazenando o caminho do arquivo, para utiliza-lo futuramente

    if(move_uploaded_file($localTemp, './img/' . $caminhoArquivo)){ // move o arquivo que foi feito pelo metodo $_FILE para o caminho informado ex: $localTemp, './img/' . $caminhoArquivo
        $animais->cadastroAnimais($nomeAnimal, $nomeArquivo, $nomeArquivo, $caminhoArquivo); // chamando a função cadastroAnimais() criada na classe Animais, e atribunindo valores aos parametros definidos nelas
        echo '<h1>Imagem Salva Com Sucesso!!</h1>'; // Exibindo um Titulo para confirmar que foi salva uma imagem
    }

}