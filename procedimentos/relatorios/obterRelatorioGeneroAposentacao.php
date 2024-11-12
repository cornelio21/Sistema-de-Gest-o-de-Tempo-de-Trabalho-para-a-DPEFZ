<?php
ini_set('display_errors', 1);
require_once "../../classes/conexao.php";
require_once "../../classes/funcionarios.php";
require_once "../../libs/dompdf/autoload.inc.php";


use Dompdf\Dompdf;

$dompdf = new Dompdf();
$con = new Conexao();
$conexao = $con->conectar();




$html = '
<html>
    <head>
       <style>
     
      .container h1.titulo-relatorio{
        text-transform: uppercase;
        margin-bottom: 60px;
        font-weight: bold;
        text-align: center;
      }
      
      .container h2.subtitulo-relatorio{
      margin-top: 5px;
      text-align: center;
      }
      
      .tabela-relatorio{
        width: 100%;
        
      }
      
      table.tabela-relatorio, table.tabela-relatorio th, table.tabela-relatorio td{
        border: 1px solid #06001a;
        border-collapse: collapse;
      }
      
      table.tabela-relatorio th, table.tabela-relatorio td {
        padding: 5px;
        text-align: center;
      }
      
      table.tabela-relatorio th{
        font-weight: bold;
      }
      
       </style>
    </head>
    <body>
        <div class="container">
          <h2 class="subtitulo-relatorio">Serviços Provinciais de Economia e Finanças da Zambézia</h2>
          <h1 class="titulo-relatorio">Relatório dos funcionarios aptos para o processo de aposentação</h1>
    
          <table class="tabela-relatorio">
            <caption style = "margin-bottom:5px;"><strong>Ordem descendente em relação a data da aposentação do funcionário</strong></caption>
            <thead>
              <tr>
                <th>Código do funcionário</th>
                <th>Nome do funcionário</th>
                <th>Género</th>
                <th>Anos de carreira</th>
                <th>Tempo restante</th>
                <th>Departamento</th>
                <th>Estado de Aposentação</th>
                
              </tr>
            </thead>

            <tbody>';




$anoActual = date('Y');

$genero = $_POST['optionGenderAposentacao'];

if ($genero == "M") {
    $generoExtenso = "Masculino";
    $anosAposentacaoBase = 60; 
    $sqlPesquisaGeneroMasculino = "select f.idFuncionario, f.nomeFuncionario, f.generoFuncionario, YEAR(f.dataInicioCarreira), d.nomeDepartamento from funcionarios as f left join departamentos as d on f.idDepartamento = d.idDepartamento where f.generoFuncionario = 'M'";
    $resultPesquisaGeneroMasculino = mysqli_query($conexao, $sqlPesquisaGeneroMasculino);
    
    while ($dados = mysqli_fetch_row($resultPesquisaGeneroMasculino)) {
        $verificacaoAnos = $anosAposentacaoBase - (date("Y") - $dados[3]);
        $estadoAposentacao = "";

        if ($verificacaoAnos <= 0) {
            $estadoAposentacao = "Em condições";
        } else if ($verificacaoAnos > 0) {
            $estadoAposentacao = "Não pode";
        }
       
        $html .= '
              <tr>
                <td>'.$dados[0].'</td>
                <td>'.$dados[1].'</td>
                <td>'.$generoExtenso.'</td>
                <td>'.((date("Y") - $dados[3])).'</td>
                <td>'.($anosAposentacaoBase - (date("Y") - $dados[3])).' anos'.'</td>
                <td>'.$dados[4].'</td>
                <td>'.$estadoAposentacao.'</td>
              </tr>';
    }

    
} else if ($genero == "F") {
     $generoExtenso = "Femenino";
     $anosAposentacaoBase = 55;
     $sqlPesquisaGeneroFemenino = "select f.idFuncionario, f.nomeFuncionario, f.generoFuncionario, YEAR(f.dataInicioCarreira), d.nomeDepartamento from funcionarios as f left join departamentos as d on f.idDepartamento = d.idDepartamento where f.generoFuncionario = 'F'";
     $resultPesquisaGeneroFemenino = mysqli_query($conexao, $sqlPesquisaGeneroFemenino);
    

    while ($dados = mysqli_fetch_row($resultPesquisaGeneroFemenino)) {
        $verificacaoAnos = $anosAposentacaoBase - (date("Y") - $dados[3]);
        $estadoAposentacao = "";

        if ($verificacaoAnos <= 0) {
            $estadoAposentacao = "Em condições";
        } else if ($verificacaoAnos > 0) {
            $estadoAposentacao = "Não pode";
        }
        $html .= '
              <tr>
              <td>'.$dados[0].'</td>
              <td>'.$dados[1].'</td>
              <td>'.$generoExtenso.'</td>
              <td>'.((date("Y") - $dados[3])).'</td>
              <td>'.($anosAposentacaoBase - (date("Y") - $dados[3])).' anos'.'</td>
              <td>'.$dados[4].'</td>
              <td>'.$estadoAposentacao.'</td>
              </tr>';
    }
    
}

$html .= '

            </tbody>
    
        </table>
    
        </div>
    </body>

</html>

';


$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream("Relatorio_anual_de_progressao" . date('d(D).M.Y H:i:s'), array("Attachment" => false));
