
function  get() {
    var datos = document.getElementById("datos") 
    fetch('http://127.0.0.1:8000/api/employees')
    .then(res=>res.json())
    .then(json=>{

        json.forEach(element => {
            datos.innerHTML+= `<td>${element.name}</td>
            <td>${element.last_name}</td>
            <td>${element.salary}</td>
            <td><button onclick='eliminar()' >Eliminar</button></td>
            
            `;
        });
        

    })
    
    //Funcion peticion delete
    


}

