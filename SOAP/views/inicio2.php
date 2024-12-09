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
body {
	color: #566787;
	background: #f5f5f5;
	font-family: 'Varela Round', sans-serif;
	font-size: 13px;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
	background: #fff;
	padding: 20px 25px;
	border-radius: 3px;
	min-width: 1000px;
	box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {        
	padding-bottom: 15px;
	background: #435d7d;
	color: #fff;
	padding: 16px 30px;
	min-width: 100%;
	margin: -20px -25px 10px;
	border-radius: 3px 3px 0 0;
}
.table-title h2 {
	margin: 5px 0 0;
	font-size: 24px;
}
.table-title .btn-group {
	float: right;
}
.table-title .btn {
	color: #fff;
	float: right;
	font-size: 13px;
	border: none;
	min-width: 50px;
	border-radius: 2px;
	border: none;
	outline: none !important;
	margin-left: 10px;
}
.table-title .btn i {
	float: left;
	font-size: 21px;
	margin-right: 5px;
}
.table-title .btn span {
	float: left;
	margin-top: 2px;
}
table.table tr th, table.table tr td {
	border-color: #e9e9e9;
	padding: 12px 15px;
	vertical-align: middle;
}
table.table tr th:first-child {
	width: 60px;
}
table.table tr th:last-child {
	width: 100px;
}
table.table-striped tbody tr:nth-of-type(odd) {
	background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
	background: #f5f5f5;
}
table.table th i {
	font-size: 13px;
	margin: 0 5px;
	cursor: pointer;
}	
table.table td:last-child i {
	opacity: 0.9;
	font-size: 22px;
	margin: 0 5px;
}
table.table td a {
	font-weight: bold;
	color: #566787;
	display: inline-block;
	text-decoration: none;
	outline: none !important;
}
table.table td a:hover {
	color: #2196F3;
}
table.table td a.edit {
	color: #FFC107;
}
table.table td a.delete {
	color: #F44336;
}
table.table td i {
	font-size: 19px;
}
table.table .avatar {
	border-radius: 50%;
	vertical-align: middle;
	margin-right: 10px;
}
.pagination {
	float: right;
	margin: 0 0 5px;
}
.pagination li a {
	border: none;
	font-size: 13px;
	min-width: 30px;
	min-height: 30px;
	color: #999;
	margin: 0 2px;
	line-height: 30px;
	border-radius: 2px !important;
	text-align: center;
	padding: 0 6px;
}
.pagination li a:hover {
	color: #666;
}	
.pagination li.active a, .pagination li.active a.page-link {
	background: #03A9F4;
}
.pagination li.active a:hover {        
	background: #0397d6;
}
.pagination li.disabled i {
	color: #ccc;
}
.pagination li i {
	font-size: 16px;
	padding-top: 6px
}
.hint-text {
	float: left;
	margin-top: 10px;
	font-size: 13px;
}    
/* Custom checkbox */
.custom-checkbox {
	position: relative;
}
.custom-checkbox input[type="checkbox"] {    
	opacity: 0;
	position: absolute;
	margin: 5px 0 0 3px;
	z-index: 9;
}
.custom-checkbox label:before{
	width: 18px;
	height: 18px;
}
.custom-checkbox label:before {
	content: '';
	margin-right: 10px;
	display: inline-block;
	vertical-align: text-top;
	background: white;
	border: 1px solid #bbb;
	border-radius: 2px;
	box-sizing: border-box;
	z-index: 2;
}
.custom-checkbox input[type="checkbox"]:checked + label:after {
	content: '';
	position: absolute;
	left: 6px;
	top: 3px;
	width: 6px;
	height: 11px;
	border: solid #000;
	border-width: 0 3px 3px 0;
	transform: inherit;
	z-index: 3;
	transform: rotateZ(45deg);
}
.custom-checkbox input[type="checkbox"]:checked + label:before {
	border-color: #03A9F4;
	background: #03A9F4;
}
.custom-checkbox input[type="checkbox"]:checked + label:after {
	border-color: #fff;
}
.custom-checkbox input[type="checkbox"]:disabled + label:before {
	color: #b8b8b8;
	cursor: auto;
	box-shadow: none;
	background: #ddd;
}
/* Modal styles */
.modal .modal-dialog {
	max-width: 400px;
}
.modal .modal-header, .modal .modal-body, .modal .modal-footer {
	padding: 20px 30px;
}
.modal .modal-content {
	border-radius: 3px;
	font-size: 14px;
}
.modal .modal-footer {
	background: #ecf0f1;
	border-radius: 0 0 3px 3px;
}
.modal .modal-title {
	display: inline-block;
}
.modal .form-control {
	border-radius: 2px;
	box-shadow: none;
	border-color: #dddddd;
}
.modal textarea.form-control {
	resize: vertical;
}
.modal .btn {
	border-radius: 2px;
	min-width: 100px;
}	
.modal form label {
	font-weight: normal;
}
.col-sm-12 .form-group{
	padding-right: 8.5rem;
    padding-left: 8.5rem;
	padding-top: 2rem;
    margin-right: auto;
    margin-left: auto;
	min-width: 100%;
	margin: -20px -25px 10px;	
}	

.col-sm-12 .form-group button{
	background: #435d7d;
	border-color: #435d7d;
}
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
</script>
</head>
<body>
<div class="col-sm-12">
    <div class="form-group">
        <h1><label for="searchCedula">Buscar:</label></h1>
        <input type="text" id="searchCedula" class="form-control" placeholder="Ingresa la cédula...">
        <button id="searchButton" class="btn btn-primary mt-2">Buscar</button>
        <button id="actualizar" onclick="loadEmployees()" class="btn btn-primary mt-2">Actualizar Tabla</button>
    </div>
</div>
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Estudiantes<b></b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
												
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							
						</th>
						<th field="cedula">Cedula</th>
						<th field="nombre" >Nombre</th>
						<th field="apellido" >Apellido</th>
						<th field="direccion" >Direccion</th>
						<th field="telefono" >Telefono</th>
					</tr>
				</thead>
				<tbody id='tabla'>
					
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
				<ul class="pagination">
					<li class="page-item disabled"><a href="#">Previous</a></li>
					<li class="page-item"><a href="#" class="page-link">1</a></li>
					<li class="page-item"><a href="#" class="page-link">2</a></li>
					<li class="page-item active"><a href="#" class="page-link">3</a></li>
					<li class="page-item"><a href="#" class="page-link">4</a></li>
					<li class="page-item"><a href="#" class="page-link">5</a></li>
					<li class="page-item"><a href="#" class="page-link">Next</a></li>
				</ul>
			</div>
		</div>
	</div>        
</div>
<!-- Edit Modal HTML -->
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
					<input type="text" id="addcedula" class='form-control' required>
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" id="addnombre" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Apellido</label>
						<input type="text" id="addapellido" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Direccion</label>
						<input type="text" id="adddireccion" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Telefono</label>
						<input type="text" id="addtelefono" class="form-control" required>
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit" class="btn btn-info" value="Agregar">
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
					<input type="hidden" id="editcedula"> <!-- Input oculto para la cédula -->
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" id="editnombre" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Apellido</label>
						<input type="text" id="editapellido" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Direccion</label>
						<input type="text" id="editdireccion" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Telefono</label>
						<input type="text" id="edittelefono" class="form-control" required>
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit" class="btn btn-info" value="Guardar Cambios">
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
					<p>Are you sure you want to delete these Records?</p>
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
        // Carga los datos iniciales
        loadEmployees();
    });

    // Cargar datos de empleados
    function loadEmployees() {
        fetch('http://localhost:8087/SOAP/controllers/apiRest.php', {
            method: "GET"
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error en la solicitud: " + response.status);
            }
            return response.json();
        })
        .then(res => {
            const table = document.getElementById('tabla');
            table.innerHTML = '';

            res.forEach(item => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>
                        
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
        .catch(error => console.error("Error en el procesamiento:", error));
    }

    // Asigna los eventos de eliminar y editar
    function assignDeleteAndEditEvents() {
        document.querySelectorAll('.delete').forEach(button => {
            button.addEventListener('click', (e) => {
                const cedula = e.target.closest('tr').querySelector('td:nth-child(2)').innerText;
                confirmDeleteEmployee(cedula);
            });
        });

        document.querySelectorAll('.edit').forEach(button => {
            button.addEventListener('click', (e) => {
                //const cedula = e.target.getAttribute('data-cedula');
				const cedula = e.target.closest('tr').querySelector('td:nth-child(2)').innerText;
                showEditModal(cedula);
            });
        });
    }

    // Confirmación de eliminación
    function confirmDeleteEmployee(cedula) {
        document.querySelector('#deleteEmployeeModal input[type="submit"]').onclick = () => {
            deleteEmployee(cedula);
        };
    }

    // Método para eliminar un empleado
    function deleteEmployee(cedula) {
        fetch(`http://localhost:8087/SOAP/controllers/apiRest.php?cedula=${cedula}`, {
            method: "DELETE"
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al eliminar el registro: " + response.status);
            }
            alert("Empleado eliminado con éxito");
            loadEmployees();  // Actualiza la tabla
        })
        .catch(error => console.error("Error al eliminar:", error));
    }

    // Muestra el modal de edición y carga los datos actuales
    function showEditModal(cedula) {
        fetch(`http://localhost:8087/SOAP/controllers/apiRest.php?cedula=${cedula}`)
            .then(response => response.json())
            .then(data => {
				console.log(data);
                document.getElementById("editcedula").value = data[0].cedula;
                document.getElementById("editnombre").value = data[0].nombre;
                document.getElementById("editapellido").value = data[0].apellido;
                document.getElementById("editdireccion").value = data[0].direccion;
                document.getElementById("edittelefono").value = data[0].telefono;
				
            })
            .catch(error => console.error("Error al cargar datos para editar:", error));
    }

    // Procesa la edición del empleado
    document.getElementById("editForm").onsubmit = function(event) {
        event.preventDefault();

        const cedula = document.getElementById("editcedula").value;
        const nombre = document.getElementById("editnombre").value;
        const apellido = document.getElementById("editapellido").value;
        const direccion = document.getElementById("editdireccion").value;
        const telefono = document.getElementById("edittelefono").value;

        fetch(`http://localhost:8087/SOAP/controllers/apiRest.php?cedula=${cedula}`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ nombre, apellido, direccion, telefono })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al actualizar el registro: " + response.status);
            }
            alert("Empleado actualizado con éxito");
            loadEmployees();  // Actualiza la tabla
            $('#editEmployeeModal').modal('hide');  // Cierra el modal
        })
        .catch(error => console.error("Error al actualizar:", error));
    };

	// Procesa la adición de un nuevo estudiante
