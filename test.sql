SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `doc` (
  `id` int(10) NOT NULL,
  `FName` varchar(20) NOT NULL,
  `LName` varchar(20) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `doctype` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doc`
--

INSERT INTO `doc` (`id`, `FName`, `LName`, `Email`, `phone`, `doctype`) VALUES
(2, 'kamal', 'jangra', 'dsfds@mail.com', '9186073734', 'MD'),
(5, 'kamal', 'jangra', 'kamaljangra@gmail.com', '9186073734', 'MBBS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doc`
--
ALTER TABLE `doc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doc`
--
ALTER TABLE `doc`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;