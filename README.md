🏠 Hostel Management System

A web-based application built using PHP, MySQL, and HTML/CSS/JavaScript, designed to streamline hostel operations including student management, complaints handling, room assignments, payment tracking, and user authentication for both Admin and Students.

📌 Features

🔐 Authentication
Role-based login for Admins and Students
Secure session-based access control

🧑‍💼 Admin Features

Manage student records (Add/Edit/Delete)
Assign and update rooms
Handle student complaints and update their status
Post and broadcast notifications
Track and update payment statuses
View and manage student logins

👩‍🎓 Student Features

Login and view personalized dashboard
Submit complaints
View assigned room details
Check payment status
View notifications
Change password

🗂️ Project Structure

bash
Copy
Edit
hostel_mgmt_system/
│
├── index.php                # Landing page with login links
├── db.php                   # Database connection
├── session_check.php        # Session validation for role-based access
├── logout.php               # Logout script

├── admin_dashboard.php      # Admin dashboard main page
├── view_students.php        # View student list with edit/delete
├── update_student.php       # Update student information
├── delete_student.php       # Delete a student record
├── add_student_login.php    # Form to add student login credentials
├── view_complaints.php      # Admin view and manage complaints
├── post_notification.php    # Admin posts notification
├── update_payment.php       # Update payment status
├── student_logins.php       # View/manage student logins

├── student_login.php        # Student login page
├── student_dashboard.php    # Student dashboard
├── submit_complaint.php     # Form for student complaints
├── view_notifications.php   # Student view notifications
├── view_room.php            # Room details
├── view_payment.php         # Payment status
├── change_password.php      # Password update

├── assets/                  # Images (graduation.png, hostel_quote.png, etc.)
├── style.css                # Custom styling


🛠️ Technologies Used

Frontend: HTML, CSS (custom), JavaScript
Backend: PHP (session-based role validation)
Database: MySQL
Development Tool: XAMPP (Apache + MySQL)

🚀 How to Run Locally

1. Clone the repository
    bash
    Copy
    Edit
    git clone https://github.com/your-username/hostel-management-system.git
    cd hostel-management-system
2. Start local server (using XAMPP)
    Copy the project folder to htdocs/
    Open XAMPP and start Apache & MySQL

3. Create MySQL Database
    Open phpMyAdmin
    Create a new database named: hostel_db
    Import the SQL tables manually or use exported .sql file

4. Set up required tables
    admin
    admin_login
    students
    student_login
    room
    complaints
    payments
    notifications

5. Sample Credentials
    Admin: admin01 / admin123
    Student: Yogarasa P / 2022E110

🌱 Future Enhancements

Add Warden role for room management
Real-time complaint notification system
Generate downloadable PDF/CSV reports
Notification pop-up with read/unread status

👩‍💻 Author

Poojah Yogarasa.
3rd Year Computer Engineering Student

For any questions or feedback, feel free to reach out via LinkedIn - www.linkedin.com/in/poojah-yogarasa

