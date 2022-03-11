<?php
include("fastread.html");
 if(isset($_GET[pag])&&ctype_digit($_GET["pag"])){
//buscar os valores passados nas forms
$pericia=$_SESSION[pericia];$forca=$_SESSION[forca];$sorte=$_SESSION[sorte];
$ouro=$_SESSION[ouro];$provisoes=$_SESSION[provisoes];
settype($pericia,"int");settype($forca,"int");settype($sorte,"int");
settype($ouro,"int");settype($provisoes,"int");
//conectar á base de dados
class MyDB extends SQLite3{function __construct(){$this->open('ffgamebooks_quest-bd.db3',SQLITE3_OPEN_READONLY);}}
$db = new MyDB();
if(ctype_digit($_GET["pag"])){$_SESSION["pag"]=$_GET['pag'];
$stm =$db->prepare("SELECT * FROM quest WHERE incremento=:pag");
$stm->bindValue(':pag',$_GET['pag']);
$resultado=$stm->execute();
if($resultado==FALSE){die("Error:");}}
else{echo "<h5>---No page---</h5>";}
//utilizar os dados da BaseDados
if(isset($resultado)){while($ver=$resultado->fetchArray()){echo "<h5 align='center'>".$ver['incremento']."</h5>";
//se existir imagem na BD
if ($ver['imagem']!=""){echo "<img align='right' src='{$ver[imagem]}' widht=100 height=100>";}
echo "<div id='sayt'>{$ver['textos']}</div>";
//se ouver nome de inimigos
if ($ver['inimigos']!=""){echo "<form name='luta' action='{$_SERVER[PHP_SELF]}' ><p><b>".$ver[inimigos]."</b></p>Skill:<input type='text' name='iskill' value='{$ver[pericia]}' readonly='readonly'>";
echo "Stamina:<input type='text' name='istamina' value='{$ver[forca]}' readonly='readonly'>";
echo "<input type='hidden' name='pag' value={$_GET[pag]}>";
echo "<input type='submit' value='Fight'>";
echo "</form>";}}$resultado->finalize();}$db->close();
if ($_SESSION["forca"]<9&&$_SESSION["forca"]>0&&$_SESSION["provisoes"]>0){echo "<h5>you decide to rest and drink a stamina potion</h5>";
echo "<script type='text/javascript'>provisoes=Number(document.pontuacao.provisoes.value);";
echo "forca=Number(document.pontuacao.forca.value);document.pontuacao.forca.value=forca+4;";
echo "document.pontuacao.provisoes.value=provisoes-1;</script>";
$_SESSION["provisoes"]-=1;$_SESSION["forca"]+=4;}
$_SESSION["pag"]=$_GET[pag];}
//se ouver luta
if(isset($_GET["iskill"])&&ctype_digit($_GET["iskill"])&&isset($_GET["istamina"])&&ctype_digit($_GET["istamina"])){echo "<img align='left' src='imagens/luta.gif'>";
//passagem dos dados do inimigo para outras pags
$_SESSION["istamina"]=$_GET["istamina"];$_SESSION["iskill"]=$_GET["iskill"];
//contador de nº de batalhas e hits consecutivos
$count=0;$cqhits=0;$cdanos=0;
//fazer feitiço de fogo
if ($_SESSION["item1"]=="fireball"){$i=0;while($i<1){$i++;
if(rand(2,12)<$_SESSION["sorte"]){$_GET["istamina"]-=4;echo "<h5>$i You hit the creature with a fireball</h5>";}else{echo "<h5>$i The fireball missed</h5>";}}}
//if ($_GET["istamina"]<=0){echo"<h3> You Win!</h3>";}
//matar os lich knights com armas especiais
if ($_GET["pag"]=="110"){$_GET["istamina"]*=6;if($_SESSION["item2"]=="warhammer"){$_GET["istamina"]-=20;echo "<h5>Two of the lich knights fall to the ground</h5>";}
elseif($_SESSION["item8"]=="silver_ring"){$_GET["istamina"]-=10;echo"<h5>One of the lich knights fall to the ground</h5>";}}
//deduzir forca do Demon knight
if($_GET["pag"]=="30"){if($_SESSION["item20"]=="silver_bell"){$_GET["iskill"]-=2;}}
//ciclo de luta
include("pluta.php");
//proteccao do chainmail
if($_SESSION["armour"]=="chainmail"&&$_SESSION["forca"]>0){if ($cdanos>3) {echo "<h5>You have been protected by the chainmail</h5>";$_SESSION["forca"]+=3;}}
//proteccao do platemail
if($_SESSION["armour"]=="platemail"&&$_SESSION["forca"]>0){if ($cdanos>2) {echo "<h5>You have been protected by the platemail</h5>";$_SESSION["forca"]+=4;}}}
?>