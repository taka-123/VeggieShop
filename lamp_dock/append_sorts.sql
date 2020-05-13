CREATE TABLE `sorts` (
  `sort_id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_name` varchar(100) NOT NULL,
  `sort_key` varchar(100) NOT NULL,
  `sort_sql` varchar(100) NOT NULL,
  PRIMARY KEY (`sort_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;;

--
-- テーブルのデータのダンプ `sorts`
--

INSERT INTO `sorts` (`sort_id`, `sort_name`, `sort_key`, `sort_sql`) VALUES
(1, '新着順', 'new', 'ORDER BY created DESC'),
(2, '価格の安い順', 'low', 'ORDER BY price'),
(3, '価格の高い順', 'high', 'ORDER BY price DESC');

-- --------------------------------------------------------