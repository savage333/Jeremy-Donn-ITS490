-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2018 at 10:22 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dmcs`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteClient` (IN `v_client_id` INT(11))  BEGIN
	-- Delete a client's record based on person_id
    DELETE FROM CLIENT
    WHERE person_id = v_client_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteDisaster` (IN `v_disaster_id` INT(11))  BEGIN
	-- Delete a disaster record by its id
    DELETE FROM DISASTER
    WHERE disaster_id = v_disaster_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteDonor` (IN `v_dnr_id` INT(11))  BEGIN
	-- Delete a donor's record based on person_id
    DELETE FROM DONOR
    WHERE person_id = v_dnr_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteEmployee` (IN `v_emp_id` INT(11))  BEGIN
	-- Delete an employee's record based on person_id
	DELETE FROM EMPLOYEE
    WHERE person_id = v_emp_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteGroups` (IN `v_grp_id` INT(11))  BEGIN
	-- Delete a group based on its id
    DELETE FROM GROUPS
    WHERE group_id = v_grp_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteGroup_Location` (IN `v_grp_id` INT(11))  BEGIN
	-- Delete group location based on its id
    DELETE FROM GROUP_LOCATION
    WHERE group_id = v_grp_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteGroup_Tasks` (IN `v_grp_id` INT(11))  BEGIN
	DELETE FROM GROUP_TASKS
	WHERE group_id = v_grp_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteLocation` (IN `v_loc_id` INT(11))  BEGIN
	DELETE FROM LOCATION
    WHERE location_id = v_loc_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deletePerson` (IN `v_prsn_id` INT(11))  BEGIN
	DELETE FROM PERSON
    WHERE person_id = v_prsn_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deletePhone_Calls` (IN `v_req_id` INT(11))  BEGIN
	DELETE FROM PHONE_CALLS
    WHERE request_id = v_req_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteProduct` (IN `v_prod_id` INT(11))  BEGIN
	DELETE FROM PRODUCT
	WHERE product_id = v_prod_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteProduct_Requests` (IN `v_product_id` INT(11))  BEGIN
	DELETE FROM PRODUCT_REQUESTS
    WHERE product_id = v_product_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteProject` (IN `v_proj_id` INT(11))  BEGIN
	-- Delete project by its project_id
	DELETE FROM PROJECT
    WHERE project_id = v_proj_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteProject_Location` (IN `v_proj_id` INT(11))  BEGIN
	DELETE FROM PROJECT_LOCATION
    WHERE project_id = v_proj_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteRequests` (IN `v_req_id` INT(11))  BEGIN
	-- Delete request by its id
	DELETE FROM REQUESTS
    WHERE request_id = v_req_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteSkills` (IN `v_sk_id` INT(11))  BEGIN
	DELETE FROM SKILLS
	WHERE skill_id = v_sk_Id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteSocial_Media` (IN `v_sm_email` VARCHAR(50))  BEGIN
	DELETE FROM SOCIAL_MEDIA
    WHERE sm_email = v_sm_email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteTasks` (IN `v_proj_id` INT(11), IN `v_task_id` INT(11))  BEGIN
	-- Remove a task (id) from specified proj_id
	DELETE FROM TASKS
    WHERE project_id = v_proj_id
    AND task_id = v_task_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteVolunteer` (IN `v_vol_id` INT(11))  BEGIN
		DELETE FROM VOLUNTEER
		WHERE person_id = v_vol_id;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteVolunteer_Groups` (IN `v_group_id` INT(11), IN `v_prsn_id` INT(11))  BEGIN
	-- Remove a volunteer (id) from a group (id)
	DELETE FROM volunteer_groups
    WHERE group_id = v_group_id
    AND person_id = v_prsn_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteVolunteer_Skills` (IN `v_prsn_id` INT(11))  BEGIN
	DELETE FROM VOLUNTEER_SKILLS
	WHERE person_id = v_prsn_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteVolunteer_Tasks` (IN `v_vol_id` INT(11))  BEGIN
	DELETE FROM VOLUNTEER_TASKS
    WHERE person_id = v_vol_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteWarehouse` (IN `v_wh_id` INT(11))  BEGIN
	DELETE FROM WAREHOUSE
	WHERE warehouse_id = v_wh_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteWarehouse_Product` (IN `v_wh_id` INT(11), IN `v_prod_id` INT(11))  BEGIN
	DELETE FROM WAREHOUSE_PRODUCT
    WHERE warehouse_id = v_wh_id
    AND product_id = v_prod_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteWebsite` (IN `v_web_username` VARCHAR(45))  BEGIN
	DELETE FROM WEBSITE
    WHERE web_username = v_web_username;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getClient` (IN `v_client_status` VARCHAR(25))  BEGIN
	-- Get list of client_names based on specified status
    SELECT person_name, client_status
    FROM PERSON, CLIENT
    WHERE person.person_id = client.person_id
    AND client_status = v_client_status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getDisaster` (IN `v_disaster_name` VARCHAR(30))  BEGIN
	-- Get disaster record by its name
	SELECT disaster_id, disaster_date, disaster_name, disaster_desc
    FROM DISASTER
    WHERE disaster_name = v_disaster_name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getDonor` (IN `v_dnr_type` VARCHAR(25))  BEGIN
	-- Get donation_amount based on donation_type
    SELECT donation_amount
    FROM DONOR
    WHERE donation_type = v_dnr_type;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getEmployee` (IN `v_emp_dept` VARCHAR(50))  BEGIN
	-- Get all employees from a specified department
	SELECT person_name, person_email, department
    FROM PERSON, EMPLOYEE
    WHERE person.person_id = employee.person_id
    AND department = v_emp_dept;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getEmployee2` ()  NO SQL
BEGIN
	-- Get all employees (id, name, email, dept, job_desc)
	SELECT employee.person_id, person.person_name, person.person_email, 				employee.department, employee.job_desc
    FROM person, employee
    WHERE person.person_id = employee.person_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getEncounter` (IN `v_req_id` INT(11))  NO SQL
