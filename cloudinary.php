<?php

// Cloudinary configuration without Composer
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/cloudinary.php';

// The $cloudinary object is now available from the CloudinaryHelper class
// Usage examples:
// $result = $cloudinary->upload('/path/to/file.jpg');
// $url = $cloudinary->getSecureUrl('public_id');
// $cloudinary->delete('public_id');
