<?php
require_once "src/nusoap.php"; // Adjust the path as necessary

$client = new nusoap_client("http://localhost/nu-soap/SoapServer.php?wsdl", "wsdl");

$response = "";
if ($_POST) {
    $decada = $_POST['decada'];
    $parametros = array('decada' => $decada);
    $response = $client->call("get_peliculas", $parametros);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SOAP Client</title>
</head>
<body>
    <form action="SoapClient.php" method="post">
        Ingresar decada:
        <input type="text" name="decada" required>
        <br/>
        <input type="submit" value="Buscar">
    </form>
    <?php
    if (!empty($response)) {
        echo "<h3>Respuesta del servidor:</h3>";
        echo "<p>$response</p>";
    }
    ?>
</body>
</html>
