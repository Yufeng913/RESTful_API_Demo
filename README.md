# REST_API_Demo
***Example DB using RESTful APIs, submission for Tuco Technologies***

This project is a simple SQL database with a set of REST APIs to perform some simple CRUD operations.

Coded in PHP using Visual Studio Code  
Created in XAMPP  
API platform for testing: Postman  

The database contains the tables: **Agent, Property, and Listing**

## File Structure (for relevant content):
- config folder: contains database class for connection to MySQL using PDO.
- models folder: contains models for the tables: agent, property, listing
- API folder: API process files that will be tested and evaluated in Postman.
- Screenshots folder: contains screenshots of the RESTful API testing and evaluation in Postman along with respective descriptions of operations.
- SQL dump folder: contains the SQL dump file

## Table Structure
**Agent**
- id (primary key, AUTO_INCREMENT)
- category_id
- agent_name
- age
- email
- created_at (current_timestamp)

**Property**
- id (primary key, AUTO_INCREMENT)
- price
- address
- area
- agent
- created_at (current_timestamp)

**Listing**
- id (primary key, AUTO_INCREMENT)
- price
- address
- area
- agent
- available
- created_at (current_timestamp)

## APIs
- **read.php** (each table has their own respective GET API for reading the table)
  - agent: **sorted** by created_at ascending
  - property: **sorted** by created_at descending
  - listing: **filtered** by available: YES

- **read_single.php**
  - Reads a single entry by the specified ID for the **Agent** table *(list featured agent based on the ID)*  

- **create.php** 
  - Creates or adds (POST) an entry (specific API file for each table)

- **update.php** 
  - Updates (PUT) an existing entry (specific API file for each table)

- **delete.php** 
  - Deletes an existing entry (specific API file for each table)