BEGIN
	-- Get assoicated project (id) of a specified request (id)
    SELECT project_id
    FROM encounter
    WHERE request_id = v_req_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getEncounter2` (IN `v_proj_id` INT(11))  NO SQL
BEGIN
	-- Get associated request (id) of a specified project (id)
    SELECT request_id
    FROM encounter
    WHERE project_id = v_proj_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getGroups` (IN `v_grp_id` INT(11))  BEGIN
	-- Get group name, group leader, group_desc by group id
	SELECT groups.group_name, groups.group_desc, groups.group_id, person.person_id, person.person_name
    FROM GROUPS, PERSON
    WHERE groups.group_leader = person.person_id
    AND group_id = v_grp_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getGroup_Location` (IN `v_grp_id` INT(11))  BEGIN
	-- Get location (address) of spefied group (id)
	SELECT LOCATION.location_address
    FROM GROUP_LOCATION, LOCATION
    WHERE GROUP_LOCATION.location_id = LOCATION.location_id
    AND GROUP_LOCATION.group_id = v_grp_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getGroup_Tasks` (IN `v_grp_id` INT(11))  BEGIN
	-- Get all tasks assigned to a group (by its id)
	SELECT group_tasks.task_id, tasks.task_desc
    FROM group_tasks, tasks, groups
    WHERE group_tasks.task_id = tasks.task_id
    AND group_tasks.group_id = groups.group_id
    AND group_tasks.group_id = v_grp_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getGroup_Tasks2` (IN `v_task_id` INT)  NO SQL
BEGIN
	-- Get group info (id, name) by specified task (id)
	SELECT group_tasks.task_id, group_tasks.group_id, 		  				groups.group_name
	FROM group_tasks, groups
	WHERE group_tasks.group_id = groups.group_id
	AND group_tasks.task_id = v_task_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getLocation` (IN `v_loc_desc` VARCHAR(45))  BEGIN
	SELECT location_id, location_address
    FROM LOCATION
    WHERE location_desc LIKE CONCAT("%",v_loc_desc,"%");
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getPerson` (IN `v_prsn_email` VARCHAR(50))  BEGIN
	-- Get person info based on their email
	SELECT *
    FROM person
    WHERE person_email = v_prsn_email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getPerson2` (IN `v_disas_id` INT(11), IN `v_req_id` INT(11))  NO SQL
BEGIN
	-- Get person info based on his/her request id
    SELECT person.person_id, person.person_name, person.person_address, 				person.person_phone, person.person_email
    FROM person, requests, encounter
    WHERE encounter.person_id = person.person_id
    AND encounter.request_id = requests.request_id
    AND encounter.disaster_id = v_disas_id
    AND encounter.request_id = v_req_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getPhone_Calls` (IN `v_req_id` INT(11))  BEGIN
	SELECT phone_num
    FROM PHONE_CALLS
    WHERE request_id = v_req_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getProduct` (IN `v_prod_id` INT(11))  BEGIN
	SELECT product_quantity
	FROM PRODUCT
	WHERE product_id = v_prod_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getProduct_Requests` (IN `v_product_id` INT(11), IN `v_req_id` INT(11))  BEGIN
	SELECT product_id
    FROM PRODUCT_REQUESTS
    WHERE request_id = v_req_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getProject` (IN `v_disaster_id` INT(11))  BEGIN
	-- Get all projects (id, name, desc, status) by specified disaster_id
	SELECT project.project_id, project.project_name, project.project_desc, 				requests.request_status
	FROM project, disaster, encounter, requests
	WHERE encounter.project_id = project.project_id 
	AND encounter.disaster_id = disaster.disaster_id
    AND encounter.request_id = requests.request_id
	AND encounter.disaster_id = v_disaster_id
    ORDER BY project.project_id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getProject_Location` (IN `v_loc_id` INT(11))  BEGIN
	-- Get list of all projects (id, name, desc) of specified location (id)
	SELECT PROJECT_LOCATION.project_id, PROJECT.project_name, PROJECT.project_desc
    FROM PROJECT, PROJECT_LOCATION, LOCATION
    WHERE PROJECT.project_id = PROJECT_LOCATION.project_id
    AND PROJECT_LOCATION.location_id = LOCATION.location_id
    AND PROJECT_LOCATION.location_id = v_loc_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getProject_Location2` (IN `v_proj_id` INT(11))  NO SQL
BEGIN
	-- Get project info (name, desc, location) from specified proj id
	SELECT project.project_name, project.project_desc, location.location_address
    FROM PROJECT, PROJECT_LOCATION, LOCATION
    WHERE PROJECT_LOCATION.project_id = project.project_id
    AND PROJECT_LOCATION.location_id = LOCATION.location_id
    AND project.project_id = v_proj_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getRequests` (IN `v_req_status` VARCHAR(30))  BEGIN
	-- Get all requests that have "open" status
	SELECT request_id, request_time, request_desc
    FROM REQUESTS
    WHERE request_status = v_req_status;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getRequests2` (IN `v_disas_id` INT(11))  NO SQL
