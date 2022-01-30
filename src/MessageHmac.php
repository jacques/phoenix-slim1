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

namespace Jacques\Phoenix\HTTP;

final class MessageHmac
{
    /**
     * Check the signature against the provided data and the provided signature and shared key.
     *
     * @param string $message
     * @param string $key
     * @param string $signature
     *
     * @return bool
     */
    public static function checksignature(string $message, string $key, string $signature)
    {
        return hash_equals(hash_hmac('sha256', $message, $key), $signature);
    }

    /**
     * Generates a signature using the HMAC method for the provided data and
     * key.  By default we are using the sha256 hashing algorithm.
     *
     * @param array  $message Message to create the key has for.
     * @param string $key     Shared secret key used for generating the HMAC variant of the message digest.
     *
     * @return string
     */
    public static function make(string $message, string $key): string
    {
        return hash_hmac('sha256', $message, $key);
    }
}
