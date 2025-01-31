import React, { Component, useState } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import {
  Alert, Row, Col, UncontrolledAccordion, AccordionItem, AccordionHeader, AccordionBody, Input, Button, Modal, ModalHeader, ModalBody, ModalFooter, FormGroup, Label
 } from 'reactstrap';

const VentanaModal = (props) => {
  const { className } = props;
  const handleChange = (event) => {
    // COMPLETA ESTA FUNCION
  }

 
  return (
    <div>
      <Modal isOpen={props.mostrar} toggle={props.toggle} className={className} onEntering={"//ESTO SE EJECUTA CUANDO MUESTRAS LA VENTANA"}>
        <ModalHeader toggle={props.toggle}>{props.titulo}</ModalHeader>
        <ModalBody>
          <FormGroup row>
            <Label sm={2} > Nombre: </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="nombre"
                name="nombre"
                type="nombre" />
            </Col>
          </FormGroup>
          <FormGroup row>
          <Label sm={2} > Apellidos: </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="apellidos"
                name="apellidos"
                type="apellidos" />
            </Col>
          </FormGroup>
          <FormGroup row>
          <Label sm={2} > Telefono: </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="telefono"
                name="telefono"
                type="telefono" />
            </Col>
          </FormGroup>
        </ModalBody>
        <ModalFooter>
          <Button color="primary" onClick={props.toggle}>Cancelar</Button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <Button color="primary" onClick={()=>props.aceptar("NECESITA DATOS")}>Aceptar</Button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </ModalFooter>
      </Modal>
    </div>
  );
}

const Lista = ({ usuarios }) => {
  
  let copia = usuarios;

  return (
    <>
      <h2>Listado</h2>
      <ul>
      {copia.map(u=> {
        return(<li>
          {u.nombre} - {u.apellidos} - {u.telefono} 
        </li>)
      })}
    </ul>
    </>
  );
}


class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      contactos: [
       {nombre:"Victor", apellidos:"Mena", telefono:"123"},
      ],
      isOpen:false,
    };
  }

  abrirAlta(){
    this.setState({isOpen:true})
  }

  aceptar(datos){
    console.log(datos)
    this.toggleModal();
  }

  toggleModal(){this.setIsOpen(!this.state.isOpen)}

  render() {
    return (
      <div className="App">
       <Lista usuarios={this.state.contactos}/>
       <Button onClick={()=>this.abrirAlta()}>Dar de alta</Button>
       <VentanaModal 
            aceptar={(datos)=>this.aceptar(datos)}
            mostrar={this.state.isOpen}
            botonAceptar={"Calcular"}
            titulo={"Introduce los datos del USUARIO"}
            toogle={()=>this.toggleModal()}
        />
      </div>
    );
  }
}
export default App;