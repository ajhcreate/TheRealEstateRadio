CREATE TABLE IF NOT EXISTS `#__eb_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `layout` varchar(50) DEFAULT NULL,
  `description` text,
  `ordering` int(11) DEFAULT NULL,
  `published` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) CHARACTER SET `utf8`;
CREATE TABLE IF NOT EXISTS `#__eb_configs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `config_key` varchar(100) DEFAULT NULL,
  `config_value` text,
  PRIMARY KEY (`id`)
) CHARACTER SET `utf8`;
DROP TABLE IF EXISTS `#__eb_countries`  ;
CREATE TABLE IF NOT EXISTS `#__eb_countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_id` int(11) NOT NULL DEFAULT '1',
  `name` varchar(64) DEFAULT NULL,
  `country_3_code` char(3) DEFAULT NULL,
  `country_2_code` char(2) DEFAULT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`country_id`),
  KEY `idx_country_name` (`name`)
) CHARACTER SET `utf8`;
INSERT INTO `#__eb_countries` (`country_id`, `zone_id`, `name`, `country_3_code`, `country_2_code`, `published`) VALUES
(1, 1, 'Afghanistan', 'AFG', 'AF', 1),
(2, 1, 'Albania', 'ALB', 'AL', 1),
(3, 1, 'Algeria', 'DZA', 'DZ', 1),
(4, 1, 'American Samoa', 'ASM', 'AS', 1),
(5, 1, 'Andorra', 'AND', 'AD', 1),
(6, 1, 'Angola', 'AGO', 'AO', 1),
(7, 1, 'Anguilla', 'AIA', 'AI', 1),
(8, 1, 'Antarctica', 'ATA', 'AQ', 1),
(9, 1, 'Antigua and Barbuda', 'ATG', 'AG', 1),
(10, 1, 'Argentina', 'ARG', 'AR', 1),
(11, 1, 'Armenia', 'ARM', 'AM', 1),
(12, 1, 'Aruba', 'ABW', 'AW', 1),
(13, 1, 'Australia', 'AUS', 'AU', 1),
(14, 1, 'Austria', 'AUT', 'AT', 1),
(15, 1, 'Azerbaijan', 'AZE', 'AZ', 1),
(16, 1, 'Bahamas', 'BHS', 'BS', 1),
(17, 1, 'Bahrain', 'BHR', 'BH', 1),
(18, 1, 'Bangladesh', 'BGD', 'BD', 1),
(19, 1, 'Barbados', 'BRB', 'BB', 1),
(20, 1, 'Belarus', 'BLR', 'BY', 1),
(21, 1, 'Belgium', 'BEL', 'BE', 1),
(22, 1, 'Belize', 'BLZ', 'BZ', 1),
(23, 1, 'Benin', 'BEN', 'BJ', 1),
(24, 1, 'Bermuda', 'BMU', 'BM', 1),
(25, 1, 'Bhutan', 'BTN', 'BT', 1),
(26, 1, 'Bolivia', 'BOL', 'BO', 1),
(27, 1, 'Bosnia and Herzegowina', 'BIH', 'BA', 1),
(28, 1, 'Botswana', 'BWA', 'BW', 1),
(29, 1, 'Bouvet Island', 'BVT', 'BV', 1),
(30, 1, 'Brazil', 'BRA', 'BR', 1),
(31, 1, 'British Indian Ocean Territory', 'IOT', 'IO', 1),
(32, 1, 'Brunei Darussalam', 'BRN', 'BN', 1),
(33, 1, 'Bulgaria', 'BGR', 'BG', 1),
(34, 1, 'Burkina Faso', 'BFA', 'BF', 1),
(35, 1, 'Burundi', 'BDI', 'BI', 1),
(36, 1, 'Cambodia', 'KHM', 'KH', 1),
(37, 1, 'Cameroon', 'CMR', 'CM', 1),
(38, 1, 'Canada', 'CAN', 'CA', 1),
(39, 1, 'Cape Verde', 'CPV', 'CV', 1),
(40, 1, 'Cayman Islands', 'CYM', 'KY', 1),
(41, 1, 'Central African Republic', 'CAF', 'CF', 1),
(42, 1, 'Chad', 'TCD', 'TD', 1),
(43, 1, 'Chile', 'CHL', 'CL', 1),
(44, 1, 'China', 'CHN', 'CN', 1),
(45, 1, 'Christmas Island', 'CXR', 'CX', 1),
(46, 1, 'Cocos (Keeling) Islands', 'CCK', 'CC', 1),
(47, 1, 'Colombia', 'COL', 'CO', 1),
(48, 1, 'Comoros', 'COM', 'KM', 1),
(49, 1, 'Congo', 'COG', 'CG', 1),
(50, 1, 'Cook Islands', 'COK', 'CK', 1),
(51, 1, 'Costa Rica', 'CRI', 'CR', 1),
(52, 1, 'Cote D''Ivoire', 'CIV', 'CI', 1),
(53, 1, 'Croatia', 'HRV', 'HR', 1),
(54, 1, 'Cuba', 'CUB', 'CU', 1),
(55, 1, 'Cyprus', 'CYP', 'CY', 1),
(56, 1, 'Czech Republic', 'CZE', 'CZ', 1),
(57, 1, 'Denmark', 'DNK', 'DK', 1),
(58, 1, 'Djibouti', 'DJI', 'DJ', 1),
(59, 1, 'Dominica', 'DMA', 'DM', 1),
(60, 1, 'Dominican Republic', 'DOM', 'DO', 1),
(61, 1, 'East Timor', 'TMP', 'TP', 1),
(62, 1, 'Ecuador', 'ECU', 'EC', 1),
(63, 1, 'Egypt', 'EGY', 'EG', 1),
(64, 1, 'El Salvador', 'SLV', 'SV', 1),
(65, 1, 'Equatorial Guinea', 'GNQ', 'GQ', 1),
(66, 1, 'Eritrea', 'ERI', 'ER', 1),
(67, 1, 'Estonia', 'EST', 'EE', 1),
(68, 1, 'Ethiopia', 'ETH', 'ET', 1),
(69, 1, 'Falkland Islands (Malvinas)', 'FLK', 'FK', 1),
(70, 1, 'Faroe Islands', 'FRO', 'FO', 1),
(71, 1, 'Fiji', 'FJI', 'FJ', 1),
(72, 1, 'Finland', 'FIN', 'FI', 1),
(73, 1, 'France', 'FRA', 'FR', 1),
(74, 1, 'France, Metropolitan', 'FXX', 'FX', 1),
(75, 1, 'French Guiana', 'GUF', 'GF', 1),
(76, 1, 'French Polynesia', 'PYF', 'PF', 1),
(77, 1, 'French Southern Territories', 'ATF', 'TF', 1),
(78, 1, 'Gabon', 'GAB', 'GA', 1),
(79, 1, 'Gambia', 'GMB', 'GM', 1),
(80, 1, 'Georgia', 'GEO', 'GE', 1),
(81, 1, 'Germany', 'DEU', 'DE', 1),
(82, 1, 'Ghana', 'GHA', 'GH', 1),
(83, 1, 'Gibraltar', 'GIB', 'GI', 1),
(84, 1, 'Greece', 'GRC', 'GR', 1),
(85, 1, 'Greenland', 'GRL', 'GL', 1),
(86, 1, 'Grenada', 'GRD', 'GD', 1),
(87, 1, 'Guadeloupe', 'GLP', 'GP', 1),
(88, 1, 'Guam', 'GUM', 'GU', 1),
(89, 1, 'Guatemala', 'GTM', 'GT', 1),
(90, 1, 'Guinea', 'GIN', 'GN', 1),
(91, 1, 'Guinea-bissau', 'GNB', 'GW', 1),
(92, 1, 'Guyana', 'GUY', 'GY', 1),
(93, 1, 'Haiti', 'HTI', 'HT', 1),
(94, 1, 'Heard and Mc Donald Islands', 'HMD', 'HM', 1),
(95, 1, 'Honduras', 'HND', 'HN', 1),
(96, 1, 'Hong Kong', 'HKG', 'HK', 1),
(97, 1, 'Hungary', 'HUN', 'HU', 1),
(98, 1, 'Iceland', 'ISL', 'IS', 1),
(99, 1, 'India', 'IND', 'IN', 1),
(100, 1, 'Indonesia', 'IDN', 'ID', 1),
(101, 1, 'Iran (Islamic Republic of)', 'IRN', 'IR', 1),
(102, 1, 'Iraq', 'IRQ', 'IQ', 1),
(103, 1, 'Ireland', 'IRL', 'IE', 1),
(104, 1, 'Israel', 'ISR', 'IL', 1),
(105, 1, 'Italy', 'ITA', 'IT', 1),
(106, 1, 'Jamaica', 'JAM', 'JM', 1),
(107, 1, 'Japan', 'JPN', 'JP', 1),
(108, 1, 'Jordan', 'JOR', 'JO', 1),
(109, 1, 'Kazakhstan', 'KAZ', 'KZ', 1),
(110, 1, 'Kenya', 'KEN', 'KE', 1),
(111, 1, 'Kiribati', 'KIR', 'KI', 1),
(112, 1, 'Korea, Democratic People''s Republic of', 'PRK', 'KP', 1),
(113, 1, 'Korea, Republic of', 'KOR', 'KR', 1),
(114, 1, 'Kuwait', 'KWT', 'KW', 1),
(115, 1, 'Kyrgyzstan', 'KGZ', 'KG', 1),
(116, 1, 'Lao People''s Democratic Republic', 'LAO', 'LA', 1),
(117, 1, 'Latvia', 'LVA', 'LV', 1),
(118, 1, 'Lebanon', 'LBN', 'LB', 1),
(119, 1, 'Lesotho', 'LSO', 'LS', 1),
(120, 1, 'Liberia', 'LBR', 'LR', 1),
(121, 1, 'Libyan Arab Jamahiriya', 'LBY', 'LY', 1),
(122, 1, 'Liechtenstein', 'LIE', 'LI', 1),
(123, 1, 'Lithuania', 'LTU', 'LT', 1),
(124, 1, 'Luxembourg', 'LUX', 'LU', 1),
(125, 1, 'Macau', 'MAC', 'MO', 1),
(126, 1, 'Macedonia, The Former Yugoslav Republic of', 'MKD', 'MK', 1),
(127, 1, 'Madagascar', 'MDG', 'MG', 1),
(128, 1, 'Malawi', 'MWI', 'MW', 1),
(129, 1, 'Malaysia', 'MYS', 'MY', 1),
(130, 1, 'Maldives', 'MDV', 'MV', 1),
(131, 1, 'Mali', 'MLI', 'ML', 1),
(132, 1, 'Malta', 'MLT', 'MT', 1),
(133, 1, 'Marshall Islands', 'MHL', 'MH', 1),
(134, 1, 'Martinique', 'MTQ', 'MQ', 1),
(135, 1, 'Mauritania', 'MRT', 'MR', 1),
(136, 1, 'Mauritius', 'MUS', 'MU', 1),
(137, 1, 'Mayotte', 'MYT', 'YT', 1),
(138, 1, 'Mexico', 'MEX', 'MX', 1),
(139, 1, 'Micronesia, Federated States of', 'FSM', 'FM', 1),
(140, 1, 'Moldova, Republic of', 'MDA', 'MD', 1),
(141, 1, 'Monaco', 'MCO', 'MC', 1),
(142, 1, 'Mongolia', 'MNG', 'MN', 1),
(143, 1, 'Montserrat', 'MSR', 'MS', 1),
(144, 1, 'Morocco', 'MAR', 'MA', 1),
(145, 1, 'Mozambique', 'MOZ', 'MZ', 1),
(146, 1, 'Myanmar', 'MMR', 'MM', 1),
(147, 1, 'Namibia', 'NAM', 'NA', 1),
(148, 1, 'Nauru', 'NRU', 'NR', 1),
(149, 1, 'Nepal', 'NPL', 'NP', 1),
(150, 1, 'Netherlands', 'NLD', 'NL', 1),
(151, 1, 'Netherlands Antilles', 'ANT', 'AN', 1),
(152, 1, 'New Caledonia', 'NCL', 'NC', 1),
(153, 1, 'New Zealand', 'NZL', 'NZ', 1),
(154, 1, 'Nicaragua', 'NIC', 'NI', 1),
(155, 1, 'Niger', 'NER', 'NE', 1),
(156, 1, 'Nigeria', 'NGA', 'NG', 1),
(157, 1, 'Niue', 'NIU', 'NU', 1),
(158, 1, 'Norfolk Island', 'NFK', 'NF', 1),
(159, 1, 'Northern Mariana Islands', 'MNP', 'MP', 1),
(160, 1, 'Norway', 'NOR', 'NO', 1),
(161, 1, 'Oman', 'OMN', 'OM', 1),
(162, 1, 'Pakistan', 'PAK', 'PK', 1),
(163, 1, 'Palau', 'PLW', 'PW', 1),
(164, 1, 'Panama', 'PAN', 'PA', 1),
(165, 1, 'Papua New Guinea', 'PNG', 'PG', 1),
(166, 1, 'Paraguay', 'PRY', 'PY', 1),
(167, 1, 'Peru', 'PER', 'PE', 1),
(168, 1, 'Philippines', 'PHL', 'PH', 1),
(169, 1, 'Pitcairn', 'PCN', 'PN', 1),
(170, 1, 'Poland', 'POL', 'PL', 1),
(171, 1, 'Portugal', 'PRT', 'PT', 1),
(172, 1, 'Puerto Rico', 'PRI', 'PR', 1),
(173, 1, 'Qatar', 'QAT', 'QA', 1),
(174, 1, 'Reunion', 'REU', 'RE', 1),
(175, 1, 'Romania', 'ROM', 'RO', 1),
(176, 1, 'Russian Federation', 'RUS', 'RU', 1),
(177, 1, 'Rwanda', 'RWA', 'RW', 1),
(178, 1, 'Saint Kitts and Nevis', 'KNA', 'KN', 1),
(179, 1, 'Saint Lucia', 'LCA', 'LC', 1),
(180, 1, 'Saint Vincent and the Grenadines', 'VCT', 'VC', 1),
(181, 1, 'Samoa', 'WSM', 'WS', 1),
(182, 1, 'San Marino', 'SMR', 'SM', 1),
(183, 1, 'Sao Tome and Principe', 'STP', 'ST', 1),
(184, 1, 'Saudi Arabia', 'SAU', 'SA', 1),
(185, 1, 'Senegal', 'SEN', 'SN', 1),
(186, 1, 'Seychelles', 'SYC', 'SC', 1),
(187, 1, 'Sierra Leone', 'SLE', 'SL', 1),
(188, 1, 'Singapore', 'SGP', 'SG', 1),
(189, 1, 'Slovakia (Slovak Republic)', 'SVK', 'SK', 1),
(190, 1, 'Slovenia', 'SVN', 'SI', 1),
(191, 1, 'Solomon Islands', 'SLB', 'SB', 1),
(192, 1, 'Somalia', 'SOM', 'SO', 1),
(193, 1, 'South Africa', 'ZAF', 'ZA', 1),
(194, 1, 'South Georgia and the South Sandwich Islands', 'SGS', 'GS', 1),
(195, 1, 'Spain', 'ESP', 'ES', 1),
(196, 1, 'Sri Lanka', 'LKA', 'LK', 1),
(197, 1, 'St. Helena', 'SHN', 'SH', 1),
(198, 1, 'St. Pierre and Miquelon', 'SPM', 'PM', 1),
(199, 1, 'Sudan', 'SDN', 'SD', 1),
(200, 1, 'Suriname', 'SUR', 'SR', 1),
(201, 1, 'Svalbard and Jan Mayen Islands', 'SJM', 'SJ', 1),
(202, 1, 'Swaziland', 'SWZ', 'SZ', 1),
(203, 1, 'Sweden', 'SWE', 'SE', 1),
(204, 1, 'Switzerland', 'CHE', 'CH', 1),
(205, 1, 'Syrian Arab Republic', 'SYR', 'SY', 1),
(206, 1, 'Taiwan', 'TWN', 'TW', 1),
(207, 1, 'Tajikistan', 'TJK', 'TJ', 1),
(208, 1, 'Tanzania, United Republic of', 'TZA', 'TZ', 1),
(209, 1, 'Thailand', 'THA', 'TH', 1),
(210, 1, 'Togo', 'TGO', 'TG', 1),
(211, 1, 'Tokelau', 'TKL', 'TK', 1),
(212, 1, 'Tonga', 'TON', 'TO', 1),
(213, 1, 'Trinidad and Tobago', 'TTO', 'TT', 1),
(214, 1, 'Tunisia', 'TUN', 'TN', 1),
(215, 1, 'Turkey', 'TUR', 'TR', 1),
(216, 1, 'Turkmenistan', 'TKM', 'TM', 1),
(217, 1, 'Turks and Caicos Islands', 'TCA', 'TC', 1),
(218, 1, 'Tuvalu', 'TUV', 'TV', 1),
(219, 1, 'Uganda', 'UGA', 'UG', 1),
(220, 1, 'Ukraine', 'UKR', 'UA', 1),
(221, 1, 'United Arab Emirates', 'ARE', 'AE', 1),
(222, 1, 'United Kingdom', 'GBR', 'GB', 1),
(223, 1, 'United States', 'USA', 'US', 1),
(224, 1, 'United States Minor Outlying Islands', 'UMI', 'UM', 1),
(225, 1, 'Uruguay', 'URY', 'UY', 1),
(226, 1, 'Uzbekistan', 'UZB', 'UZ', 1),
(227, 1, 'Vanuatu', 'VUT', 'VU', 1),
(228, 1, 'Vatican City State (Holy See)', 'VAT', 'VA', 1),
(229, 1, 'Venezuela', 'VEN', 'VE', 1),
(230, 1, 'Viet Nam', 'VNM', 'VN', 1),
(231, 1, 'Virgin Islands (British)', 'VGB', 'VG', 1),
(232, 1, 'Virgin Islands (U.S.)', 'VIR', 'VI', 1),
(233, 1, 'Wallis and Futuna Islands', 'WLF', 'WF', 1),
(234, 1, 'Western Sahara', 'ESH', 'EH', 1),
(235, 1, 'Yemen', 'YEM', 'YE', 1),
(236, 1, 'Serbia', 'SRB', 'RS', 1),
(237, 1, 'The Democratic Republic of Congo', 'DRC', 'DC', 1),
(238, 1, 'Zambia', 'ZMB', 'ZM', 1),
(239, 1, 'Zimbabwe', 'ZWE', 'ZW', 1),
(240, 1, 'East Timor', 'XET', 'XE', 1),
(241, 1, 'Jersey', 'XJE', 'XJ', 1),
(242, 1, 'St. Barthelemy', 'XSB', 'XB', 1),
(243, 1, 'St. Eustatius', 'XSE', 'XU', 1),
(244, 1, 'Canary Islands', 'XCA', 'XC', 1),
(245, 1, 'Montenegro', 'MNE', 'ME', 1);
DROP TABLE IF EXISTS `#__eb_currencies`;
CREATE TABLE IF NOT EXISTS `#__eb_currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_code` varchar(10) DEFAULT NULL,
  `currency_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) CHARACTER SET `utf8`;
INSERT INTO `#__eb_currencies` (`id`, `currency_code`, `currency_name`) VALUES
(1, 'CAD', 'Canadian Dollars'),
(2, 'EUR', 'Euros'),
(3, 'GBP', 'Pounds Sterling'),
(4, 'USD', 'U.S. Dollars'),
(5, 'JPY', 'Japanese Yen'),
(6, 'AUD', 'Australian Dollars'),
(7, 'NZD', 'New Zealand Dollars'),
(8, 'CHF', 'Swiss Francs'),
(9, 'HKD', 'Hong Kong Dollars'),
(10, 'SGD', 'Singapore Dollars'),
(11, 'SEK', 'Swedish Kronor'),
(12, 'DKK', 'Danish Kroner'),
(13, 'PLN', 'Polish Zloty'),
(14, 'NOK', 'Norwegian Kroner'),
(15, 'HUF', 'Hungarian Forint'),
(16, 'CZK', 'Czech Koruna'),
(17, 'ILS', 'Israeli Shekel'),
(18, 'BRL', 'Brazilian Real'),
(19, 'MYR', 'Malaysian Ringgit'),
(20, 'MXN', 'Mexican Peso'),
(21, 'PHP', 'Philippine Peso'),
(22, 'TWD', 'Taiwan New Dollar'),
(23, 'THB', 'Thai Baht'),
(24, 'RUB', 'Russian Rubles');
CREATE TABLE IF NOT EXISTS `#__eb_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `location_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `event_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `event_date` datetime DEFAULT NULL,
  `event_end_date` datetime DEFAULT NULL,
  `short_description` mediumtext,
  `description` text,
  `access` tinyint(3) unsigned DEFAULT NULL,
  `registration_access` tinyint(3) unsigned DEFAULT NULL,
  `individual_price` decimal(10,2) DEFAULT NULL,
  `event_capacity` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT '0',
  `cut_off_date` datetime DEFAULT NULL,
  `registration_type` tinyint(3) unsigned DEFAULT NULL,
  `max_group_number` int(11) DEFAULT NULL,
  `discount_type` int(11) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT '0.00',
  `early_bird_discount_type` tinyint(3) unsigned DEFAULT NULL,
  `early_bird_discount_date` datetime DEFAULT NULL,
  `early_bird_discount_amount` decimal(10,2) DEFAULT NULL,
  `enable_cancel_registration` tinyint(3) unsigned DEFAULT NULL,
  `cancel_before_date` datetime DEFAULT NULL,
  `enable_auto_reminder` tinyint(3) unsigned DEFAULT NULL,
  `remind_before_x_days` tinyint(3) unsigned DEFAULT NULL,
  `recurring_type` tinyint(3) unsigned DEFAULT NULL,
  `recurring_frequency` int(11) DEFAULT NULL,
  `weekdays` varchar(50) DEFAULT NULL,
  `monthdays` varchar(50) DEFAULT NULL,
  `recurring_end_date` datetime DEFAULT NULL,
  `recurring_occurrencies` int(11) DEFAULT NULL,
  `paypal_email` varchar(255) DEFAULT NULL,
  `notification_emails` varchar(255) DEFAULT NULL,
  `user_email_body` text,
  `user_email_body_offline` text,
  `thanks_message` text,
  `thanks_message_offline` text,
  `params` text,
  `ordering` int(11) DEFAULT NULL,
  `published` int(11) DEFAULT NULL,
  `custom_fields` text,
  PRIMARY KEY (`id`),
  KEY `jos_eb_events_FKIndex1` (`category_id`),
  KEY `jos_eb_events_FKIndex2` (`location_id`)
) CHARACTER SET `utf8`;
CREATE TABLE IF NOT EXISTS `#__eb_event_group_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `registrant_number` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `#__eb_event_prices_FKIndex1` (`event_id`)
) CHARACTER SET `utf8`;
CREATE TABLE IF NOT EXISTS `#__eb_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `field_type` int(11) DEFAULT NULL,
  `required` tinyint(3) unsigned DEFAULT NULL,
  `values` text,
  `default_values` text,
  `fee_field` tinyint(3) unsigned DEFAULT NULL,
  `fee_values` text,
  `fee_formula` varchar(255) DEFAULT NULL,
  `display_in` tinyint(3) unsigned DEFAULT NULL,
  `rows` tinyint(3) unsigned DEFAULT NULL,
  `cols` tinyint(3) unsigned DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `css_class` varchar(50) DEFAULT NULL,
  `field_mapping` varchar(100) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `published` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `#__eb_fields_FKIndex1` (`field_type`)
) CHARACTER SET `utf8`;
DROP TABLE IF EXISTS `#__eb_field_types` ;
CREATE TABLE IF NOT EXISTS `#__eb_field_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `is_core` tinyint(3) unsigned DEFAULT '1',
  `class` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `#__eb_field_types` (`id`, `name`, `is_core`, `class`) VALUES
