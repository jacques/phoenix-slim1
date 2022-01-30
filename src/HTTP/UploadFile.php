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

final class UploadFile
{
    /**
     * Check if we have files uploaded as part of the HTTP request.
     *
     * @var bool
     */
    public static function hasUploadedFiles(): bool
    {
        if (sizeof($_FILES['files']['name']) > 0 && $_FILES['files']['name']['0'] !== '') {
            return true;
        }

        return false;
    }
}
