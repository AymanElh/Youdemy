# Youdemy - Courses Managment Platform

## Project Context
The Youdemy online course platform aims to revolutionize learning by offering an interactive and personalized system for students and teachers.

## Required Features

### Front Office

#### Visitor
- Access to the course catalog with pagination.
- Search for courses by keywords.
- Account creation with role selection (Student or Teacher).

#### Student
- View the course catalog.
- Search and view course details (description, content, teacher, etc.).
- Enroll in a course after authentication.
- Access a "My Courses" section that lists enrolled courses.

#### Teacher
- Add new courses with details such as:
  - Title, description, content (video or document), tags, and category.
- Manage courses:
  - Edit, delete, and view enrollments.
- Access a "Statistics" section on courses:
  - Number of enrolled students, number of courses, etc.

### Back Office

#### Administrator
- Validate teacher accounts.
- User management:
  - Activation, suspension, or deletion.
- Content management:
  - Courses, categories, and tags.
- Bulk insertion of tags for efficiency.
- Access to global statistics:
  - Total number of courses, distribution by category, course with the most students, Top 3 teachers.

### Cross-functional Features
- A course can contain multiple tags (many-to-many relationship).
- Application of polymorphism in the following methods: Add course and display course.
- Authentication and authorization system to protect sensitive routes.
- Access control: each user can only access features corresponding to their role.

## Technical Requirements
- Adherence to OOP principles (encapsulation, inheritance, polymorphism).
- Relational database management with relationships (one-to-many, many-to-many).
- Use of PHP sessions for managing logged-in users.
- User data validation system to ensure security.

## Additional Feature
- Download the certificate as a PDF.

This documentation provides an overview of the key features and technical requirements for the Youdemy platform, ensuring a robust and secure online learning environment.
