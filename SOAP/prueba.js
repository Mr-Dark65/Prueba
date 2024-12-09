//variable de tipo string
let cadena = "Holaaa...";
//window.alert(cadena);

//varibales numericas
let numero = 12;
console.log(numero);

//variables booleanos
let boolean = true;
console.log(boolean);

//variables arrays
let vector = ['lunes','martes','miercoles','jueves','viernes'];
console.log(vector[0]);

//variables de objetos
let persona = {cedula:"0705565638",nombre:"steeven",apellido:"Loor"}
console.log(persona.cedula);

let JSON1 = 
{
    "cedula": "070889893",
    "nombre": "Steeven",
    "apellido": "Loor",
    "instruccion": {
        "primaria":"La Salle",
        "secundaria":"Bolivar"
    },
    "edad": 40
}
console.log(JSON1);
//JSON.Parse -> convierte un string de json a un objeto de javascript
var cadena2 = '{"nombre":"Steevem","apellido":"Loor"}';
console.log(cadena2);
var Myjson = JSON.parse(cadena2);
console.log(Myjson);
console.log(Myjson.nombre);

//JSON.stringfy -> convierte un objeto de javaScript a Json String
let cadena3 = {"cedula":"0705565638","nombre":"steeven","apellido":"Loor"};
console.log(cadena3);
var miTexto = JSON.stringify(cadena3);
console.log(miTexto);


//convertir array en texto
var vector1 = ["lunes","martes"];
// console.log(vector1);
// var textito = JSON.stringify(vector1);
// console.log(textito);

