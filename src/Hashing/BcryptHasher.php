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

namespace Jacques\Phoenix\Hashing;

use RuntimeException;

final class BcryptHasher
{
    /**
     * Default cost (iteration count to use).
     */
    protected $cost = 10;

    /**
     * Create a new Bcrypt Hasher Instance.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->cost = $options['cost'] ?? $this->cost;
    }

    /**
     * @return int
     */
    public function getCost(): int
    {
        return $this->cost;
    }

    /**
     * Hash the password.
     *
     * @param string $password
     * @param array  $options
     *
     * @throws \RuntimeException
     *
     * @return string|null
     */
    public function hash($password, $options = []): ?string
    {
        $hash = password_hash($password, PASSWORD_BCRYPT, [
            'cost' => $options['cost'] ?? $this->cost,
        ]);

        if ($hash === false) {
            throw new RuntimeException('Bcrypt hashing is not supported.');
        }

        return $hash;
    }

    /**
     * Checks if we need to rehash the password given the hash and the
     * options provided.
     */
    public function needsRehash($hash, array $options = []): bool
    {
        return password_needs_rehash($hash, PASSWORD_BCRYPT, [
            'cost' => $options['cost'] ?? $this->cost,
        ]);
    }

    /**
     * Set the cost (iteration count) for hashing the password.
     *
     * @param int $cost Iteration count to use when hashing the password.
     *
     * @throws \RuntimeException
     */
    public function setCost(int $cost): void
    {
        if ($cost < 4 || $cost > 31) {
            new RuntimeException('Invalid cost parameter provided.');
        }

        $this->cost = $cost;
    }

    /**
     * Verify that the password matches the expected hash.
     *
     * @param string $password
     * @param string $hash
     *
     * @return bool
     */
    public function verify($password, $hash): bool
    {
        return password_verify($password, $hash);
    }
}
