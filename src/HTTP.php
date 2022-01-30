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

final class HTTP
{
    /**
     * Download file.
     *
     * @param \Slim $app
     * @param string $contentType
     * @param string $filename
     * @param string $data
     *
     * @return void
     */
    public static function downloadFile($app, $contentType, $filename, $data): void
    {
        $app->contentType($contentType);
        $app->response()->header('Pragma', 'no-cache');
        $app->response()->header('Expires', '0');
        $app->response()->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $app->response()->header('Content-Transfer-Encoding', 'ascii');
        $app->response()->header('Content-Length', (string)strlen($data));
        $app->response()->body($data);
    }
}
