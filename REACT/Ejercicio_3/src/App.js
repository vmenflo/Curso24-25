import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Button, Popover, PopoverHeader,PopoverBody  } from 'reactstrap';
import React, { Component } from 'react';

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      estado:false,
      descripcion: "Bla Bla Bla Bla Bla es una descripción desde el estado",
      titulo: "Pólitica y Privacidad"
    };
  }

  cambiarEstado = ()=>{
    this.setState({estado:!this.state.estado})
  }

  render() {
    return (
      <div>
        <Button
          id="Popover1"
          type="button"
        >
          Términos y Condiciones
        </Button>
        <Popover
          isOpen={this.state.estado}
          target="Popover1"
          toggle={this.cambiarEstado}
        >
          <PopoverHeader>
            {this.state.titulo}
          </PopoverHeader>
          <PopoverBody>
            {this.state.descripcion}
          </PopoverBody>
        </Popover>
      </div>
    );
  }
}

export default App;
