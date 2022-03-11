<?php
session_start();
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);

echo "<head>";
echo "<meta name='viewport' content='width=device-width'>";
echo "<title>Home of the gamebooks web engine!</title>";
//configura estilo da pagina
echo "<link rel='stylesheet' media='screen and (max-width:480px)' href='../gamebooks_css/css/1.css' type='text/css' />";
echo "<link rel='stylesheet' media='screen and (min-width:481px) and (max-width:4800px)' href='../gamebooks_css/css/2.css' type='text/css' />";
echo"<script type='text/javascript' src='../fontsize.js'></script>";
echo "</head>";
echo "<body>";
?>
<!--google translate script-->
<script>
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en',
    autoDisplay: false,
    floatPosition: google.translate.TranslateElement.FloatPosition.TOP_LEFT
  });
}
</script><script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript" src="../jquery-1.3.2.min.js"></script>
<?php include_once("../analytics_google.php"); ?>
<div>
<center>
<h3>From the Shadows&copy</h3><h3> Editor: Victor Cheng </h3><h3>CONTRIBUTORS: Sylas, Cobb Webb, Al sander, Khaxzan, Odo_ital, Archmage</h3>
</center> 
</div>

<?php
echo "<div id='header'>";
echo "<img src='imagens/character.jpg'>";
//ver sessao com o nome  escolhido
echo "Name: <b>{$_SESSION['nome'] } </b> ";
//resto do conteudo
echo "<form name='pagina' action='index2.php'>";
echo "Pag. nº<input type='text' size=4 name='pag' maxlength='3'>";
echo "<input type='submit' value='Go To'><b>(Put the page number you want to go and hit Go To or Enter)</b>";
echo "</form>";

echo "</div>";
echo "<div id='menu'>";
echo "<b>Menu</b>";
echo "<li><a href='../index.php'>New</a></li>";
echo "<li><a href='saveload/load.php'>Load</a></li>";
echo "<li><a target='_blank' href='saveload/save.php'>Save</a></li>";
echo "<li><a target='_blank' href='../rater/index.php'>Rate this Adventure!</a></li>";
echo "<li><a target='_blank' href='../embed.htm'>Add Sound</a></li>";
echo "<li><a target='_blank' href='reviews.php'>Reviews</a></li>";
echo "</div>";
echo "<div id='content'>";
echo "<h3>Reviews</h3>";
echo "<img style='float:left' src='imagens/bn.jpg' widht=60 height=60>";
?>
     <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'ffgamebooksadmin'; // required: replace example with your forum shortname
        var disqus_identifier = 'ftshadows';
        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    
<?php
echo "</div>";//rodape
echo "<div id='rodape'>";
echo "<form name='pontuacao'>";
echo "Skill:<input type='text' size=2 name='pericia' value={$_SESSION['pericia']}>";
echo "Stamina:<input type='text' size=2 name='forca'value={$_SESSION['forca']}>";
echo "Luck:<input type='text' size=2 name='sorte' value={$_SESSION['sorte']}>";
echo "Gold:<input type='text' size=2 name='ouro' value={$_SESSION['ouro']}>";
echo "Provisions:<input type='text' size=1 name='provisoes' value={$_SESSION['provisoes']}>";
echo "<p align=right>items:<input type='text' size=8 name='item1' value={$_SESSION['item1']}><input type='text' size=8 name='item2' value={$_SESSION['item2']}> ";
echo "<input type='text' size=8 name='item3' value={$_SESSION['item3']}><input type='text' size=8 name='item4' value={$_SESSION['item4']}><input type='text' size=8 name='item5' value={$_SESSION['item5']}> ";
echo "<input type='text' size=8 name='item6' value={$_SESSION['item6']}><input type='text' size=8 name='item7' value={$_SESSION['item7']}><input type='text' size=8 name='item8' value={$_SESSION['item8']}> ";
echo "<input type='text' size=8 name='item9' value={$_SESSION['item9']}><input type='text' size=8 name='item10' value={$_SESSION['item10']}><input type='text' size=8 name='item11' value={$_SESSION['item11']}> ";
echo "<input type='text' size=8 name='item12' value={$_SESSION['item12']}><input type='text' size=8 name='item13' value={$_SESSION['item13']}><input type='text' size=8 name='item14' value={$_SESSION['item14']}> ";
echo "<input type='text' size=8 name='item15' value={$_SESSION['item15']}><input type='text' size=8 name='item16' value={$_SESSION['item16']}><input type='text' size=8 name='item17' value={$_SESSION['item17']}>";
echo "<input type='text' size=8 name='item18' value={$_SESSION['item18']}><input type='text' size=8 name='item19' value={$_SESSION['item19']}><input type='text' size=8 name='item20' value={$_SESSION['item20']}>";
echo "<input type='text' size=8 name='item21' value={$_SESSION['item21']}><input type='text' size=8 name='item22' value={$_SESSION['item22']}><input type='text' size=8 name='item23' value={$_SESSION['item23']}>";
echo "<input type='text' size=8 name='item24' value={$_SESSION['item24']}><input type='text' size=8 name='item25' value={$_SESSION['item25']}><input type='text' size=8 name='item26' value={$_SESSION['item26']}>";
echo "<input type='text' size=8 name='item27' value={$_SESSION['item27']}><input type='text' size=8 name='item28' value={$_SESSION['item28']}>";
echo "</form>";
echo "</div>";
?>
<center>
<p><img src="../images/1.gif"></p>
<a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/3.0/80x15.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/">Creative Commons Attribution-NonCommercial-NoDerivs 3.0 Unported License</a>.
</center>
