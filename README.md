# Smart Monitor – IoT Device Management System

Smart Monitor is a web-based IoT Device Management System that allows users to register devices, simulate sensor data, monitor environmental readings, and receive alerts when abnormal conditions occur.

This project demonstrates core **Database Management System (DBMS)** concepts such as relational schema design, foreign key constraints, CRUD operations, joins, filtering, and aggregation.

---

## Tech Stack

Backend: PHP  
Database: MySQL (XAMPP)  
Frontend: HTML, CSS  
Server: Apache (XAMPP)

---

## Features

### User Authentication
- User registration
- Secure login using sessions
- Logout functionality

### Device Management
- Add new IoT devices
- View all devices owned by user
- Delete devices
- Toggle device status (Active / Inactive)
- Search devices by name

### Sensor Data Simulation
- Random temperature and humidity generation
- Data stored in database
- Simulates real IoT sensor behavior

### Sensor Data Monitoring
- View sensor readings for each device
- Displays temperature, humidity, and timestamp

### Alert System
- Automatic alert generation when temperature exceeds threshold
- View alerts linked to specific devices

### Dashboard Statistics
- Total number of devices
- Number of active devices
- Total alerts generated

---

## Database Schema

The system uses four relational tables.

### Users
Stores user authentication data.

| Column | Description |
|------|-------------|
| user_id | Primary Key |
| username | Unique username |
| password | User password |

### Devices
Stores IoT devices owned by users.

| Column | Description |
|------|-------------|
| device_id | Primary Key |
| user_id | Foreign Key → users |
| device_name | Device name |
| device_type | Type of device |
| location | Device location |
| status | Active / Inactive |
| created_at | Device creation time |

### Sensor Data
Stores environmental readings.

| Column | Description |
|------|-------------|
| data_id | Primary Key |
| device_id | Foreign Key → devices |
| temperature | Temperature value |
| humidity | Humidity value |
| recorded_at | Timestamp |

### Alerts
Stores abnormal device events.

| Column | Description |
|------|-------------|
| alert_id | Primary Key |
| device_id | Foreign Key → devices |
| message | Alert description |
| created_at | Timestamp |

Foreign key constraints ensure relational integrity and cascade deletion.

---

## DBMS Concepts Demonstrated

This project implements several important DBMS concepts:

- Primary Keys
- Foreign Keys
- ON DELETE CASCADE
- CRUD Operations
- JOIN Queries
- Aggregation (COUNT)
- Filtering with WHERE
- Pattern Search using LIKE
- Session-based access control

---

## System Workflow

1. User registers and logs into the system
2. User adds IoT devices
3. System simulates environmental sensor readings
4. Sensor data is stored in the database
5. Alerts are generated if thresholds are exceeded
6. Users can view device data and alerts through the dashboard

---

## How to Run the Project

1. Install XAMPP
2. Start Apache and MySQL
3. Copy project folder into:
C:\xampp\htdocs\
4. Import database using phpMyAdmin
5. Open browser and navigate to:

---

## Future Improvements

- Real IoT device integration using MQTT
- Data visualization using charts
- Password hashing for enhanced security
- Responsive UI design
- Device editing functionality
- Automated background sensor simulation

---

## Author

Developed as a DBMS project demonstrating IoT device monitoring concepts.
