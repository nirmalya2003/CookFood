CREATE TABLE addRecipe (
    idRecipe INT AUTO_INCREMENT PRIMARY KEY,
    username varchar(50) not null,
    strRecipe VARCHAR(255),
    strInstructions TEXT,
    strYoutube VARCHAR(255),
    strCategory VARCHAR(255),
    strArea VARCHAR(255),
    strRecipeThumb VARCHAR(255),
    strIngredientsMeasurements TEXT,
    FOREIGN key (username) REFERENCES login(username)
);