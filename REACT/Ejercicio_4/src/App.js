import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Button, ToastHeader, Toast, ToastBody } from 'reactstrap';
import React, { Component } from 'react';

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      estadoVerde:false,
      descripcionVerde: "Bla Bla Bla Bla Bla es una descripción desde el estado de VERDE",
      tituloVerde: "Toast color VERDE",
      colorVerde:"white",
      estadoRojo:false,
      descripcionRojo: "Bla Bla Bla Bla Bla es una descripción desde el estado de ROJO",
      tituloRojo: "Toast color ROJO",
      colorRojo:"white",
      estadoAmarillo:false,
      descripcionAmarillo: "Bla Bla Bla Bla Bla es una descripción desde el estado de AMARILLO",
      tituloAmarillo: "Toast color AMARILLO",
      colorAmarillo:"white"
      
    };
  }

  cambiarEstadoVerde = ()=>{
    let aux = "p-3 bg-success my-2 rounded"
    let blanco = "white";
    this.setState({estadoVerde:!this.state.estadoVerde})
    if (this.state.colorVerde ==="white") {
      this.setState({colorVerde:aux})
    }else{
      this.setState({colorVerde:blanco})
    }
  }

  cambiarEstadoRojo = ()=>{
    let aux = "p-3 bg-danger my-2 rounded"
    let blanco = "white";
    this.setState({estadoRojo:!this.state.estadoRojo})
    if (this.state.colorRojo ==="white") {
      this.setState({colorRojo:aux})
    }else{
      this.setState({colorRojo:blanco})
    }
  }

  cambiarEstadoAmarillo = ()=>{
    let aux = "p-3 bg-warning my-2 rounded"
    let blanco = "white";
    this.setState({estadoAmarillo:!this.state.estadoAmarillo})
    if (this.state.colorAmarillo ==="white") {
      this.setState({colorAmarillo:aux})
    }else{
      this.setState({colorAmarillo:blanco})
    }
  }

  render() {
    return (
      <div>
        <Button color="success" outline onClick={this.cambiarEstadoVerde}>
          success
        </Button>
        <Button color="warning" outline onClick={this.cambiarEstadoAmarillo}>
          warning
        </Button>
        <Button color="danger" outline onClick={this.cambiarEstadoRojo}>
          danger
        </Button>
        <div className={this.state.colorVerde}>
          <Toast isOpen={this.state.estadoVerde} toogle={this.cambiarEstadoVerde}>
            <ToastHeader>
              {this.state.tituloVerde}
            </ToastHeader>
            <ToastBody>
              {this.state.descripcionVerde}
            </ToastBody>
          </Toast>
        </div>
        <div className={this.state.colorAmarillo}>
          <Toast isOpen={this.state.estadoAmarillo} toogle={this.cambiarEstadoAmarillo}>
            <ToastHeader>
              {this.state.tituloAmarillo}
            </ToastHeader>
            <ToastBody>
              {this.state.descripcionAmarillo}
            </ToastBody>
          </Toast>
        </div>
        <div className={this.state.colorRojo}>
          <Toast isOpen={this.state.estadoRojo} toogle={this.cambiarEstadoRojo}>
            <ToastHeader>
              {this.state.tituloRojo}
            </ToastHeader>
            <ToastBody>
              {this.state.descripcionRojo}
            </ToastBody>
          </Toast>
        </div>
      </div>
    );
  }
}

export default App;
