<!DOCTYPE html>
<html lang="en-US" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title>PHP Info</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex, nofollow, noarchive, nosnippet">
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #1a1a1a;
                color: #f0f0f0;
                display: flex;
                flex-direction: column;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .container {
                background-color: #2c2c2c;
                padding: 30px;
                border-radius: 15px;
                width: 80%;
                max-width: 500px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                text-align: center;
                margin-top: 30px;
            }
            .header {
                font-size: 1.8em;
                color: #fff;
                font-weight: bold;
                margin-bottom: 20px;
            }
            .info {
                font-size: 1.2em;
                margin: 10px 0;
                padding: 10px;
                background-color: #444;
                border-radius: 8px;
                transition: background-color 0.3s ease;
            }
            .info:hover {
                background-color: #555;
            }
            .bold {
                font-weight: bold;
            }
            .footer {
                font-size: 0.9em;
                color: #bbb;
                margin-top: 20px;
                padding-bottom: 20px;
            }
            .footer a {
                color: #f9f9f9;
                text-decoration: none;
            }
            .footer a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <div class="header">PHP Host Information</div>
            <?php
            /**
             * Converts a size string (e.g., '128M') to bytes.
             */
            function convertToBytes($size) {
                $unit = strtoupper(substr($size, -1));
                $size = (int)$size;
                $multipliers = ['K' => 1024, 'M' => 1024 ** 2, 'G' => 1024 ** 3];
                return isset($multipliers[$unit]) ? $size * $multipliers[$unit] : $size;
            }
            
            /**
             * Formats a size in bytes to a human-readable format.
             */
            function formatSize($size) {
                if ($size >= 1024 ** 3) return floor($size / (1024 ** 3)) . ' GB';
                if ($size >= 1024 ** 2) return floor($size / (1024 ** 2)) . ' MB';
                return floor($size / 1024) . ' KB';
            }
            
            /**
             * Displays a labeled information box.
             */
            function displayInfo($label, $value) {
                echo "<div class='info'>{$label}: <span class='bold'>{$value}</span></div>";
            }
            
            /**
             * Checks if an extension is loaded and returns its version or a default message.
             */
            function getExtensionInfo($extensionName, $notInstalledMessage = 'Not installed') {
                if (extension_loaded($extensionName)) {
                    return phpversion($extensionName) ?: 'Enabled';
                }
                return $notInstalledMessage;
            }
            
            displayInfo('PHP Version', PHP_VERSION);
            displayInfo('Ioncube Loader', function_exists('ioncube_loader_version') ? ioncube_loader_version() : 'Not installed');
            displayInfo('SourceGuardian', getExtensionInfo('sourceguardian'));
            
            $configurations = [
                'PHP Memory Limit' => formatSize(convertToBytes(ini_get('memory_limit'))),
                'PHP Max Execution Time' => ini_get('max_execution_time') . ' seconds',
                'PHP Max Upload Filesize' => formatSize(convertToBytes(ini_get('upload_max_filesize'))),
                'PHP Post Max Size' => formatSize(convertToBytes(ini_get('post_max_size'))),
                'PHP Max Input Vars' => ini_get('max_input_vars'),
                'PHP Max Input Time' => ini_get('max_input_time') . ' seconds',
                'PHP Timezone' => ini_get('date.timezone') ?: 'Not set',
                'PHP Loaded Extensions' => implode(', ', get_loaded_extensions())
            ];
            
            foreach ($configurations as $label => $value) {
                displayInfo($label, $value);
            }
            
            $extensions = [
                'GD Library' => 'gd',
                'cURL' => 'curl',
                'mbstring' => 'mbstring',
                'OpenSSL' => 'openssl',
                'PDO' => 'pdo',
                'PDO MySQL' => 'pdo_mysql',
                'Xdebug' => 'xdebug'
            ];
            
            foreach ($extensions as $name => $ext) {
                displayInfo("{$name} Extension", getExtensionInfo($ext));
            }
            ?>
        </div>
        <div class="footer">&copy; <?php echo date("Y"); ?> <a href="https://github.com/basemax" target="_blank" rel="nofollow">Max Base</a></div>
    </body>
</html>
