
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Resultado</title>
    </head>
    <body>
        <header>
            <h1>Resultado do processamento</h1>
        </header>
        <main>
            <?php 

                $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=%2711-21-2025%27&@dataFinalCotacao=%2711-29-2025%27&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra';
            
                $dados = json_decode(file_get_contents($url), true);

                $cotacao = $dados["value"][0]["cotacaoCompra"];

                $reais = $_GET["reais"] ?? "0";
                $convertido = $reais / $cotacao;
                
                $padrao = numfmt_create("pt_BR", NumberFormatter::CURRENCY);

                echo "Seus " . numfmt_format_currency($padrao, $reais, "BRL")." equivalem a " . numfmt_format_currency($padrao, $convertido, "USD" . " Na cotacao atual");
                
                echo "<p>Cotacao pelo <a href='https://www.bcb.gov.br/' target='_blank'><strong>Banco central</strong></a> </p>";

            ?>
            <button onclick="javascript:history.go(-1)">&#x25C0 Voltar</button>
        </main>
        
    </body>
</html>

