-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 10, 2015 at 10:07 PM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: bitsnbytes
--

-- --------------------------------------------------------

--
-- Table structure for table Food
--
DROP DATABASE IF EXISTS bitsnbytes;
CREATE DATABASE bitsnbytes;
USE bitsnbytes;

DROP TABLE IF EXISTS Food;
DROP TABLE IF EXISTS Food_Type;
DROP TABLE IF EXISTS Meal;
DROP TABLE IF EXISTS Meal_Category;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Meal_Item;

CREATE TABLE Food (
  id int(11) NOT NULL,
  name varchar(128) NOT NULL,
  type_id int(11) NOT NULL,
  calories int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table Food
--

INSERT INTO Food (id, name, type_id, calories) VALUES
(1, 'Steak (8oz)', 1, 200),
(2, 'Baked Potato (loaded)', 8, 500),
(5, 'Grilled Salmon Filet', 5, 250),
(6, 'Broccoli', 8, 125);

-- --------------------------------------------------------

--
-- Table structure for table Food_Type
--

CREATE TABLE Food_Type (
  id int(11) NOT NULL,
  name varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table Food_Type
--

INSERT INTO Food_Type (id, name) VALUES
(7, 'Fruit'),
(1, 'Meat'),
(2, 'Poultry'),
(5, 'Seafood'),
(8, 'Vegetable');

-- --------------------------------------------------------

--
-- Table structure for table Meal
--

CREATE TABLE Meal (
  id int(11) NOT NULL,
  name varchar(128) NOT NULL,
  user_id int(11) NOT NULL,
  category_id int(11) NOT NULL,
  comment varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table Meal
--

INSERT INTO Meal (id, name, user_id, category_id, comment) VALUES
(1, 'Steak and Potatoes', 1, 4, 'The staple of my diet.'),
(2, 'Seafood Lunch', 3, 2, 'Dunno if Bob Marley ever ate this.'),
(3, 'Eggs', 1, 1, 'healthy'),
(4, 'Milk', 1, 1, 'healthy'),
(5, 'fish', 1, 1, 'healthy'),
(6, 'chicken wings', 1, 1, 'healthy');

-- --------------------------------------------------------

--
-- Table structure for table Meal_Category
--

CREATE TABLE Meal_Category (
  id int(11) NOT NULL,
  name varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table Meal_Category
--

INSERT INTO Meal_Category (id, name) VALUES
(1, 'Breakfast'),
(4, 'Dinner'),
(2, 'Lunch'),
(5, 'Snack');

-- --------------------------------------------------------

--
-- Table structure for table Meal_Item
--

CREATE TABLE Meal_Item (
  meal_id int(11) NOT NULL,
  food_id int(11) NOT NULL,
  servings int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table Meal_Item
--

INSERT INTO Meal_Item (meal_id, food_id, servings) VALUES
(1, 1, 1),
(1, 2, 1),
(2, 5, 1),
(2, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table Users
--

CREATE TABLE Users (
  id int(11) NOT NULL,
  first_name varchar(64) NOT NULL,
  last_name varchar(64) NOT NULL,
  email varchar(128) NOT NULL,
  password text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table Users
--

INSERT INTO Users (id, first_name, last_name, email, password) VALUES
(1, 'John', 'Smith', 'jsmith@test.com', 'qweasdzxc'),
(2, 'Bob', 'Jones', 'bones@test.com', 'qweasdzxc'),
(3, 'Bob', 'Marley', 'tuffgong@test.com', 'qweasdzxc'),
(4, 'Joe', 'Shoo', 'jsmoo@test.com', 'qweasdzxc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table Food
--
ALTER TABLE Food
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY name (name);

--
-- Indexes for table Food_Type
--
ALTER TABLE Food_Type
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY name (name);

--
-- Indexes for table Meal
--
ALTER TABLE Meal
  ADD PRIMARY KEY (id);

--
-- Indexes for table Meal_Category
--
ALTER TABLE Meal_Category
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY name (name);

--
-- Indexes for table Meal_Item
--
ALTER TABLE Meal_Item
  ADD PRIMARY KEY (meal_id,food_id);

--
-- Indexes for table Users
--
ALTER TABLE Users
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY email (email);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table Food
--
ALTER TABLE Food
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table Food_Type
--
ALTER TABLE Food_Type
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table Meal
--
ALTER TABLE Meal
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table Meal_Category
--
ALTER TABLE Meal_Category
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table Users
--
ALTER TABLE Users
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
