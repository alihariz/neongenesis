document.addEventListener("DOMContentLoaded", function() {
    const taskList = document.getElementById("taskList");

    fetch("php/dashboard.php")
        .then(response => response.json())
        .then(data => {
            if (data.tasks && data.tasks.length > 0) {
                data.tasks.forEach(task => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${task.title}</td>
                        <td>${task.description}</td>
                        <td>${task.due_date}</td>
                        <td>${task.priority}</td>
                        <td>${task.status}</td>
                        <td>
                            <a href="edit_task.html?id=${task.id}&title=${task.title}&description=${task.description}&due_date=${task.due_date}&priority=${task.priority}&status=${task.status}" class="btn btn-warning">Edit</a>
                            <a href="php/delete_task.php?id=${task.id}" class="btn btn-danger">Delete</a>
                        </td>
                    `;
                    taskList.appendChild(row);
                });
            } else {
                taskList.innerHTML = "<tr><td colspan='6'>No tasks found</td></tr>";
            }
        })
        .catch(error => console.error("Error fetching tasks:", error));
});
