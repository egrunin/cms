USE gc200310426;

CREATE TABLE page (
page_id INT AUTO_INCREMENT PRIMARY KEY,
page_title VARCHAR(20),
page_info VARCHAR (500)
);

ALTER TABLE page
ADD COLUMN page_image VARCHAR(255);

ALTER TABLE page
ADD COLUMN upload_id INT;

SELECT * FROM page;

SELECT * FROM admins;