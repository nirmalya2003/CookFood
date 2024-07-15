CREATE TABLE comments (
    commentid INT AUTO_INCREMENT PRIMARY KEY,
    recipeid INT NOT NULL,
    username VARCHAR(255) NOT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (recipeid) REFERENCES addrecipe(idRecipe)
);
