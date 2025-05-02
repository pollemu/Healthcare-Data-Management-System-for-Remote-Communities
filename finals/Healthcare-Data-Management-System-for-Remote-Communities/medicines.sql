-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2025 at 06:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthcare_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `medicine_id` int(11) NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `purpose` text DEFAULT NULL,
  `dosage_per_day` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`medicine_id`, `medicine_name`, `category`, `purpose`, `dosage_per_day`) VALUES
(1, 'Paracetamol', 'Fever/Pain Relievers', 'Relieves fever and mild pain', '1 tablet every 4-6 hours'),
(2, 'Ibuprofen', 'Fever/Pain Relievers', 'Reduces inflammation, fever, and pain', '1 tablet every 6-8 hours'),
(3, 'Amoxicillin', 'Antibiotics', 'Treats bacterial infections', '1 capsule every 8 hours'),
(4, 'Cotrimoxazole', 'Antibiotics', 'Treats urinary and respiratory infections', '1 tablet twice a day'),
(5, 'Metronidazole', 'Antibiotics', 'Treats parasitic and bacterial infections', '1 tablet three times a day'),
(6, 'Cephalexin', 'Antibiotics', 'Treats respiratory, skin, and urinary infections', '1 capsule every 6 hours'),
(7, 'Erythromycin', 'Antibiotics', 'Treats respiratory tract infections', '1 tablet every 6 hours'),
(8, 'Clarithromycin', 'Antibiotics', 'Treats bronchitis and pneumonia', '1 tablet twice a day'),
(9, 'Salbutamol', 'Asthma Medicines', 'Relieves asthma attacks', '2 puffs every 4-6 hours'),
(10, 'Budesonide', 'Asthma Medicines', 'Prevents asthma symptoms', '1-2 puffs twice daily'),
(11, 'Loratadine', 'Antihistamines', 'Treats allergies', '1 tablet once a day'),
(12, 'Cetirizine', 'Antihistamines', 'Relieves allergic symptoms', '1 tablet once a day'),
(13, 'Diphenhydramine', 'Antihistamines', 'Treats allergies and cold symptoms', '1 tablet every 6-8 hours'),
(14, 'Chlorphenamine', 'Antihistamines', 'Treats hay fever and allergies', '1 tablet every 4-6 hours'),
(15, 'Omeprazole', 'Gastrointestinal Medicines', 'Treats acid reflux and ulcers', '1 capsule once a day'),
(16, 'Ranitidine', 'Gastrointestinal Medicines', 'Reduces stomach acid', '1 tablet twice a day'),
(17, 'Loperamide', 'Anti-diarrheal', 'Treats diarrhea', '1 capsule after each loose stool'),
(18, 'Oral Rehydration Salts (ORS)', 'Anti-diarrheal', 'Prevents dehydration', 'After each diarrhea episode'),
(19, 'Domperidone', 'Gastrointestinal Medicines', 'Relieves nausea and vomiting', '1 tablet three times a day'),
(20, 'Metformin', 'Diabetes Medicines', 'Controls blood sugar levels', '1 tablet twice a day'),
(21, 'Glibenclamide', 'Diabetes Medicines', 'Lowers blood sugar', '1 tablet once or twice daily'),
(22, 'Amlodipine', 'Hypertension Medicines', 'Lowers blood pressure', '1 tablet once a day'),
(23, 'Losartan', 'Hypertension Medicines', 'Treats high blood pressure', '1 tablet once a day'),
(24, 'Enalapril', 'Hypertension Medicines', 'Lowers blood pressure', '1 tablet once or twice daily'),
(25, 'Hydrochlorothiazide', 'Hypertension Medicines', 'Reduces fluid retention', '1 tablet once daily'),
(26, 'Simvastatin', 'Cholesterol Medicines', 'Lowers bad cholesterol', '1 tablet once daily'),
(27, 'Aspirin', 'Antiplatelet', 'Prevents blood clots', '1 tablet once daily'),
(28, 'Warfarin', 'Anticoagulant', 'Prevents blood clots', 'Dosage varies by INR result'),
(29, 'Clopidogrel', 'Antiplatelet', 'Prevents heart attacks', '1 tablet once daily'),
(30, 'Acetylcysteine', 'Respiratory Medicines', 'Thins mucus in lungs', '1 sachet twice a day'),
(31, 'Mebendazole', 'Anthelmintic', 'Treats worm infections', '1 tablet twice daily for 3 days'),
(32, 'Albendazole', 'Anthelmintic', 'Kills parasitic worms', '1 tablet single dose'),
(33, 'Vitamin C', 'Supplements', 'Boosts immune system', '1 tablet once daily'),
(34, 'Ferrous Sulfate', 'Supplements', 'Treats iron deficiency anemia', '1 tablet once or twice daily'),
(35, 'Folic Acid', 'Supplements', 'Prevents anemia', '1 tablet once daily'),
(36, 'Multivitamins', 'Supplements', 'Improves general health', '1 tablet once daily'),
(37, 'Calcium Carbonate', 'Supplements', 'Supports bone health', '1 tablet twice daily'),
(38, 'Zinc Sulfate', 'Supplements', 'Boosts immunity and wound healing', '1 tablet once daily'),
(39, 'Hydrocortisone Cream', 'Topical Medicines', 'Treats skin inflammation', 'Apply twice daily'),
(40, 'Mupirocin Ointment', 'Topical Antibiotics', 'Treats skin infections', 'Apply 2-3 times daily'),
(41, 'Betadine Solution', 'Antiseptic', 'Disinfects wounds', 'Apply as needed'),
(42, 'Clotrimazole Cream', 'Antifungal', 'Treats fungal skin infections', 'Apply twice daily'),
(43, 'Ketoconazole Shampoo', 'Antifungal', 'Treats dandruff and fungal scalp infections', 'Use twice weekly'),
(44, 'Silver Sulfadiazine Cream', 'Burn Treatment', 'Prevents infection in burns', 'Apply once or twice daily'),
(45, 'Dextrose 5%', 'IV Fluids', 'Replenishes fluids and energy', 'As directed'),
(46, 'Normal Saline', 'IV Fluids', 'Restores hydration', 'As directed'),
(47, 'Adrenaline Injection', 'Emergency Medicines', 'Treats anaphylaxis and cardiac arrest', 'As needed'),
(48, 'Atropine Injection', 'Emergency Medicines', 'Treats bradycardia', 'As needed'),
(49, 'Diazepam', 'Anticonvulsants', 'Treats seizures and anxiety', '1 tablet as needed or per doctor advice');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`medicine_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
