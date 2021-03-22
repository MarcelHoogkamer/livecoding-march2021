<?php require 'View/includes/header.php'?>

<h3><?php echo $title ?></h3>

<form method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $user->getName()?>">

    <br />

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $user->getEmail()?>">

    <br />

    <label for="age">Age:</label>
    <input type="number" id="age" name="age" value="<?php echo $user->getAge()?>">

    <br />

    <input type="submit" value="Save">
</form>

<?php require 'View/includes/footer.php'?>