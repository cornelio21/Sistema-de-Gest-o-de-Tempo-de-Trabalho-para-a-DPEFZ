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
        <h1 class="titulo-relatorio">Relatório das progressões anuais de funcionários</h1>
    
        <table class="tabela-relatorio">
        <caption style = "margin-bottom:5px;"><strong>Ordem descendente em relação a data de promoção do funcionário</strong></caption>
            <thead>
                <tr>
                    <th>Código de registo</th>
                    <th>Nome do funcionário</th>
                    <th>Departamento</th>
                    <th>Escalão antigo</th>
                    <th>Escalão actual</th>
                    <th>Data</th>
                </tr>
            </thead>

            <tbody>
                ';

$ano = $_POST['optionYearProgressao'];
$sql = "SELECT f.idFuncionario, f.nomeFuncionario, d.nomeDepartamento, p.escalao_antigo, p.escalao_actual, p.dataRegisto_progressao FROM funcionarios_progressao_carreiras AS p INNER JOIN funcionarios AS f ON p.idFuncionario = f.idFuncionario INNER JOIN departamentos AS d ON p.idDepartamento = f.idDepartamento where YEAR(p.dataRegisto_progressao)= '$ano' ORDER BY p.dataRegisto_progressao DESC";
$result = mysqli_query($conexao, $sql);

while ($dados = mysqli_fetch_row($result)) {
    $html .= '      <tr>
                        <td>' . $dados[0] . '</td>
                        <td>' . $dados[1] . '</td>
                        <td>' . $dados[2] . '</td>
                        <td>' . $dados[3] . '</td>
                        <td>' . $dados[4] . '</td>
                        <td>' . $dados[5] . '</td>              
                    </tr>';
};



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
