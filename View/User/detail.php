<?php require 'View/includes/header.php'?>

<h2><?php echo $user->getName()?></h2>
<p>Age: <?php echo $user->getAge()?></p>
<p>Email: <?php echo $user->getEmail()?></p>

<?php require 'View/includes/footer.php'?>