<?php

use Service\Container;

require __DIR__ . '/bootstrap.php';

$container = new Container($configuration);

$armyLoader = $container->getArmyLoader();
$armys = $armyLoader->getArmys();

$army1Id = isset($_POST['army1_id']) ? $_POST['army1_id'] : null;
$army1Quantity = isset($_POST['army1_quantity']) ? $_POST['army1_quantity'] : 1;
$army2Id = isset($_POST['army2_id']) ? $_POST['army2_id'] : null;
$army2Quantity = isset($_POST['army2_quantity']) ? $_POST['army2_quantity'] : 1;

if (!$army1Id || !$army2Id) {
    header('Location: /index.php?error=missing_data');
    die;
}

$army1 = $armyLoader->findOneById($army1Id);
$army2 = $armyLoader->findOneById($army2Id);

if (!$army1 || !$army2) {
    header('Location: /index.php?error=bad_armies');
    die;
}

$battleManager = $container->getBattleManager();

if ($army1Quantity <= 0 || $army2Quantity <= 0) {
    header('Location: /index.php?error=bad_quantities');
    die;
}

$battleType = $_POST['battle_type'];
$battleResult = $battleManager->battle($army1, $army1Quantity, $army2, $army2Quantity, $battleType);
?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POO Battle of Nottingham</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet' type='text/css'>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
             <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
             <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
           <![endif]-->
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>POO Battle of Nottingham</h1>
        </div>
        <div>
            <h2 class="text-center">The Match:</h2>
            <p class="text-center">
                <br>
                <?php echo $army1Quantity; ?> <?php echo $army1; ?><?php echo $army1Quantity > 1 ? 's' : ''; ?>
                VS.
                <?php echo $army2Quantity; ?> <?php echo $army2; ?><?php echo $army2Quantity > 1 ? 's' : ''; ?>
            </p>
        </div>
        <div class="result-box center-block">
            <h3 class="text-center">
                Winner:
                <?php if ($battleResult->isThereAWinner()) : ?>
                    <?php echo $battleResult['winningArmy']->getName(); ?>
                <?php else : ?>
                    Nobody
                <?php endif; ?>
            </h3>
            <p class="text-center">
                <?php if (!$battleResult->isThereAWinner()) : ?>
                    Both armies are destroyed each other in an epic battle to the end.
                <?php else : ?>
                    The <?php echo $battleResult->getWinningArmy()->getName(); ?>
                    <?php if ($battleResult->isMagicPowersUsed()) : ?>
                        used its Magics Powers for a stunning victory!
                    <?php else : ?>
                        have destroyed the <?php echo $battleResult->getLosingArmy()->getName() ?>
                    <?php endif; ?>
                <?php endif; ?>
            </p>
            <h3>Strength</h3>
            <dl class="dl-horizontal">
                <dt><?php echo $army1->getName(); ?></dt>
                <dd><?php echo $army1->getStrength(); ?></dd>
                <dt><?php echo $army2->getName(); ?></dt>
                <dd><?php echo $army2->getStrength(); ?></dd>
            </dl>
        </div>
        <a href="/index.php">
            <p class="text-center"><i class="fa fa-undo"></i> Battle again</p>
        </a>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </div>
</body>

</html>