BEGIN
	-- Get all requests by specified disaster id
    SELECT requests.request_id, requests.request_time, requests.request_type, 			requests.request_desc, requests.request_status, person.person_name
    FROM encounter, requests, person
    WHERE encounter.request_id = requests.request_id
    AND encounter.person_id = person.person_id
    AND encounter.disaster_id = v_disas_id
    ORDER BY request_time DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getRequests3` (IN `v_disas_id` INT(11), IN `v_req_id` INT(11))  NO SQL
BEGIN
	-- Get request info by specified disaster id and request id
    SELECT requests.request_id, requests.request_time, requests.request_type, 			requests.request_desc, requests.request_status
    FROM requests, encounter
    WHERE encounter.request_id = requests.request_id 
    AND encounter.disaster_id = v_disas_id
    AND encounter.request_id = v_req_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getSkills` (IN `v_keyword` VARCHAR(50))  BEGIN
	SELECT * FROM SKILLS
	WHERE skill_desc LIKE CONCAT("%",v_keyword,"%");
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getSocial_Media` (IN `v_req_id` INT(11), IN `v_sm_email` VARCHAR(50))  BEGIN
	SELECT sm_email
    FROM SOCIAL_MEDIA
    WHERE request_id = v_req_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getTasks` (IN `v_proj_id` INT(11))  BEGIN
	-- Get list of tasks and respective group info for specified project (id)
    SELECT tasks.task_id, tasks.task_desc, groups.group_id, groups.group_name, 				groups.group_leader
	FROM group_tasks, groups, tasks, project
	WHERE group_tasks.task_id = tasks.task_id
	AND group_tasks.group_id = groups.group_id
	AND tasks.project_id = project.project_id
	AND project.project_id = v_proj_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getTasks2` (IN `v_proj_id` INT)  NO SQL
BEGIN
	-- Get list of tasks for specified project (id)
    SELECT task_id, task_desc
	FROM tasks
	WHERE project_id = v_proj_id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getVolunteer` ()  BEGIN
	-- Get all volunteer info (id, name, availability) 
	SELECT volunteer.person_id, person.person_name, volunteer.availability
    FROM VOLUNTEER, PERSON
    WHERE person.person_id = volunteer.person_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getVolunteer_Groups` (IN `v_group_id` INT(11))  BEGIN
	-- Get list of volunteers (id, name) for specified group (id)
	SELECT volunteer_groups.group_id, volunteer_groups.person_id, person.person_name
    FROM volunteer_groups, person
    WHERE volunteer_groups.person_id = person.person_id 
    AND group_id = v_group_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getVolunteer_Skills` (IN `v_vol_id` INT(11))  BEGIN
	SELECT * FROM VOLUNTEER_SKILLS
	WHERE person_id = v_vol_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getVolunteer_Tasks` (IN `v_vol_id` INT(11))  BEGIN
	SELECT * FROM VOLUNTEER_TASKS
    WHERE person_id = v_vol_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getWarehouse` (IN `v_wh_id` INT(11))  BEGIN
	SELECT location_id
	FROM WAREHOUSE
	WHERE warehouse_id = v_wh_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getWarehouse_Product` (IN `v_prod_id` INT(11))  BEGIN
	-- Get warehouse info (id, name, address) of a specified product
	SELECT WAREHOUSE.warehouse_id, WAREHOUSE.warehouse_name, LOCATION.location_address
    FROM WAREHOUSE_PRODUCT, WAREHOUSE, LOCATION
    WHERE WAREHOUSE_PRODUCT.warehouse_id = WAREHOUSE.warehouse_id
    AND WAREHOUSE.location_id = LOCATION.location_id
    AND WAREHOUSE_PRODUCT.product_id = v_prod_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getWebsite` (IN `v_req_id` INT(11))  BEGIN
	SELECT web_username
    FROM WEBSITE
    WHERE request_id = v_req_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertClient` (IN `v_client_desc` VARCHAR(150), IN `v_client_status` VARCHAR(25))  BEGIN
	-- Insert new client based on person_id, client_desc, client_status
    INSERT INTO CLIENT (client_desc, client_status)
	VALUES (v_client_desc, v_client_status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertDisaster` (IN `v_disaster_desc` VARCHAR(100), IN `v_disaster_date` DATE, IN `v_disaster_name` VARCHAR(30))  BEGIN
	-- Insert new disaster record
    INSERT INTO DISASTER (disaster_desc, disaster_date, disaster_name)
    VALUES (v_disaster_desc, v_disaster_date, v_disaster_name);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertDonor` (IN `v_dnr_id` INT(11), IN `v_dnr_type` VARCHAR(100), IN `v_dnr_amt` INT(11))  BEGIN
	-- insert new donor based on person_id, donation_type, and donation amount
	INSERT INTO DONOR (person_id, donation_type, donation_amount)
    VALUES (v_dnr_id, v_dnr_type, v_dnr_amt);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertEmployee` (IN `v_emp_id` INT(11), IN `v_emp_job_desc` VARCHAR(100), IN `v_emp_dept` VARCHAR(45))  BEGIN
	INSERT INTO EMPLOYEE (person_id, job_desc, department)
    VALUES (v_emp_id, v_emp_job_desc, v_emp_dept);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertEncounter` (IN `v_disas_id` INT(11), IN `v_proj_id` INT(11), IN `v_req_id` INT(11), IN `v_prsn_id` INT(11), OUT `last_enc_id` INT(11))  NO SQL
BEGIN
	-- Create new encounter 
    INSERT INTO encounter (disaster_id, project_id, request_id, person_id)
    VALUES (v_disas_id, v_proj_id, v_req_id, v_prsn_id);
    SET last_enc_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertGroups` (IN `v_grp_name` VARCHAR(45), IN `v_grp_desc` VARCHAR(100), `v_grp_leader` VARCHAR(45), IN `v_grp_spec` VARCHAR(45))  BEGIN
	-- Insert new group
	INSERT INTO GROUPS (group_name, group_desc, group_leader, group_specialization)
	VALUES (v_grp_name, v_grp_desc, v_grp_leader, v_grp_spec);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertGroup_Location` (IN `v_grp_id` INT(11), IN `v_loc_id` INT(11))  BEGIN
	INSERT INTO GROUP_LOCATION (group_id, location_id)
    VALUES (v_grp_id, v_loc_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertGroup_Tasks` (IN `v_grp_id` INT(11), IN `v_task_id` INT(11))  BEGIN
	-- Assign a group (id) a specified task (id)
	INSERT INTO GROUP_TASKS (group_id, task_id)
	VALUES (v_grp_id, v_task_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertLocation` (IN `v_loc_desc` VARCHAR(45), IN `v_loc_add` VARCHAR(80), OUT `last_loc_id` INT)  BEGIN
	-- Create new location (desc, address)
	INSERT INTO LOCATION (location_desc, location_address)
    VALUES (v_loc_desc, v_loc_add);
    SET last_loc_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertPerson` (IN `v_prsn_name` VARCHAR(50), IN `v_prsn_add` VARCHAR(100), IN `v_prsn_ph` VARCHAR(10), IN `v_prsn_email` VARCHAR(50), OUT `last_prsn_id` INT(11))  BEGIN
	-- Insert new record for individual
	INSERT INTO PERSON (person_name, person_address, person_phone, 									person_email)
    VALUES (v_prsn_name, v_prsn_add, v_prsn_ph, v_prsn_email);
    SET last_prsn_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertPhone_Calls` (IN `v_req_id` INT(11), IN `v_phone_num` VARCHAR(10))  BEGIN
	INSERT INTO PHONE_CALLS (request_id, phone_number)
    VALUES (v_req_id, v_phone_num);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertProduct` (IN `v_prod_type` VARCHAR(45), IN `v_prod_qty` INT(11))  BEGIN
	INSERT INTO PRODUCT (product_type, product_quantity)
	VALUES (v_prod_type, v_prod_qty);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertProduct_Requests` (IN `v_product_id` INT(11), IN `v_req_id` INT(11))  BEGIN
	INSERT INTO PRODUCT_REQUESTS(product_id, request_id)
    VALUES (v_product_id, v_req_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertProject` (IN `v_proj_name` VARCHAR(100), IN `v_proj_desc` VARCHAR(100), OUT `last_proj_id` INT(11))  BEGIN
	-- Insert new project based on project_name and project_description
    INSERT INTO PROJECT (project_name, project_desc)
    VALUES (v_proj_name, v_proj_desc);
    SET last_proj_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertProject_Location` (IN `v_proj_id` INT(11), IN `v_loc_id` INT(11))  BEGIN
	-- Assign a project (id) to a location(id)
	INSERT INTO PROJECT_LOCATION (project_id, location_id)
    VALUES (v_proj_id, v_loc_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertRequests` (IN `v_req_time` DATETIME, IN `v_req_type` VARCHAR(10), IN `v_req_desc` VARCHAR(300), IN `v_req_status` VARCHAR(11), OUT `last_req_id` INT(11))  BEGIN
	INSERT INTO REQUESTS (request_time, request_type, request_desc, 									request_status)
    VALUES (v_req_time, v_req_type, v_req_desc, v_req_status);
    SET last_req_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertSkills` (IN `v_sk_desc` VARCHAR(50), OUT `last_skill_id` INT)  BEGIN
	-- Insert a new skill
	INSERT INTO SKILLS (skill_desc)
	VALUES (v_sk_desc);
    SET last_skill_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertSocial_Media` (IN `v_req_id` INT(11), IN `v_sm_email` VARCHAR(50))  BEGIN
	INSERT INTO SOCIAL_MEDIA (request_id, sm_email)
    VALUES (v_req_id, v_sm_email);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertTasks` (IN `v_task_desc` VARCHAR(100), IN `v_proj_id` INT(11), OUT `last_id` INT)  BEGIN
	-- Create new task (desc) for specified project (id)
	INSERT INTO TASKS (task_desc, project_id)
    VALUES (v_task_desc, v_proj_id);
    SET last_id = LAST_INSERT_ID();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertVolunteer` (IN `v_vol_id` INT(11), IN `v_hours` VARCHAR(50))  BEGIN
	INSERT INTO VOLUNTEER (person_id, availability) 
    VALUES (v_vol_id, v_hours);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertVolunteer_Groups` (IN `v_grp_id` INT(11), IN `v_prsn_id` INT(11))  BEGIN
	-- Add a volunteer (id) to a group (id)
	INSERT INTO VOLUNTEER_GROUPS (group_id, person_id)
    VALUES (v_grp_id, v_prsn_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertVolunteer_Skills` (IN `v_vol_id` INT(11), IN `v_skill_no` INT(11))  BEGIN
	INSERT INTO VOLUNTEER_SKILLS (person_id, skill_id)
	VALUES (v_vol_id, v_skill_no);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertVolunteer_Tasks` (IN `v_prsn_id` INT(11), IN `v_tsk_id` INT(11))  BEGIN
	INSERT INTO VOLUNTEER_TASKS (person_id, task_id)
    VALUES (v_prsn_id, v_tsk_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertWarehouse` (IN `v_wh_name` VARCHAR(45), IN `v_loc_id` INT(11))  BEGIN
	INSERT INTO WAREHOUSE (warehouse_name, location_id)
	VALUES (v_wh_name, v_loc_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertWarehouse_Product` (IN `v_wh_id` INT(11), IN `v_prod_id` INT(11))  BEGIN
	INSERT INTO WAREHOUSE_PRODUCT (warehouse_id, product_id)
    VALUES (v_wh_id, v_prod_id);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertWebsite` (IN `v_req_id` INT(11), `v_web_username` VARCHAR(45))  BEGIN
	INSERT INTO WEBSITE (request_id, web_username)
    VALUES (v_req_id, v_web_username);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateClient` (IN `v_client_id` INT(11), IN `v_client_status` VARCHAR(30))  BEGIN
	-- Update client's status based on person_id
    UPDATE CLIENT
    SET client_status = v_client_status
    WHERE person_id = v_client_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateDisaster` (IN `v_disaser_desc` VARCHAR(80))  BEGIN
	-- Update disaster_desc based on disaster_id
    UPDATE DISASTER
    SET disaster_desc = v_disaster_desc
    WHERE disaster_id = v_disaster_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateDonor` (IN `v_dnr_name` VARCHAR(25), IN `v_dnr_amt` INT(11))  BEGIN
	-- Update donation amount based on person_name
    UPDATE DONOR
    SET donation_amount = v_dnr_amt
    WHERE person.person_id = donor.person_id
    AND person.person_name = v_dnr_name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateEmployee` (IN `v_emp_id` INT(11), IN `v_emp_job_desc` VARCHAR(100))  BEGIN
	-- Update employee's job description based on person_id
	UPDATE EMPLOYEE
	SET job_desc = v_emp_job_desc
	WHERE person_id = v_emp_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateEncounter` (IN `v_disas_id` INT(11), IN `v_proj_id` INT(11), IN `v_req_id` INT(11), IN `v_prsn_id` INT(11))  NO SQL
BEGIN
	-- Assign a project to an encounter
    UPDATE encounter
    SET project_id = v_proj_id
    WHERE disaster_id = v_disas_id
    AND request_id = v_req_id
    AND person_id = v_prsn_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateGroups` (IN `v_grp_id` INT(11), IN `v_grp_leader` INT(11))  BEGIN
	-- Change group leader (id) of a specified group (id)
    UPDATE GROUPS
    SET group_leader = v_grp_leader
    WHERE group_id = v_grp_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateGroup_Location` (IN `v_grp_id` INT(11), IN `v_loc_id` INT(11))  BEGIN
	UPDATE GROUP_LOCATION
	SET location_id = v_loc_id
	WHERE group_id = v_group_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateGroup_Tasks` (IN `v_task_id` INT(11), IN `v_grp_id` INT(11))  BEGIN
	-- change assigned group (id) for a task (id)
	UPDATE group_tasks
	SET group_id = v_grp_id
	WHERE task_id = v_task_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateGroup_Tasks2` (IN `v_grp_id` INT, IN `v_task_id` INT)  NO SQL
BEGIN
    -- change assigned task (id) for a group (id)
	UPDATE group_tasks
	SET task_id = v_task_id
	WHERE group_id = v_grp_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateLocation` (IN `v_loc_id` INT(11), `v_loc_add` VARCHAR(80))  BEGIN
	UPDATE LOCATION
    SET location_address = v_loc_add
    WHERE location_id = v_loc_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePerson` (IN `v_prsn_name` VARCHAR(50), IN `v_prsn_phone` VARCHAR(10))  BEGIN
	UPDATE PERSON
    SET person_phone = v_prsn_phone
    WHERE person_name = v_prsn_name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePhone_Calls` (IN `v_req_id` INT(11), IN `v_phone_num` VARCHAR(10))  BEGIN
	UPDATE PHONE_CALLS
    SET phone_num = v_phone_num
    WHERE request_id = v_req_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateProduct` (IN `v_prod_id` INT(11), IN `v_prod_qty` INT(11))  BEGIN
	UPDATE PRODUCT
	SET product_quantity = v_prod_qty
	WHERE product_id = v_prod_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateProduct_Requests` (IN `v_product_id` INT(11), `v_req_id` INT(11))  BEGIN
	UPDATE PRODUCT_REQUESTS
    SET product_id = v_product_id
    WHERE request_id = v_req_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateProject` (IN `v_proj_id` INT(11), IN `v_proj_name` VARCHAR(45), IN `v_proj_desc` VARCHAR(100))  BEGIN
	-- Change project name, project_desc by its project_id
    UPDATE PROJECT
    SET project_name = v_proj_name, project_desc = v_proj_desc
    WHERE project_id = v_proj_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateProject_Location` (IN `v_proj_id` INT(11), IN `v_loc_id` INT(11))  BEGIN
	-- Change a project's location id
	UPDATE PROJECT_LOCATION
    SET location_id = v_loc_id
    WHERE project_id = v_proj_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateRequests` (IN `v_req_id` INT(11), IN `v_req_status` VARCHAR(30))  BEGIN
	-- Change request satus for specified request (id)
	UPDATE REQUESTS
    SET request_status = v_req_status
    WHERE request_id = v_req_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateSkills` (IN `v_sk_id` INT(11), IN `v_sk_desc` VARCHAR(50))  BEGIN
	UPDATE SKILLS
	SET skill_desc = v_sk_desc
	WHERE skill_id = v_sk_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateSocial_Media` (IN `v_req_id` INT(11), IN `v_sm_email` VARCHAR(50))  BEGIN
	UPDATE SOCIAL_MEDIA
    SET sm_email = v_sm_email
    WHERE request_id = v_req_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateStatus` (IN `v_client_id` INT(11), IN `v_client_status` VARCHAR(30))  BEGIN
	-- UPdate client's status based on person_id
    UPDATE CLIENT
    SET client_status = v_client_status
    WHERE person_id = v_client_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateTasks` (IN `v_proj_id` INT(11), IN `v_task_id` INT(11), IN `v_task_desc` VARCHAR(100))  BEGIN
	-- update a task's desc from specified proj id & task id
	UPDATE TASKS
    SET task_desc = v_task_desc
    WHERE project_id = v_proj_id
    AND task_id = v_task_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateVolunteer` (IN `v_vol_id` INT(11), IN `v_hours` VARCHAR(30))  BEGIN
	UPDATE VOLUNTEER 
    SET availability = v_hours
    WHERE person_id = v_vol_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateVolunteer_Groups` (IN `v_prsn_id` INT(11), IN `v_grp_id` INT(11))  BEGIN
	UPDATE VOLUNTEER_GROUPS
    SET group_id = v_grp_id
    WHERE person_id = v_prsn_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateVolunteer_Skills` (IN `_v_vol_id` INT(11), IN `v_skill_no` INT(11))  BEGIN
	UPDATE VOLUNTEER_SKILLS
	SET skill_id = v_skill_no
	WHERE person_id = v_vol_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateVolunteer_Tasks` (IN `v_vol_id` INT(11), IN `v_tsk_id` INT(11))  BEGIN
	UPDATE VOLUNTEER_TASKS
    SET task_id = v_tsk_id
    WHERE person_id = v_vol_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateWarehouse` (IN `v_wh_id` INT(11), IN `v_wh_name` VARCHAR(45))  BEGIN
	UPDATE WAREHOUSE
	SET warehouse_name = v_wh_name
	WHERE warehouse_id = v_wh_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateWarehouse_Product` (IN `v_prod_id` INT(11), IN `v_wh_id` INT(11))  BEGIN
	-- Change where product is stored (diff warehouse)
	UPDATE WAREHOUSE_PRODUCT
    SET warehouse_id = v_wh_id
    WHERE product_id = v_prod_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateWebsite` (IN `v_req_id` INT(11), IN `v_web_useranme` VARCHAR(45))  BEGIN
	UPDATE WEBSITE
    SET web_username = v_web_username
	WHERE request_id = v_req_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `person_id` int(11) NOT NULL,
  `client_desc` varchar(100) NOT NULL,
  `client_status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`person_id`, `client_desc`, `client_status`) VALUES
(10, 'Height: 5.07 Weight:147lb, Appearance: White Pants, Blue Hoodie', 'Active'),
(11, 'Height: 5\'10\", Weight: 170 lb, Appearance: Red Hat, Blue Jeans, Red shirt', 'Active'),
(12, 'Height: 5\'11\", Weight: 190 lb, Appearance: Green Jacket, Blue Shorts', 'Active'),
(13, 'Height: 5\'3\", Weight: 155 lb, Appearance: Blue Shirt, Red Pants', 'Active'),
(14, 'Height: 5\'7\", Weight: 147 lb, Appearance: White Pants, Blue Hoodie', 'Active'),
(15, 'Height: 5\'4\", Weight: 120 lb, Appearance: White Shirt, Blue Jeans', 'Missing');

-- --------------------------------------------------------

--
-- Table structure for table `disaster`
--

CREATE TABLE `disaster` (
  `disaster_id` int(11) NOT NULL,
  `disaster_desc` varchar(80) NOT NULL,
  `disaster_date` date NOT NULL,
  `disaster_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `disaster`
--

INSERT INTO `disaster` (`disaster_id`, `disaster_desc`, `disaster_date`, `disaster_name`) VALUES
(1, 'Category 4 Hurricane', '2017-08-17', 'Hurricane Harvey'),
(2, 'Category 5 Hurricane', '2017-08-30', 'Hurricane Irma'),
(3, 'Magnitude 7.8 Earthquake & Fire', '1906-04-18', 'San Francisco Earthquake'),
(4, 'Heat Wave in Chicago', '1995-07-13', 'Heat Wave'),
(5, 'Tropical Cyclone Category 5', '2005-08-23', 'Hurricane Katrina');

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `person_id` int(11) NOT NULL,
  `donation_type` varchar(45) NOT NULL,
  `donation_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`person_id`, `donation_type`, `donation_amount`) VALUES
(5, 'Money', 10000),
(6, 'Food Packets', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `person_id` int(11) NOT NULL,
  `job_desc` varchar(100) NOT NULL,
  `department` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`person_id`, `job_desc`, `department`) VALUES
(6, 'Research Scientist', 'Research & Development'),
(7, 'Recruiter', 'Human Resources'),
(8, 'Assistant Controller', 'Accounting & Finance'),
(9, 'System Analyst', 'Technical Support'),
(10, 'Operations Coordinator', 'Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `encounter`
--

CREATE TABLE `encounter` (
  `encounter_id` int(11) NOT NULL,
  `disaster_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `request_id` int(11) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `encounter`
--

INSERT INTO `encounter` (`encounter_id`, `disaster_id`, `project_id`, `request_id`, `person_id`) VALUES
(1, 1, 4, 1, 10),
(2, 5, 2, 3, 11),
(3, 3, 3, 4, 12),
(4, 2, 5, 2, 13),
(5, 2, 1, 6, 13),
(6, 2, 4, 4, 11),
(7, 2, 3, 3, 12),
(16, 2, NULL, 10, 11);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(45) NOT NULL,
  `group_desc` varchar(100) NOT NULL,
  `group_leader` int(11) NOT NULL,
  `group_specialization` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `group_desc`, `group_leader`, `group_specialization`) VALUES
(1, 'Medical Team', 'Helps with medical emergencies', 10, 'Medical'),
(2, 'Sandbag Team', 'Helps set up sandbags when required', 8, 'Sandbag'),
(3, 'Rescue Team', 'Helps with search and rescues', 7, 'Rescue'),
(4, 'Driving Team', 'Responsible for driving under extreme conditions', 6, 'Driving'),
(5, 'Swimming Team', 'Assists in rescues that require swimming or that are around water', 10, 'Swimming'),
(6, 'Line Technicians', 'Provides support to restore/provide power', 6, 'Installing generators'),
(7, 'Warehouse Team', 'Manages all related activities to products stored in warehouses', 6, 'Inventory management');

-- --------------------------------------------------------

--
-- Table structure for table `group_location`
--

CREATE TABLE `group_location` (
  `group_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group_location`
--

INSERT INTO `group_location` (`group_id`, `location_id`) VALUES
(1, 2),
(2, 1),
(3, 1),
(4, 5),
(5, 3),
(6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `group_tasks`
--

CREATE TABLE `group_tasks` (
  `group_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group_tasks`
--

INSERT INTO `group_tasks` (`group_id`, `task_id`) VALUES
(1, 5),
(1, 6),
(2, 1),
(3, 4),
(4, 2),
(4, 7),
(6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_desc` varchar(45) NOT NULL,
  `location_address` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_desc`, `location_address`) VALUES
(1, 'Behind Walmart', '1456 Wicker St, Hammond, IN-46323'),
(2, 'Near Police Dept', '19456 Marsh St, Lansing, IL-60438'),
(3, 'Near Speedway', '1675 45th St, Munster, IN-46321'),
(4, 'Near Central Park', '1876 171st St, Hammond, IN-46323'),
(5, 'Near Community Hospital', '14253 Valparaiso Dr, Muster, IN-46321'),
(6, 'Near ALDI', '19923 Bernice Rd, Lansing, IL-60438'),
(7, 'Nearest corner: 173rd St & Kennedy Ave', '(41.577024, -87.451619)');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `person_id` int(11) NOT NULL,
  `person_name` varchar(50) NOT NULL,
  `person_address` varchar(100) NOT NULL,
  `person_phone` varchar(10) NOT NULL,
  `person_email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `person_name`, `person_address`, `person_phone`, `person_email`) VALUES
(1, 'John Smith', '694 Greywall Ln, Hammond', '9904204678', 'jhsmith77@gmail.com'),
(2, 'David Jackson', '171st St, Munster', '7739821435', 'dj1173@yahoo.com'),
(3, 'Brandon Marshal', '2732 Margo Ln, Munster', '2579741234', 'bmarshal13@google.com'),
(4, 'Amy Smith', '4321 Park St, Lansing', '9724569873', 'SmithAmy@yahoo.com'),
(5, 'Michael Wilson', 'Marsh St, Schererville', '7872456578', 'Mwilson@yahoo.com'),
(6, 'Michelle Foster', '189th St, Hammond', '7739861245', 'FosterM98@gmail.com'),
(7, 'Sarah Miller', 'New Devon St, Lansing', '7084767654', 'Smills983@yahoo.com'),
(8, 'David Mark', '9824 Wicker St, Hammond', '2199834632', 'dm0089@hotmail.com'),
(9, 'Jacob Marcus', '9344 Fischer St, Hammond', '2199123632', 'fishMark@gmail.com'),
(10, 'David Starc', '7834 Park St, Calumet City', '7738924578', 'daveStar97@yahoo.com'),
(11, 'Crystal Ramos', '3685 Duffy St., LaPorte, IN. 46350', '2198513166', 'cr11@hotmail.com'),
(12, 'Joanna Harris', '3794 Stewart St., Indianapolis, IN. 46202', '3177159145', 'jh12@yahoo.com'),
(13, 'Brenda Richardson', '3794 Heliport Loop, Evansville, IN. 47710', '8127153937', 'br13@gmail.com'),
(14, 'Alexandra Lynch', '3431 Pearcy Ave., South Bend, IN. 46625', '2607889271', 'al14@yahoo.com'),
(15, 'Lucy Mendez', '3423 Sand Fork Rd., South Bend, IN 46601', '5746227736', 'lm15@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `phone_calls`
--

CREATE TABLE `phone_calls` (
  `request_id` int(11) NOT NULL,
  `phone_num` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phone_calls`
--

INSERT INTO `phone_calls` (`request_id`, `phone_num`) VALUES
(5, '2195551234'),
(6, '2194849810');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_type` varchar(45) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_type`, `product_quantity`) VALUES
(1, 'food packets', 8000),
(2, 'first Aid kits', 700),
(3, 'Women Clothing', 900),
(4, 'Men Clothing', 1200),
(5, 'Sleeping bags', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `product_requests`
--

CREATE TABLE `product_requests` (
  `product_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_requests`
--

INSERT INTO `product_requests` (`product_id`, `request_id`) VALUES
(1, 1),
(1, 5),
(1, 6),
(2, 2),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(45) NOT NULL,
  `project_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `project_desc`) VALUES
(1, 'Sandbagging', 'Set up sandbags along the river'),
(2, 'Deliver Food', 'Ensure everyone gets food'),
(3, 'Restore Power', 'Restore power to the area'),
(4, 'Move rescued', 'Move rescued people to shelters'),
(5, 'Medical', 'Provide medical attention to people who need it'),
(7, 'Rescue client', 'Free the client from her vehicle at target location');

-- --------------------------------------------------------

--
-- Table structure for table `project_location`
--

CREATE TABLE `project_location` (
  `project_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_location`
--

INSERT INTO `project_location` (`project_id`, `location_id`) VALUES
(1, 5),
(2, 1),
(3, 1),
(4, 2),
(5, 2),
(7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `request_time` datetime NOT NULL,
  `request_type` varchar(10) NOT NULL,
  `request_desc` varchar(300) NOT NULL,
  `request_status` varchar(11) NOT NULL DEFAULT 'Open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `request_time`, `request_type`, `request_desc`, `request_status`) VALUES
(1, '2018-02-14 00:00:00', 'Rescue', 'I\'m stuck on the roof', 'open'),
(2, '2018-02-20 10:23:11', 'Medical', 'My leg is broken', 'in-progress'),
(3, '2017-07-16 01:11:00', 'Rescue', 'Trapped in my house', 'closed'),
(4, '2018-02-22 12:14:22', 'Rescue', 'Im trapped in my car', 'in-progress'),
(5, '2018-01-29 09:11:55', 'Supply', 'I need food', 'closed'),
(6, '2018-02-10 07:01:53', 'Rescue', 'Stuck on roof', 'in-progress'),
(10, '2018-05-02 09:28:47', 'Supply', 'Need 2 gallons of distilled water', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `skill_id` int(11) NOT NULL,
  `skill_desc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`skill_id`, `skill_desc`) VALUES
(1, 'Doctor'),
(2, 'Rescuer'),
(3, 'Counseling'),
(4, 'Stress Management'),
(5, 'Survival Skills'),
(7, 'adult cpr');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `request_id` int(11) NOT NULL,
  `sm_email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`request_id`, `sm_email`) VALUES
(1, 'gutierrez@gmail.com '),
(2, 'savage@gmail.com ');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `task_desc` varchar(100) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `task_desc`, `project_id`) VALUES
(1, 'Set up sandbags on east side', 1),
(2, 'Deliver food to the stadium', 2),
(3, 'Setup generators at shelters', 3),
(4, 'Move rescued to shelter ', 4),
(5, 'Make sure everyone is treated', 5),
(6, 'Assist first-aid responders', 1),
(7, 'Deliver sandbags to target location', 1);

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `person_id` int(11) NOT NULL,
  `availability` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`person_id`, `availability`) VALUES
(1, 'mon-wed: 9-5pm'),
(2, 'Mon-Wed: 11:00am - 14:00pm'),
(3, 'Mon-Thurs: On Call'),
(4, 'Mon-Fri: All Day'),
(5, 'Mon 3-5pm');

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_groups`
--

CREATE TABLE `volunteer_groups` (
  `group_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `volunteer_groups`
--

INSERT INTO `volunteer_groups` (`group_id`, `person_id`) VALUES
(1, 1),
(1, 4),
(2, 1),
(2, 3),
(3, 3),
(4, 1),
(4, 2),
(4, 5),
(5, 2),
(5, 3),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_skills`
--

CREATE TABLE `volunteer_skills` (
  `skill_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `volunteer_skills`
--

INSERT INTO `volunteer_skills` (`skill_id`, `person_id`) VALUES
(1, 4),
(2, 3),
(3, 4),
(4, 4),
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `warehouse_id` int(11) NOT NULL,
  `warehouse_name` varchar(45) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`warehouse_id`, `warehouse_name`, `location_id`) VALUES
(1, 'Auto Storage', 3),
(2, 'Supply House', 4),
(3, 'UpLine Warehouse', 5),
(4, 'Star Logistics', 6);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_product`
--

CREATE TABLE `warehouse_product` (
  `warehouse_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warehouse_product`
--

INSERT INTO `warehouse_product` (`warehouse_id`, `product_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 2),
(3, 5),
(4, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `website`
--

CREATE TABLE `website` (
  `request_id` int(11) NOT NULL,
  `web_username` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `website`
--

INSERT INTO `website` (`request_id`, `web_username`) VALUES
(3, 'donxx90'),
(4, 'jose219');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `disaster`
--
ALTER TABLE `disaster`
  ADD PRIMARY KEY (`disaster_id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `encounter`
--
ALTER TABLE `encounter`
  ADD PRIMARY KEY (`encounter_id`),
  ADD KEY `encounter_disaster_id_fk_idx` (`disaster_id`),
  ADD KEY `encounter_project_id_fk_idx` (`project_id`),
  ADD KEY `encounter_request_id_fk_idx` (`request_id`),
  ADD KEY `encounter_client_id_fk_idx` (`person_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `groups_group_leader_fk` (`group_leader`);

--
-- Indexes for table `group_location`
--
ALTER TABLE `group_location`
  ADD PRIMARY KEY (`group_id`,`location_id`),
  ADD KEY `group_location_location_id_fk_idx` (`location_id`);

--
-- Indexes for table `group_tasks`
--
ALTER TABLE `group_tasks`
  ADD PRIMARY KEY (`group_id`,`task_id`),
  ADD KEY `group_tasks_task_id_fk_idx` (`task_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `phone_calls`
--
ALTER TABLE `phone_calls`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_requests`
--
ALTER TABLE `product_requests`
  ADD PRIMARY KEY (`product_id`,`request_id`),
  ADD KEY `product_requests_request_id_fk_idx` (`request_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `project_location`
--
ALTER TABLE `project_location`
  ADD PRIMARY KEY (`project_id`,`location_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`skill_id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `tasks_project_id_fk_idx` (`project_id`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `volunteer_groups`
--
ALTER TABLE `volunteer_groups`
  ADD PRIMARY KEY (`group_id`,`person_id`),
  ADD KEY `volunteer_groups_person_id_fk_idx` (`person_id`);

--
-- Indexes for table `volunteer_skills`
--
ALTER TABLE `volunteer_skills`
  ADD PRIMARY KEY (`skill_id`,`person_id`),
  ADD KEY `volunteer_skills_person_id_fk_idx` (`person_id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`warehouse_id`),
  ADD KEY `warehouse_location_id_fk_idx` (`location_id`);

--
-- Indexes for table `warehouse_product`
--
ALTER TABLE `warehouse_product`
  ADD PRIMARY KEY (`warehouse_id`,`product_id`),
  ADD KEY `warehouse_product_product_id_fk_idx` (`product_id`);

--
-- Indexes for table `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`request_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disaster`
--
ALTER TABLE `disaster`
  MODIFY `disaster_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `encounter`
--
ALTER TABLE `encounter`
  MODIFY `encounter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `warehouse_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_person_id_fk` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `donor`
--
ALTER TABLE `donor`
  ADD CONSTRAINT `donor_person_id_fk` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_person_id_fk` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `encounter`
--
ALTER TABLE `encounter`
  ADD CONSTRAINT `encounter_disaster_id_fk` FOREIGN KEY (`disaster_id`) REFERENCES `disaster` (`disaster_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `encounter_person_id_fk` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `encounter_project_id_fk` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `encounter_request_id_fk` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_group_leader_fk` FOREIGN KEY (`group_leader`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `group_location`
--
ALTER TABLE `group_location`
  ADD CONSTRAINT `group_location_group_id_fk` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `group_location_loc_id_fk` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `group_tasks`
--
ALTER TABLE `group_tasks`
  ADD CONSTRAINT `group_tasks_group_id_fk` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `group_tasks_task_id_fk` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `phone_calls`
--
ALTER TABLE `phone_calls`
  ADD CONSTRAINT `phone_calls_request_id_fk` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_requests`
--
ALTER TABLE `product_requests`
  ADD CONSTRAINT `product_requests_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_requests_request_id_fk` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `project_location`
--
ALTER TABLE `project_location`
  ADD CONSTRAINT `project_location_project_id_fk` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `social_media`
--
ALTER TABLE `social_media`
  ADD CONSTRAINT `social_media_request_id_fk` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_project_id_fk1` FOREIGN KEY (`project_id`) REFERENCES `project` (`project_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD CONSTRAINT `volunteer_person_id_fk` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `volunteer_groups`
--
ALTER TABLE `volunteer_groups`
  ADD CONSTRAINT `volunteer_groups_group_id_fk` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `volunteer_groups_person_id_fk` FOREIGN KEY (`person_id`) REFERENCES `volunteer` (`person_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `volunteer_skills`
--
ALTER TABLE `volunteer_skills`
  ADD CONSTRAINT `volunteer_skills_person_id_fk` FOREIGN KEY (`person_id`) REFERENCES `volunteer` (`person_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `volunteer_skills_skills_id_fk` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`skill_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD CONSTRAINT `warehouse_location_id_fk` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `warehouse_product`
--
ALTER TABLE `warehouse_product`
  ADD CONSTRAINT `warehouse_product_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `warehouse_product_warehouse_id_fk` FOREIGN KEY (`warehouse_id`) REFERENCES `warehouse` (`warehouse_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `website`
--
ALTER TABLE `website`
  ADD CONSTRAINT `website_request_id_fk` FOREIGN KEY (`request_id`) REFERENCES `requests` (`request_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
