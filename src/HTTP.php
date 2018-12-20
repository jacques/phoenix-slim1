<?php declare(strict_types=1);
/**
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2018 Jacques Marneweck.  All rights strictly reserved.
 */

namespace Jacques\Phoenix;

class HTTP
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
