const searchBox = document.querySelector('.searchBox');
const searchBtn = document.querySelector('.searchBtn');
const recipeContainer = document.querySelector('.recipe-container');
const quote1 = document.querySelector('.quote1');
const quote2 = document.querySelector('.quote2');
const favRecipeDetailsContent = document.querySelector('.fav-recipe-details-content');
const urlParams = new URLSearchParams(window.location.search);
const variableValue = urlParams.get('username');

// Now 'variableValue' holds the value passed through the URL
console.log(variableValue);
//Working of Search Button
searchBtn.addEventListener('click', (e)=> {
    e.preventDefault();
    const searchInput = document.getElementById("searchBox").value.trim();
    if(!searchInput) {
        recipeContainer.innerHTML = `<h2>Type the main ingredient of the meal.</h2>`;
        return;
    }
    fetchRecipes(searchInput);
})

// Function to get recipes using the API
const fetchRecipes = async (query) => {
    recipeContainer.innerHTML = "<h2>Fetching Recipes...</h2>";
    try {
        const data = await fetch(`https://www.themealdb.com/api/json/v1/1/filter.php?i=${query}`);
        const response = await data.json();
        console.log(response);

        recipeContainer.innerHTML = "";
        quote1.innerHTML = "";
        quote2.innerHTML = "";
        
        response.meals.forEach(meal => {
            const recipeDiv = document.createElement('div');
            recipeDiv.classList.add('recipe');
            recipeDiv.innerHTML = `
                <img src="${meal.strMealThumb}">
                <h3>${meal.strMeal}</h3>
            `

            // Adding button for Favourite Recipe
            const favButton = document.createElement('favButton');
            favButton.textContent = "Add to Favourites"
            recipeDiv.appendChild(favButton);
            
            //Adding eventListner for Favourite Recipe button
            favButton.addEventListener('click', ()=> {
                favRecipe(meal);
            })
            
            recipeContainer.appendChild(recipeDiv);

        });
    }
    catch(error) {
        recipeContainer.innerHTML = "<h2>Sorry, there is no recipe available by this ingredient.</h2>";
    }
}

//Function to acknowlwdge favourite recipe popup
const favRecipe = (meal) => {
    let mealId = meal.idMeal;
    let mealName = meal.strMeal;
    console.log(mealId);
    console.log(mealName);

    const sendMealToPHP = async (mealId, mealName) => {
        try {
            const response = await fetch('favFoodStore.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ mealId: mealId, mealName: mealName, username: variableValue }),
            });
            const data = await response.json();
            console.log(data);
        } catch (error) {
            console.error('Error:', error);
        }
    };

    alert(mealName + " has been added to your favourites.");
    sendMealToPHP(mealId, mealName);
};
