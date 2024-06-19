CREATE DATABASE manager
USE manager

CREATE TABLE videos (
    id_video VARCHAR(50) PRIMARY KEY,
    title_video VARCHAR(300) NOT NULL,
    id_page INT NOT NULL,
    FOREIGN KEY (id_page) REFERENCES pages(id_page)
);
CREATE TABLE pages (
    id_page INT AUTO_INCREMENT PRIMARY KEY,
    page_title VARCHAR(100) NOT NULL
);
CREATE TABLE statistical (
    id_statistical INT AUTO_INCREMENT PRIMARY KEY,
    id_video VARCHAR(50) NOT NULL,
    check_date DATE NOT NULL,
    revenue FLOAT,
    share_count INT,
    comment_count INT,
    like_count INT,
    reach_count INT,
    published_date datetime,
    FOREIGN KEY (id_video) REFERENCES videos(id_video)
);