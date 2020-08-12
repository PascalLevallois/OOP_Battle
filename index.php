<?php

use Service\BattleManager;
use Service\Container;


require __DIR__ . '/bootstrap.php';

$container = new Container($configuration);

$armysLoader = $container->getArmyLoader();
$armys = $armysLoader->getArmys();

$battleTypes = BattleManager::getAllBattleTypesWithDescriptions();

$errorMessage = '';
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'missing_data':
            $errorMessage = 'Don\'t forget to select some army to battle!';
            break;
        case 'bad_armies':
            $errorMessage = 'You\'re trying to fight with an army that\'s unknown to the country?';
            break;
        case 'bad_quantities':
            $errorMessage = 'You pick strange numbers of armies to battle - try again.';
            break;
        default:
            $errorMessage = 'The magic power don\'t work. Try again.';
    }
}
?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OOP Battle of Nottingham</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
             <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
             <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
           <![endif]-->
</head>

<?php if ($errorMessage) : ?>
    <div>
        <?php echo $errorMessage; ?>
    </div>
<?php endif; ?>

<body>
    <div class="container">
        <div class="page-header">
            <h1>OOP Battle of Nottingham</h1>
        </div>
        <table class="table table-hover">
            <caption><i class="fa fa-battery"></i> These armies are ready for their next War</caption>
            <thead>
                <tr>
                    <th>Army</th>
                    <th>Weapon Power</th>
                    <th>Magic Factor</th>
                    <th>Strength</th>
                    <th>Type</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($armys as $army) : ?>
                    <tr>
                        <td><?php echo $army->getName(); ?></td>
                        <td><?php echo $army->getWeaponPower(); ?></td>
                        <td><?php echo $army->getMagicFactor(); ?></td>
                        <td><?php echo $army->getStrength(); ?></td>
                        <td><?php echo $army->getType(); ?></td>
                        <td>
                            <?php if ($army->isFunctional()) : ?>
                                <i class="fa fa-sun-o"></i>
                            <?php else : ?>
                                <i class="fa fa-cloud"></i>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="battle-box center-block border">
            <div>
                <form method="POST" action="/battleResult.php">
                    <h2 class="text-center">The War</h2>
                    <input class="center-block form-control text-field" type="text" name="army1_quantity" placeholder="Enter Number of Armies" />
                    <select class="center-block form-control btn drp-dwn-width btn-default dropdown-toggle" name="army1_id">
                        <option value="">Choose an Army</option>
                        <?php foreach ($armys as $army) : ?>
                            <?php if ($army->isFunctional()) : ?>
                                <option value="<?php echo $army->getId(); ?>"><?php echo $army->getNameAndSpecif(); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <br>
                    <p class="text-center">AGAINST</p>
                    <br>
                    <input class="center-block form-control text-field" type="text" name="army2_quantity" placeholder="Enter Number of Armies" />
                    <select class="center-block form-control btn drp-dwn-width btn-default dropdown-toggle" name="army2_id">
                        <option value="">Choose an Army</option>
                        <?php foreach ($armys as $army) : ?>
                            <?php if ($army->isFunctional()) : ?>
                                <option value="<?php echo $army->getId(); ?>"><?php echo $army->getNameAndSpecif(); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                    <br>

                    <div class="text-center">
                        <label for="battle_type">Battle Type</label>
                        <select name="battle_type" id="battle_type" class="form-control drp-dwn-width center-block">
                            <?php foreach ($battleTypes as $battleType => $typeText) : ?>
                                <option value="<?php echo $battleType ?>"><?php echo $typeText; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <br />

                    <button class="btn btn-md btn-danger center-block" type="submit">Battle!</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>