document.getElementById("addForm").onsubmit = function(event) {
    event.preventDefault();

    // Obtén los valores de los campos del formulario
    const cedula = document.getElementById("addcedula").value;
    const nombre = document.getElementById("addnombre").value;
    const apellido = document.getElementById("addapellido").value;
    const direccion = document.getElementById("adddireccion").value;
    const telefono = document.getElementById("addtelefono").value;

    // Enviar los datos usando POST a la API
    fetch('http://localhost:8087/SOAP/controllers/apiRest.php', {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ cedula, nombre, apellido, direccion, telefono })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Error al agregar el registro: " + response.status);
        }
        alert("Estudiante agregado con éxito");
        loadEmployees();  // Actualiza la tabla
        $('#addEmployeeModal').modal('hide');  // Cierra el modal
    })
    .catch(error => console.error("Error al agregar:", error));
};

function searchEstudiantes() {
    const searchValue = document.getElementById("searchCedula").value.toLowerCase();

    // Llamada a la API para obtener los datos
    fetch("http://localhost:8087/SOAP/controllers/apiRest.php") // Reemplaza con la URL de tu API
        .then(response => response.json())
        .then(data => {
            // Limpia la tabla antes de agregar los resultados
            const tabla = document.querySelector("#tabla");
            tabla.innerHTML = ""; // Limpia las filas existentes

            // Filtra los datos de la API buscando coincidencia exacta
            const filteredData = data.filter(estudiante => 
                estudiante.cedula.toLowerCase() === searchValue
            );

            // Muestra los resultados filtrados
            filteredData.forEach(estudiante => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${estudiante.cedula}</td>
                    <td>${estudiante.nombre}</td>
                    <td>${estudiante.apellido}</td>
                    <td>${estudiante.direccion}</td>
                    <td>${estudiante.telefono}</td>
                `;
                tabla.appendChild(row);
            });

            // Maneja el caso en que no se encuentran resultados
            if (filteredData.length === 0) {
                const noResultsRow = document.createElement("tr");
                noResultsRow.innerHTML = `<td colspan="4" class="text-center">No se encontraron resultados</td>`;
                tabla.appendChild(noResultsRow);
            }
        })
        .catch(error => console.error("Error al obtener los datos:", error));
		}

		document.getElementById("searchButton").addEventListener("click", searchEstudiantes);

    </script>

</body>
</html>