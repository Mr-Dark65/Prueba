<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
/* Same styles as before */
</style>
<script>
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});

document.addEventListener('DOMContentLoaded', () => {
    loadEmployees(); // Load initial data
});

// Load employees
function loadEmployees() {
    fetch('http://localhost:8087/SOAP/controllers/apiRest.php', { method: "GET" })
    .then(response => response.json())
    .then(res => {
        const table = document.getElementById('tabla');
        table.innerHTML = '';

        res.forEach(item => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>
                    <span class="custom-checkbox">
                        <input type="checkbox" id="checkbox${item.cedula}" name="options[]" value="${item.cedula}">
                        <label for="checkbox${item.cedula}"></label>
                    </span>
                </td>
                <td>${item.cedula}</td>
                <td>${item.nombre}</td>
                <td>${item.apellido}</td>
                <td>${item.direccion}</td>
                <td>${item.telefono}</td>
                <td>
                    <a href="#editEmployeeModal" class="edit" data-toggle="modal" data-cedula="${item.cedula}"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <a href="#deleteEmployeeModal" class="delete" data-toggle="modal" data-cedula="${item.cedula}"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                </td>`;
            table.appendChild(row);
        });

        assignDeleteAndEditEvents();
    })
    .catch(error => console.error("Error:", error));
}

// Assign events for edit and delete buttons
function assignDeleteAndEditEvents() {
    document.querySelectorAll('.delete').forEach(button => {
        button.addEventListener('click', (e) => {
            const cedula = e.target.closest('tr').querySelector('td:nth-child(2)').innerText;
            confirmDeleteEmployee(cedula);
        });
    });

    document.querySelectorAll('.edit').forEach(button => {
        button.addEventListener('click', (e) => {
            const cedula = e.target.closest('tr').querySelector('td:nth-child(2)').innerText;
            showEditModal(cedula);
        });
    });
}

// Confirm delete
function confirmDeleteEmployee(cedula) {
    document.querySelector('#deleteEmployeeModal input[type="submit"]').onclick = () => {
        deleteEmployee(cedula);
    };
}

// Delete employee
function deleteEmployee(cedula) {
    fetch(`http://localhost:8087/SOAP/controllers/apiRest.php?cedula=${cedula}`, { method: "DELETE" })
    .then(response => {
        if (!response.ok) throw new Error("Error al eliminar el registro: " + response.status);
        alert("Empleado eliminado con éxito");
        loadEmployees();
    })
    .catch(error => console.error("Error:", error));
}

// Show edit modal
function showEditModal(cedula) {
    fetch(`http://localhost:8087/SOAP/controllers/apiRest.php?cedula=${cedula}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById("editcedula").value = data.cedula;
            document.getElementById("editnombre").value = data.nombre;
            document.getElementById("editapellido").value = data.apellido;
            document.getElementById("editdireccion").value = data.direccion;
            document.getElementById("edittelefono").value = data.telefono;
        })
        .catch(error => console.error("Error:", error));
}

// Process edit
document.getElementById("editForm").onsubmit = function(event) {
    event.preventDefault();
    const cedula = document.getElementById("editcedula").value;
    const nombre = document.getElementById("editnombre").value;
    const apellido = document.getElementById("editapellido").value;
    const direccion = document.getElementById("editdireccion").value;
    const telefono = document.getElementById("edittelefono").value;

    fetch(`http://localhost:8087/SOAP/controllers/apiRest.php?cedula=${cedula}`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ nombre, apellido, direccion, telefono })
    })
    .then(response => {
        if (!response.ok) throw new Error("Error al actualizar el registro: " + response.status);
        alert("Empleado actualizado con éxito");
        loadEmployees();
        $('#editEmployeeModal').modal('hide');
    })
    .catch(error => console.error("Error:", error));
};

// Process add
document.getElementById("addForm").onsubmit = function(event) {
    event.preventDefault();
    const cedula = document.getElementById("addcedula").value;
    const nombre = document.getElementById("addnombre").value;
    const apellido = document.getElementById("addapellido").value;
    const direccion = document.getElementById("adddireccion").value;
    const telefono = document.getElementById("addttelefono").value;

    fetch("http://localhost:8087/SOAP/controllers/apiRest.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ cedula, nombre, apellido, direccion, telefono })
    })
    .then(response => {
        if (!response.ok) throw new Error("Error al agregar el registro: " + response.status);
        alert("Empleado agregado con éxito");
        loadEmployees();
        $('#addEmployeeModal').modal('hide');
    })
    .catch(error => console.error("Error:", error));
};
</script>
</head>
<body>
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Estudiantes</h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
                        <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                            </span>
                        </th>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                    </tr>
                </thead>
                <tbody id='tabla'></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modals -->
<!-- Add Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addForm">
                <div class="modal-header">						
                    <h4 class="modal-title">Agregar Estudiante</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <label>Cedula</label>
                    <input type="text" id="addcedula" class="form-control" required>
                    <label>Nombre</label>
                    <input type="text" id="addnombre" class="form-control" required>
                    <label>Apellido</label>
                    <input type="text" id="addapellido" class="form-control" required>
                    <label>Direccion</label>
                    <input type="text" id="adddireccion" class="form-control" required>
                    <label>Telefono</label>
                    <input type="text" id="addttelefono" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success" value="Agregar">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm">
                <div class="modal-header">						
                    <h4 class="modal-title">Editar Estudiante</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                    <input type="hidden" id="editcedula" class="form-control" required>
                    <label>Nombre</label>
                    <input type="text" id="editnombre" class="form-control" required>
                    <label>Apellido</label>
                    <input type="text" id="editapellido" class="form-control" required>
                    <label>Direccion</label>
                    <input type="text" id="editdireccion" class="form-control" required>
                    <label>Telefono</label>
                    <input type="text" id="edittelefono" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-info" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">						
                    <h4 class="modal-title">Delete Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">					
                    <p>Are you sure you want to delete this Record?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" value="Delete">
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
