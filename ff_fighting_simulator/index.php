<html>
<head>
<meta charset="UTF-8">
<title>Fighting Fantasy Fight Simulator</title>
<?php include_once("header.php");?>
</head>
<body>
<form>
<label>Your stamina: </label>
<input type="number" step=1 id="msta" required>
<label>Your skill: </label>
<input type="number" step=1 id="msk" required>
<label>Your luck: </label>
<input type="number" step=1 id="ml" required>
<br>
<label>Enimy stamina: </label>
<input type="number" step=1 id="esta" required>
<label>Enimy skill: </label>
<input type="number" step=1 id="esk" required>
<br>
<button id="go">Start Fighting</button><button id="go2">Test Luck</button><button id="go3">Continue Fighting</button><button id="restart">Start new Fight</button>
</form>
<table class='tab1'>
<caption><h2>Stats</h2></caption>
<thead><tr><td>My 1st dice</td><td>My 2nd dice</td><td>Enemy's 1st dice</td><td>Enemy's 2nd dice</td><td>Round Result</td><td>Fight Result</td></tr></thead>
<tbody>

</tbody>
</table>
<table class='tab2'>
<caption><h2>Errors</h2></caption>
<thead><tr><td>Messages</td></tr></thead>
<tbody>

</tbody>
</table>