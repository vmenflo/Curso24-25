import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Button,Modal, ModalBody,ModalHeader, ModalFooter } from 'reactstrap';
import React, { Component } from 'react';

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      estadoAlerta: false,
      descripcion: "Bla Bla Bla Bla Bla es una descripción desde el estado",
      titulo: "Esto es un titulo desde el estado"
    };
  }

  cambiarEstadoAlerta = () => {
    this.setState({ estadoAlerta: !this.state.estadoAlerta })
  };


  render() {
    return (
      <div className="App">
        <Button color="danger" onClick={this.cambiarEstadoAlerta}>
          Click me!
        </Button>
        <Modal isOpen={this.state.estadoAlerta} toggle={this.cambiarEstadoAlerta}>
        <ModalHeader toggle={this.cambiarEstadoAlerta}>{this.state.titulo}</ModalHeader>
        <ModalBody>
          {this.state.descripcion}
        </ModalBody>
        <ModalFooter>
          <Button color="primary" onClick={this.cambiarEstadoAlerta}>
            Do Something
          </Button>{' '}
          <Button color="secondary" onClick={this.cambiarEstadoAlerta}>
            Cancel
          </Button>
        </ModalFooter>
      </Modal>
        
      </div>
    );
  }
}

export default App;
