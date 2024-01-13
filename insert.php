<?php
$host = 'localhost';
$db   = 'winkel';
$user = 'root';
$pass = 'Banaan12!';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try 
{
     $pdo = new PDO($dsn, $user, $pass, $options);

} 
catch (\PDOException $e) 
{
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $product_naam = $_POST['product_naam'];
    $prijs_per_stuk = $_POST['prijs_per_stuk'];
    $omschrijving = $_POST['omschrijving'];

    try {

        $query = "INSERT INTO producten (product_naam, prijs_per_stuk, omschrijving) VALUES (:product_naam, :prijs_per_stuk, :omschrijving)";
        $statement = $pdo->prepare($query);

        $statement->bindParam(':product_naam', $product_naam);
        $statement->bindParam(':prijs_per_stuk', $prijs_per_stuk);
        $statement->bindParam(':omschrijving', $omschrijving);

        $statement->execute();
        
    } catch (PDOException $e) {
        $error_message = "Er is een fout opgetreden. Probeer het later opnieuw. Fout: " . $e->getMessage();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form method="POST" action="">
        <label for="product_naam">product_naam</label>
        <input type="text" id="product_naam" name="product_naam" required><br>

        <label for="prijs_per_stuk">prijs_per_stuk</label>
        <input type="text" id="prijs_per_stuk" name="prijs_per_stuk" required><br>

        <label for="omschrijving">omschrijving</label>
        <input type="text" id="omschrijving" name="omschrijving" required><br>

        <input type="submit" value="sturen">
    </form>

</body>
</html>

