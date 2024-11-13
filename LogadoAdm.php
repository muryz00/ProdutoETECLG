<?php 
// session_start inicia a sessão

// as variáveis login e senha recebem os dados digitados na página anterior
$usuarioAdm = $_POST['usuario_login'];
$senhaAdm = $_POST['senha_login'];


$logarAdm =  new LogarAdm ( $usuarioAdm , $senhaAdm);

class LogarAdm
{
    //Cria uma classe Publica, onde todos os arquivis do projeto tema cesso
     public $usuarioAdm; 
     public $senhaAdm;
     
    
    public function __construct($usuarioAdm, $senhaAdm)
    {
        //Método construtor é respnsavel pelo vinculo dos campos aos aobjtos criados
        $this->usuarioAdm = $usuarioAdm; 
        $this->senhaAdm = $senhaAdm;
               
    }
    public function loginAdm()
    {
        try
        {
            include "conexao.php";
            //Adiciona o arquivo de conexao ao projeto. 

            $Comando=$conexao->prepare("SELECT ID_ADM, NOME_ADM, EMAIL_ADM, SENHA_ADM FROM TB_CADASTRO_ADM 
            WHERE  EMAIL_ADM=? AND SENHA_ADM=?");   
            $Comando->bindParam(1, $this-> usuarioAdm);
            $Comando->bindParam(2, $this-> senhaAdm);        
                         
            if ($Comando->execute())
            {
                if ($Comando->rowCount () >0) 
                {   
                  while ($Linha = $Comando->fetch(PDO::FETCH_OBJ)) {
                  $id = $Linha->ID_ADM;
                  $_SESSION['IdAdm'] = $id;

                  $nome = $Linha->NOME_ADM;
                  $_SESSION['nomeAdm'] = $nome;

                  $email = $Linha->EMAIL_ADM;
                  $_SESSION['emailAdm'] = $email;

                  $senha = $Linha->SENHA_ADM;
                  $_SESSION['senhaAdm'] = $senha;
      
                  header('location:FormAlterarAdm.php');
                }
              }
              else
              {
                //unset ($_SESSION['controle']);
                echo "<script> alert('Usuário e/ou senha não confere!')</script>"; 
                echo "<A href=\"FormLoginAdm.php\">Retornar</A>"; 
              }
          }
      
        }   
        catch (PDOException $erro)
        {
            echo"Erro" . $erro->getMessage();
    
        }  
    }
}

$logarAdm->loginAdm();
// Executa a função que vai permitir para fazer a consulta

   
?>
 
