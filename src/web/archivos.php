<?php
use Google\Client;
use Google\Service\Drive;
require '../../vendor/autoload.php';

$serviceAccountClient = new Client();
$serviceAccountClient->setAuthConfig('../keys/secret.json');
$serviceAccountClient->setScopes(['https://www.googleapis.com/auth/drive.file']);
$serviceAccountDriveService = new Drive($serviceAccountClient);

function listFiles($driveService) {
    $files = [];
    $pageToken = null;

    do {
        $response = $driveService->files->listFiles([
            'pageSize' => 10,
            'fields' => 'nextPageToken, files(id, name, thumbnailLink, webViewLink)',
            'pageToken' => $pageToken
        ]);

        foreach ($response->files as $file) {
            $files[] = $file;
        }

        $pageToken = $response->nextPageToken;
    } while ($pageToken != null);

    return $files;
}

$serviceAccountFiles = listFiles($serviceAccountDriveService);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="bg-gray-50 dark:bg-gray-700">
    <div class="getFiles">
        <h1>Archivos</h1>
        <ul>
            <?php
            foreach ($serviceAccountFiles as $file) {
                echo '<li>' . $file->name . '</li>';
                if (isset($file->thumbnailLink)) {
                    echo '<img src="' . $file->thumbnailLink . '" alt="' . $file->name . '">';
                }
                if (isset($file->webViewLink)) {
                    echo '<a href="' . $file->webViewLink . '">Ver</a>';
                }
            }
            ?>
        </ul>
    </div>
</body>
</html>