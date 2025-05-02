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
-- Table structure for table `illnesses`
--

CREATE TABLE `illnesses` (
  `illness_id` int(11) NOT NULL,
  `illness_name` varchar(255) NOT NULL,
  `symptoms` text DEFAULT NULL,
  `medicine_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `illnesses`
--

INSERT INTO `illnesses` (`illness_id`, `illness_name`, `symptoms`, `medicine_id`) VALUES
(1, 'Fever', 'High temperature, chills, sweating', 1),
(2, 'Mild to Moderate Pain', 'Headache, body pain, muscle aches', 2),
(3, 'Bacterial Infection', 'Fever, chills, infection symptoms', 3),
(4, 'Urinary Infection', 'Burning sensation when urinating', 4),
(5, 'Parasitic Infection', 'Diarrhea, abdominal pain, nausea', 5),
(6, 'Skin Infection', 'Redness, swelling, warmth on skin', 6),
(7, 'Respiratory Tract Infection', 'Cough, sore throat, chest pain', 7),
(8, 'Bronchitis', 'Coughing up mucus, wheezing', 8),
(9, 'Asthma Attack', 'Shortness of breath, wheezing', 9),
(10, 'Chronic Asthma', 'Difficulty breathing, frequent attacks', 10),
(11, 'Allergic Rhinitis', 'Sneezing, runny nose, itchy eyes', 11),
(12, 'Seasonal Allergies', 'Sneezing, nasal congestion, itchy throat', 12),
(13, 'Cold Symptoms', 'Sneezing, coughing, watery eyes', 13),
(14, 'Hay Fever', 'Sneezing, itchy, watery eyes', 14),
(15, 'Acid Reflux', 'Heartburn, chest pain, sour taste', 15),
(16, 'Stomach Ulcer', 'Burning sensation in stomach, nausea', 16),
(17, 'Indigestion', 'Fullness, bloating, discomfort after eating', 17),
(18, 'Gastroenteritis', 'Diarrhea, vomiting, stomach cramps', 18),
(19, 'Irritable Bowel Syndrome (IBS)', 'Abdominal pain, bloating, diarrhea', 19),
(20, 'Diarrhea', 'Loose stools, abdominal pain', 20),
(21, 'Constipation', 'Difficulty passing stools, abdominal pain', 21),
(22, 'Nausea', 'Feeling of queasiness or vomiting', 22),
(23, 'Vomiting', 'Throwing up, loss of appetite', 23),
(24, 'Migraine', 'Severe headache, nausea, sensitivity to light', 24),
(25, 'Sinusitis', 'Headache, facial pain, nasal congestion', 25),
(26, 'Chronic Fatigue Syndrome', 'Persistent tiredness, muscle pain', 26),
(27, 'Back Pain', 'Pain in the back, stiffness, difficulty moving', 27),
(28, 'Arthritis', 'Joint pain, swelling, stiffness', 28),
(29, 'Rheumatism', 'Pain, stiffness in the joints', 29),
(30, 'Gout', 'Sudden, severe pain in the joints, redness', 30),
(31, 'Sciatica', 'Pain radiating from lower back to leg', 31),
(32, 'Tonsillitis', 'Sore throat, difficulty swallowing', 32),
(33, 'Sore Throat', 'Pain, irritation in the throat', 33),
(34, 'Ear Infection', 'Earache, fever, difficulty hearing', 34),
(35, 'Pneumonia', 'Cough, shortness of breath, chest pain', 35),
(36, 'Tuberculosis', 'Cough, weight loss, night sweats', 36),
(37, 'Diabetes', 'High blood sugar, frequent urination', 37),
(38, 'Hypertension', 'Headache, dizziness, high blood pressure', 38),
(39, 'Heart Disease', 'Chest pain, shortness of breath', 39),
(40, 'Stroke', 'Sudden numbness, confusion, difficulty speaking', 40),
(41, 'Epilepsy', 'Seizures, loss of consciousness', 41),
(42, 'Parkinson\'s Disease', 'Tremors, stiffness, difficulty walking', 42),
(43, 'Multiple Sclerosis', 'Fatigue, vision problems, numbness', 43),
(44, 'Alzheimer\'s Disease', 'Memory loss, confusion, difficulty thinking', 44),
(45, 'Cataracts', 'Cloudy vision, difficulty seeing at night', 45),
(46, 'Conjunctivitis', 'Redness, itching in the eyes', 46),
(47, 'Glaucoma', 'Vision loss, eye pain, headache', 47),
(48, 'Anemia', 'Fatigue, pale skin, shortness of breath', 48),
(49, 'Leukemia', 'Fatigue, fever, frequent infections', 49),
(50, 'HIV/AIDS', 'Fatigue, swollen lymph nodes, weight loss', 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `illnesses`
--
ALTER TABLE `illnesses`
  ADD PRIMARY KEY (`illness_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `illnesses`
--
ALTER TABLE `illnesses`
  MODIFY `illness_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
