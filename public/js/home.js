let todoList = [];

async function addTodoItem() {
    const inputTodo = document.querySelector("#inputTodo").value;

    if (!inputTodo.trim()) {
        alert("Input tidak boleh kosong");
        return;
    }

    try {
        const response = await fetch("http://35.219.123.247/db", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ text: inputTodo, done: false }), // Include 'done' status
        });

        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.error);
        }

        const newTodoItem = await response.json();
        todoList.push(newTodoItem);
        document.querySelector("#inputTodo").value = "";
        renderTodoList();
    } catch (error) {
        console.error(error);
        alert("Failed to add todo item");
    }
}

// Add this function to load existing todos from the server:

async function loadTodos() {
    try {
        const response = await fetch("http://35.219.123.247/db");
        const todos = await response.json();

        if (!Array.isArray(todoList)) {
            todoList = [];
        }

        todoList.push(...todos);
        renderTodoList();
    } catch (error) {
        console.error(error);
        alert("Failed to load todo items");
    }
}

document.addEventListener("DOMContentLoaded", () => {
    loadTodos();
    const addTodoButton = document.getElementById("addTodo");
    addTodoButton.addEventListener("click", addTodoItem);
});

async function deleteTodoItem(index) {
    const todoId = todoList[index]._id;

    try {
        const response = await fetch(`http://35.219.123.247/db/${todoId}`, {
            method: "DELETE",
        });

        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.error);
        }

        todoList.splice(index, 1);
        renderTodoList();
    } catch (error) {
        console.error(error);
        alert("Failed to delete todo item");
    }
}

function renderTodoList() {
    const todoListElement = document.getElementById("todoList");
    todoListElement.innerHTML = ""; // Clear the content before updating

    // Iterate through todoList and add elements to todoListElement
    todoList.forEach((todo, index) => {
        const listItem = document.createElement("li");

        // Create a checkbox to mark task as done
        const checkbox = document.createElement("input");
        checkbox.type = "checkbox";
        checkbox.checked = todo.done;
        checkbox.addEventListener("change", () => toggleTodoItem(index)); // Add event listener to toggle done status
        listItem.appendChild(checkbox);

        // Display text with or without strikethrough based on 'done' status
        const todoText = document.createElement("span");
        todoText.textContent = todo.text;
        if (todo.done) {
            todoText.style.textDecoration = "line-through";
        }
        listItem.appendChild(todoText);

        // Create a delete button
        const deleteButton = document.createElement("button");
        deleteButton.textContent = "Delete";
        deleteButton.addEventListener("click", () => deleteTodoItem(index));
        listItem.appendChild(deleteButton);

        todoListElement.appendChild(listItem);
    });
}

async function toggleTodoItem(index) {
    // Toggle the 'done' status locally
    todoList[index].done = !todoList[index].done;

    // Update the UI
    renderTodoList();

    // Send a request to update the 'done' status on the server
    updateTodoStatus(index);
}

async function updateTodoStatus(index) {
    const todoItem = todoList[index];

    try {
        const response = await fetch(
            `http://35.219.123.247/db/${todoItem._id}`,
            {
                method: "PATCH",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ done: todoItem.done }),
            }
        );

        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.error);
        }

        // Handle the response from the server if needed
        console.log(
            "Todo item status updated successfully:",
            await response.json()
        );
    } catch (error) {
        // Handle errors that occurred during the fetch
        console.error("Error during fetch operation:", error);
        alert("Failed to update todo item status");
    }
}

function updateTime() {
    var now = new Date();
    var daysOfWeek = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
    ];

    var day = daysOfWeek[now.getDay()];
    var date = now.getDate();
    var month = now.getMonth() + 1; // Months are zero-based
    var year = now.getFullYear();
    var hours = now.getHours();
    var minutes = now.getMinutes();
    var seconds = now.getSeconds();

    // Formatting to ensure two digits
    date = date < 10 ? "0" + date : date;
    month = month < 10 ? "0" + month : month;
    hours = hours < 10 ? "0" + hours : hours;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    var dateString = date + "/" + month + "/" + year;
    var timeString = hours + ":" + minutes + ":" + seconds;

    // Update the content of the 'time' element
    document.getElementById("time").innerHTML = "Time: " + timeString;
    document.getElementById("date").innerHTML = day + ", " + dateString;
}

// Call updateTime every second (1000 milliseconds)
setInterval(updateTime, 1000);
