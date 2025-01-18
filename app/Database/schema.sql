DROP DATABASE IF EXISTS youdemy_db;

CREATE DATABASE youdemy_db;

USE youdemy_db;


CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fullName VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    passwordHashed VARCHAR(255) NOT NULL,
    bio TEXT,
    profilePicture VARCHAR(255),
    dateOfBirth DATE,
    creationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    role ENUM('admin', 'teacher', 'student')
);


CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);


CREATE TABLE courses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    type ENUM('video', 'document') NOT NULL,
    description TEXT,
    content TEXT,
    teacherId INT,
    categoryId INT,
    creationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    isComplete TINYINT(1) DEFAULT 0,
    status ENUM('draft', 'published') DEFAULT 'draft',
    CONSTRAINT fk_course_teacher FOREIGN KEY (teacherId) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_course_category FOREIGN KEY (categoryId) REFERENCES categories(id) ON DELETE SET NULL
);

CREATE TABLE tags (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);


CREATE TABLE courseTags (
    courseId INT,
    tagId INT,
    PRIMARY KEY (courseId, tagId),
    CONSTRAINT fk_course_tags_course FOREIGN KEY (courseId) REFERENCES courses(id) ON DELETE CASCADE,
    CONSTRAINT fk_course_tags_tag FOREIGN KEY (tagId) REFERENCES tags(id) ON DELETE CASCADE
);


CREATE TABLE enrollments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    courseId INT,
    userId INT,
    enrollmentDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'completed') DEFAULT 'active',
    finishedDate DATE,
    CONSTRAINT fk_enroll_course FOREIGN KEY (courseId) REFERENCES courses(id),
    CONSTRAINT fk_enroll_student FOREIGN KEY (userId) REFERENCES users(id) 
)

-- Insert Users
INSERT INTO users (fullName, username, email, passwordHashed, role) VALUES
('John Doe', 'admin_user', 'admin@example.com', 'hashedpassword1', 'admin'),
('Jane Smith', 'teacher_user', 'teacher@example.com', 'hashedpassword2', 'teacher'),
('Michael Johnson', 'student_user', 'student@example.com', 'hashedpassword3', 'student');


-- Insert Categories
INSERT INTO categories (name) VALUES
('Web Development'),
('Data Science'),
('Design'),
('Marketing');


-- Insert Tags
INSERT INTO tags (name) VALUES
('Beginner'),
('Advanced'),
('JavaScript'),
('Python'),
('UI/UX'),
('Machine Learning');


-- Insert Courses
INSERT INTO courses (title, type, description, content, teacherId, categoryId, status) VALUES
('Introduction to Web Development', 'video', 'Learn the basics of web development.', 'HTML, CSS, JavaScript', 2, 1, 'published'),
('Python for Data Science', 'document', 'An introductory course on Python for Data Science.', 'Python basics, libraries like Pandas and NumPy', 2, 2, 'published'),
('UI/UX Design Fundamentals', 'video', 'Learn the basics of UI/UX design.', 'Wireframing, Prototyping, User Testing', 2, 3, 'draft'),
('Digital Marketing 101', 'document', 'A beginner’s guide to digital marketing strategies.', 'SEO, SEM, Social Media Marketing', 2, 4, 'draft');


-- Insert Course Tags
INSERT INTO courseTags (courseId, tagId) VALUES
(1, 1), -- 'Introduction to Web Development' has the 'Beginner' tag
(1, 3), -- 'Introduction to Web Development' has the 'JavaScript' tag
(2, 2), -- 'Python for Data Science' has the 'Advanced' tag
(2, 4), -- 'Python for Data Science' has the 'Python' tag
(3, 5), -- 'UI/UX Design Fundamentals' has the 'UI/UX' tag
(4, 6); -- 'Digital Marketing 101' has the 'Machine Learning' tag


-- Insert Enrollments
INSERT INTO enrollments (courseId, userId, status) VALUES
(1, 3, 'active'), -- Student enrolls in 'Introduction to Web Development'
(2, 3, 'active'); -- Student enrolls in 'Python for Data Science'
