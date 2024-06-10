<?php
require_once "src/nusoap.php";

$server = new soap_server();
$namespace = "http://localhost/nu-soap/SoapServer.php";
$server->configureWSDL("soapdemo", $namespace);
$server->wsdl->schemaTargetNamespace = $namespace;

function get_peliculas($decada) {
    error_log("Received decade: " . $decada);

    $movies = array(
        "1930" => array("Gone with the Wind", "You Can't Take It with You", "It Happened One Night 1930"),
        "1990" => array("Edward Scissorhands", "Men in Black", "The Truman Show 1990"),
        "2000" => array("The Dark Knight", "Donnie Darko", "Eternal Sunshine of the Spotless Mind 2000"),
        "2010" => array("Inception", "Drive", "The Avengers 2010"),
        "2020" => array("Dune", "CODA", "Tick, Tick... Boom! 2020 ")
    );

    if (isset($movies[$decada])) {
        return join(" , ", $movies[$decada]);
    } else {
        return "RESULT NOT FOUND. Current date: " . date("Y-m-d H:i:s");
    }
}

$server->register(
    "get_peliculas",
    array("decada" => "xsd:string"),
    array("return" => "xsd:string"),
    $namespace,
    false,
    "rpc",
    "encoded",
    "Get movies by decade"
);

$server->service(file_get_contents("php://input"));
?>
