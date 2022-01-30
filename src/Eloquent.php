<?php declare(strict_types=1);
/**
 *         ##### ##      /
 *      ######  /###   #/                                       #
 *     /#   /  /  ###  ##                                      ###
 *    /    /  /    ### ##                                       #
 *        /  /      ## ##
 *       ## ##      ## ##  /##      /###     /##  ###  /###   ###     /##    ###
 *       ## ##      ## ## / ###    / ###  / / ###  ###/ #### / ###   / ###  #### /
 *     /### ##      /  ##/   ###  /   ###/ /   ###  ##   ###/   ##      ### /###/
 *    / ### ##     /   ##     ## ##    ## ##    ### ##    ##    ##       ##/  ##
 *       ## ######/    ##     ## ##    ## ########  ##    ##    ##        /##
 *       ## ######     ##     ## ##    ## #######   ##    ##    ##       / ###
 *       ## ##         ##     ## ##    ## ##        ##    ##    ##      /   ###
 *       ## ##         ##     ## ##    ## ####    / ##    ##    ##     /     ###
 *       ## ##         ##     ##  ######   ######/  ###   ###   ### / /       ### /
 *  ##   ## ##          ##    ##   ####     #####    ###   ###   ##/ /         ##/
 * ###   #  /                 /
 *  ###    /                 /
 *   #####/                 /
 *     ###                 /
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2018-2022 Jacques Marneweck.  All rights strictly reserved.
 * @package   Phoenix
 */

namespace Jacques\Phoenix;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Facade;
use Monolog\Monolog;

class Eloquent
{
    /**
     * @var \Illuminate\Database\Capsule\Manager|null
     * @psalm-suppress UndefinedClass
     */
    public static \Illuminate\Database\Capsule\Manager $capsule;

    /**
     * Boot up Eloquent outside of Laravel.
     *
     * @param array           $params
     * @param \Monolog\Logger $logger Monolog logger instance to use to log database queries
     *
     * @return void
     * @psalm-suppress UndefinedClass
     */
    public static function boot(array $params = [], \Monolog\Logger $logger)
    {
        if (!\array_key_exists('driver', $params)) {
            throw new \Exception('Driver for connecting to the database is missing.');
        }

        if (!\array_key_exists('username', $params)) {
            throw new \Exception('Username for connecting to the database is missing.');
        }

        if (!\array_key_exists('password', $params)) {
            throw new \Exception('Password for connecting to the database is missing.');
        }

        if (!\array_key_exists('database', $params)) {
            throw new \Exception('Database name for connecting to is missing.');
        }

        $capsule = new Capsule;
        $capsule->addConnection($params);
        $capsule->setEventDispatcher(new Dispatcher(new Container));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        Facade::setFacadeApplication(new Container);

        $capsule->getConnection()->listen(function ($query) use ($logger) {
            $sql = $query->sql;
            $bindings = $query->bindings ?? [];

            foreach ($bindings as $binding) {
                $sql = \preg_replace("#\?#", $binding, $sql, 1);
            }

            $logger->info(
                \sprintf(
                    'time: %s sql: %s',
                    $query->time,
                    $sql
                )
            );
        });

        self::$capsule = $capsule;
    }
}
