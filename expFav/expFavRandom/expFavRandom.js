const searchBtn = document.querySelector('.searchBtn');
const recipeContainer = document.querySelector('.recipe-container');
const quote1 = document.querySelector('.quote1');
const quote2 = document.querySelector('.quote2');
const recipeDetailsContent = document.querySelector('.recipe-details-content');
const favRecipeDetailsContent = document.querySelector('.fav-recipe-details-content');
const recipeCloseBtn = document.querySelector('.recipe-close-btn');
const urlParams = new URLSearchParams(window.location.search);
const variableValue = urlParams.get('username');

// Now 'variableValue' holds the value passed through the URL
console.log(variableValue);
//Working of Search Button
searchBtn.addEventListener('click', (e)=> {
    e.preventDefault();
    fetchRecipes();
})

// Function to get recipes using the API
const fetchRecipes = async () => {
    recipeContainer.innerHTML = "<h2>Fetching Recipe...</h2>";
    try {
        const data = await fetch(`https://www.themealdb.com/api/json/v1/1/random.php`);
        const response = await data.json();
        
        recipeContainer.innerHTML = "";
        quote1.innerHTML = "";
        quote2.innerHTML = "";
        
        response.meals.forEach(meal => {
            const recipeDiv = document.createElement('div');
            recipeDiv.classList.add('recipe');
            recipeDiv.innerHTML = `
                <img src="${meal.strMealThumb}">
                <h3>${meal.strMeal}</h3>
                <p><span>${meal.strArea}</span> Dish</p>
                <p>Belongs to <span>${meal.strCategory}</span> Category</p>
            `

            // Adding button for View Recipe
            const button = document.createElement('button');
            button.textContent = "View Recipe"
            recipeDiv.appendChild(button);

            //Adding eventListner for View Recipe button
            button.addEventListener('click', ()=> {
                openRecipePopup(meal);
            })
            
            recipeContainer.appendChild(recipeDiv);

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
        recipeContainer.innerHTML = "<h2>Sorry, there is no recipe available by this name.</h2>";
    }
}

//Function to fetch ingredients and measurements
const fetchIngredients = (meal) => {
    let ingredientsList = "";
    for(let i=1; i<=20; i++) {
        const ingredient = meal[`strIngredient${i}`];
        if(ingredient) {
            const measure = meal[`strMeasure${i}`];
            ingredientsList += `<li>${measure} ${ingredient}</li>`
        }
        else {
            break;
        }
    }
    return ingredientsList;
}

//Function to open recipe popup
const openRecipePopup = (meal) => {
    recipeDetailsContent.innerHTML = `
        <h2 class="recipeName">${meal.strMeal}</h2>
        <h3>Ingredients</h3>
        <ul class="ingredientList">${fetchIngredients(meal)}</ul>
        <div class="recipeInstructions">
            <h3>Instructions:</h3>
            <p>${meal.strInstructions}</p>
        </div>
        <div class="recipeVid">
            <a href = "${meal.strYoutube}" target = "_blank"><i class="fa-brands fa-youtube"></i></a>
        </div>
    `

    recipeDetailsContent.parentElement.style.display = "block";
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



//Adding event listner for popupclose button
recipeCloseBtn.addEventListener('click', ()=> {
    recipeDetailsContent.parentElement.style.display = "none";
})