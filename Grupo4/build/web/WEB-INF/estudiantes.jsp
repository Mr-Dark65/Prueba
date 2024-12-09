<%@page import="Model.Estudiante"%>
<%@page import="java.util.List"%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lista de Estudiantes</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>



        <div class="container my-5">
            <h1 class="text-center">Lista de Estudiantes</h1>
            <a href="EstudianteServlet?action=add" class="btn btn-primary mb-1">Agregar</a>
            <div class="mb-4">
                <!-- Formulario de búsqueda -->
                <form action="EstudianteServlet" method="get" class="d-flex">
                    <input type="hidden" name="action" value="search" />
                    <input type="text" name="cedula" class="form-control me-2" placeholder="Buscar estudiante por cédula" />
                    <button type="submit" class="btn btn-outline-primary">Buscar</button>
                </form>
            </div>

            <!-- Mensaje de error -->
            <% String error = (String) request.getAttribute("error"); %>
            <% if (error != null) {%>
            <div class="alert alert-danger text-center">
                <%= error%>
            </div>
            <% } %>

            <table class="table table-bordered table-striped mt-4">
                <thead class="thead-dark">
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <%
                        List<Model.Estudiante> students = (List<Model.Estudiante>) request.getAttribute("students");
                        if (students != null) {

                            for (Model.Estudiante student : students) {


                    %>

                    <tr>
                        <td><%=student.getCedula()%></td>
                        <td><%=student.getNombre()%></td>
                        <td><%=student.getApellido()%></td>
                        <td><%=student.getDireccion()%></td>
                        <td><%=student.getTelefono()%></td>
                        <td>
                            <a href="EstudianteServlet?action=edit&cedula=<%=student.getCedula()%>" class="btn btn-primary btn-sm">Editar</a>

                            <form action="EstudianteServlet" method="post" style="display: inline;">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="cedula" value="<%=student.getCedula()%>">
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>

                            </form>
                        </td>
                    </tr>
                    <%
                        }
                    } else {

                    %>
                </tbody>
                <tr>
                    <td colspan="6" class="text-center">No hay Estudiantes</td>
                </tr>
                <%}%>
            </table>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>