-- ==========================================================
-- SQL Insert / Update for Categories Table
-- Generated for Mistry App
-- ==========================================================

INSERT INTO `categories` (`id`, `category_name`, `name`, `category_icon`, `category_image`, `image`, `in_home`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'AC Service & Repair', 'AC Service & Repair', '/uploads/81d04b15-76dc-4e1e-bc38-e9d609dba55f.png', '/uploads/81d04b15-76dc-4e1e-bc38-e9d609dba55f.png', '/uploads/81d04b15-76dc-4e1e-bc38-e9d609dba55f.png', 1, 1, 1, NOW(), NOW()),
(2, 'Fan', 'Fan', '/uploads/c6cfcfa1-86ae-42eb-9f01-2863f612df9d.png', '/uploads/c6cfcfa1-86ae-42eb-9f01-2863f612df9d.png', '/uploads/c6cfcfa1-86ae-42eb-9f01-2863f612df9d.png', 1, 1, 2, NOW(), NOW()),
(3, 'Electrician', 'Electrician', '/uploads/4025a0af-aa83-40f9-ad7e-9669a5e5de31.png', '/uploads/4025a0af-aa83-40f9-ad7e-9669a5e5de31.png', '/uploads/4025a0af-aa83-40f9-ad7e-9669a5e5de31.png', 1, 1, 3, NOW(), NOW()),
(4, 'CCTV Camera', 'CCTV Camera', '/uploads/cf921d82-6ce5-4d5b-8583-cd9c6aae2e93.png', '/uploads/cf921d82-6ce5-4d5b-8583-cd9c6aae2e93.png', '/uploads/cf921d82-6ce5-4d5b-8583-cd9c6aae2e93.png', 1, 1, 4, NOW(), NOW()),
(5, 'Water Purifier', 'Water Purifier', '/uploads/fb30c8c9-ca97-4726-acb8-0ac607084192.png', '/uploads/fb30c8c9-ca97-4726-acb8-0ac607084192.png', '/uploads/fb30c8c9-ca97-4726-acb8-0ac607084192.png', 1, 1, 5, NOW(), NOW()),
(6, 'Inverter/Stabilizer', 'Inverter/Stabilizer', '/uploads/1ec79783-1535-48d9-b262-6ac755dfb7ce.png', '/uploads/1ec79783-1535-48d9-b262-6ac755dfb7ce.png', '/uploads/1ec79783-1535-48d9-b262-6ac755dfb7ce.png', 1, 1, 6, NOW(), NOW()),
(7, 'Geyser', 'Geyser', '/uploads/d700f9fc-1f1d-4052-9497-8fca7de1651a.png', '/uploads/d700f9fc-1f1d-4052-9497-8fca7de1651a.png', '/uploads/d700f9fc-1f1d-4052-9497-8fca7de1651a.png', 1, 1, 7, NOW(), NOW()),
(8, 'Washing Machine', 'Washing Machine', '/uploads/175accac-e4fa-48cf-9f5a-c5e7975b3c60.png', '/uploads/175accac-e4fa-48cf-9f5a-c5e7975b3c60.png', '/uploads/175accac-e4fa-48cf-9f5a-c5e7975b3c60.png', 1, 1, 8, NOW(), NOW()),
(9, 'Switch Board/Socket', 'Switch Board/Socket', '/uploads/dca56e22-2d08-41a5-8986-9a7d84ba06e7.png', '/uploads/dca56e22-2d08-41a5-8986-9a7d84ba06e7.png', '/uploads/dca56e22-2d08-41a5-8986-9a7d84ba06e7.png', 1, 1, 9, NOW(), NOW()),
(10, 'Refrigerator', 'Refrigerator', '/uploads/288ae102-5592-4f49-be2b-2c604e32ff5f.png', '/uploads/288ae102-5592-4f49-be2b-2c604e32ff5f.png', '/uploads/288ae102-5592-4f49-be2b-2c604e32ff5f.png', 1, 1, 10, NOW(), NOW()),
(13, 'Lights Installation', 'Lights Installation', '/uploads/59644ccd-354d-43c8-a746-e4b891cb5e24.png', '/uploads/59644ccd-354d-43c8-a746-e4b891cb5e24.png', '/uploads/59644ccd-354d-43c8-a746-e4b891cb5e24.png', 1, 1, 11, NOW(), NOW())
ON DUPLICATE KEY UPDATE
`category_name` = VALUES(`category_name`),
`name` = VALUES(`name`),
`category_icon` = VALUES(`category_icon`),
`category_image` = VALUES(`category_image`),
`image` = VALUES(`image`),
`in_home` = VALUES(`in_home`),
`status` = VALUES(`status`),
`sort_order` = VALUES(`sort_order`),
`updated_at` = NOW();
