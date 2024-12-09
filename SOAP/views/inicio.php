<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Basic CRUD Application - jQuery EasyUI CRUD Demo</title>
    <link rel="stylesheet" type="text/css" href="../jquery/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="../jquery/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="../jquery/themes/color.css">
    <script type="text/javascript" src="../jquery/jquery.min.js"></script>
    <script type="text/javascript" src="../jquery/jquery.easyui.min.js"></script>
</head>
<body>
    <h2>Basic CRUD Application</h2>
    <p>Click the buttons on datagrid toolbar to do crud actions.</p>
    
    <table id="dg" title="My Users" class="easyui-datagrid" style="width:700px;height:250px"
            url='http://localhost:8087/SOAP/controllers/apiRest.php' method="GET"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="cedula" width="50">Cedula</th>
                <th field="nombre" width="50">Nombre</th>
                <th field="apellido" width="50">Apellido</th>
                <th field="direccion" width="50">Direccion</th>
                <th field="telefono" width="50">Telefono</th>
            </tr>
        </thead>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nuevo Usuario</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar Usuario</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remover Usuario</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-shear" plain="true" onclick="buscar()">Buscar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-shear" plain="true" onclick="recargar()">Recargar</a>
    </div>
    
    <div id="dlg" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Estudiante</h3>
            <div style="margin-bottom:10px">
                <input name="cedula" id="cedula" class="easyui-textbox" required="true" label="Cedula : " style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="nombre" class="easyui-textbox" required="true" label="Nombre :" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="apellido" class="easyui-textbox" required="true" label="Apellido :" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="direccion" class="easyui-textbox" required="true" label="Direccion :" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
                <input name="telefono" class="easyui-textbox" required="true" label="Telefono :" style="width:100%">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
    </div>

    <div id="dlg2" class="easyui-dialog" style="width:400px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons2'">
    <form id="fm2" method="post" novalidate style="margin:0;padding:20px 50px"> <!-- Nuevo formulario -->
        <h3>Buscar Estudiante</h3>
        <div style="margin-bottom:10px">
            <input name="cedula" id="cedula2" class="easyui-textbox" required="true" label="Cedula : " style="width:100%">
        </div>
    </form>
</div>

<div id="dlg-buttons2">
    <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="buscarCedula()" style="width:90px">Buscar</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg2').dialog('close')" style="width:90px">Cancel</a>
    
</div>


    <script type="text/javascript">
        var url;

    function newUser() {
        $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Buscar Usuario');
        $('#fm').form('clear'); 
        $('#cedula').textbox('readonly', false); 
        url = 'http://localhost:8087/SOAP/controllers/apiRest.php';  
    }

    function buscar() {
    $('#dlg2').dialog('open').dialog('center').dialog('setTitle', 'Buscar Usuario');
    $('#fm2').form('clear');  // Limpiar el formulario de búsqueda
    $('#cedula2').textbox('readonly', false);  // Desactivar readonly en el campo de búsqueda
    url = 'http://localhost:8087/SOAP/controllers/apiRest.php';  // Esta URL solo se necesita si luego vas a hacer algo con POST o PUT
}


    function editUser() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle', 'Edit User');
            $('#fm').form('load', row);  
            
            $('#cedula').textbox('readonly', true);  
            url = 'http://localhost:8087/SOAP/controllers/apiRest.php?cedula=' + row.cedula; 
        }
    }

    function recargar(){
        $('#dg').datagrid('reload'); 
    }

    function saveUser() {
        var method = url.includes('?cedula=') ? 'PUT' : 'POST';  
        $('#fm').form('submit', {
            url: url,
            method: method,  
            iframe: false,
            onSubmit: function() {
                return $(this).form('validate'); 
            },
            success: function(result) {
                try {
                    var resultObj = JSON.parse(result);  
                    if (resultObj.errorMsg) {
                        $.messager.show({
                            title: 'Error',
                            msg: resultObj.errorMsg
                        });
                    } else {
                        $('#dlg').dialog('close');  
                        $('#dg').datagrid('reload');  
                    }
                } catch (e) {
                    $.messager.show({
                        title: 'Error',
                        msg: 'Error in server response format'
                    });
                }
            },
            error: function() {
                $.messager.show({
                    title: 'Error',
                    msg: 'Error while saving user'
                });
            }
        });
    }

    function buscarCedula() {
    var cedula = $('#cedula2').val(); // Obtén el valor del campo de búsqueda
    console.log(cedula);
    if (!cedula) {
        $.messager.show({
            title: 'Error',
            msg: 'Por favor, ingrese una cédula para buscar'
        });
        return;
    }

    var searchUrl = 'http://localhost:8087/SOAP/controllers/apiRest.php?cedula=' + cedula;

    $.ajax({
        url: searchUrl,
        method: 'GET',
        success: function(result) {
            try {
                var resultObj = JSON.parse(result);  // Convierte la respuesta a objeto JSON
                if (resultObj.errorMsg) {
                    $.messager.show({
                        title: 'Error',
                        msg: resultObj.errorMsg
                    });
                } else if (resultObj && resultObj.length > 0) {  
                    $('#dg').datagrid('loadData', { total: 1, rows: [resultObj[0]] });
                    $('#dlg2').dialog('close');  
                } else {
                    $.messager.show({
                        title: 'Info',
                        msg: 'No se encontró un usuario con la cédula ingresada'
                    });
                }
            } catch (e) {
                $.messager.show({
                    title: 'Error',
                    msg: 'Error en el formato de respuesta del servidor'
                });
            }
        },
        error: function() {
            $.messager.show({
                title: 'Error',
                msg: 'Error al buscar usuario'
            });
        }
    });
}




    function destroyUser() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $.messager.confirm('Confirm', 'Are you sure you want to destroy this user?', function(r) {
                if (r) {
                    $.ajax({
                        url: 'http://localhost:8087/SOAP/controllers/apiRest.php?cedula=' + row.cedula,
                        type: 'DELETE',
                        success: function(result) {
                            if (result.success) {
                                $.messager.show({
                                    title: 'Success',
                                    timeout: 3000,
                                    showType: 'slide'
                                });
                                $('#dg').datagrid('reload');
                            } else {
                                $('#dlg').dialog('close');  
                                $('#dg').datagrid('reload'); 
                            }
                        },
                        error: function() {
                            $.messager.show({
                                title: 'Error',
                                msg: 'Error while trying to delete the user'
                            });
                        }
                    });
                }
            });
        }
    }
</script>
</body>
</html>