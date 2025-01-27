import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import React, { useState } from 'react';

import { Component } from 'react';
import {
  Alert, Row, Col, UncontrolledAccordion, AccordionItem, AccordionHeader, AccordionBody, Input, Button, Modal, ModalHeader, ModalBody, ModalFooter, FormGroup, Label
 } from 'reactstrap';
 
const VentanaModal = (props) => {
  const { className } = props;

  const [total, setTotal] = useState('');
  const [meses, setMeses] = useState("6");
  const [tae, setTae] = useState("6");
  const [info, setInfo] = useState('Inserte los datos');

  const handleChange = (event) => {
    setInfo('');
    const target = event.target;
    if (target.name == "total") {
        setTotal(target.value);
    }
    if (target.name == "meses") {
        setMeses(target.value);
    }
    if (target.name == "tae") {
      setTae(target.value);
  }
  }

  const pasarDatos = () => {
    if(total === " "){
      setInfo("Inserte los datos")
    }else{
      setInfo("")
      props.aceptar(total,meses,tae);
    }
      
    
  };
 
  return (
    <div>
      <Modal isOpen={props.mostrar} toggle={props.toggle} className={className} onEntering={"//ESTO SE EJECUTA CUANDO MUESTRAS LA VENTANA"}>
        <ModalHeader toggle={props.toggle}>{props.titulo}</ModalHeader>
        <ModalBody>
          <FormGroup row>
            <Label sm={2} > Cantidad a pedir: </Label>
            <Col sm={10}>
              <Input onChange={handleChange}
                id="total"
                name="total"
                type="Text" />
            </Col>
          </FormGroup>
          <FormGroup row>
            <Col sm={12}>
            <Input onChange={handleChange} onClick={handleChange}
                id="meses"
                name="meses"
                type="number"
                min={6}
                max={36}
                value={meses} 
              >
              </Input>
              <br/>
              <Input onChange={handleChange} onClick={handleChange}
                id="tae"
                name="tae"
                type="select"
                value={tae}
              >
                <option value={5}>5%</option>
                <option value={6}>6%</option>
                <option value={7}>7%</option>
                <option value={8}>8%</option>
                <option value={8}>9%</option>
              </Input>
              <br/>
                {info}
            </Col>
          </FormGroup>
        </ModalBody>
        <ModalFooter>
          <Button color="primary" onClick={pasarDatos}>{props.botonAceptar}</Button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </ModalFooter>
      </Modal>
    </div>
  );
}


class App extends Component {
  constructor(props){
    super(props)
    this.state = {
      isOpen:false,
    }
  }
  
  setIsOpen(d){
    if (d===undefined) return;
    this.setState({isOpen:d})
  }
  
  aceptar(total,meses,tae){
      this.toggleModal();

      let r = (tae / 100) /12

      let cuota = (total*r)/(1-Math.pow((1+r),-meses))
   
      console.log("La cuota es: "+Math.round(cuota)+" al mes.")
    
  }

  toggleModal(){this.setIsOpen(!this.state.isOpen)}

  render() {
    return (
      <div className="App">
        <Button onClick={()=>{this.toggleModal()}}>
          Dale
        </Button>
        <VentanaModal 
            aceptar={(total,meses,tae)=>this.aceptar(total,meses,tae)}
            mostrar={this.state.isOpen}
            botonAceptar={"Calcular"}
            titulo={"CALCULO DE TU CUOTA"}
        />

      </div>
    );
  }
}

export default App;
