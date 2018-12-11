<?php
/**
 * PHP version 7.2
 * src\create_result.php
 *
 * @category Utils
 * @package  MiW\Results
 * @author   Javier Gil <franciscojavier.gil@upm.es>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es ETS de Ingeniería de Sistemas Informáticos
 */


use MiW\Results\Entity\User;
use MiW\Results\Utils;

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(
    __DIR__ . '/..',
    Utils::getEnvFileName(__DIR__ . '/..')
);
$dotenv->load();
try {
$dotenv->load();

$entityManager = Utils::getEntityManager();

if ($argc <3 || $argc >8) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich  <UserId> [<Username>] [<Email>] [<Password>] [<Enabled>] [<isAdmin>]

MARCA_FIN;
    exit(0);
}

$userId       = (int) $argv[1];


    /** @var User $user */
    $user = $entityManager
        ->getRepository(User::class)
        ->findOneBy(['id' => $userId]);
    if (null === $user) {
        echo "Usuario con Id $userId no encontrado" . PHP_EOL;
        exit(0);
    }else{
        foreach ($argv as $k => $v) {
            if($v!=="--json") {
                if ($k === 2) {
                    $user->setUsername($v);
                } else if ($k === 3) {
                    $user->setEmail($v);
                } else if ($k === 4) {
                    $user->setPassword($v);
                } else if ($k === 5) {
                    if ($v === 'true' || $v === 'false') {
                        $isEnabled = $v === 'true' ? true : false;
                        $user->setEnabled($isEnabled);
                    }
                } else if ($k === 6) {
                    $user->setIsAdmin((int)v);
                }
            }
        }
    }
    $entityManager->persist($user);
    $entityManager->flush();
    if (in_array('--json', $argv, true)) {
        echo json_encode($user, JSON_PRETTY_PRINT). PHP_EOL;
    }
    echo 'Update User with ID #' . $userId . PHP_EOL;
} catch (Exception $exception) {

    echo $exception->getMessage() . PHP_EOL;
}

