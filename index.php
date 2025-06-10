
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@1,100&display=swap" rel="stylesheet">
<style>
    body {
        font-family: system-ui;
        background: #f1fad7;
        width: 96% !important;
    }
    .floating-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 60px;
      height: 60px;
      background-color: #1b1b37;
      color: white;
      border: none;
      border-radius: 50%;
      padding: 0;
      font-size: 24px;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.25);
      cursor: pointer;
      z-index: 9999;
  }

  .floating-button:hover {
      background-color: #242449cf;
  }
</style>

</head>


<div class="calendario none">
  <form  method="POST" >
    <label>Data:<input type="date" name="data" style="width: 109px; padding: 3px;"></label>
    <input type="submit" value="Pesquisar" style="width: 109px; padding: 3px;">
  </form>
</div>

<?php 
//ini_set('display_errors',0);

date_default_timezone_set('America/Manaus');

if (isset($_POST['capitulo'])) {
  $conteudo ='';
} else {

$mysqli = new mysqli("localhost","id19689874_marcusabagnale","j<ABO7M/>(J~?lB7","id19689874_dbbiblia");


include 'functions.php';
$mysqli = conectarBancoDeDados();

//echo executarConsulta("SELECT COUNT(*) AS total FROM resultados", 'total').'<br>';

 echo '<div><p style="text-aling: center; width: 100%">'.executarConsulta("SELECT
CONCAT ((select livro from livros_biblicos WHERE id = reg.livro),' Capítulos ' ,MIN(capitulo),' a ' , MAX(capitulo),'.') leitura  FROM (
SELECT * FROM PRG_ANUAL WHERE DIA = ".(date('d')*1)." AND MES = ".(date('m')*1)." ORDER BY capitulo) AS reg 
GROUP BY livro", 'leitura').'</p></div>';


$conteudo ='';
  if (isset($_POST['data'])) {
    $sql = "SELECT * FROM  PRG_ANUAL 
    WHERE DIA = DAY('".$_POST['data']."') AND MES = MONTH('".$_POST['data']."') ORDER BY CAPITULO";
  } else {
    $sql = "SELECT * FROM  PRG_ANUAL 
    WHERE DIA = ".(date('d')*1)." AND MES = ".(date('m')*1)." ORDER BY CAPITULO";
  }
  
  if ($result = $mysqli -> query($sql)) {

    foreach ($result as $key => $value) {
     $conteudo .= getConteudo($value["links"]);
   }
  
   $result -> free_result();
 }

 $mysqli -> close();

} 
 

?>


<div id="livros" style="display: none">
    <form method="POST">

        <fieldset>

           <label class="campo">Capítulo:
            <?php
            $livro = (isset($_POST['livro'])) ? $_POST['livro'] : 'gen' ; 
            $capitulo = (isset($_POST['capitulo'])) ? $_POST['capitulo'] : 1 ;  

            for ($i=1; $i < 10; $i++) { 
                echo '<input type="submit" onclick="livros()" name="capitulo" value="'.$i.'">';
            }
            echo '<input type="hidden" onclick="livros()" name="livro" value="'.$livro.'">';
            ?>
        </label>

    </fieldset>

</form>
</div>


<body style="width: 90%;">
  
  <div id="pontos" style="
  display: none;
  padding: 5px;
    background: rgba(156, 91, 91, 0.5);
    position: fixed;
    height: 146px;
    top: 198px;
    right: 0px;
    border-radius: 6px;
    width: 26px;
  ">
  <div class="ponto_fixo">
    <i onclick="showbooks()">&#128270;</i>          
  </div>

  <div class="ponto_fixo2">
    <i id="vOn" onclick="showVersiculos()">&#128279;</i>          
    <i id="vOff" class="none" onclick="hideVersiculos()">&#128279;</i>          
  </div>

  <div class="ponto_fixo3">
    <i id="cOn" onclick="showCalendario()">&#128467;</i>          
    <i id="cOff" class="none" onclick="hideCalendario()">&#128467;</i>          
  </div>

  <div class="ponto_fixo4">
    <i id="mOn" class="none" onclick="makeWhite()">W</i>          
    <i id="mOff"  onclick="makeBlack()">B</i>          
  </div>
  
  </div>
  

<div style="width: 90%; margin-top: 50px;" id="caixa_livros" class="none">

    <label class="campo">Livro:</label>
    <button onclick="setLivro('1')" value="1">Gênesis</button>
    <button onclick="setLivro('2')" value="2">Êxodo</button>
    <button onclick="setLivro('3')" value="3">Levítico</button>
    <button onclick="setLivro('4')" value="4">Números</button>
    <button onclick="setLivro('5')" value="5">Deuteronômio</button>
    <button onclick="setLivro('6')" value="6">Josué</button>
    <button onclick="setLivro('7')" value="7">Juízes</button>
    <button onclick="setLivro('8')" value="8">Rute</button>
    <button onclick="setLivro('9')" value="9">1 Samuel</button>
    <button onclick="setLivro('10')" value="10">2 Samuel</button>
    <button onclick="setLivro('11')" value="11">1 Reis</button>
    <button onclick="setLivro('12')" value="12">2 Reis</button>
    <button onclick="setLivro('13')" value="13">1 Crônicas</button>
    <button onclick="setLivro('14')" value="14">2 Crônicas</button>
    <button onclick="setLivro('15')" value="15">Esdras</button>
    <button onclick="setLivro('16')" value="16">Neemias</button>
    <button onclick="setLivro('17')" value="17">Ester</button>
    <button onclick="setLivro('18')" value="18">Jó</button>
    <button onclick="setLivro('19')" value="19">Salmos</button>
    <button onclick="setLivro('20')" value="20">Provérbios</button>
    <button onclick="setLivro('21')" value="21">Eclesiastes</button>
    <button onclick="setLivro('22')" value="22">Cântico de Salomão</button>
    <button onclick="setLivro('23')" value="23">Isaías</button>
    <button onclick="setLivro('24')" value="24">Jeremias</button>
    <button onclick="setLivro('25')" value="25">Lamentações</button>
    <button onclick="setLivro('26')" value="26">Ezequiel</button>
    <button onclick="setLivro('27')" value="27">Daniel</button>
    <button onclick="setLivro('28')" value="28">Oseias</button>
    <button onclick="setLivro('29')" value="29">Joel</button>
    <button onclick="setLivro('30')" value="30">Amós</button>
    <button onclick="setLivro('31')" value="31">Obadias</button>
    <button onclick="setLivro('32')" value="32">Jonas</button>
    <button onclick="setLivro('33')" value="33">Miqueias</button>
    <button onclick="setLivro('34')" value="34">Naum</button>
    <button onclick="setLivro('35')" value="35">Habacuque</button>
    <button onclick="setLivro('36')" value="36">Sofonias</button>
    <button onclick="setLivro('37')" value="37">Ageu</button>
    <button onclick="setLivro('38')" value="38">Zacarias</button>
    <button onclick="setLivro('39')" value="39">Malaquias</button>
    <button onclick="setLivro('40')" value="40">Mateus</button>
    <button onclick="setLivro('41')" value="41">Marcos</button>
    <button onclick="setLivro('42')" value="42">Lucas</button>
    <button onclick="setLivro('43')" value="43">João</button>
    <button onclick="setLivro('44')" value="44">Atos</button>
    <button onclick="setLivro('45')" value="45">Romanos</button>
    <button onclick="setLivro('46')" value="46">1 Coríntios</button>
    <button onclick="setLivro('47')" value="47">2 Coríntios</button>
    <button onclick="setLivro('48')" value="48">Gálatas</button>
    <button onclick="setLivro('49')" value="49">Efésios</button>
    <button onclick="setLivro('50')" value="50">Filipenses</button>
    <button onclick="setLivro('51')" value="51">Colossenses</button>
    <button onclick="setLivro('52')" value="52">1 Tessalonicenses</button>
    <button onclick="setLivro('53')" value="53">2 Tessalonicenses</button>
    <button onclick="setLivro('54')" value="54">1 Timóteo</button>
    <button onclick="setLivro('55')" value="55">2 Timóteo</button>
    <button onclick="setLivro('56')" value="56">Tito</button>
    <button onclick="setLivro('57')" value="57">Filêmon</button>
    <button onclick="setLivro('58')" value="58">Hebreus</button>
    <button onclick="setLivro('59')" value="59">Tiago</button>
    <button onclick="setLivro('60')" value="60">1 Pedro</button>
    <button onclick="setLivro('61')" value="61">2 Pedro</button>
    <button onclick="setLivro('62')" value="62">1 João</button>
    <button onclick="setLivro('63')" value="63">2 João</button>
    <button onclick="setLivro('64')" value="64">3 João</button>
    <button onclick="setLivro('65')" value="65">Judas</button>
    <button onclick="setLivro('66')" value="66">Apocalipse</button>


</div>


</div>

<div id="caixa_capitulo" class="none">


</div>


<form id="form" method="POST" class="none">
    <input type="text" id="livro" name="livro" value="">
    <input type="number" id="capitulo" name="Capítulo" value="">

</form>
</div>



<script type="text/javascript">


    function setLivro(i) {

        lim = 2;

        $('#caixa_livros').hide()
        $('#caixa_capitulo').show()
        $('#livro').val(i)
        console.log($('#livro').val())

        $('#caixa_capitulo').append('<label class="campo">Capítulo:</label><br>')

        if ($('#livro').val() == '1') 
            { lim = 51}
        if ($('#livro').val() == '2') 
            { lim = 41}
        if ($('#livro').val() == '3') 
            { lim = 28}
        if ($('#livro').val() == '4') 
            { lim = 37}
        if ($('#livro').val() == '5') 
            { lim = 35}
        if ($('#livro').val() == '6') 
            { lim = 25}
        if ($('#livro').val() == '7') 
            { lim = 22}
        if ($('#livro').val() == '8') 
            { lim = 5}
        if ($('#livro').val() == '9') 
            { lim = 32}
        if ($('#livro').val() == '10') 
            { lim = 25}
        if ($('#livro').val() == '11') 
            { lim = 23}
        if ($('#livro').val() == '12') 
            { lim = 26}
        if ($('#livro').val() == '13') 
            { lim = 30}
        if ($('#livro').val() == '14') 
            { lim = 37}
        if ($('#livro').val() == '15') 
            { lim = 11}
        if ($('#livro').val() == '16') 
            { lim = 14}
        if ($('#livro').val() == '17') 
            { lim = 11}
        if ($('#livro').val() == '18') 
            { lim = 43}
        if ($('#livro').val() == '19') 
            { lim = 151}
        if ($('#livro').val() == '20') 
            { lim = 32}
        if ($('#livro').val() == '21') 
            { lim = 13}
        if ($('#livro').val() == '22') 
            { lim = 9}
        if ($('#livro').val() == '23') 
            { lim = 67}
        if ($('#livro').val() == '24') 
            { lim = 53}
        if ($('#livro').val() == '25') 
            { lim = 6}
        if ($('#livro').val() == '26') 
            { lim = 49}
        if ($('#livro').val() == '27') 
            { lim = 13}
        if ($('#livro').val() == '28') 
            { lim = 15}
        if ($('#livro').val() == '29') 
            { lim = 4}
        if ($('#livro').val() == '30') 
            { lim = 10}
        if ($('#livro').val() == '31') 
            { lim = 2}
        if ($('#livro').val() == '32') 
            { lim = 5}
        if ($('#livro').val() == '33') 
            { lim = 8}
        if ($('#livro').val() == '34') 
            { lim = 4}
        if ($('#livro').val() == '35') 
            { lim = 4}
        if ($('#livro').val() == '36') 
            { lim = 4}
        if ($('#livro').val() == '37') 
            { lim = 3}
        if ($('#livro').val() == '38') 
            { lim = 15}
        if ($('#livro').val() == '39') 
            { lim = 5}
        if ($('#livro').val() == '40') 
            { lim = 29}
        if ($('#livro').val() == '41') 
            { lim = 17}
        if ($('#livro').val() == '42') 
            { lim = 25}
        if ($('#livro').val() == '43') 
            { lim = 22}
        if ($('#livro').val() == '44') 
            { lim = 27}
        if ($('#livro').val() == '45') 
            { lim = 17}
        if ($('#livro').val() == '46') 
            { lim = 17}
        if ($('#livro').val() == '47') 
            { lim = 14}
        if ($('#livro').val() == '48') 
            { lim = 7}
        if ($('#livro').val() == '49') 
            { lim = 7}
        if ($('#livro').val() == '50') 
            { lim = 5}
        if ($('#livro').val() == '51') 
            { lim = 5}
        if ($('#livro').val() == '52') 
            { lim = 6}
        if ($('#livro').val() == '53') 
            { lim = 4}
        if ($('#livro').val() == '54') 
            { lim = 7}
        if ($('#livro').val() == '55') 
            { lim = 5}
        if ($('#livro').val() == '56') 
            { lim = 4}
        if ($('#livro').val() == '57') 
            { lim = 2}
        if ($('#livro').val() == '58') 
            { lim = 14}
        if ($('#livro').val() == '59') 
            { lim = 6}
        if ($('#livro').val() == '60') 
            { lim = 6}
        if ($('#livro').val() == '61') 
            { lim = 4}
        if ($('#livro').val() == '62') 
            { lim = 6}
        if ($('#livro').val() == '63') 
            { lim = 2}
        if ($('#livro').val() == '64') 
            { lim = 2}
        if ($('#livro').val() == '65') 
            { lim = 2}
        if ($('#livro').val() == '66') 
            { lim = 23}


        if (lim == 2) {
            setCapitulo (1);
        }


        for ($j=1; $j < lim; $j++) { 
           $('#caixa_capitulo').append('<button onclick="setCapitulo(\''+$j+'\')" value="'+$j+'">'+$j+'</button>');
       }



   }


   function setCapitulo (i) {
    $('#capitulo').val(i)
    $('#form').submit()
}







</script>











<?php


$capitulo = (isset($_POST['capitulo'])) ? $_POST['capitulo'] : 1 ;                    
$versiculo = (isset($_POST['versiculo'])) ? $_POST['versiculo'] : 1 ;           

if (empty($_POST['livro'])) {
    $livro = 'gen';
} else {
    $livro = $_POST['livro'];

    $versiculo2 = (empty($_POST['versiculo2'])) ? '' : '-'.$_POST['versiculo2'] ;   

    echo $versiculo2.'<br>';                 
    $url = 'https://wol.jw.org/pt/wol/b/r5/lp-t/nwtsty/'.$livro.'/'.$capitulo.'#study=discover';
    $conteudo = getConteudo($url);
}


function getConteudo ($url)
{

    $r = '';
    $dadosSite = file_get_contents($url);

    $var1 = explode('<li class="result">',$dadosSite);

    if (isset($var1)) {


        $conteudo =  $var1[0];
        $r .= "<input type='hidden' id='len' value='".strlen($conteudo)."'>";
        $r .= $conteudo;
    } else {
        $r .= "Nada encontrado.";

    }
    return $r;
}


?>

<div id='conteudo' ondblclick='stop()' style='    margin-left: 12px; margin-top: 50px;' class='cont'><?php echo $conteudo?> </div>
</div>
<br>
<br>
<br>
<br>
<br>


<button class="floating-button">+</button>



</body>



</html>

<script type="text/javascript">


  /*$('#btnDesabilitar').addClass(['none']);*/

  function showbooks() {

    $('#caixa_livros').removeClass(['none'])
    $('#conteudo').addClass(['none'])
    $( "#detalhe" ).removeAttr('open')
    $('#livros').removeAttr(['none'])
    $('#caixa_livros').removeClass(['none'])
  }



  function slideup() {
    console.log('foi clicado');
    $('#conteudo').addClass('slideOutUp');
    $('#btnDesabilitar').removeClass(['none']);
    $('#btnHabilitar').addClass(['none']);

  }
  function stop() {
    $('#conteudo').removeClass('slideOutUp');
    /*$('#slideOff').addClass(['none']);*/
    $('#slideOn').removeClass(['none']);
    $('#conteudo')
    .css("-webkit-animation-name", "")
    .css("animation-name", "")
    .css("-webkit-animation-duration", "0s")
    .css("animation-duration", "0s")
    .css("-webkit-animation-fill-mode", "")
    .css("animation-fill-mode", "")
    .css("@-webkit-keyframes","") 
    console.log('parar')
  }

  function hide() {
    $('#caixa').addClass(['none'])
    /*$('#conteudo').removeClass(['none'])*/
  } 
  function slide () {   
    time = ($('#len').val() /300)
    $('#conteudo')
    .css("-webkit-animation-name", "slideOutUp")
    .css("animation-name", "slideOutUp")
    .css("-webkit-animation-duration", time+"s")
    .css("animation-duration", time+"s")
    .css("-webkit-animation-fill-mode", "both")
    .css("animation-fill-mode", "both")
    .css("@-webkit-keyframes","slideOutUp") 
    $('#slideOn').addClass(['none']);
    $('#slideOff').removeClass(['none']);
  }
  function livros() {
   $('#livros').addClass(['none'])


 }

 function showVersiculos(argument) {
   $('a').css('display','block')
   $('#vOn').addClass(['none']);
   $('#vOff').removeClass(['none']);
 }

 function hideVersiculos(argument) {
   $('a').css('display','none')
   $('#vOn').removeClass(['none']);
   $('#vOff').addClass(['none']);
 }

 function showCalendario(argument) {
  window.scrollTo(0, 0);
  $('.calendario').removeClass(['none']);
  $('#cOn').addClass(['none']);
  $('#cOff').removeClass(['none']);
}

function hideCalendario(argument) {
  $('.calendario').addClass(['none']);
  $('#cOn').removeClass(['none']);
  $('#cOff').addClass(['none']);
}


function makeBlack(argument) {
  $('body').removeClass(['bodyw']);
  $('body').addClass(['body']);
  $('#mOn').removeClass(['none']);
  $('#mOff').addClass(['none']);
}

function makeWhite(argument) {
  $('body').removeClass(['body']);
  $('body').addClass(['bodyw']);
  $('#mOn').addClass(['none']);
  $('#mOff').removeClass(['none']);
}

function makeLeft(argument) {
    alert('alinhando a esquerda')
  $('cont').removeAttr('text-align');
  $('#mOn').removeClass(['none']);
  $('#mOff').addClass(['none']);
}

function makeJustify(argument) {
  $('cont').addAttr('text-align', 'justify');
  $('#aOn').removeClass(['none']);
  $('#aOff').addClass(['none']);
}

$(document).ready(function() {
  $(".floating-button").click(function() {
    $("#pontos").toggle();
    $("#.cont").toggleClass("show");
});
});

$(function() {
  console.clear();
});
</script>


