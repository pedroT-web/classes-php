### Classes e Funções
```class Animais -> // Criando a classe Animais
{

    private $conn; -> // Criando uma variável privada, que pode ser acessada apenas no arquivo onde foi declarada

    public function __construct() // Função de Contruir a classe, quando a classe é chamada, ele que executa ela
    {
        $dsn = 'mysql:dbname=db_aula05;host=127.0.0.1'; 
        $usuario = 'root';
        $senha = '';

        $this->conn = new PDO($dsn, $usuario, $senha); // this é utilizado para especificar que o conn é aquele, se eu definisse um conn dentro da função, ele seria diferente do conn privado criado anteriormente
    }

    public function consultarAnimais()
    {
        $script = 'SELECT * FROM tb_animais';

        $resultado = $this->conn->query($script)->fetchAll();

        return $resultado;
    }

    public function consultarAnimaisById($id) // o $id dentro do parenteses é um parametro
    {
        $script = "SELECT * FROM tb_animais WHERE id = {$id}";

        $resultado = $this->conn->query($script)->fetchAll();

        return $resultado;
    }

    public function cadastroAnimais($nome, $nome_arquivo, $tipo, $caminho_arquivo) // as váriaveis entre parenteses são parametros
    {
        $script = "INSERT INTO tb_animais(nome_animal, nome_arquivo_original, tipo_arquivo, caminho_arquivo) VALUES (:nome_animal, :nome_arquivo, :tipo_arquivo, :caminho_arquivo)";

        $insert = $this->conn->prepare($script);
        
        $insert->execute([
            ":nome_animal" => $nome,    
            ":nome_arquivo"    => $nome_arquivo,
            ":tipo_arquivo"    => $tipo,
            ":caminho_arquivo" => $caminho_arquivo
        ]);

        return $this->conn->lastInsertId(); // Retorna o id do ultimo valor inserido 
    }
}
```

### Utilizando a classe e novos Métodos

- instanciando a classe Animais -> ```$animais = new Animais()``` 
<br>
-  Formatação da página para os var_dumps ->  ```echo '<pre>'; ```
<br>
- var_dump -> para Validar se o Método POST está trazendo os dados de maneira correta -> ```var_dump($_POST);```  
<br>
-  var_dump -> Para Validar se o método FILES está correto -> ```var_dump($_FILES);```
<br>
- Condição que verificar se as validações estão corretas para executar o próximo conteúdo -> ```if($_SERVER['REQUEST_METHOD'] = 'POST' && isset($_POST['cadastro'])){ ```
<br>
pegando pelo input do nome do animal, utilizando método POST -> ```$nomeAnimal = $_POST['nome_animal'];``` 
<br>
Pegando o local onde o arquivo está sendo alocado pelo arquivo, utilizando o método FILES -> ```$localTemp = $_FILES['foto_animal']['tmp_name'];``` 
<br>
Pegando o nome do arquivo pelo método FILES -> ```$nomeArquivo = $_FILES['foto_animal']['name'];``` 
<br>
Separando a string onde comteno o nome do arquivo utilizando o explode, sempre que tem um . ex: panda.html -> utilizando o explode seria: pandahtml -> ```$tipoArquivo = explode('.' , $nomeArquivo);```
<br> 
Pegando o último valor depois do explode, no exemplo acima seria o html -> ```$tipoArquivo = '.' . end($tipoArquivo);```
gerando um novo nome para o arquivo, uniqid() Gera um ID unico aleatorio, date("YmdHis") formato da data, e a variável tipo do arquivo -> ```$novoNome = uniqid() . date("YmdHis") . $tipoArquivo;```
<br>
Armazenando o caminho do arquivo, para utiliza-lo futuramente -> ```$caminhoArquivo = "animais/{$novoNome";```
<br>
move o arquivo que foi feito pelo metodo FILE para o caminho informado ex: $localTemp, './img/' . $caminhoArquivo -> ```if(move_uploaded_file($localTemp, './img/' . $caminhoArquivo)){```
<br>
    chamando a função cadastroAnimais() criada na classe Animais, e atribunindo valores aos parametros definidos nelas -> ```$animais->cadastroAnimais($nomeAnimal, $nomeArquivo, $nomeArquivo, $caminhoArquivo);```
    <br>
    Exibindo um Titulo para confirmar que foi salva uma imagem -> ```echo '<h1>Imagem Salva Com Sucesso!!</h1>';```
}
}

### Instanciando a Classe Animais

```
    <?php 
        include './class/Animais.php'; // Incluindo a pasta de 
        $animais = new Animais(); // Instanciando a classe Animais

        $todosAnimais = $animais->consultarAnimais(); // Utilizando a classe Animais para poder utilizar a função consultarAnimais que foi declarada na classe Animais
    ?>

```