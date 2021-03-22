<?php require 'View/includes/header.php'?>

<a href="index.php?page=save">Create user</a>

<h2>Overview</h2>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        /** @var User $user */
        foreach($users AS $user):?>
        <tr>
            <td><a href="index.php?page=detail&id=<?php echo $user->getId()?>"><?php echo $user->getName() ?></a></td>
            <td><?php echo $user->getEmail() ?></td>
            <td><?php echo $user->getAge() ?></td>
            <td>
                <a href="index.php?page=save&id=<?php echo $user->getId()?>">Edit</a>
                <a href="index.php?page=delete&id=<?php echo $user->getId()?>">Delete</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

<?php require 'View/includes/footer.php'?>