(1, 'Textbox', 1, NULL),
(2, 'Textarea', 1, NULL),
(3, 'Dropdown', 1, NULL),
(4, 'MultiSelect', 1, NULL),
(5, 'Checkbox List', 1, NULL),
(6, 'Radio List', 1, NULL),
(7, 'Date Time', 1, NULL),
(8, 'Heading', 1, NULL),
(9, 'Message', 1, NULL);
CREATE TABLE IF NOT EXISTS `#__eb_field_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registrant_id` int(11) DEFAULT NULL,
  `field_id` int(11) DEFAULT NULL,
  `field_value` text,
  PRIMARY KEY (`id`)
) CHARACTER SET `utf8`;
CREATE TABLE IF NOT EXISTS `#__eb_field_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) CHARACTER SET `utf8`;
CREATE TABLE IF NOT EXISTS `#__eb_field_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) CHARACTER SET `utf8`;
CREATE TABLE IF NOT EXISTS `#__eb_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `lat` decimal(10,6) DEFAULT NULL,
  `long` decimal(10,6) DEFAULT NULL,
  `published` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) CHARACTER SET `utf8`;
CREATE TABLE IF NOT EXISTS `#__eb_registrants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `organization` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `zip` varchar(15) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `number_registrants` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `transaction_id` varchar(50) DEFAULT NULL,
  `comment` text,
  `published` tinyint(3) unsigned DEFAULT NULL,
  `cart_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `jos_eb_registrants_FKIndex1` (`event_id`)
) CHARACTER SET `utf8`;
CREATE TABLE IF NOT EXISTS `#__eb_payment_plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `creation_date` varchar(50) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `author_email` varchar(50) DEFAULT NULL,
  `author_url` varchar(50) DEFAULT NULL,
  `version` varchar(20) DEFAULT NULL,
  `description` text,
  `params` text,
  `ordering` int(11) DEFAULT NULL,
  `published` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) CHARACTER SET `utf8`;
