import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Button, Alert } from 'reactstrap';
import React, { Component } from 'react';

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      estadoAlerta: false, 
      estadoAlertaRojo:false,
    };
  }

  cambiarEstadoAlerta = () => {
    this.setState({ estadoAlerta: !this.state.estadoAlerta })
    this.setState({ estadoAlertaRojo: false })
  };

  cambiarEstadoAlertaRojo = () => {
    this.setState({ estadoAlertaRojo: !this.state.estadoAlertaRojo })
    this.setState({ estadoAlerta: false })
  };

  render() {
    return (
      <div className="App">
        <Button color="primary" onClick={this.cambiarEstadoAlerta}>
          Click me!
        </Button>
        <Button color="danger" onClick={this.cambiarEstadoAlertaRojo}>Click me!</Button>
        {this.state.estadoAlerta && (
          <Alert color="info" toggle={this.cambiarEstadoAlerta}>
            Soy una alerta Azul!
          </Alert>
        )}
        {this.state.estadoAlertaRojo && (
          <Alert color="danger" toggle={this.cambiarEstadoAlertaRojo}>
            Soy una alerta rojo!
          </Alert>
        )}
      </div>
    );
  }
}

export default App;
