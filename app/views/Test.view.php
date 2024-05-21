<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Kata-Kata Hari ini <?php echo $test; ?></h1>
    <?php
    foreach ($users as $user) {
    ?>
        <h1>Name : <?php echo $user['name'];  ?></h1>
        <h2>email : <?php echo $user['email'];  ?></h2>
        <h3>telephone : <?php echo $user['telephone'];  ?></h3>
    <?php
    }
    ?>
</body>
</html>