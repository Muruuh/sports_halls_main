# Sports_Halls

CREATE TABLE `users` (
`user_id` varchar(255) NOT NULL,
`user_email` varchar(125) DEFAULT NULL,
`user_name` varchar(125) DEFAULT NULL,
`user_created_date` datetime DEFAULT NULL,
`user_role` varchar(45) DEFAULT NULL,
`user_password` varchar(500) DEFAULT NULL,
`user_social_id` varchar(125) DEFAULT NULL,
PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci
