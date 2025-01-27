import React, { Component, useState } from 'react';
import { Button, Form, FormGroup, Label, Input } from 'reactstrap';
import 'bootstrap/dist/css/bootstrap.min.css';


const Altas = ({ nuevoUsuario }) => {
  // UTILICE HOOKS EN ESTE COMPONENTE
  const [nombre, setNombre]=useState("")
  const [apellidos, setApellidos]=useState("")
  const [telefono, setTelefono]=useState("")

  const handleChange = (event) => {
    if(event.target.name === "nombre"){
      setNombre(event.target.value)
    }
    if(event.target.name === "apellidos"){
      setApellidos(event.target.value)
    }
    if(event.target.name === "telefono"){
      setTelefono(event.target.value)
    }
  }

  const handleSubmit = (e) => {
    e.preventDefault()
    nuevoUsuario(nombre,apellidos,telefono)
  }

  return (
    <Form onSubmit={handleSubmit}>
      <FormGroup>
        <Label for="Nombre">Nombre:</Label>
        <Input
          name="nombre"
          id="nombre"
          placeholder="introduzca nombre"
          onChange={handleChange}
        />
        <Label for="Nombre">Apellidos:</Label>
        <Input
          name="apellidos"
          id="apellidos"
          placeholder="introduzca apellidos"
          onChange={handleChange}
        />
        <Label for="Nombre">Telefono:</Label>
        <Input
          name="telefono"
          id="telefono"
          placeholder="introduzca telefono"
          onChange={handleChange}
        />
      </FormGroup>
      <Button>Añadir</Button>
    </Form>
  );
}

const Mostrar = ({contactos}) => {
  // ESTE COMPONENTE MUESTRA EL LISTÍN TELEFÓNICO.

  return (
    <>
      <h3>Listado</h3>
      <ul>
        {contactos.map(u=>{
          return (<li> Nombre: {u.nombre} - Apellidos: {u.apellidos} - Telefono: {u.telefono}</li>)
        })}
    </ul>
    </>
    
  );
}

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      // INSERTE AQUÍ EL ESTADO NECESARIO. AQUÍ SE GUARDARÁ TODA LA INFORMACIÓN DE LA APLICACIÓN. EL LISTÍN TELEFÓNICO
      contactos: [
       {nombre:"Victor", apellidos:"Mena", telefono:"123"},
      ],
    };
  }

  nuevoUsuario = (nombre,apellidos,telefono) => {
    let copia = this.state;

    let obj = {}
    obj.nombre = nombre;
    obj.apellidos = apellidos;
    obj.telefono=telefono;


    copia.contactos.push(obj)
    this.setState({copia})
  }

  render() {
    return (
      <div className="App">
        <Mostrar
          contactos={this.state.contactos}
        />
        <Altas nuevoUsuario={(nombre,apellidos,telefono)=>this.nuevoUsuario(nombre,apellidos,telefono)} />
      </div>
    );
  }
}
export default App;