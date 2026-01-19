<?php

/**
 * Cloudinary Configuration without Composer
 * Uses REST API for uploads
 */

class CloudinaryHelper
{
    private $cloud_name;
    private $api_key;
    private $api_secret;

    public function __construct()
    {
        $this->cloud_name = getenv('CLOUDINARY_CLOUD_NAME') ?: 'ddpacsja9';
        $this->api_key = getenv('CLOUDINARY_API_KEY') ?: '652238455688288';
        $this->api_secret = getenv('CLOUDINARY_API_SECRET') ?: 'qwPi67zYjoTbm-6vobSSaOQfgPY';
    }

    /**
     * Upload file to Cloudinary
     */
    public function upload($file_path, $options = [])
    {
        $url = "https://api.cloudinary.com/v1_1/{$this->cloud_name}/upload";

        $post_data = [
            'file' => new CURLFile($file_path),
            'api_key' => $this->api_key,
            'timestamp' => time(),
        ];

        // Add additional options
        if (!empty($options)) {
            $post_data = array_merge($post_data, $options);
        }

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $post_data,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code === 200) {
            return json_decode($response, true);
        }

        return [
            'error' => 'Upload failed',
            'details' => $response
        ];
    }

    /**
     * Get secure URL for resource
     */
    public function getSecureUrl($public_id)
    {
        return "https://res.cloudinary.com/{$this->cloud_name}/image/upload/{$public_id}";
    }

    /**
     * Delete resource from Cloudinary
     */
    public function delete($public_id)
    {
        $url = "https://api.cloudinary.com/v1_1/{$this->cloud_name}/resources/image";

        $post_data = [
            'public_ids[]' => $public_id,
            'api_key' => $this->api_key,
            'timestamp' => time(),
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($post_data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
        ]);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return json_decode($response, true);
    }
}

// Create singleton instance
$cloudinary = new CloudinaryHelper();
