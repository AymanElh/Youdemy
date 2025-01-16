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
    role ENUM('admin', 'teacher', 'student'),
    status ENUM('pending', 'accepted', 'refused', 'banned')
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
    teacherId INT NOT NULL,
    categoryId INT NOT NULL,
    creationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    isComplete TINYINT(1) DEFAULT 0,
    CONSTRAINT fk_course_teacher FOREIGN KEY (teacherId) REFERENCES users(id),
    CONSTRAINT fk_course_category FOREIGN KEY (categoryId) REFERENCES categories(id)
);

CREATE TABLE tags (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
);


CREATE TABLE courseTags (
    courseId INT,
    tagId INT,
    PRIMARY KEY (courseId, tagId),
    CONSTRAINT fk_course_tags_course FOREIGN KEY (courseId) REFERENCES courses(id),
    CONSTRAINT fk_course_tags_tag FOREIGN KEY (tagId) REFERENCES tags(id)
);


CREATE TABLE enrollments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    courseId INT,
    userId INT,
    enrollmentDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'completed') DEFAULT 'active',
    finishedDate DATE
)
