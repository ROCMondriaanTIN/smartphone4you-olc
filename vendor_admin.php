<?php

$db = new PDO("mysql:host=localhost;dbname=phone4you_olc","root", "");



$ascOrDesc = 'ASC';
$description = '';

if(isset($_POST['search'])){
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
}

if(isset($_POST['order-id'])){
    $ordering = filter_input(INPUT_POST, 'ordering', FILTER_SANITIZE_SPECIAL_CHARS);
    echo $ordering;
    if($ordering === 'ASC'){
        $ascOrDesc = 'DESC';
    } else {
        $ascOrDesc = 'ASC';
    }

}

if($description === ''){
    $query = $db->prepare("SELECT * FROM vendor ORDER BY id " . $ascOrDesc);
} else{
    $description = "%". $description . "%";
    $query = $db->prepare("SELECT * FROM vendor WHERE description LIKE :description ORDER BY id " . $ascOrDesc);
    $query->bindParam(':description', $description);
}

$query->execute();

$vendors = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SmartPhone4u Home</title>
    <link rel="stylesheet" href="css/phones.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-white fs-3" href="index_html.php">SmartPhone4u</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active fs-5 text-white" aria-current="page" href="index_html.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-secondary fs-5" href="vendor.php">Bestellen</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">inloggen</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<header>
    <div class="container-fluid py-5 "  style="background: url('img/header.png'); background-size: cover">
        <div class="row py-5"></div>
    </div>
</header>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                    <div class="mb-3">
                        <label for="inputDescription" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" id="inputDescription">
                    </div>
                    <button type="submit" name="search" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">
                            <form method="post">
                                <input type="hidden" name="ordering" value="<?=$ascOrDesc?>">
                                <button type="submit" name="order-id" value="#">#</button>
                            </form>
                        </th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">View</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    foreach ($vendors as $vendor){

                    ?>

                    <tr>
                        <th scope="row"><?=$vendor['id']?></th>
                        <td><?=$vendor['name']?></td>
                        <td><?=$vendor['description']?></td>
                        <td><a href="vendor_admin_view.php?id=<?=$vendor['id']?>">View</a></td>
                        <td><a href="vendor_admin_edit.php?id=<?=$vendor['id']?>">Edit</a></td>
                        <td><a href="vendor_admin_delete.php?id=<?=$vendor['id']?>">Delete</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <th scope="row"><a href="vendor_admin_add.php">Add</th>

                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>
<footer class="bg-dark">
    <div class="container-fluid text-white">
        <div class="row pb-3">
            <div class="col-md-6 mt-4 text-center">
                <ul class="list-unstyled">
                    <li class="list-group-item fw-bold">Contactgegevens</li>
                    <li class="list-group-item">SmartPhone4u</li>
                    <li class="list-group-item">Phoenixstraat 1</li>
                    <li class="list-group-item">1111AA Delft</li>
                    <li class="list-group-item">smartphones4u@gmail.com</li>
                    <li class="list-group-item">06- 12345678</li>
                </ul>
            </div>
            <div class="col-md-6 mt-4 text-center">
                <ul class="list-unstyled">
                    <li class="list-group-item fw-bold">Openingstijden</li>
                    <li class="list-group-item">Maandag: Gesloten</li>
                    <li class="list-group-item">Dinsdag: 11:00 - 22:00</li>
                    <li class="list-group-item">Woensdag: 11:00 - 22:00</li>
                    <li class="list-group-item">Donderdag: 11:00 - 22:00</li>
                    <li class="list-group-item">Vrijdag: 15:00 - 22:00</li>
                    <li class="list-group-item">Zaterdag: 15:00 - 22:00</li>
                    <li class="list-group-item">Zondag: Gesloten</li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
