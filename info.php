<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Info</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1a1a1a;
            color: #f0f0f0;
            display: flex;
            flex-direction: column;
            justify-content: center;
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
    function convertToBytes($size) {
        $unit = strtoupper(substr($size, -1));
        $size = (int)$size;
        switch ($unit) {
            case 'G': return $size * 1024 * 1024 * 1024;
            case 'M': return $size * 1024 * 1024;
            case 'K': return $size * 1024;
            default: return $size;
        }
    }

    function formatSize($size) {
        if ($size >= 1024 * 1024 * 1024) return floor($size / (1024 * 1024 * 1024)) . ' GB';
        if ($size >= 1024 * 1024) return floor($size / (1024 * 1024)) . ' MB';
        return floor($size / 1024) . ' KB';
    }

    function displayInfo($label, $value) {
        echo "<div class='info'>{$label}: <span class='bold'>{$value}</span></div>";
    }

    displayInfo('PHP Version', PHP_VERSION);

    if (function_exists('ioncube_loader_version')) {
        displayInfo('Ioncube Version', ioncube_loader_version());
    } else {
        displayInfo('Ioncube Loader', 'Not installed');
    }

    if (extension_loaded('sourceguardian')) {
        displayInfo('SourceGuardian Version', phpversion('sourceguardian'));
    } else {
        displayInfo('SourceGuardian', 'Not installed');
    }

    $memoryLimit = formatSize(convertToBytes(ini_get('memory_limit')));
    $uploadMaxFilesize = formatSize(convertToBytes(ini_get('upload_max_filesize')));
    $maxExecutionTime = ini_get('max_execution_time') . ' seconds';

    displayInfo('PHP Memory Limit', $memoryLimit);
    displayInfo('PHP Max Execution Time', $maxExecutionTime);
    displayInfo('PHP Max Upload Filesize', $uploadMaxFilesize);
    ?>
</div>
<div class="footer">&copy; <?php echo date("Y"); ?> <a href="https://example.com" target="_blank" rel="nofollow">Your Host</a></div>
</body>
</html>
