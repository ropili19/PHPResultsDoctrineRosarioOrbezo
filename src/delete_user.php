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

use MiW\Results\Entity\Result;
use MiW\Results\Entity\User;
use MiW\Results\Utils;

require __DIR__ . '/../vendor/autoload.php';

// Carga las variables de entorno
$dotenv = new \Dotenv\Dotenv(
    __DIR__ . '/..',
    Utils::getEnvFileName(__DIR__ . '/..')
);
$dotenv->load();

$entityManager = Utils::getEntityManager();

if ($argc <2 || $argc >3) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <UserId> 

MARCA_FIN;
    exit(0);
}


$userId       = (int) $argv[1];

try {
    /** @var User $user */
    $user = $entityManager
        ->getRepository(User::class)
        ->findOneBy(['id' => $userId]);
    if (null === $user) {
        echo "Usuario con Id $userId no encontrado" . PHP_EOL;
        exit(0);
    }else{
        $entityManager->remove($user);
        $entityManager->flush();
    }
    if (in_array('--json', $argv, true)) {
        echo json_encode($user, JSON_PRETTY_PRINT). PHP_EOL;
    }
    echo 'Delete el User with ID #' . $userId . PHP_EOL;
} catch (Exception $exception) {

    echo $exception->getMessage() . PHP_EOL;
}