CREATE TABLE IF NOT EXISTS `#__eb_coupons` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(20) NULL,
  `coupon_type` TINYINT UNSIGNED NULL,
  `discount` DECIMAL(10,2) NULL,
  `event_id` int(11) NOT NULL DEFAULT '0',
  `times` int(11) NOT NULL DEFAULT '0',
  `used` int(11) NOT NULL DEFAULT '0',
  `valid_from` DATE NULL,
  `valid_to` DATE NULL,
  `published` TINYINT UNSIGNED NULL,
  PRIMARY KEY(`id`)
) CHARACTER SET `utf8`;
CREATE TABLE IF NOT EXISTS `#__eb_coupon_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) CHARACTER SET `utf8`;
CREATE TABLE IF NOT EXISTS `#__eb_event_categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `event_id` INT NULL,
  `category_id` INT NULL,
  PRIMARY KEY(`id`),
  INDEX `#__eb_event_categories_FKIndex1`(`event_id`),
  INDEX `#__eb_event_categories_FKIndex2`(`category_id`)
) CHARACTER SET `utf8`;
DROP TABLE IF EXISTS `#__eb_states` ;
CREATE TABLE IF NOT EXISTS `#__eb_states` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL DEFAULT '1',
  `state_name` varchar(64) DEFAULT NULL,
  `state_3_code` char(3) DEFAULT NULL,
  `state_2_code` char(2) DEFAULT NULL,
  PRIMARY KEY (`state_id`),
  UNIQUE KEY `state_3_code` (`country_id`,`state_3_code`),
  UNIQUE KEY `state_2_code` (`country_id`,`state_2_code`),
  KEY `idx_country_id` (`country_id`)
) CHARACTER SET `utf8`;
INSERT INTO `#__eb_states` (`state_id`, `country_id`, `state_name`, `state_3_code`, `state_2_code`) VALUES
(1, 223, 'Alabama', 'ALA', 'AL'),
(2, 223, 'Alaska', 'ALK', 'AK'),
(3, 223, 'Arizona', 'ARZ', 'AZ'),
(4, 223, 'Arkansas', 'ARK', 'AR'),
(5, 223, 'California', 'CAL', 'CA'),
(6, 223, 'Colorado', 'COL', 'CO'),
(7, 223, 'Connecticut', 'CCT', 'CT'),
(8, 223, 'Delaware', 'DEL', 'DE'),
(9, 223, 'District Of Columbia', 'DOC', 'DC'),
(10, 223, 'Florida', 'FLO', 'FL'),
(11, 223, 'Georgia', 'GEA', 'GA'),
(12, 223, 'Hawaii', 'HWI', 'HI'),
(13, 223, 'Idaho', 'IDA', 'ID'),
(14, 223, 'Illinois', 'ILL', 'IL'),
(15, 223, 'Indiana', 'IND', 'IN'),
(16, 223, 'Iowa', 'IOA', 'IA'),
(17, 223, 'Kansas', 'KAS', 'KS'),
(18, 223, 'Kentucky', 'KTY', 'KY'),
(19, 223, 'Louisiana', 'LOA', 'LA'),
(20, 223, 'Maine', 'MAI', 'ME'),
(21, 223, 'Maryland', 'MLD', 'MD'),
(22, 223, 'Massachusetts', 'MSA', 'MA'),
(23, 223, 'Michigan', 'MIC', 'MI'),
(24, 223, 'Minnesota', 'MIN', 'MN'),
(25, 223, 'Mississippi', 'MIS', 'MS'),
(26, 223, 'Missouri', 'MIO', 'MO'),
(27, 223, 'Montana', 'MOT', 'MT'),
(28, 223, 'Nebraska', 'NEB', 'NE'),
(29, 223, 'Nevada', 'NEV', 'NV'),
(30, 223, 'New Hampshire', 'NEH', 'NH'),
(31, 223, 'New Jersey', 'NEJ', 'NJ'),
(32, 223, 'New Mexico', 'NEM', 'NM'),
(33, 223, 'New York', 'NEY', 'NY'),
(34, 223, 'North Carolina', 'NOC', 'NC'),
(35, 223, 'North Dakota', 'NOD', 'ND'),
(36, 223, 'Ohio', 'OHI', 'OH'),
(37, 223, 'Oklahoma', 'OKL', 'OK'),
(38, 223, 'Oregon', 'ORN', 'OR'),
(39, 223, 'Pennsylvania', 'PEA', 'PA'),
(40, 223, 'Rhode Island', 'RHI', 'RI'),
(41, 223, 'South Carolina', 'SOC', 'SC'),
(42, 223, 'South Dakota', 'SOD', 'SD'),
(43, 223, 'Tennessee', 'TEN', 'TN'),
(44, 223, 'Texas', 'TXS', 'TX'),
(45, 223, 'Utah', 'UTA', 'UT'),
(46, 223, 'Vermont', 'VMT', 'VT'),
(47, 223, 'Virginia', 'VIA', 'VA'),
(48, 223, 'Washington', 'WAS', 'WA'),
(49, 223, 'West Virginia', 'WEV', 'WV'),
(50, 223, 'Wisconsin', 'WIS', 'WI'),
(51, 223, 'Wyoming', 'WYO', 'WY'),
(52, 38, 'Alberta', 'ALB', 'AB'),
(53, 38, 'British Columbia', 'BRC', 'BC'),
(54, 38, 'Manitoba', 'MAB', 'MB'),
(55, 38, 'New Brunswick', 'NEB', 'NB'),
(56, 38, 'Newfoundland and Labrador', 'NFL', 'NL'),
(57, 38, 'Northwest Territories', 'NWT', 'NT'),
(58, 38, 'Nova Scotia', 'NOS', 'NS'),
(59, 38, 'Nunavut', 'NUT', 'NU'),
(60, 38, 'Ontario', 'ONT', 'ON'),
(61, 38, 'Prince Edward Island', 'PEI', 'PE'),
(62, 38, 'Quebec', 'QEC', 'QC'),
(63, 38, 'Saskatchewan', 'SAK', 'SK'),
(64, 38, 'Yukon', 'YUT', 'YT'),
(65, 222, 'England', 'ENG', 'EN'),
(66, 222, 'Northern Ireland', 'NOI', 'NI'),
(67, 222, 'Scotland', 'SCO', 'SD'),
(68, 222, 'Wales', 'WLS', 'WS'),
(69, 13, 'Australian Capital Territory', 'ACT', 'AC'),
(70, 13, 'New South Wales', 'NSW', 'NS'),
(71, 13, 'Northern Territory', 'NOT', 'NT'),
(72, 13, 'Queensland', 'QLD', 'QL'),
(73, 13, 'South Australia', 'SOA', 'SA'),
(74, 13, 'Tasmania', 'TAS', 'TS'),
(75, 13, 'Victoria', 'VIC', 'VI'),
(76, 13, 'Western Australia', 'WEA', 'WA'),
(77, 138, 'Aguascalientes', 'AGS', 'AG'),
(78, 138, 'Baja California Norte', 'BCN', 'BN'),
(79, 138, 'Baja California Sur', 'BCS', 'BS'),
(80, 138, 'Campeche', 'CAM', 'CA'),
(81, 138, 'Chiapas', 'CHI', 'CS'),
(82, 138, 'Chihuahua', 'CHA', 'CH'),
(83, 138, 'Coahuila', 'COA', 'CO'),
(84, 138, 'Colima', 'COL', 'CM'),
(85, 138, 'Distrito Federal', 'DFM', 'DF'),
(86, 138, 'Durango', 'DGO', 'DO'),
(87, 138, 'Guanajuato', 'GTO', 'GO'),
(88, 138, 'Guerrero', 'GRO', 'GU'),
(89, 138, 'Hidalgo', 'HGO', 'HI'),
(90, 138, 'Jalisco', 'JAL', 'JA'),
(91, 138, 'M�xico (Estado de)', 'EDM', 'EM'),
(92, 138, 'Michoac�n', 'MCN', 'MI'),
(93, 138, 'Morelos', 'MOR', 'MO'),
(94, 138, 'Nayarit', 'NAY', 'NY'),
(95, 138, 'Nuevo Le�n', 'NUL', 'NL'),
(96, 138, 'Oaxaca', 'OAX', 'OA'),
(97, 138, 'Puebla', 'PUE', 'PU'),
(98, 138, 'Quer�taro', 'QRO', 'QU'),
(99, 138, 'Quintana Roo', 'QUR', 'QR'),
(100, 138, 'San Luis Potos�', 'SLP', 'SP'),
(101, 138, 'Sinaloa', 'SIN', 'SI'),
(102, 138, 'Sonora', 'SON', 'SO'),
(103, 138, 'Tabasco', 'TAB', 'TA'),
(104, 138, 'Tamaulipas', 'TAM', 'TM'),
(105, 138, 'Tlaxcala', 'TLX', 'TX'),
(106, 138, 'Veracruz', 'VER', 'VZ'),
(107, 138, 'Yucat�n', 'YUC', 'YU'),
(108, 138, 'Zacatecas', 'ZAC', 'ZA'),
(109, 30, 'Acre', 'ACR', 'AC'),
(110, 30, 'Alagoas', 'ALG', 'AL'),
(111, 30, 'Amap�', 'AMP', 'AP'),
(112, 30, 'Amazonas', 'AMZ', 'AM'),
(113, 30, 'Bah�a', 'BAH', 'BA'),
(114, 30, 'Cear�', 'CEA', 'CE'),
(115, 30, 'Distrito Federal', 'DFB', 'DF'),
(116, 30, 'Espirito Santo', 'ESS', 'ES'),
(117, 30, 'Goi�s', 'GOI', 'GO'),
(118, 30, 'Maranh�o', 'MAR', 'MA'),
(119, 30, 'Mato Grosso', 'MAT', 'MT'),
(120, 30, 'Mato Grosso do Sul', 'MGS', 'MS'),
(121, 30, 'Minas Gera�s', 'MIG', 'MG'),
(122, 30, 'Paran�', 'PAR', 'PR'),
(123, 30, 'Para�ba', 'PRB', 'PB'),
(124, 30, 'Par�', 'PAB', 'PA'),
(125, 30, 'Pernambuco', 'PER', 'PE'),
(126, 30, 'Piau�', 'PIA', 'PI'),
(127, 30, 'Rio Grande do Norte', 'RGN', 'RN'),
(128, 30, 'Rio Grande do Sul', 'RGS', 'RS'),
(129, 30, 'Rio de Janeiro', 'RDJ', 'RJ'),
(130, 30, 'Rond�nia', 'RON', 'RO'),
(131, 30, 'Roraima', 'ROR', 'RR'),
(132, 30, 'Santa Catarina', 'SAC', 'SC'),
(133, 30, 'Sergipe', 'SER', 'SE'),
(134, 30, 'S�o Paulo', 'SAP', 'SP'),
(135, 30, 'Tocantins', 'TOC', 'TO'),
(136, 44, 'Anhui', 'ANH', '34'),
(137, 44, 'Beijing', 'BEI', '11'),
(138, 44, 'Chongqing', 'CHO', '50'),
(139, 44, 'Fujian', 'FUJ', '35'),
(140, 44, 'Gansu', 'GAN', '62'),
(141, 44, 'Guangdong', 'GUA', '44'),
(142, 44, 'Guangxi Zhuang', 'GUZ', '45'),
(143, 44, 'Guizhou', 'GUI', '52'),
(144, 44, 'Hainan', 'HAI', '46'),
(145, 44, 'Hebei', 'HEB', '13'),
(146, 44, 'Heilongjiang', 'HEI', '23'),
(147, 44, 'Henan', 'HEN', '41'),
(148, 44, 'Hubei', 'HUB', '42'),
(149, 44, 'Hunan', 'HUN', '43'),
(150, 44, 'Jiangsu', 'JIA', '32'),
(151, 44, 'Jiangxi', 'JIX', '36'),
(152, 44, 'Jilin', 'JIL', '22'),
(153, 44, 'Liaoning', 'LIA', '21'),
(154, 44, 'Nei Mongol', 'NML', '15'),
(155, 44, 'Ningxia Hui', 'NIH', '64'),
(156, 44, 'Qinghai', 'QIN', '63'),
(157, 44, 'Shandong', 'SNG', '37'),
(158, 44, 'Shanghai', 'SHH', '31'),
(159, 44, 'Shaanxi', 'SHX', '61'),
(160, 44, 'Sichuan', 'SIC', '51'),
(161, 44, 'Tianjin', 'TIA', '12'),
(162, 44, 'Xinjiang Uygur', 'XIU', '65'),
(163, 44, 'Xizang', 'XIZ', '54'),
(164, 44, 'Yunnan', 'YUN', '53'),
(165, 44, 'Zhejiang', 'ZHE', '33'),
(166, 104, 'Israel', 'ISL', 'IL'),
(167, 104, 'Gaza Strip', 'GZS', 'GZ'),
(168, 104, 'West Bank', 'WBK', 'WB'),
(169, 151, 'St. Maarten', 'STM', 'SM'),
(170, 151, 'Bonaire', 'BNR', 'BN'),
(171, 151, 'Curacao', 'CUR', 'CR'),
(172, 175, 'Alba', 'ABA', 'AB'),
(173, 175, 'Arad', 'ARD', 'AR'),
(174, 175, 'Arges', 'ARG', 'AG'),
(175, 175, 'Bacau', 'BAC', 'BC'),
(176, 175, 'Bihor', 'BIH', 'BH'),
(177, 175, 'Bistrita-Nasaud', 'BIS', 'BN'),
(178, 175, 'Botosani', 'BOT', 'BT'),
(179, 175, 'Braila', 'BRL', 'BR'),
(180, 175, 'Brasov', 'BRA', 'BV'),
(181, 175, 'Bucuresti', 'BUC', 'B'),
(182, 175, 'Buzau', 'BUZ', 'BZ'),
(183, 175, 'Calarasi', 'CAL', 'CL'),
(184, 175, 'Caras Severin', 'CRS', 'CS'),
(185, 175, 'Cluj', 'CLJ', 'CJ'),
(186, 175, 'Constanta', 'CST', 'CT'),
(187, 175, 'Covasna', 'COV', 'CV'),
(188, 175, 'Dambovita', 'DAM', 'DB'),
(189, 175, 'Dolj', 'DLJ', 'DJ'),
(190, 175, 'Galati', 'GAL', 'GL'),
(191, 175, 'Giurgiu', 'GIU', 'GR'),
(192, 175, 'Gorj', 'GOR', 'GJ'),
(193, 175, 'Hargita', 'HRG', 'HR'),
(194, 175, 'Hunedoara', 'HUN', 'HD'),
(195, 175, 'Ialomita', 'IAL', 'IL'),
(196, 175, 'Iasi', 'IAS', 'IS'),
(197, 175, 'Ilfov', 'ILF', 'IF'),
(198, 175, 'Maramures', 'MAR', 'MM'),
(199, 175, 'Mehedinti', 'MEH', 'MH'),
(200, 175, 'Mures', 'MUR', 'MS'),
(201, 175, 'Neamt', 'NEM', 'NT'),
(202, 175, 'Olt', 'OLT', 'OT'),
(203, 175, 'Prahova', 'PRA', 'PH'),
(204, 175, 'Salaj', 'SAL', 'SJ'),
(205, 175, 'Satu Mare', 'SAT', 'SM'),
(206, 175, 'Sibiu', 'SIB', 'SB'),
(207, 175, 'Suceava', 'SUC', 'SV'),
(208, 175, 'Teleorman', 'TEL', 'TR'),
(209, 175, 'Timis', 'TIM', 'TM'),
(210, 175, 'Tulcea', 'TUL', 'TL'),
(211, 175, 'Valcea', 'VAL', 'VL'),
(212, 175, 'Vaslui', 'VAS', 'VS'),
(213, 175, 'Vrancea', 'VRA', 'VN'),
(214, 105, 'Agrigento', 'AGR', 'AG'),
(215, 105, 'Alessandria', 'ALE', 'AL'),
(216, 105, 'Ancona', 'ANC', 'AN'),
(217, 105, 'Aosta', 'AOS', 'AO'),
(218, 105, 'Arezzo', 'ARE', 'AR'),
(219, 105, 'Ascoli Piceno', 'API', 'AP'),
(220, 105, 'Asti', 'AST', 'AT'),
(221, 105, 'Avellino', 'AVE', 'AV'),
(222, 105, 'Bari', 'BAR', 'BA'),
(223, 105, 'Belluno', 'BEL', 'BL'),
(224, 105, 'Benevento', 'BEN', 'BN'),
(225, 105, 'Bergamo', 'BEG', 'BG'),
(226, 105, 'Biella', 'BIE', 'BI'),
(227, 105, 'Bologna', 'BOL', 'BO'),
(228, 105, 'Bolzano', 'BOZ', 'BZ'),
(229, 105, 'Brescia', 'BRE', 'BS'),
(230, 105, 'Brindisi', 'BRI', 'BR'),
(231, 105, 'Cagliari', 'CAG', 'CA'),
(232, 105, 'Caltanissetta', 'CAL', 'CL'),
(233, 105, 'Campobasso', 'CBO', 'CB'),
(234, 105, 'Carbonia-Iglesias', 'CAR', 'CI'),
(235, 105, 'Caserta', 'CAS', 'CE'),
(236, 105, 'Catania', 'CAT', 'CT'),
(237, 105, 'Catanzaro', 'CTZ', 'CZ'),
(238, 105, 'Chieti', 'CHI', 'CH'),
(239, 105, 'Como', 'COM', 'CO'),
(240, 105, 'Cosenza', 'COS', 'CS'),
(241, 105, 'Cremona', 'CRE', 'CR'),
(242, 105, 'Crotone', 'CRO', 'KR'),
(243, 105, 'Cuneo', 'CUN', 'CN'),
(244, 105, 'Enna', 'ENN', 'EN'),
(245, 105, 'Ferrara', 'FER', 'FE'),
(246, 105, 'Firenze', 'FIR', 'FI'),
(247, 105, 'Foggia', 'FOG', 'FG'),
(248, 105, 'Forli-Cesena', 'FOC', 'FC'),
(249, 105, 'Frosinone', 'FRO', 'FR'),
(250, 105, 'Genova', 'GEN', 'GE'),
(251, 105, 'Gorizia', 'GOR', 'GO'),
(252, 105, 'Grosseto', 'GRO', 'GR'),
(253, 105, 'Imperia', 'IMP', 'IM'),
(254, 105, 'Isernia', 'ISE', 'IS'),
(255, 105, 'L''Aquila', 'AQU', 'AQ'),
(256, 105, 'La Spezia', 'LAS', 'SP'),
(257, 105, 'Latina', 'LAT', 'LT'),
(258, 105, 'Lecce', 'LEC', 'LE'),
(259, 105, 'Lecco', 'LCC', 'LC'),
(260, 105, 'Livorno', 'LIV', 'LI'),
(261, 105, 'Lodi', 'LOD', 'LO'),
(262, 105, 'Lucca', 'LUC', 'LU'),
(263, 105, 'Macerata', 'MAC', 'MC'),
(264, 105, 'Mantova', 'MAN', 'MN'),
(265, 105, 'Massa-Carrara', 'MAS', 'MS'),
(266, 105, 'Matera', 'MAA', 'MT'),
(267, 105, 'Medio Campidano', 'MED', 'VS'),
(268, 105, 'Messina', 'MES', 'ME'),
(269, 105, 'Milano', 'MIL', 'MI'),
(270, 105, 'Modena', 'MOD', 'MO'),
(271, 105, 'Napoli', 'NAP', 'NA'),
(272, 105, 'Novara', 'NOV', 'NO'),
(273, 105, 'Nuoro', 'NUR', 'NU'),
(274, 105, 'Ogliastra', 'OGL', 'OG'),
(275, 105, 'Olbia-Tempio', 'OLB', 'OT'),
(276, 105, 'Oristano', 'ORI', 'OR'),
(277, 105, 'Padova', 'PDA', 'PD'),
(278, 105, 'Palermo', 'PAL', 'PA'),
(279, 105, 'Parma', 'PAA', 'PR'),
(280, 105, 'Pavia', 'PAV', 'PV'),
(281, 105, 'Perugia', 'PER', 'PG'),
(282, 105, 'Pesaro e Urbino', 'PES', 'PU'),
(283, 105, 'Pescara', 'PSC', 'PE'),
(284, 105, 'Piacenza', 'PIA', 'PC'),
(285, 105, 'Pisa', 'PIS', 'PI'),
(286, 105, 'Pistoia', 'PIT', 'PT'),
(287, 105, 'Pordenone', 'POR', 'PN'),
(288, 105, 'Potenza', 'PTZ', 'PZ'),
(289, 105, 'Prato', 'PRA', 'PO'),
(290, 105, 'Ragusa', 'RAG', 'RG'),
(291, 105, 'Ravenna', 'RAV', 'RA'),
(292, 105, 'Reggio Calabria', 'REG', 'RC'),
(293, 105, 'Reggio Emilia', 'REE', 'RE'),
(294, 105, 'Rieti', 'RIE', 'RI'),
(295, 105, 'Rimini', 'RIM', 'RN'),
(296, 105, 'Roma', 'ROM', 'RM'),
(297, 105, 'Rovigo', 'ROV', 'RO'),
(298, 105, 'Salerno', 'SAL', 'SA'),
(299, 105, 'Sassari', 'SAS', 'SS'),
(300, 105, 'Savona', 'SAV', 'SV'),
(301, 105, 'Siena', 'SIE', 'SI'),
(302, 105, 'Siracusa', 'SIR', 'SR'),
(303, 105, 'Sondrio', 'SOO', 'SO'),
(304, 105, 'Taranto', 'TAR', 'TA'),
(305, 105, 'Teramo', 'TER', 'TE'),
(306, 105, 'Terni', 'TRN', 'TR'),
(307, 105, 'Torino', 'TOR', 'TO'),
(308, 105, 'Trapani', 'TRA', 'TP'),
(309, 105, 'Trento', 'TRE', 'TN'),
(310, 105, 'Treviso', 'TRV', 'TV'),
(311, 105, 'Trieste', 'TRI', 'TS'),
(312, 105, 'Udine', 'UDI', 'UD'),
(313, 105, 'Varese', 'VAR', 'VA'),
(314, 105, 'Venezia', 'VEN', 'VE'),
(315, 105, 'Verbano Cusio Ossola', 'VCO', 'VB'),
(316, 105, 'Vercelli', 'VER', 'VC'),
(317, 105, 'Verona', 'VRN', 'VR'),
(318, 105, 'Vibo Valenzia', 'VIV', 'VV'),
(319, 105, 'Vicenza', 'VII', 'VI'),
(320, 105, 'Viterbo', 'VIT', 'VT'),
(321, 195, 'A Coru�a', 'ACO', '15'),
(322, 195, 'Alava', 'ALA', '01'),
(323, 195, 'Albacete', 'ALB', '02'),
(324, 195, 'Alicante', 'ALI', '03'),
(325, 195, 'Almeria', 'ALM', '04'),
(326, 195, 'Asturias', 'AST', '33'),
(327, 195, 'Avila', 'AVI', '05'),
(328, 195, 'Badajoz', 'BAD', '06'),
(329, 195, 'Baleares', 'BAL', '07'),
(330, 195, 'Barcelona', 'BAR', '08'),
(331, 195, 'Burgos', 'BUR', '09'),
(332, 195, 'Caceres', 'CAC', '10'),
(333, 195, 'Cadiz', 'CAD', '11'),
(334, 195, 'Cantabria', 'CAN', '39'),
(335, 195, 'Castellon', 'CAS', '12'),
(336, 195, 'Ceuta', 'CEU', '51'),
(337, 195, 'Ciudad Real', 'CIU', '13'),
(338, 195, 'Cordoba', 'COR', '14'),
(339, 195, 'Cuenca', 'CUE', '16'),
(340, 195, 'Girona', 'GIR', '17'),
(341, 195, 'Granada', 'GRA', '18'),
(342, 195, 'Guadalajara', 'GUA', '19'),
(343, 195, 'Guipuzcoa', 'GUI', '20'),
(344, 195, 'Huelva', 'HUL', '21'),
(345, 195, 'Huesca', 'HUS', '22'),
(346, 195, 'Jaen', 'JAE', '23'),
(347, 195, 'La Rioja', 'LRI', '26'),
(348, 195, 'Las Palmas', 'LPA', '35'),
(349, 195, 'Leon', 'LEO', '24'),
(350, 195, 'Lleida', 'LLE', '25'),
(351, 195, 'Lugo', 'LUG', '27'),
(352, 195, 'Madrid', 'MAD', '28'),
(353, 195, 'Malaga', 'MAL', '29'),
(354, 195, 'Melilla', 'MEL', '52'),
(355, 195, 'Murcia', 'MUR', '30'),
(356, 195, 'Navarra', 'NAV', '31'),
(357, 195, 'Ourense', 'OUR', '32'),
(358, 195, 'Palencia', 'PAL', '34'),
(359, 195, 'Pontevedra', 'PON', '36'),
(360, 195, 'Salamanca', 'SAL', '37'),
(361, 195, 'Santa Cruz de Tenerife', 'SCT', '38'),
(362, 195, 'Segovia', 'SEG', '40'),
(363, 195, 'Sevilla', 'SEV', '41'),
(364, 195, 'Soria', 'SOR', '42'),
(365, 195, 'Tarragona', 'TAR', '43'),
(366, 195, 'Teruel', 'TER', '44'),
(367, 195, 'Toledo', 'TOL', '45'),
(368, 195, 'Valencia', 'VAL', '46'),
(369, 195, 'Valladolid', 'VLL', '47'),
(370, 195, 'Vizcaya', 'VIZ', '48'),
(371, 195, 'Zamora', 'ZAM', '49'),
(372, 195, 'Zaragoza', 'ZAR', '50'),
(373, 11, 'Aragatsotn', 'ARG', 'AG'),
(374, 11, 'Ararat', 'ARR', 'AR'),
(375, 11, 'Armavir', 'ARM', 'AV'),
(376, 11, 'Gegharkunik', 'GEG', 'GR'),
(377, 11, 'Kotayk', 'KOT', 'KT'),
(378, 11, 'Lori', 'LOR', 'LO'),
(379, 11, 'Shirak', 'SHI', 'SH'),
(380, 11, 'Syunik', 'SYU', 'SU'),
(381, 11, 'Tavush', 'TAV', 'TV'),
(382, 11, 'Vayots-Dzor', 'VAD', 'VD'),
(383, 11, 'Yerevan', 'YER', 'ER'),
(384, 99, 'Andaman & Nicobar Islands', 'ANI', 'AI'),
(385, 99, 'Andhra Pradesh', 'AND', 'AN'),
(386, 99, 'Arunachal Pradesh', 'ARU', 'AR'),
(387, 99, 'Assam', 'ASS', 'AS'),
(388, 99, 'Bihar', 'BIH', 'BI'),
(389, 99, 'Chandigarh', 'CHA', 'CA'),
(390, 99, 'Chhatisgarh', 'CHH', 'CH'),
(391, 99, 'Dadra & Nagar Haveli', 'DAD', 'DD'),
(392, 99, 'Daman & Diu', 'DAM', 'DA'),
(393, 99, 'Delhi', 'DEL', 'DE'),
(394, 99, 'Goa', 'GOA', 'GO'),
(395, 99, 'Gujarat', 'GUJ', 'GU'),
(396, 99, 'Haryana', 'HAR', 'HA'),
(397, 99, 'Himachal Pradesh', 'HIM', 'HI'),
(398, 99, 'Jammu & Kashmir', 'JAM', 'JA'),
(399, 99, 'Jharkhand', 'JHA', 'JH'),
(400, 99, 'Karnataka', 'KAR', 'KA'),
(401, 99, 'Kerala', 'KER', 'KE'),
(402, 99, 'Lakshadweep', 'LAK', 'LA'),
(403, 99, 'Madhya Pradesh', 'MAD', 'MD'),
(404, 99, 'Maharashtra', 'MAH', 'MH'),
(405, 99, 'Manipur', 'MAN', 'MN'),
(406, 99, 'Meghalaya', 'MEG', 'ME'),
(407, 99, 'Mizoram', 'MIZ', 'MI'),
(408, 99, 'Nagaland', 'NAG', 'NA'),
(409, 99, 'Orissa', 'ORI', 'OR'),
(410, 99, 'Pondicherry', 'PON', 'PO'),
(411, 99, 'Punjab', 'PUN', 'PU'),
(412, 99, 'Rajasthan', 'RAJ', 'RA'),
(413, 99, 'Sikkim', 'SIK', 'SI'),
(414, 99, 'Tamil Nadu', 'TAM', 'TA'),
(415, 99, 'Tripura', 'TRI', 'TR'),
(416, 99, 'Uttaranchal', 'UAR', 'UA'),
(417, 99, 'Uttar Pradesh', 'UTT', 'UT'),
(418, 99, 'West Bengal', 'WES', 'WE'),
(419, 101, 'Ahmadi va Kohkiluyeh', 'BOK', 'BO'),
(420, 101, 'Ardabil', 'ARD', 'AR'),
(421, 101, 'Azarbayjan-e Gharbi', 'AZG', 'AG'),
(422, 101, 'Azarbayjan-e Sharqi', 'AZS', 'AS'),
(423, 101, 'Bushehr', 'BUS', 'BU'),
(424, 101, 'Chaharmahal va Bakhtiari', 'CMB', 'CM'),
(425, 101, 'Esfahan', 'ESF', 'ES'),
(426, 101, 'Fars', 'FAR', 'FA'),
(427, 101, 'Gilan', 'GIL', 'GI'),
(428, 101, 'Gorgan', 'GOR', 'GO'),
(429, 101, 'Hamadan', 'HAM', 'HA'),
(430, 101, 'Hormozgan', 'HOR', 'HO'),
(431, 101, 'Ilam', 'ILA', 'IL'),
(432, 101, 'Kerman', 'KER', 'KE'),
(433, 101, 'Kermanshah', 'BAK', 'BA'),
(434, 101, 'Khorasan-e Junoubi', 'KHJ', 'KJ'),
(435, 101, 'Khorasan-e Razavi', 'KHR', 'KR'),
(436, 101, 'Khorasan-e Shomali', 'KHS', 'KS'),
(437, 101, 'Khuzestan', 'KHU', 'KH'),
(438, 101, 'Kordestan', 'KOR', 'KO'),
(439, 101, 'Lorestan', 'LOR', 'LO'),
(440, 101, 'Markazi', 'MAR', 'MR'),
(441, 101, 'Mazandaran', 'MAZ', 'MZ'),
(442, 101, 'Qazvin', 'QAS', 'QA'),
(443, 101, 'Qom', 'QOM', 'QO'),
(444, 101, 'Semnan', 'SEM', 'SE'),
(445, 101, 'Sistan va Baluchestan', 'SBA', 'SB'),
(446, 101, 'Tehran', 'TEH', 'TE'),
(447, 101, 'Yazd', 'YAZ', 'YA'),
(448, 101, 'Zanjan', 'ZAN', 'ZA');
CREATE TABLE IF NOT EXISTS `#__eb_waiting_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `event_id` int(11) DEFAULT '0',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `organization` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `zip` varchar(15) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `number_registrants` int(11) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `notified` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) CHARACTER SET `utf8`;
CREATE TABLE IF NOT EXISTS `#__eb_messages` (
  `id` int(11) NOT NULL,
  `message_key` varchar(50) DEFAULT NULL,
  `message` text
) CHARACTER SET `utf8`;
