--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
	`account_id` int(10) UNSIGNED NOT NULL,
	`account_name` varchar(255) NOT NULL,
	`account_passwd` varchar(255) NOT NULL,
	`account_reg_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`account_enabled` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
	`account_is_admin` bool DEFAULT FALSE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
	ADD PRIMARY KEY (`account_id`),
	ADD UNIQUE KEY `account_name` (`account_name`);

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
	MODIFY `account_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Table structure for table `account_sessions`
--

CREATE TABLE `account_sessions` (
	`session_id` varchar(255) NOT NULL,
	`account_id` int(10) UNSIGNED NOT NULL,
	`login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for table `account_sessions`
--
ALTER TABLE `account_sessions`
	ADD PRIMARY KEY (`session_id`);


INSERT INTO accounts (account_name, account_passwd, account_reg_time, account_enabled, account_is_admin) VALUES
	('GuébertPatrick', '$2y$10$.Fvh1Lo3d1uiz8G8KGpO3ONWz5BiCVnpXQWapQFsSniloq/psDISa', CURRENT_TIMESTAMP, '1', TRUE),
	('Collègue1', '$2y$10$twVgCZe8wFvmKQF7kJjQ3.drugQLj3lWZ/6DfhnSUAZ4X2LjJRHz.', CURRENT_TIMESTAMP, '1', FALSE),
	('Collègue2', '$2y$10$twVgCZe8wFvmKQF7kJjQ3.drugQLj3lWZ/6DfhnSUAZ4X2LjJRHz.', CURRENT_TIMESTAMP, '1', FALSE),
	('Collègue3', '$2y$10$twVgCZe8wFvmKQF7kJjQ3.drugQLj3lWZ/6DfhnSUAZ4X2LjJRHz.', CURRENT_TIMESTAMP, '1', FALSE);