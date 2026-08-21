<?php
/**
 * Automated Image Downloader for Mistry App
 * Use this script to download all category and service images into public/uploads
 */

// Source Base URL jahan se images download karni hain (e.g. https://your-source-site.com)
$sourceBaseUrl = isset($_GET['source']) ? rtrim($_GET['source'], '/') : 'https://nakaeworks.com';

$images = [
    // Category Icons
    '/uploads/81d04b15-76dc-4e1e-bc38-e9d609dba55f.png',
    '/uploads/c6cfcfa1-86ae-42eb-9f01-2863f612df9d.png',
    '/uploads/4025a0af-aa83-40f9-ad7e-9669a5e5de31.png',
    '/uploads/cf921d82-6ce5-4d5b-8583-cd9c6aae2e93.png',
    '/uploads/fb30c8c9-ca97-4726-acb8-0ac607084192.png',
    '/uploads/1ec79783-1535-48d9-b262-6ac755dfb7ce.png',
    '/uploads/d700f9fc-1f1d-4052-9497-8fca7de1651a.png',
    '/uploads/175accac-e4fa-48cf-9f5a-c5e7975b3c60.png',
    '/uploads/dca56e22-2d08-41a5-8986-9a7d84ba06e7.png',
    '/uploads/288ae102-5592-4f49-be2b-2c604e32ff5f.png',
    '/uploads/59644ccd-354d-43c8-a746-e4b891cb5e24.png',

    // Services Thumbnails
    '/uploads/6fb226d3-49e4-4643-a721-1633c68d6c85.webp',
    '/uploads/53b00189-538d-4e03-8c75-8e4d2ea15d0b.webp',
    '/uploads/4aee0500-da50-4d6d-89cb-0398536ff723.jpg',
    '/uploads/4f1e3a4c-c234-4677-bead-89034943efc1.jpg',
    '/uploads/4cacd74b-6a43-449d-a8ae-428a5817b859.jpg',
    '/uploads/2ebf62b5-fed0-41f5-b9cb-8dc1f878028f.jpg',
    '/uploads/a6f61efe-38c2-4faf-bbef-58231cd75c59.jpg',
    '/uploads/227576aa-e79f-4f06-8f8d-05683820e1f3.jpg',
    '/uploads/524d5e0a-097d-4263-b50a-0744557c1ec1.jpg',
    '/uploads/9e4bd4f3-7ca7-4f5b-9a23-fe05622c80d4.webp',
    '/uploads/059650a5-d3d3-41ec-ad0d-3806f2c51289.webp',
    '/uploads/db37dfa6-e159-4d57-a1de-064a264994a9.webp',
    '/uploads/4aced99c-83a6-440b-922f-0b6a52769d30.webp',
    '/uploads/5884363e-fd0b-44ab-8646-a79bed7230b1.webp',
    '/uploads/491d580a-8f9c-4bdd-83f4-5a4ee1453d90.webp',
    '/uploads/91d9c64c-e05b-427a-9111-074657a4c21e.webp',
    '/uploads/a5124374-fe02-4b22-b70b-28c6bdbac029.webp',
    '/uploads/cb1406fb-3f4f-4b1a-8653-19de65862a65.webp',
    '/uploads/b5766f23-4d71-49e0-a099-054c2ff5c75b.webp',
    '/uploads/32539407-1d20-4e70-9f11-d2d5a58186b4.webp',
    '/uploads/07c8ad7a-c11c-49b5-b2e8-02e7828fabdc.webp',
    '/uploads/517370f9-8707-4696-87b4-8095130bf7b0.webp',
    '/uploads/3ca58b56-63c0-4908-8121-7cdc41b90c15.jpeg',
    '/uploads/6bc6046e-a9fe-4ac7-8d48-dec9bceb13fd.webp',
    '/uploads/656f0873-0365-49b7-b75c-08072e1abded.webp',
    '/uploads/74a5d5f8-255e-47c3-83b1-570b7e5d7ac6.jpeg',
    '/uploads/14593356-b51a-44f9-8041-b19523425811.jpeg',
    '/uploads/8a947737-b9ae-4e7b-97ae-d0d0bb968ad4.jpeg',
    '/uploads/156cc469-b263-4610-beb2-267d33c9d6e1.png',
    '/uploads/d4ae1d32-5d95-48a4-8d77-a7d75be2ee7a.jpeg',
    '/uploads/254a4354-0c89-4483-8db6-cd7daf2e74d3.jpeg',
    '/uploads/77c1c155-0afd-4bf8-a5f3-1501b0a32180.png',
    '/uploads/b8e1f305-e070-434c-b70b-6866a45e28c3.jpg',
    '/uploads/70f77e0d-66da-49e2-8d7d-f2cef2fd6793.png',
    '/uploads/4d4b115c-7115-4582-b69b-68caf809e7c7.png',
    '/uploads/c54bdc39-7361-468a-9972-8dcec847e263.jpeg',
    '/uploads/d3333c82-a086-40bf-a6a9-2beee51083d6.jpeg',
    '/uploads/00936db4-9417-421f-81dd-ab7933742d4b.png',
    '/uploads/3fc5c35b-ed6e-48f7-ac39-f0a6e41684e5.png',
    '/uploads/dac04fb3-47a4-48da-bdf8-bdc5e633f7f6.jpeg',
    '/uploads/eeab34a8-1be2-4dae-b15e-0dea038a454d.jpeg',
    '/uploads/0dd9b3c5-3aec-4a51-b9b9-de6a75acb0e0.jpeg',
    '/uploads/3e90fbc4-e2dc-4a0c-92a0-135555389a2c.png',
    '/uploads/614ef2ce-57d4-4d9c-a080-4b2cdb23a989.jpeg',
    '/uploads/1382fcc2-50f1-468b-b841-d0522d077040.jpeg',
    '/uploads/80c45024-fb95-4d45-812b-40ef7885385a.jpeg',
    '/uploads/deb51533-0974-467b-81bc-5ba3a76da423.jpeg',
    '/uploads/8b0d45bb-9c8a-4ad6-9a2f-01c64004cd4e.jpeg',
    '/uploads/1a19c33f-9a7a-42f2-86bc-27903c9f5b39.jpeg',
    '/uploads/f9aa177b-05f4-4a6f-9358-254269810345.jpeg',
    '/uploads/7d0742c0-8ca5-465c-a11b-fc153c07ad01.webp',
    '/uploads/f598af4e-9259-4eae-9c81-8a2537863dcf.jpeg',
    '/uploads/5163f9c1-3965-40be-b61d-38f09f689b77.jpg',
    '/uploads/cfb73d96-6132-4a58-a0e5-149cf477fdd6.jpg',
    '/uploads/b34a2799-2f20-4cb3-bd31-4019e6d3cb0c.jpeg',
    '/uploads/36395910-96c2-4e0c-8a8b-c364b46f255b.jpeg',
    '/uploads/d67431f4-ee08-45e4-a152-40d3ba48e847.jpeg',
    '/uploads/5f351174-4754-409a-b035-7b35ef9b3284.jpeg',
    '/uploads/2478845e-c344-4f31-90de-43815c83bccc.webp',
    '/uploads/a3ce51e4-8797-48bf-926c-97aba270276a.webp',
    '/uploads/49ea2ef5-9b53-48c8-9c6b-68a103cd3a43.jpeg',
];

$targetDir = __DIR__ . '/uploads';
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

echo "<h2>Downloading Images from: " . htmlspecialchars($sourceBaseUrl) . "</h2><ul>";

$downloaded = 0;
$failed = 0;

foreach ($images as $imgPath) {
    $cleanPath = ltrim($imgPath, '/');
    $fullSourceUrl = $sourceBaseUrl . '/' . $cleanPath;
    $filename = basename($imgPath);
    $localFilePath = $targetDir . '/' . $filename;

    if (file_exists($localFilePath) && filesize($localFilePath) > 0) {
        echo "<li style='color:green;'>Already exists: $filename</li>";
        $downloaded++;
        continue;
    }

    $ch = curl_init($fullSourceUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200 && !empty($data)) {
        file_put_contents($localFilePath, $data);
        echo "<li style='color:green;'>✅ Downloaded: $filename (" . strlen($data) . " bytes)</li>";
        $downloaded++;
    } else {
        echo "<li style='color:red;'>❌ Failed ($httpCode): $fullSourceUrl</li>";
        $failed++;
    }
}

echo "</ul>";
echo "<h3>Result: $downloaded downloaded/already existed, $failed failed.</h3>";
