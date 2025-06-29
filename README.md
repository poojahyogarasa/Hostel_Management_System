# 🏨 Hostel Management System

A web-based application built using **PHP**, **MySQL**, and **HTML/CSS/JavaScript**, designed to streamline hostel operations including student management, complaints handling, room assignments, payment tracking, and user authentication for both Admin and Students.

---

## 📌 Features

### 🔐 Authentication
- Role-based login for **Admins** and **Students**
- Secure session-based access control

### 🧑‍💼 Admin Features
- Manage student records (Add/Edit/Delete)
- Assign and update rooms
- Handle student complaints and update their status
- Post and broadcast notifications
- Track and update payment statuses
- View and manage student logins

### 🧑‍🎓 Student Features
- Login and view personalized dashboard
- Submit complaints
- View assigned room details
- Check payment status
- View notifications
- Change password

---

## 📁 Project Structure
```bash
hostel_mgmt_system/
├── index.php              # Landing page with login links
├── db.php                 # Database connection
├── session_check.php      # Session validation for role-based access
├── logout.php             # Logout script
├── admin_dashboard.php    # Admin dashboard
├── view_students.php      # View/edit/delete student data
├── add_student_login.php  # Add student login credentials
├── update_student.php     # Update student record
├── delete_student.php     # Delete student
├── view_complaints.php    # Admin view complaints
├── post_notification.php  # Admin post announcements
├── update_payment.php     # Update student payment
├── student_logins.php     # View student login data
├── student_login.php      # Student login page
├── student_dashboard.php  # Student dashboard
├── submit_complaint.php   # Complaint form
├── view_notifications.php # View announcements
├── view_room.php          # View room assignment
├── view_payment.php       # View payment status
├── change_password.php    # Change password
├── assets/                # Images (graduation.png, quotes, etc.)
```

---

## 🚀 How to Run Locally

### 1. **Clone the repository**
```bash
git clone https://github.com/your-username/hostel-management-system.git
cd hostel-management-system
```

### 2. **Set up local server** (e.g., XAMPP)
- Place the project folder in `htdocs/`
- Start **Apache** & **MySQL**

### 3. **Create MySQL database**
- Open **phpMyAdmin**
- Create a database named: `hostel_db`
- Import SQL file (if available)

### 4. **Sample credentials**
- **Admin**: `admin01 / admin123`
- **Student**: `Yogarasa P / 2022E110`

---

## ✨ Author
**Poojah Y.**  
3rd Year Computer Engineering Student
For any questions or feedback, feel free to reach out via LinkedIn - www.linkedin.com/in/poojah-yogarasa
