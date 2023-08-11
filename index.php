<?php
// This PHP script will serve your React app

// Get the requested file path
$requestPath = $_SERVER['REQUEST_URI'];

// Define the base path to your build directory
$basePath = "dist/";

// Map the requested path to the file system path
$filePath = $basePath . ltrim($requestPath, '/');

error_log($requestPath);

// Serve static files directly
if ($requestPath === "/user/login") {
    echo "Hello";
} else {
    if (file_exists($filePath) && is_file($filePath)) {
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

        // Set appropriate content type based on file extension
        $contentTypes = array(
            'js' => 'application/javascript',
            'css' => 'text/css',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'woff2' => 'font/woff2',
            'ttf' => 'font/ttf',
            'svg' => 'image/svg+xml'
            // Add more content types as needed
        );

        if (array_key_exists($fileExtension, $contentTypes)) {
            header("Content-Type: " . $contentTypes[$fileExtension]);
        }

        // Output the file content
        readfile($filePath);

    } else {
        // If the file doesn't exist, serve the index.html
        header("Content-Type: text/html");
        readfile($basePath . 'index.html');
    }
}
?>