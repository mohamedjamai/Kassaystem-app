


/*
 TODO:
 - products (id, category_id, price, name, description, image)
    -- Foreign key naar category

 - categories (id, parent_category_id, name)

 - customers (id, email, password, salt, street, number, number_add, city, postal, country)

 - sale_order_items (tabel bestaat al)
    -- aanmaken: foreign key naar producten en
 - sale_orders
    -- aanmaken: foreign key naar customers of users

 */

DROP TABLE IF EXISTS `sale_order_items`;
CREATE TABLE `sale_order_items` (
                                    `id` int NOT NULL AUTO_INCREMENT,
                                    `sale_order_id` int NOT NULL,
                                    `product_id` int DEFAULT NULL,
                                    `product_naam` varchar(255) DEFAULT NULL,
                                  --  `description` varchar(255) DEFAULT NULL,
                                    `price` decimal(12,2) DEFAULT NULL,
                                    `quantity` int(11) DEFAULT NULL,
                                    `updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                    `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

DROP TABLE IF EXISTS `sale_orders`;
CREATE TABLE `sale_orders` (
                              `id` int NOT NULL AUTO_INCREMENT,
                              `user_id` BIGINT NOT NULL,
                              `notitie` varchar(255) DEFAULT NULL,
                              `totaal_bedrag` decimal(12,2) DEFAULT NULL,
                            --  `name` varchar(255) DEFAULT NULL,
                            --   `email` varchar(255) DEFAULT NULL,
                            --   `street` varchar(255) DEFAULT NULL,
                            --   `number` varchar(10) DEFAULT NULL,
                            --   `city` varchar(255) DEFAULT NULL,
                             -- `postal` varchar(255) DEFAULT NULL,
                             -- `country` varchar(255) DEFAULT NULL,
                             -- `is_completed` tinyint(1) DEFAULT '0',
                            --  `is_paid` tinyint(1) DEFAULT '0',
                          --    `is_shipped` tinyint(1) DEFAULT '0',
                              `updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                              `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



-- ALTER TABLE `sale_orders` ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `sale_order_items` ADD CONSTRAINT `fk_sale_order_item` FOREIGN KEY (`sale_order_id`) REFERENCES `sale_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `sale_orders` (`id`, `user_id`, `notitie`, `totaal_bedrag`, `updated_at`, `created_at`) VALUES (NULL, '6', '1 geen saus', '250', NULL, NULL);

INSERT INTO `sale_order_items` (`id`, `sale_order_id`, `product_id`, `product_naam`, `price`, `quantity`, `updated_at`, `created_at`) VALUES (NULL, '1', '1', 'Sushi rolls', '15', '1', NULL, NULL);
INSERT INTO `sale_order_items` (`id`, `sale_order_id`, `product_id`, `product_naam`, `price`, `quantity`, `updated_at`, `created_at`) VALUES (NULL, '1', '1', 'Sushboxi rolls', '45', '1', NULL, NULL);
INSERT INTO `sale_order_items` (`id`, `sale_order_id`, `product_id`, `product_naam`, `price`, `quantity`, `updated_at`, `created_at`) VALUES (NULL, '1', '1', 'Sushi sausrolls', '30', '1', NULL, NULL);


