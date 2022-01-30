<?php declare(strict_types=1);
/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2014-2022 Jacques Marneweck.  All rights strictly reserved.
 */

namespace Jacques\Phoenix;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;

final class UUID
{
    /**
     * Returns a UUID in version 4 format.
     *
     * @return string
     */
    public static function uuidv4(): string
    {
        return RamseyUuid::uuid4()->toString();
    }
}
